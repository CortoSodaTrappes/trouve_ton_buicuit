<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilFormulaireController extends Controller
{
    /**
     * @Route("/prive/profil_formulaire", name="prive")
     */
    public function index()
    {
        return $this->render('profil.html.twig', [
            'controller_name' => 'ProfilFormulaireController',
        ]);
    }
}
