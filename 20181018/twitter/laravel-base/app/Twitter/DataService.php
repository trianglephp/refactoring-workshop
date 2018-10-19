<?php

namespace App\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

class DataService implements ServiceClient
{
    private $client;

    public function __construct(TwitterOAuth $client = null)
    {
        $this->client = $client ?? new TwitterOAuth(
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    public function getCycleList(int $userID) : \stdClass
    {
        $lists = $this->client->get("lists/list", ["user_id" => $userID]);
        return $list[0];
    }

    public function getFilteredTimeline(int $userID, \DateTimeImmutable $cutoff) : \Generator
    {
        foreach ($this->timelineFeed($userID) as $status) {
            if (
                $status->in_reply_to_user_id ||
                isset($status->retweeted_status) ||
                isset($status->quated_status)
            ) {
                yield $status;
            }

        }
    }

    private function timelineFeed(int $userID, \DateTimeImmutable $cutoff) : \Generator
    {
        $conditions = [
            'user_id' => $userID,
            'include_rts' => true,
            'exclude_replies' => false,
            'count' => 3200
        ];
        $finished = false;
        while (!$finished) {
            $data = $this->client->get(
                "statuses/user_timeline",
                $conditions
            );

            // Loop through and grab the oldest ID
            foreach ($data as $status) {
                if (strtotime($status->created_at) >= $cutoff) {
                    yield $status;
                    $max_id = $status->id;
                } else {
                    break;
                    $finished = true;
                }
            }

            if (isset($conditions['max_id'])) {
                if ($conditions['max_id'] == $max_id) {
                    $finished = true;
                }
            }

            $conditions['max_id'] = $max_id;
        }
    }
}
