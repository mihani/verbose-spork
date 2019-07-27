<?php

namespace App\Manager;


use App\Entity\Answer;
use App\Entity\Question;
use App\Traits\EntityManagerInterfaceTrait;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class AnswerManager
{
    use EntityManagerInterfaceTrait;

    /** @var QuestionManager */
    private $questionManager;

    /**
     * @param QuestionManager $questionManager
     */
    public function __construct(QuestionManager $questionManager)
    {
        $this->questionManager = $questionManager;
    }

    /**
     * @param array $formAnswers
     *
     * @throws \Exception
     */
    public function createAnwser(array $formAnswers)
    {
        foreach ($formAnswers as $formAnswer) {
            if (!$question = $this->em->getRepository(Question::class)->findOneBy([
                'typeformId'=>$formAnswer['field']['id'],
                'typeformRef' => $formAnswer['field']['ref']])
            ){
                throw new \Exception(
                    sprintf('No question found with id %s and ref %s',
                        $formAnswer['field']['id'],
                        $formAnswer['field']['ref'])
                );
            }

            $this->create($formAnswer, $question);
        }

    }

    /**
     * @param array    $formAnswer
     * @param Question $question
     */
    private function create(array $formAnswer, Question $question)
    {
        $content = $formAnswer[$formAnswer['type']];
        if (is_array($content)){
            $content = json_encode($content);
        }

        if (is_bool($content)){
            $content = $content ? 'true' : 'false';
        }

        $this->em->persist((new Answer())
            ->setQuestion($question)
            ->setContent((string) $content));
        $this->em->flush();
    }
}
