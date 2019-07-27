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
        if ($receivedSignature = $requestEvent->getRequest()->headers->get('Typeform-Signature')){
            if (!$this->verifySignature($receivedSignature, (string) $requestEvent->getRequest()->getContent())){
                $requestEvent->setResponse(new JsonResponse(null, Response::HTTP_FORBIDDEN));
            }
        }
    }

    /**
     * @param $receivedSignature
     * @param $payload
     *
     * @return bool
     */
    private function verifySignature($receivedSignature, $payload)
    {
        $hash = hash_hmac('sha256',$payload,'created_token', true);
        $signature = sprintf('%s%s','sha256=',base64_encode($hash));

        return $signature === $receivedSignature;
    }
}
