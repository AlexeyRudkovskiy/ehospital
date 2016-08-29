<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrganizationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(ContractorGroupsTableSeeder::class);
        $this->call(ContractorsTableSeeder::class);

        $this->call(DepartmentsTableSeeder::class);

        $this->call(PatientsTableSeeder::class);

//        $this->call(MedicamentsTableSeeder::class);
    }
}
