<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     *  
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // $this->redirectToRoute('register_success');
        }
        $users = $userRepository->findAll();

        return $this->render('user/index.html.twig', array(
            'form' => $form->createView(),
            'users' => $users,
        ));

    }

    /**
     * @Route("/user/{byFirstname}", name="user firstname")
     * @ParamConverter("user", options={"mapping"={"byFirstname"="firstname"}})
     * 
     */
    public function firstname(Request $request, UserRepository $userRepository,  User $user)
    {
        return $this->render('user/user.html.twig', array(
            'user' => $user,
        ));
    }
}
