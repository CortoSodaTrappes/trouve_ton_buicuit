<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\MessagerieRepository;
use App\Entity\Messagerie;




class MessagerieController extends Controller
{

    // public function list(MembresRepository $membresRepository): Response
    // {
    //     // Liste de tous les membres
    //     return $this->render('tests/list.html.twig', 
    //         ['membres' => $membresRepository->findAll()]);
    // }

    // public function show(Membres $pseudo): Response
    // {
    //     // Apparemment, en passant un id en argument sf4 s'arrange 
    //     // pour que show() reçoive un objet Membre complet.
    //     return $this->render('tests/show.html.twig', ['pseudo' => $pseudo]);
    // }

    public function new(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Messagerie::class);
        $membres = $repository->findAll();

        // Instanciation de la classe Membres
        $message="" ;
        $membre = new Membres();

        $membre->setPseudoset($request->get("pseudo"));
        $membre->setEmail($request->get("email"));
        $membre->setPassword( $encoder->encodePassword($membre, $request->get("password")) );
        $repository->persist($membre);
        $repository->flush();


        // Affichage du formulaire (qui n'a pas encore été soumis)
        return $this->render('tests/form.html.twig', [
            'membres' => $membres,
        ]);
    }

    // public function edit(Request $request, Membres $membre): Response
    // {
    //     $form = $this->createFormBuilder($membre)
    //     ->add('pseudo')
    //     ->add('password')
    //     ->add('email')
    //     ->add('save', SubmitType::class)
    //     ->getForm();

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('test_list', ['id' => $membre->getId()]);
    //     }

    //     return $this->render('tests/form.html.twig', [
    //         'membre' => $membre,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // public function delete(Request $request, Membres $membre): Response
    // {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($membre);
    //         $em->flush();

    //     return $this->redirectToRoute('test_list');
    // }


}