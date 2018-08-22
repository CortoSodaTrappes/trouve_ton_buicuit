<?php 

namespace App\Controller;


use App\Entity\Membres;
use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\File\UploadedFile;




class LandingController extends Controller {

    // Methode d'Inscription
    public function landing_inscript(Request $request, UserPasswordEncoderInterface $encoder)
    {
        dump($request);
        $membre = new Membres();

        if(!filter_var($request->get("email"), FILTER_VALIDATE_EMAIL)){
            return $this->render('front/landing_inscript.html.twig', ['error' => "Email invalide"]);
        }

        $er = $this->getDoctrine()->getRepository(Membres::class);
        $membreOne = $er->findOneBy(["email" => $request->get("email")]);

        if(!$membreOne){
                $em = $this->getDoctrine()->getManager();

            $membre = new Membres();
            $membre->setPseudo($request->get("pseudo"));
            $membre->setEmail($request->get("email"));
            $membre->setPassword( $encoder->encodePassword($membre, $request->get("password")) );
            $membre->setmainimage($request->get("mainimage"));
            $datedefaut = new \DateTime("2000-01-15");
            $membre->setnaissance($datedefaut);
            $membre->setville("Paris");
            $membre->setRole("ROLE_USER");
            // $membre->setnaissance("2000-01-15");
            $datedefaut = new \DateTime("2000-01-15");
            $membre->setnaissance($datedefaut);
            $membre->setville("Paris");
            // $membre->setUpdated();

    

            try{
                $em->persist($membre);
                $em->flush();
            }catch(\Doctrine\ORM\EntityNotFoundException $e){
                return $this->render('front/landing_inscript.html.twig', ['error' => "Request fail"]);
            }
            // redirection
            return $this->redirectToRoute('landing');

        }else{
            return $this->render('front/landing_inscript.html.twig', ['error' => "User existe"]);
        }

    }

    // Methode de Connexion
    public function landing(Request $request, AuthenticationUtils $authenticationUtils) {

        return $this->render('front/landing.html.twig');
    }

    // Methode de deconnexion 
    public function logout(){
        return $this->render('front/landing.html.twig');
    }


}