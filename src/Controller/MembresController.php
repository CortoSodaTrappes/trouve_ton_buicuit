<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;




class MembresController extends Controller
{

    public function list(MembresRepository $membresRepository): Response
    {
        return $this->render('tests/test.html.twig', 
            ['membres' => $membresRepository->findAll()]);
    }

    public function show(Membres $membre): Response
    {
        return $this->render('tests/test.html.twig', ['membre' => $membre]);
    }

    public function new(Request $request): Response
    {
        $membre = new Membres();
        $form = $this->createForm(MembresType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            return $this->redirectToRoute('membres_index');
        }

        return $this->render('membres/new.html.twig', [
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