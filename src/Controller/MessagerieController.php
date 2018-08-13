<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Membres;


class MessagerieController extends Controller
{
    public function new(): Response
        {
            $membresRepository = $this->getDoctrine()->getRepository(Membres::class);
            // Liste de tous les membres
            return $this->render('tests/newmessage.html.twig', 
                ['membres' => $membresRepository->findAll()]);
        }
}