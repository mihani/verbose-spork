<?php

namespace App\Dto;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
final class TypeformAnswerPayload
{
    public string $eventId;

    public string $eventType;

    public FormResponseDto $formResponse;
}
