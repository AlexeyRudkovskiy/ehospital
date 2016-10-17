<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Department::truncate();

        $departments = [
            'Онкология',
            'Алергилогия',
            'Агнестезиология №2',
            'Артрология',
            'Гастроэнтерология',
            'Гематология',
            'Гинекология',
            'Глазное',
            'Госпитальное',
            'Кардиология',
            'Кардиореанимация',
            'Кардиохирургия',
            'КДЛ',
            'ЛОР',
            'Микрохирургия глаза'
        ];

        $departments = collect($departments)->shuffle();

        factory(\App\Department::class, $departments->count())->make()->each(function (\App\Department $department) use ($departments) {
            $department->name = $departments->pop();
            $department->save();
            $department->leader()->associate(\App\User::inRandomOrder()->get()->first());
        });
    }
}
