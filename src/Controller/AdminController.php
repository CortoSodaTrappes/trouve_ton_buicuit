<?php 

namespace App\Controller;

use App\Entity\Membres;
use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AdminController extends Controller {

    // Methode de deconnexion 
    public function logout_admin(){
        return $this->redirectToRoute('/landing');
    }


}