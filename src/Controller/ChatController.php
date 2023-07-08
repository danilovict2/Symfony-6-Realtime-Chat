<?php

namespace App\Controller;

use Pusher\Pusher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    #[Route('/chat', name: 'chat_index')]
    public function index(): Response
    {
        return $this->render('chat/index.html.twig');
    }

    #[Route('/pusher/auth', name: 'authorize_user')]
    public function authorizeUser(Request $request, Pusher $pusher): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        return new Response(
            $pusher->authorizePresenceChannel(
                $request->request->get('channel_name'),
                $request->request->get('socket_id'),
                $this->getUser()->getId(),
                ['name' => $this->getUser()->getName()]
            )
        );
    }
}
