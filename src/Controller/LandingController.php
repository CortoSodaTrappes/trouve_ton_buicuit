<?php 

namespace App\Controller;


use App\Entity\Membres;
use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




class LandingController extends Controller {

    // Methode d'Inscription
    public function landing_inscript(Request $request, UserPasswordEncoderInterface $encoder)
    {

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
            $membre->setRole("ROLE_USER");
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
        $membre = new Membres();

        if ($membre->isValid()) {
            return $this->redirectToRoute("/profil");
        }
        

        
    }




}