<?php

class MedicamentIncomeOutgoingTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        auth()->loginUsingId(1);

        $medicament = \App\Nomenclature::find(1);
        $batch = $medicament->batches->first();

        $amount = rand(100, 500);
//        $medicament->income($amount, $batch);
//        $medicament->outgoing($amount, $batch);
    }
}
