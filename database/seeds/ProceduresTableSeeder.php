<?php

use Illuminate\Database\Seeder;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Procedure::truncate();

        $procedures = [
            'Общий анализ крови', 'Анализ крови на глюкозу', 'Группа крови, резус фактор', 'Электрокардиограмма'
        ];

        collect($procedures)->each(function ($item) {
            \App\Procedure::create([
                'name' => $item
            ]);
        });
    }

}
