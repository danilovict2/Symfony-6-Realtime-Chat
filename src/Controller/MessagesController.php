<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pusher\Pusher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[IsGranted("ROLE_USER")]
class MessagesController extends AbstractController
{
    #[Route('/messages', name: 'messages')]
    public function messages(MessageRepository $messageRepository): JsonResponse
    {
        return $this->json(
            [
                'messages' => $messageRepository->findAll()
            ],
            context: [
                ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => fn ($obj) => $obj->getId()
            ]
        );
    }

    #[Route('/message/create', name: 'message_create', methods: ['POST', 'GET'])]
    public function create(EntityManagerInterface $entityManager, Request $request, Pusher $pusher): Response
    {
        $user = $this->getUser();
        $message = new Message();
        

        $message->setSender($user);
        $message->setMessage($request->get('message'));

        $entityManager->persist($message);
        $entityManager->flush();

        $pusher->trigger('presence-chatroom', 'message.sent', [
            'message' => $message->getMessage(),
            'sender' => $message->getSender()->getName()
        ]);

        return new Response("sucess!");
    }
}
