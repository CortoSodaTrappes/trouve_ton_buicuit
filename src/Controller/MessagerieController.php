<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Membres;
use App\Entity\Messagerie;


class MessagerieController extends Controller
{

    public function showMail(Request $request, \Swift_Mailer $mailer){

        $membres = $this->getDoctrine()->getRepository(Membres::class)->findAll();
        if($request->get("send")){ // Tous
            if($request->get("exampleFormControlSelect2") == "all"){ // boucle envoi mail à tous les users
                for($i =0; $i < count($membres); $i++)
                    $this->sendMail($membres[$i]->getEmail(), $mailer, $request->get("exampleFormControlTextarea1"));
            }else{ // Un seul
                $this->sendMail($request->get("exampleFormControlSelect2"), $mailer, $request->get("exampleFormControlTextarea1"));
            }
        }
        return $this->render('admin3/send_mailing.html.twig', array("membres" => $membres));
    }


    private function sendMail($adresse, $mailer = "wf3biscuits@gmail.com" , $message = "Coucou les loulou"){ // envoi mail à un seul user
        $message = (new \Swift_Message('Bonjour'))
        ->setFrom('WF3biscuits@gmail.com')
        ->setTo($adresse)
        ->setBody(
            $this->renderView('admin3/mail/send.html.twig',
              array('mail' => $adresse,"message" => $message)
            ),
            'text/html'
        );
        $mailer->send($message); 
    }



}