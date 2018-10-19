<?php

namespace App\Twitter;

interface ServiceClient
{
    public function getCycleList(int $userID) : \stdClass;

    public function getFilteredTimeline(int $userID, \DateTimeImmutable $cutoff) : \Generator;
}
