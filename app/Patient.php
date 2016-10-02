<?php

namespace App;

use App\Traits\EncryptionTrait;
use App\Traits\RevisionsTrait;
use Illuminate\Database\Eloquent\Model;
use Psy\Test\CodeCleaner\StaticConstructorPassTest;

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
        'name', 'birthday'
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
     * Врачи, которые так же имеют доступ к этому пациенту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(User::class, 'patient_users', 'patient_id');
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

}
