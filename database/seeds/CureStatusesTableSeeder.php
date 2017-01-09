<?php

use Illuminate\Database\Seeder;

class CureStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CureStatus::truncate();

        $types = collect(['income', 'outgoing', 'in_hospital']);
        $names = [
            'income' => "Госпитализация",
            'outgoing' => "Выписка",
            'in_hospital' => "Перевод по больнице"
        ];
        $types->each(function ($item) use ($names) {
            $status = new \App\CureStatus();
            $status->name = $names[$item];
            $status->type = $item;
            $status->save();
        });
    }

}
