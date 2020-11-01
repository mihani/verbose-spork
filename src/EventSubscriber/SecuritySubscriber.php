<?php

namespace App\EventSubscriber;

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
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['headerControl'],
        ];
    }

    public function headerControl(RequestEvent $requestEvent): void
    {
        if ($receivedSignature = $requestEvent->getRequest()->headers->get('Typeform-Signature')) {
            if (!$this->verifySignature((string) $receivedSignature, (string) $requestEvent->getRequest()->getContent())) {
                $requestEvent->setResponse(new JsonResponse('The signature doesn\'t match', Response::HTTP_FORBIDDEN));
            }
        }
    }

    private function  verifySignature(string $receivedSignature, string $payload): bool
    {
        $hash = hash_hmac('sha256', $payload, $_ENV['TYPEFORM_SECRET'], true);
        $signature = sprintf('sha256=%s', base64_encode($hash));

        return $signature === $receivedSignature;
    }
}
