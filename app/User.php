<?php

namespace App;

use App\Traits\EncryptionTrait;
use App\Traits\RevisionsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class User extends Authenticatable
{

    /**
     * Поля, которые можно заполнять с помощью User::create(), User::fill(), User::update()
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'password',
        'email',
        'phone',
        'cryptKey',
        'organization_id',
        'permission_id',
        'department_id',
        'parent_id'
    ];

    /**
     * При загрузки модели так же загружаем указанные связи
     *
     * @var array
     */
    protected $with = [
        'permission',
        'position'
    ];

    /**
     * Поля, которые необходимо шифровать.
     * При задании значения, оно будет автоматически шифроваться.
     * При извлечении данных - расшифровываться.
     * Для расшифровки используется уникальный для каждого пользователя ключ.
     * Если расшифровать не получилось - результатом будет мусор.
     *
     * @var array
     */
    protected $encrypted = [  ];

    /**
     * Автоматически шифруем пароль, что бы не следить за этим где-либо ещё
     *
     * @param string $password Пароль, который нужно установит текущим
     */
    public function setPasswordAttribute ($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Получаем доступ к родителю пользователя.
     * Родитель - тот, кто ответственный за этого человека.
     * У одного пользователя может быть один родитель,
     * однако пользователь может выступать родителем для многих пользователей.
     *
     * @see \App\User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent ()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Пациенты, к которым открыт доступ
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function additionalPatients()
    {
        return $this->belongsToMany(Patient::class, 'patient_users', 'user_id');
    }

    /**
     * Отделение, к которому относится пользователь
     *
     * @see \App\Department
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Группа прав пользователя
     *
     * @see \App\Permission
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Организация, к которой относится пользователь
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class)->orderBy('id', 'desc');
    }

    /**
     * Комментарии пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');
    }

    /**
     * Изменения, которые были сделаны пользователем
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisions()
    {
        return $this->hasMany(Revision::class)->orderBy('id', 'desc');
    }

    /**
     * Расписание пользователя.
     * Дни работы, со скольки и до скольки работает врач и сколько времени отведено на обслуживание одного пациента.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedule()
    {
        return $this->hasMany(UserSchedule::class)->orderBy('day_of_week', 'asc');
    }

    /**
     * Должность пользователя
     *
     * @see \App\UserPosition
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(UserPosition::class, 'user_position_id');
    }

    /**
     * Забронированное время
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function armored()
    {
        return $this->hasMany(ArmoredTime::class);
    }

    /**
     * Проверяет, имеет ли данная группа доступ на что-либо.
     * Этот метод вызывает метод с таким же именем, но у объекта Permission с небольшими преобразованиями.
     * Метод принимает объект, в котором используется трэйт Permissible и вызывает егго метод getActionScope.
     * Этот метод вернёт нам путь, по которому можем проверить, имеет ли группа прав доступ к нужному нам действию.
     *
     * @param Model $model
     * @param string $action
     * @return bool mixed
     * @internal param string $what
     * @see \App\Traits\Permissible
     * @see \App\Traits\Permissible::getActionScope()
     * @see Permission::granted()
     */
    public function granted(Model $model, string $action)
    {
        if (!isset($this->permission)) {
            return false;
        }
        if (!method_exists($model, 'getActionScope')) {
            $modelFullClassName = get_class($model);
            throw new \InvalidArgumentException("$modelFullClassName does not contains getActionScope method");
        }
        $permissionScope = $model->getActionScope($action);
        return $this->permission->granted($permissionScope);
    }

    /**
     * Полное имя доктора
     *
     * @return string
     */
    public function fullName()
    {
        return "{$this->lastName} {$this->firstName} {$this->middleName}";
    }

    public function getScheduleFor(Carbon $day)
    {
        $scheduleInfo = $this->schedule()->where('day_of_week', $day->dayOfWeek)->get()->first();
        $schedule = [];

        $from = $scheduleInfo->from;
        $to = $scheduleInfo->to;
        $step = Carbon::parse($scheduleInfo->per_patient);
        $step->day = 0;
        $step->year = 0;
        $step->month = 0;
        $current = Carbon::create($from->year, $from->month, $from->day, $from->hour, $from->minute, $from->second);

        $locked = ArmoredTime::where('day_of_week', $day->dayOfWeek)->where('day', $day)->get();

        array_push($schedule, $from->format('G:i'));

        do {
            $current->addMinutes($step->minute);
            $current->addHours($step->hour);

            $shouldSkip = false;

            foreach ($locked as $lockedItem) {
                $lockedItem = $lockedItem->time;
                if ($lockedItem->hour == $current->hour && $lockedItem->minute == $current->minute) {
                    $shouldSkip = true;
                    break;
                }
            }

            if (!$shouldSkip) {
                array_push($schedule, $current->format('G:i'));
            }
        } while ($current->between($to, $from, false));

        array_pop($schedule);

        return $schedule;
    }

}
