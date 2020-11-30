<?php

namespace App\Controller;

use App\Service\UserServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route(
     *      path="/api/admin/users",
     *       methods={"POST"}
     * )
     */
    public function addUsers(UserServices $userService,Request $request,EntityManagerInterface $manager){
        $todo="create";
        $user = $userService->addUser($request,$todo);
        $manager->persist($user);
        $manager->flush();
        return $this->json($userService,Response::HTTP_OK);
    }
}
