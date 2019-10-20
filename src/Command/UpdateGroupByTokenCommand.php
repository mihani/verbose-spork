<?php

namespace App\Command;

use App\Entity\Answer;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateGroupByTokenCommand extends Command
{
    protected static $defaultName = 'update:answer:group-by-token';

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \Exception
     *
     * @return null|int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formResults = $this->em->createQueryBuilder()
            ->select("GROUP_CONCAT(answer.id ORDER BY answer.id DESC SEPARATOR '|') AS response")
            ->from(Answer::class, 'answer')
            ->groupBy('answer.createdAt')
            ->getQuery()
            ->getResult()
        ;

        foreach ($formResults as $formResult) {
            $token = Uuid::uuid4();
            foreach (explode('|', $formResult['response']) as $item) {
                $answer = $this->em->getRepository(Answer::class)->findOneBy([
                    'id' => $item,
                ]);

                $answer->setGroupByToken($token);
                $this->em->flush();
            }
        }
    }
}
