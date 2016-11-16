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
    }
}
