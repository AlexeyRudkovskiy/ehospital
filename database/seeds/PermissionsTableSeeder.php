<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Permission::truncate();

        factory(\App\Permission::class)->create();

        \App\Permission::create([
            'name' => 'pharmacist',
            'map' => json_encode([
                'organization' => [
                    'index' => true,
                    'store' => true,
                    'update' => true,
                    'show' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'department' => [
                    'index' => true,
                    'store' => true,
                    'update' => true,
                    'show' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'contractor' => [
                    'index' => true,
                    'store' => true,
                    'update' => true,
                    'show' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ]
            ]),
            'sidebar' => json_encode([
                [
                    'name' => "Номенклатура",
                    'items' => [
                        [ 'path' => "nomenclature.index" ],
                        [ 'path' => "contractor.index" ],
                        [ 'path' => 'atcClassification.index' ],
                        [ 'path' => 'manufacturer.index' ],
                        [ 'path' => 'nomenclatureIncome.index' ],
                        [ 'path' => 'nomenclature.requests' ]
                    ]
                ]
            ])
        ]);

        \App\Permission::create([
            'name' => 'chief_medical_officer',
            'map' => json_encode([
                'organization' => [
                    'index' => true,
                    'store' => true,
                    'update' => true,
                    'show' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ],
                'cure' => [
                    'index' => true,
                    'store' => true,
                    'update' => true,
                    'show' => true,
                    'create' => true,
                    'edit' => true,
                    'delete' => true
                ]
            ]),
            'sidebar' => json_encode([
                [
                    'name' => "Пациенты",
                    'items' => [
                        [ 'path' => "patient.index" ]
                    ]
                ]
            ])
        ]);

        \App\Permission::create([
            'name' => 'emergency_department',
            'map' => json_encode([  ]),
            'sidebar' => json_encode([
                [
                    'name' => "Приёмный покой",
                    'items' => [
                        [ 'path' => "patient.emergency_department" ]
                    ]
                ]
            ])
        ]);
    }
}
