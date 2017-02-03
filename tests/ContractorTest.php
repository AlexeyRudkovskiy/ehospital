<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 02.02.17
 * Time: 18:12
 */


use App\Contractor;


class ContractorTest extends TestCase
{

    public function testComments()
    {
        $contractor = Contractor::first();
        $comment = $contractor->comments()->create([
            'text' => 'Test comment',
            'user_id' => 1
        ]);
        $this->assertNotNull($comment->id);
    }

}
