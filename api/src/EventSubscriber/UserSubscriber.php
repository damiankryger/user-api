<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class UserSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MailerInterface $mailer
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendMail(ViewEvent $event): void
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        if (!$user->email) {
            return;
        }

        $message = (new TemplatedEmail())
            ->from('system@example.com')
            ->to($user->email)
            ->subject('Hello in Recruitment System')
            ->htmlTemplate('emails/welcome.html.twig')
            ->context([
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
            ]);

        $this->mailer->send($message);
    }
}
