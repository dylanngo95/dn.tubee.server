<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    #[Route('/user/{id}', methods: ['GET', 'HEAD'])]
    public function get(int $id): Response
    {
        return new Response(
            '<html><body>Lucky number: '.$id.'</body></html>'
        );
    }

    #[Route('/user', methods: ['GET'])]
    public function create(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $user = new User();
        $user->setName('Dylan');
        $user->setPassword('1234');

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('<html><body>User New: '.$user->getId().'</body></html>');
    }
}