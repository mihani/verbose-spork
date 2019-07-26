<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\AddFormatListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @author Maud Remoriquet <maud.remoriquet@gmail.com>
 */
class SecuritySubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['headerControl'],
        ];
    }

    /**
     * @param RequestEvent $requestEvent
     */
    public function headerControl(RequestEvent $requestEvent): void
    {
        if (!$requestEvent->getRequest()->headers->get('x-typeform-token')){
            $requestEvent->setResponse(new JsonResponse(null, Response::HTTP_FORBIDDEN));
        }
    }
}
