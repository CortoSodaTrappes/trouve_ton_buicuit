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
        return $this->render('tests/list.html.twig', 
            ['membres' => $membresRepository->findAll()]);
    }

    public function show(Membres $pseudo): Response
    {
        // Apparemment, en passant un id en argument sf4 s'arrange 
        // pour que show() reçoive un objet membre complet.
        return $this->render('tests/show.html.twig', ['pseudo' => $pseudo]);
    }

    public function new(Request $request): Response
    {
        // Instanciation de la classe Membres
        $message="" ;
        $membre = new Membres();

        // Définition du formulaire
        $form = $this->createFormBuilder($membre)
            ->add('pseudo')
            ->add('password')
            ->add('email')
            ->add('save', SubmitType::class)
            ->getForm();

            $repository = $this->getDoctrine()->getRepository(Membres::class);
            $tempmemberemail = $repository->findOneBy(["email" => $request->get('email')]);

        if(is_null($tempmemberemail)){
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

        }else{
            $message="Il y a un loupé.";
        }




        // Affichage du formulaire (qui n'a pas encore été soumis)
        return $this->render('tests/form.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
            'message' => $message
        ]);
    }

    public function edit(Request $request, Membres $membre): Response
    {
        $form = $this->createFormBuilder($membre)
        ->add('pseudo')
        ->add('password')
        ->add('email')
        ->add('save', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test_list', ['id' => $membre->getId()]);
        }

        return $this->render('tests/form.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    public function delete(Request $request, Membres $membre): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($membre);
            $em->flush();

        return $this->redirectToRoute('test_list');
    }


}