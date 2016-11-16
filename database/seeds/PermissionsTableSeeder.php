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
            'name' => 'global',
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
                        [ 'path' => 'nomenclatureIncome.index' ]
                    ]
                ]
            ])
        ]);
    }
}
