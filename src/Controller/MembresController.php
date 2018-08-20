<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Form\Extension\Core\Type\PasswordType;
// use Symfony\Component\Form\Extension\Core\Type\EmailType;
// use Symfony\Component\Form\Extension\Core\Type\FileType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\LoginType;
use App\Form\NewEditMembreType;
use App\Form\PresentationType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Membres;
use App\Entity\Presentations;
use App\Entity\Recherches;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




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

        if(isset($presentations[0])){
            $presentation = $presentations[0]->getAllElement();
        }else{
            $presentation = $presentations ;
        }

        if(isset($recherches[0])){
            $recherche = $recherches[0]->getAllElement();
        }else{
            $recherche = $recherches ;
        }

            $datetime1 = $membre->getNaissance();
            $datetime2 = new \DateTime();
            $interval = $datetime1->diff($datetime2);
            $age = $interval->format('%Y ans');

        return $this->render('tests/show.html.twig', array(
            'membre' => $membre, 
            'presentation'=>$presentation, 
            'recherche'=>$recherche,
            'age'=>$age)
        );
    }

    public function testNew(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        // Instanciation de la classe Membres
        $message="" ;
        $membre = new Membres();
        
        $form = $this->createForm(NewEditMembreType::class, $membre);
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

            $membre->setPassword( $encoder->encodePassword($membre, $request->get("password")) );

                // Upload de l'une image
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                if($file = $form->get('mainimage')->getData()){
                    $fileName = $form->get('pseudo')->getData().'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('mainimages_directory'),
                        $fileName
                    );
                    $membre->setMainimage($fileName);
                }

                // Enregistremenrt du nouveau membre
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

        $form = $this->createForm(NewEditMembreType::class, $membre);
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
    
    public function testEditPresentation(Request $request, Membres $membre): Response
    {
        $presentation = new Presentations($membre);

        $pres = $membre->getPresentations()->getValues() ;
        $pre = $pres[0]->getAllElement();

        // Option 1 : on essaye de récupérer presentation avec le membre, qui est lié à Presentations
        // Presentation est un array et doctrine n'en veut pas.
        $presentation = $pre ;

        // Option 2 : on essaye de récupérer la présentation de façon détournée, avec l'id
        // Mais Doctrine ne veut pas parce que 'ArrayAcces' n'est pas implémenté.
        // $id_presentation = $pre['id'];
        // $presentation = $this->getDoctrine()
        // ->getRepository(Presentations::class)
        // ->find($id_presentation);

        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $presentation->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('test_show', ['id' => $membre->getId()]);
            }catch(Exception  $e){
                echo "erreur" ; 
            }
        }

        return $this->render('tests/formpresentation.html.twig', [
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