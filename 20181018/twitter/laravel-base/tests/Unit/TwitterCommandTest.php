<?php

namespace Tests\Unit;

use Tests\TestCase;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Console\Commands\UpdateTwitterList;

class TwitterCommandTest extends TestCase
{
    public function testBasicTest()
    {
        $mockClient = $this->getMockBuilder(TwitterOAuth::class)
            ->setMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();
        $timeLineConditions = [
            'user_id' => 0,
            'include_rts' => true,
            'exclude_replies' => false,
            'count' => 3200
        ];
        $mockClient->expects($this->any())->method('get')
            ->will($this->returnValueMap([
                ["lists/list", ["user_id" => 0], [(object)["id" => 10920]]],
                ["statuses/user_timeline", $timeLineConditions], [(object)['created_at' => strtotime('now')]]
            ]));
        $subject = new UpdateTwitterList($mockClient);
        $subject->handle();
    }
}
