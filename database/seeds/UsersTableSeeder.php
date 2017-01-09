<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        $user = factory(\App\User::class)->make();
        $user->email = 'test@test.test';
        $user->password = 'password';
        $user->user_position_id = 1;
        $user->regenerateApiToken();
        $user->save();

        factory(\App\User::class, 44)->make()->each(function (\App\User $user) {
            $user->user_position_id = 1;
            $user->regenerateApiToken();
            $user->save();
        });

        $u3 = \App\User::find(3);
        $u3->email = 'stmed@mail.ru';
        $u3->password = 'password';
        $u3->save();

        $u4 = \App\User::find(4);
        $u4->permission_id = 2;
        $u4->email = 'ph@mail.ru';
        $u4->password = 'password';
        $u4->save();

        $u5 = \App\User::find(5);
        $u5->permission_id = 3;
        $u5->email = 'chief@mail.ru';
        $u5->password = 'password';
        $u5->save();

        $u6 = \App\User::find(6);
        $u6->permission_id = 4;
        $u6->password = 'password';
        $u6->email = 'rd@mail.ru';
        $u6->save();
    }
}
