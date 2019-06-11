<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Dto\TypeformAnswerPayload;
use App\Manager\FormManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class TypeformSubscriber implements EventSubscriberInterface
{
    /** @var FormManager */
    private $formManager;

    public function __construct(FormManager $formManager)
    {
        $this->formManager = $formManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['newAnswer', EventPriorities::POST_VALIDATE],
        ];
    }

    public function newAnswer(ViewEvent $event)
    {
        if (!$event->getControllerResult() instanceof TypeformAnswerPayload){
            return;
        }

        $typeform = array_intersect_key(
            $event->getControllerResult()->form_response,
            TypeformAnswerPayload::PAYLOAD_PATTERN
        );

        $form = $this->formManager->createForm($typeform);
    }
}
