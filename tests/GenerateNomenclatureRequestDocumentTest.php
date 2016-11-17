<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GenerateNomenclatureRequestDocumentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $nomenclatureRequest = \App\NomenclatureRequest::first();
        $test = (new \App\Jobs\GenerateNomenclatureRequestDocument($nomenclatureRequest))->delay(2);
        dispatch($test);
    }
}
