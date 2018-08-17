<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilPriveController extends Controller
{
    /**
     * @Route("/prive", name="prive")
     */
    public function index()
    {
        return $this->render('prive/profil.html.twig', [
            'controller_name' => 'ProfilPriveController',
        ]);
    }
}
