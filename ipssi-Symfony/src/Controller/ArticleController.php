<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        // Get doctrine manager
        $em = $this-> getDoctrine()->getManager();
        
        // Get all entity from article table
        $articles = $em->getRepository(Article::class)->findAll();

        // Send to the view template ' article/index.html.twig' an array of content
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }
}
