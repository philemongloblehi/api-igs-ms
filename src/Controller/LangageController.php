<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LangageController extends AbstractController
{
    /**
     * @Route("/langage", name="langage")
     */
    public function index()
    {
        return $this->render('langage/index.html.twig', [
            'controller_name' => 'LangageController',
        ]);
    }
}
