<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class FormatedAnswerCreateEvent extends Event
{
    public const NAME = 'formated_answer.create';

    private string $groupByToken;

    public function __construct(string $groupByToken)
    {
        $this->groupByToken = $groupByToken;
    }

    public function getGroupByToken()
    {
        return $this->groupByToken;
    }
}
