<?php

namespace App\Dto;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class TypeformAnswerPayload
{
    public const PAYLOAD_PATTERN = [
        'definition' => [
            'id' => '',
            'title' => '',
            'fields' => []
        ],
        'answers' => []
    ];

    /** @var string */
    public $eventId;

    /** @var string */
    public $eventType;

    /** @var array */
    public $formResponse;
}
