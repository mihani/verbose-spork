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
    public $event_id;

    /** @var string */
    public $event_type;

    /** @var array   */
    public $form_response;
}
