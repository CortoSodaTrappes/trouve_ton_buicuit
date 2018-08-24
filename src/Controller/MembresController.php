<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File;
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
    // Edition du profil
    public function profilEdit(Request $request, Membres $membre): Response{

        $entityManager = $this->getDoctrine()->getManager();
        
        $datetime1 = $membre->getNaissance();
        $datetime2 = new \DateTime();
        $interval = $datetime1->diff($datetime2);
        $age = $interval->format('%Y ans');

        if($request->get('jeveux')){
            $membre->setJeveux($request->get('jeveux'));
            $membre->setPunchline($request->get('punchline'));
            $membre->setJesuis($request->get('jesuis'));
            $membre->setDescription($request->get('description'));
    
            if($request->get('naissance')!=""){
                $datetime = new \DateTime($request->get('naissance'));
                $membre->setNaissance($datetime);
            }
    
            // $datetime1 = $membre->getNaissance();
            // $datetime2 = new \DateTime();
            // $interval = $datetime1->diff($datetime2);
            // $age = $interval->format('%Y ans');

            $membre->setTypeRelation($request->get('selectrelations'));
            $membre->setTraitCaractere($request->get('selectcaracteres'));
    
            $membre->setTaille($request->get('selecttaille'));
            $membre->setSilhouette($request->get('selectsilhouette'));
            $membre->setYeux($request->get('selectyeux'));
            $membre->setCheveux($request->get('selectcheveux'));
            $membre->setFume($request->get('selectfume'));
            $membre->setMange($request->get('selectmange'));
            $membre->setAnimaux($request->get('selectanimaux'));
            $membre->setHobby($request->get('selecthobby'));
            $membre->setStatut($request->get('selectstatut'));
            $entityManager->flush();
        }


        // Upload de l'une image
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
        if($file = $request->files->get('mainimage')){
            // $file = $request->get('mainimage')){
            $fileName = $membre->getPseudo() .'.'. $file->guessExtension() ;
            $file->move(
                $this->getParameter('mainimages_directory'),
                $fileName
            );

            $membre->setMainimage($fileName);
            $entityManager->flush();
        }
            
        // modification en direct PSEUDO
        
         if($request->get('status_val')){
                
        $membre->setPseudo($request->get('status_val'));
        $entityManager->persist($membre);
        $entityManager->flush();
        }

        // modification en direct VILLE
         if($request->get('ville_val')){
                
        $membre->setVille($request->get('ville_val'));
        $entityManager->persist($membre);
        $entityManager->flush();
        }


        // Disparition du button "edition" profil

        // if($id = $membre->getId();  
        // {
        // <div></div>
        // }


        if(!is_null($request->get("submit"))){
            try{
                $entityManager->persist($membre);
                $entityManager->flush();
                // return $this->redirectToRoute('prive_profil', array('id' => $membre->getId()));
            }catch(\Doctrine\ORM\EntityNotFoundException $e){
                // return $this->returnJson(array("path" =>"/register", "Error : invalid request."), 501) ;
            }
        } 

        // création des options dans le formulaire

        return $this->render('prive/profil.html.twig', array(
            'membre' => $membre,
            'optionspersonnes' => $this->getOptionsPersonnes(),
            'optionsrelations' => $this->getOptionsRelations(),
            'optionstailles' => $this->getOptionsTaille(),
            'optionscaracteres' => $this->getOptionsCaracteres(),
            'optionssilhouettes' => $this->getOptionsSilhouette(),
            'optionsyeux' => $this->getOptionsYeux(),
            'optionscheveux' => $this->getOptionsCheveux(),
            'optionsstatut' => $this->getOptionsStatut(),
            'optionsfume' => $this->getOptionsFume(),
            'optionsmange' => $this->getOptionsMange(),
            'optionsanimaux' => $this->getOptionsAnimaux(),
            'optionshobby' => $this->getOptionsHobby(),
            'age' => $age,
        ));
    }

    public function profilShow(Membres $membre): Response{

        $datetime1 = $membre->getNaissance();
        $datetime2 = new \DateTime();
        $interval = $datetime1->diff($datetime2);
        $age = $interval->format('%Y ans');

        return $this->render('front/show.html.twig', array(
            'membre' => $membre, 'age'=>$age)
        );
    }


    public function listMembres(): Response{

        $repository = $this->getDoctrine()->getRepository(Membres::class);
        $membres = $repository->findAll();
dump($membres);
        return $this->render('front/list.html.twig', array(
            'membres' => $membres)
        );

    }


    ///////////////////////////////// CONTROLEURS DE TEST /////////////////////////////////////////////////////



    // Contrôleur pour afficher tous les membres
    public function testList(MembresRepository $membresRepository): Response
    {
        return $this->render('tests/list.html.twig', 
            ['membres' => $membresRepository->findAll()]);
    }

    // Ctrl pour afficher les détails d'un membre
    public function testShow(Membres $membre): Response
    {
        // $presentations = $membre->getPresentations()->getValues() ;
        // $recherches = $membre->getRecherches()->getValues();

        // if(isset($presentations[0])){
        //     $presentation = $presentations[0]->getAllElement();
        // }else{
        //     $presentation = $presentations ;
        // }

        // if(isset($recherches[0])){
        //     $recherche = $recherches[0]->getAllElement();
        // }else{
        //     $recherche = $recherches ;
        // }

            $datetime1 = $membre->getNaissance();
            $datetime2 = new \DateTime();
            $interval = $datetime1->diff($datetime2);
            $age = $interval->format('%Y ans');

        return $this->render('tests/show.html.twig', array(
            'membre' => $membre, 
            // 'presentation'=>$presentation, 
            // 'recherche'=>$recherche,
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
                // $presentation = new Presentations($membre);
                // $presentation->init();
                // $membre->addPresentation($presentation);
                // $em->persist($presentation);
                // $em->flush();

                // Initialisation de la recherche
                // $recherche = new Recherches($membre);
                // $recherche->init();
                // $membre->addRecherche($recherche);
                // $em->persist($recherche);
                // $em->flush();

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
        // $presentation = new Presentations($membre);

        // $pres = $membre->getPresentations()->getValues() ;
        // $pre = $pres[0]->getAllElement();

        // Option 1 : on essaye de récupérer presentation avec le membre, qui est lié à Presentations
        // Presentation est un array et doctrine n'en veut pas.
        // $presentation = $pre ;

        // Option 2 : on essaye de récupérer la présentation de façon détournée, avec l'id
        // Mais Doctrine ne veut pas parce que 'ArrayAcces' n'est pas implémenté.
        // $id_presentation = $pre['id'];
        // $presentation = $this->getDoctrine()
        // ->getRepository(Presentations::class)
        // ->find($id_presentation);

        $form = $this->createForm(PresentationType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $membre->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('test_show');
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

// --------------------------------------------- FIN DE CONTROLEURS DE TEST ---------------------------------------------


//////////////////////////////////////////////// FONCTIONS GENERATRICES DE SELECT-OPTIONS //////////////////////////////////////////



    public function getOptionsRelations(){
        return array(
            0=>"Non renseigné",
            1=>"Durable",
            2=>"Sans prise de tête",
            3=>"Sex-friend",
            4=>"One shot"
        );
    }

    public function getOptionsPersonnes(){
        return array(
            0=>"Non renseigné",
            1=>"Homme",
            2=>"Femme",
            3=>"Troisième sexe",
            4=>"Couple hf",
            5=>"Couple hh",
            6=>"Couple ff",
            7=>"Orgie",
        );
    }

    public function getOptionsTaille(){
        return array(
            0=>"Non renseigné",
            1=>"1m40 - 1m60",
            2=>"1m50 - 1m70",
            3=>"1m60 - 1m80",
            4=>"1m70 - 1m90",
            5=>"1m80 - 2m",
            6=>"1m90 - 2m10",
            7=>"Plus de 2m10",
        );
    }

    public function getOptionsCaracteres(){
        return array(
            0=>"Non renseigné",
            1=>"Aventureux",
            2=>"Calme",
            3=>"Sociable",
            4=>"Drôle",
            5=>"Timide",
            6=>"Extravagant",
        );
    }

    public function getOptionsSilhouette(){
        return array(
            0=>"Non renseigné",
            1=>"Maigre ou mince",
            2=>"mince et/ou sportif",
            3=>"sportif et/ou normal",
            4=>"Enveloppé(e) et/ou pulpeuse",
            5=>"pulpeu(se) et/ou rond(e)",
        );
    }

    public function getOptionsYeux(){
        return array(
            0=>"Non renseigné",
            1=>"Marron",
            2=>"Bleus",
            3=>"Verts",
            4=>"Noisette",
            5=>"Gris",
        );
    }

    public function getOptionsCheveux(){
        return array(
            0=>"Non renseigné",
            1=>"Châtain",
            2=>"Noirs",
            3=>"Blonds",
            4=>"Blancs",
            5=>"Roux",
            6=>"Autre",
        );
    }

    public function getOptionsStatut(){
        return array(
            0=>"Non renseigné",
            1=>"Jamais marié",
            2=>"Divorcé",
            3=>"Veuve",
        );
    }

    public function getOptionsFume(){
        return array(
            0=>"Non renseigné",
            1=>"Un peu",
            2=>"Beaucoup",
            3=>"Enormément",
            4=>"Jamais",
        );
    }


    public function getOptionsMange(){
        return array(
            0=>"Non renseigné",
            1=>"Tout",
            2=>"Végétarie/végan",
            3=>"Hallal",
            4=>"Casher",
        );
    }


    public function getOptionsAnimaux(){
        return array(
            0=>"Non renseigné",
            1=>"Chien",
            2=>"Chat",
            3=>"Oiseau",
            4=>"Reptile",
            5=>"Poisson",
            6=>"Autre",
        );
    }


    public function getOptionsHobby(){
        return array(
            0=>"Non renseigné",
            1=>"Nature",
            2=>"Arts",
            3=>"Sport",
            4=>"Voyages",
            5=>"Musique",
            6=>"Littérature",
            7=>"Autre",
        );
    }



}