<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NomenclatureIncome extends Model
{

    protected $fillable = [
        'source_of_financing_id',
        'contractor_id',
        'agreement_id',
        'storage_id',
        'created_by',
        'nomenclatures'
    ];

    protected $casts = [
        'nomenclatures' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sourceOfFinancing()
    {
        return $this->belongsTo(SourceOfFinancing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    public function data()
    {
        return (object)[
            'contractor' => $this->contractor->name,
            'storage' => $this->storage->name,
            'sourceOfFinancing' => $this->sourceOfFinancing->name,
            'agreement' => $this->agreement,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->created_at->format('d.m.Y H:i'),
            'nomenclatures' => $this->getNomenclatures()
        ];
    }

    private function getNomenclatures() {
        $data = [];

        foreach ($this->nomenclatures as $item) {
            array_push($data, (object)[
                'id' => $item['nomenclature_id'],
                'name' => Nomenclature::where('id', $item['nomenclature_id'])->pluck('name', 'id')->first(),
                'amount' => (int)($item['amount']),
                'price' => (float)($item['price']),
                'unit' => Unit::find($item['unit_id'])
            ]);
        }

        return $data;
    }

}
