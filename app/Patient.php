<?php

namespace App;

use App\Traits\EncryptionTrait;
use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Patient
 *
 * Имеет зашифрованные данные, доступны только доктору врача и его руководству.
 * Например, старшая медсестра врача, за которым закреплён пациент, может читать данные о пациенте и его истории болезни.
 * Другие же медсёстры и врачи этого делать не могут.
 * Однако пациент может иметь несколько дополнительных врачей, тогда и они будут иметь доступ к его личным данным.
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class Patient extends Model
{

    use RevisionsTrait;
    use EncryptionTrait;

    /**
     * Отключаем колонки created_at, updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Разрешаем заполнять эти поля
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthday',
        'phone',
        'homeless',
        'ukrainian',
        'hospital_employee'
    ];

    protected $encrypted = [
        'name', 'birthday', 'phone', 'homeless', 'ukrainian', 'hospital_employee'
    ];

    protected $casts = [
        'homeless' => 'bool',
        'ukrainian' => 'bool',
        'hospital_employee' => 'bool'
    ];

    protected $with = [
        'inspection'
    ];

    /**
     * Даём возможность комментировать пациента врачём или группой врачей
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('id', 'desc');
    }

    /**
     * Основной лечащий врач в данный момент
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Врачи, которые так же имеют доступ к этому пациенту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(User::class, 'patient_users', 'patient_id');
    }

    /**
     * Пользователь, создавший этого пациента.
     * Используется для шифрования
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Адреса проживания пациента
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable')->orderBy('id', 'desc');
    }

    /**
     * Курсы лечения пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cures()
    {
        return $this->hasMany(Cure::class)->orderBy('id', 'desc');
    }

    public function inspection()
    {
        return $this->hasOne(Inspection::class, 'patient_id');
    }

    /**
     * Статусы пользователя.
     * Тут хранится информация когды был госпитализирован\выписан, куда был переведён.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {
        return $this->hasMany(PatientStatus::class)->orderBy('id', 'desc');
    }

    /**
     * Определяет, имеет ли текущий доктор, или доктор указанный в качестве первого аргумента, доступ к пациенту и его истории в расшифрованном виде
     *
     * @param User|null $user
     * @return bool
     */
    public function granted (User $user = null) {
        if ($user == null) {
            $user = auth()->user();
        }

        $doctors = $this->getDoctors();
        $doctorsIds = $doctors->map(function (User $user) {
            return $user->id;
        });
        return $doctorsIds->contains($user->id);
    }

    /**
     * Возвращает список врачей, отсносящихся к этому пациенту в данный момент
     *
     * @return Collection
     */
    public function getDoctors()
    {
        $doctors = collect($this->doctors->toArray());
        $doctors->prepend($this->doctor);

        return $doctors;
    }

    public function setHomelessAttribute($data)
    {
        $this->attributes['homeless'] = strlen($data) > 0;
    }

    public function setUkrainianAttribute($data)
    {
        $this->attributes['ukrainian'] = strlen($data) > 0;
    }

    public function getEncrypter()
    {
        return $this->createdBy->getEncrypter();
    }

}
