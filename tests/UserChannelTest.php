<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 31.01.17
 * Time: 9:54
 */


use App\Classes\UserChannel;


class UserChannelTest extends TestCase
{

    public function testEvent()
    {
        auth()->loginUsingId(1);
        $cure = \App\Cure::first();

        event(new \App\Events\Patient\CureChiefReview($cure));
    }

}
