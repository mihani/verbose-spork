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
            'fields' => [],
        ],
        'answers' => [],
    ];

    /** @var string */
    public string $eventId;

    /** @var string */
    public string $eventType;

    /** @var array */
    public array $formResponse;
}
