<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 30.01.17
 * Time: 9:27
 */


use App\Department;


class DepartmentTest extends TestCase
{



    public function testIncomeNomenclature()
    {
        $department = Department::first();
        $nomenclature = \App\Nomenclature::first();

        $response = $department->nomenclatureIncome($nomenclature, 5);
        $this->assertArrayHasKey('in_stock', $response);
    }

    public function testArmorNomenclature()
    {
        $department = Department::first();
        $nomenclature = \App\Nomenclature::first();

        $response = $department->armorNomenclature($nomenclature, 5);
        $this->assertNotNull($response);
    }

}
