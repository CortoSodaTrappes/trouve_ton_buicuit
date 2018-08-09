<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Membres;




class MembresController extends Controller
{

    public function list(MembresRepository $membresRepository): Response
    {
        return $this->render('tests/test.html.twig', 
            ['membres' => $membresRepository->findAll()]);
    }

    public function show(Membres $pseudo): Response
    {
        return $this->render('tests/test.html.twig', ['pseudo' => $pseudo]);
    }

    public function new(Request $request): Response
    {
        // Instanciation de la classe Membres
        $membre = new Membres();

        // Dédinition du formulaire
        $form = $this->createFormBuilder($membre)
            ->add('pseudo')
            ->add('password')
            ->add('email')
            ->add('save', SubmitType::class)
            ->getForm();

        // Traitement de la soumission du formulaire
        $form->handleRequest($request);

        // Si tout se passe bien, enregistrement du membre dans la base
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            // Après l'enregistrement, affichage de la liste de membres
            return $this->redirectToRoute('test_list');
        }

        // Affichage du formulaire (qui n'a pas encore été soumis)
        return $this->render('tests/test.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, Membres $membre): Response
    {
        $form = $this->createForm(MembresType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('membres_edit', ['id' => $membre->getId()]);
        }

        return $this->render('membres/edit.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    public function delete(Request $request, Membres $membre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($membre);
            $em->flush();
        }

        return $this->redirectToRoute('membres_index');
    }


}