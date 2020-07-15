<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostDisplayController extends AbstractController
{
    /**
     * @Route("/", name="post_display")
     */
    public function index()
    {
        return $this->render('post_display/index.html.twig', [
            'controller_name' => 'PostDisplayController',
        ]);
    }
}
