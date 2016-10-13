<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MedicamentBatch
 *
 * @author Alexey Rudkovskiy
 * @package App
 */
class MedicamentBatch extends Model
{

    /**
     * Указываем, какие поля можно заполнять
     *
     * @var array
     */
    protected $fillable = [
        'expiration_date',
        'batch_number',
        'price',
        'medicament_id'
    ];

    /**
     * Медикамент, к которому относится серия
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(MedicamentBatch::class);
    }

}
