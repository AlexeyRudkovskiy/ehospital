<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NomenclatureIncome extends Model
{

    protected $fillable = [
        'source_of_financing_id',
        'contractor_id',
        'agreement_id',
        'storage_id',
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
    protected function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function data()
    {
        return (object)[
            'contractor' => $this->contractor->name,
            'storage' => $this->storage->name,
            'sourceOfFinancing' => $this->sourceOfFinancing->name,
            'agreement' => $this->agreement,
            'nomenclatures' => $this->getNomenclatures()
        ];
    }

    private function getNomenclatures() {
        $data = [];

        foreach ($this->nomenclatures as $item) {
            array_push($data, [
                'nomenclature' => Nomenclature::where('id', $item['nomenclature_id'])->pluck('name', 'id'),
                'amount' => (int)($item['amount']),
                'price' => (float)($item['price']),
                'unit' => Unit::find($item['unit_id'])
            ]);
        }

        return (object)$data;
    }

}
