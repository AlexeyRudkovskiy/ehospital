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

        $i = 1;
        factory(\App\Department::class, $departments->count())->make()->each(function (\App\Department $department) use ($departments, &$i) {
            $_i = $i * 3;
            $department->name = $departments->pop();
            $department->save();
            $department->leader()->associate(1);
            $usersInDepartment = [ $_i, $_i - 1, $_i - 2 ];

            foreach ($usersInDepartment as $item) {
                $user = \App\User::find($item);
                $user->department()->associate($department);
                $user->save();
            }

            $i += 1;
        });

        $i = 1;

        \App\Department::all()->each(function (\App\Department $department) use (&$i) {
            $departmentId = $department->id * 3;
            $department->leader_id = $departmentId;

            $userIds = [ $departmentId, $departmentId - 1, $departmentId - 2 ];

            foreach ($userIds as $userId) {
                \App\User::find($userId)->update([
                    'department_id' => $department->id
                ]);
            }

            $department->save();
        });

//        \App\User::all()->each(function (\App\User $user) {
//            $user->department_id = 1;
//            $user->save();
//        });

    }
}
