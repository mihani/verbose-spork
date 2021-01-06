<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\AnswerDto;
use App\Dto\DefinitionFieldDto;
use App\Dto\FieldDto;
use App\Dto\TypeformAnswerPayload;
use App\Entity\Answer;
use App\Traits\EntityManagerInterfaceTrait;

final class TypeformAnswerPayloadDataTransformer implements DataTransformerInterface
{
    use EntityManagerInterfaceTrait;

    /**
     * @param TypeformAnswerPayload $object
     *
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        $definitionFields = [];
        foreach ($object->formResponse->definition->fields as $field) {
            $definitionFields[] = new DefinitionFieldDto(
                $field['id'],
                $field['title'],
                $field['type'],
                $field['ref'],
                isset($field['allow_other_choice']) ? (bool) $field['allow_other_choice'] : null,
                $field['choices'] ?? null,
            );
        }

        $object->formResponse->definition->fields = $definitionFields;

        $answers = [];
        foreach ($object->formResponse->answers as $answer) {
            $answers[] = new AnswerDto(
                $answer['type'],
                'choice' === $answer['type'] ? json_encode($answer[$answer['type']]) : $answer[$answer['type']],
                new FieldDto(
                    $answer['field']['id'],
                    $answer['field']['type'],
                    $answer['field']['ref'],
                ),
            );
        }

        $object->formResponse->answers = $answers;

        return $object;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Answer::class === $to;
    }
}
