<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$lang = 'uk_UA';
$faker = Faker\Factory::create($lang);

$factory->define(App\User::class, function () use ($faker) {
    return [
        'firstName' => $faker->firstName,
        'middleName' => 'MiddleName',
        'lastName' => $faker->lastName,
        'password' => str_random(20),
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'cryptKey' => md5(\Crypt::encrypt(str_random(32) . md5($faker->firstNameFemale))),
        'organization_id' => 1,
        'permission_id' => 1
    ];
});

$factory->define(\App\Permission::class, function () use ($faker) {
    return [
        'name' => 'global',
        'map' => json_encode([
            'organization' => [
                'view' => true,
                'create' => true,
                'edit' => true,
                'delete' => true
            ]
        ])
    ];
});

$factory->define(\App\Organization::class, function () use ($faker) {
    return [
        'name' => $faker->company,
        'type' => 'legal'
    ];
});

$factory->define(\App\Medicament::class, function () use ($faker) {
    return [
        'name' => $faker->words(6, true)
    ];
});

$factory->define(\App\ContractorGroup::class, function () use ($faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(\App\Contractor::class, function () use ($faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'fullName' => $name,
        'type' => $faker->numberBetween() % 2 == 0 ? 'legal' : 'private',
        'edrpou' => $faker->numberBetween(10000000, 99999999),
        'contractor_group_id' => 1
    ];
});

$factory->define(\App\Patient::class, function () use ($faker) {
    $userId = $faker->randomNumber(6) % 2 ? 1 : 2;
    return [
        'name' => $faker->name,
        'birthday' => $faker->date(),
//        'birthday' => $faker->numberBetween(16, 70),
        'phone' => $faker->phoneNumber,
        'homeless' => $faker->randomNumber() % 2 == 0 ? true : false,
        'ukrainian' => true,
        'hospital_employee' => false,
        'user_id' => $userId,
        'first_user_id' => $userId
    ];
});

$factory->define(\App\Address::class, function () use ($faker) {

    $city = [
        'Запорожье', 'Киев', 'Днепропетровск', 'Харьков', 'Львов'
    ];

    return [
        'country' => 'Украина',
        'region' => Faker\Provider\uk_UA\Address::region(),
        'city' => $faker->randomElement($city),
        'street' => "ул. Печерская",
        'house_number' => 33,
        'apartment' => '14'
    ];
});

$factory->define(\App\Department::class, function () use ($faker) {
    $totalBeds = $faker->numberBetween(0, 100);
    $totalBedsInRepair = $faker->numberBetween(0, $totalBeds);
    $femaleBeds = $faker->numberBetween(0, $totalBeds - $totalBedsInRepair);
    $maleBeds = $faker->numberBetween(0, $totalBeds - $totalBedsInRepair - $femaleBeds);

    return [
        'name' => 'Онкология',
        'leader_id' => \App\User::inRandomOrder()->get()->first()->id,
        'organization_id' => 1,
        'department_code' => $faker->randomNumber(),
        'beds_amount' => $totalBeds,
        'beds_amount_in_repair' => $totalBedsInRepair,
        'female_beds_amount' => $femaleBeds,
        'male_beds_amount' => $maleBeds,
    ];
});
