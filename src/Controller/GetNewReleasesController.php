<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetNewReleasesController extends AbstractController
{
    /**
     * @Route("/lanzamientos", name="get_new_releases")
     */
    public function index(): Response
    {
        return $this->render('get_new_releases/index.html.twig', [
            'controller_name' => 'GetNewReleasesController',
        ]);
    }
}
