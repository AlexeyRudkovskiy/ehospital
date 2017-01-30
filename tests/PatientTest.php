<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 30.01.17
 * Time: 11:10
 */


use App\Events\Patient\CureHeadNurseReview;
use App\Patient;
use Carbon\Carbon;


class PatientTest extends TestCase
{

    public function testPostHospitalization()
    {

        $calendarValue = json_decode('{
      "1.1.2017": {
        "nomenclatures": [
          {
            "name": "test",
            "measure": "1"
          }
        ],
        "procedures": [],
        "tag": "1.1.2017"
      },
      "2.1.2017": {
        "nomenclatures": [
          {
            "name": "test",
            "measure": "1"
          }
        ],
        "procedures": [],
        "tag": "2.1.2017"
      },
      "4.1.2017": {
        "nomenclatures": [
          {
            "name": "test 2",
            "measure": "2"
          }
        ],
        "procedures": [],
        "tag": "4.1.2017"
      }
    }');

        $cure = new \App\Cure();

        $cure->patient_id = 50;
        $cure->department_id = 1;
        $cure->user_id = 1;
        $cure->cure_status_id = 1;
        $cure->hospitalization_date = \Carbon\Carbon::parse('2017-01-30 00:00:00.000000');
        $cure->diagnosis = substr(md5(rand(0, 99999999)), 0, 10);
        $cure->review = [
            'destination_list' => $calendarValue,
            'requested' => $calendarValue,
            'accepted' => new \stdClass(),
            'headNurse' => false,
            'chief' => false,
            'accepted_date' => null,
            'chief_date' => null,
            'requested_date' => Carbon::today(),
            'headNurse_id' => 0,
            'chief_id' => 0
        ];

        $response = $cure->save();
        $this->assertNotNull($response);
        $response = event(new CureHeadNurseReview($cure));
        $this->assertNotNull($response);

    }

}
