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
        \DB::statement("SET foreign_key_checks=0");
        $this->call(OrganizationsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(ContractorGroupsTableSeeder::class);
        $this->call(ContractorsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);

        $this->call(CureStatusesTableSeeder::class);

        $this->call(CountriesTableSeeder::class);
        $this->call(PatientsTableSeeder::class);

        $this->call(SourceOfFinancingsTableSeeder::class);
        $this->call(StoragesTableSeeder::class);

//        $this->call(MedicamentsTableSeeder::class);
        \DB::statement("SET foreign_key_checks=1");

        Artisan::call('patient:encrypt');
    }
}
