<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\LoginType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Membres;
use App\Entity\Presentations;
use App\Entity\Recherches;




class MembresController extends Controller
{

    // Ctrl pour afficher tous les membres
    public function testList(MembresRepository $membresRepository): Response
    {
        return $this->render('tests/list.html.twig', 
            ['membres' => $membresRepository->findAll()]);
    }

    // Ctrl pour afficher les détails d'un membre
    public function testShow(Membres $membre): Response
    {
        $presentations = $membre->getPresentations()->getValues() ;
        $recherches = $membre->getRecherches()->getValues();


        // foreach($presentations as $key => $presentations){
        //     echo $presentations->presentation;
        // }
            dump($presentations);

        // echo "<pre>" ; print_r($presentations);echo "</pre>";
        // $presentation = $this
        //     ->getDoctrine()
        //     ->getRepository(Presentations::class)
        //     ->find($id);



        return $this->render('tests/show.html.twig', array(
            'membre' => $membre, 
            'presentation'=>$presentations[0]->getAllElement(), 
            'recherche'=>$recherches[0]->getAllElement())
        );
        
            
            
            
            
    }

    public function testNew(Request $request): Response
    {
        // Instanciation de la classe Membres
        $message="" ;
        $membre = new Membres();
        $date = new \DateTime();


        // Définition du formulaire
        $form = $this->createFormBuilder($membre)
            ->add('pseudo')
            ->add('password', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('mainimage', FileType::class, array('label' => 'Image', 'required'=>false))
            ->add('ville')
            ->add('naissance', DateType::class, array(
                'widget' => 'choice',
                'years' => range(1950,$date->format('Y')),
                'format' => 'dd-MM-yyyy')
            )
            ->add('save', SubmitType::class)
            ->setMethod("POST")
            ->getForm();

            $form->handleRequest($request);

            // Récupération d'éventuels membres qui auraient les 
            // mêmes email et pseudo que ceux saisis.
            $repository = $this->getDoctrine()->getRepository(Membres::class);
            $tempmemberemail = $repository->findOneBy(["email" => $membre->getEmail()]);
            $tempmemberpseudo = $repository->findOneBy(["pseudo" => $membre->getPseudo()]);

        // email et pseudos inconnus, on tente l'enregistrement.
        if(!$tempmemberemail && !$tempmemberpseudo){
            $membre->setRole("ROLE_USER");
            // Si tout se passe bien, enregistrement du membre dans la base
            if ($form->isSubmitted() && $form->isValid()) {

                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                if($file = $form->get('mainimage')->getData()){
                    $fileName = $form->get('pseudo')->getData().'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('mainimages_directory'),
                        $fileName
                    );
                    $membre->setMainimage($fileName);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($membre);
                $em->flush();
                $id = $membre->getId();

                // Initialisation de la présentation
                $presentation = new Presentations($membre);
                $presentation->init();
                $membre->addPresentation($presentation);
                $em->persist($presentation);
                $em->flush();

                // Initialisation de la recherche
                $recherche = new Recherches($membre);
                $recherche->init();
                $membre->addRecherche($recherche);
                $em->persist($recherche);
                $em->flush();


                // Après l'enregistrement, affichage de la liste de membres
                return $this->redirectToRoute('test_login');
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

    public function testEdit(Request $request, Membres $membre): Response
    {
        $form = $this->createFormBuilder($membre)
        ->add('pseudo')
        ->add('password')
        ->add('email')
        ->add('mainimage', FileType::class, array('label' => 'Image', 'data_class' => null, 'required'=>false))
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

    public function testDelete(Request $request, Membres $membre): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($membre);
            $em->flush();

        return $this->redirectToRoute('test_list');
    }

    public function testLogin(Request $request, AuthenticationUtils $authenticationUtils)
    {   
        $membre = new Membres();
        $form = $this->createForm(LoginType::class, $membre);
        $form->handleRequest($request);
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($form->isSubmitted() && $form->isValid()) {
            // return $this->render("home/index.html.twig");
        }
        dump($error);
        return $this->render("tests/login.html.twig", array(
            "form" => $form->createView(),
            "error" => $error
        ));
    }

    public function testLogout(){
        return $this->redirectToRoute('test_login');
    }    
}