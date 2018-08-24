<?php

namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Membres;
use App\Entity\Messages;


class MessagesController extends Controller
{
    public function newmessage(Request $request): Response
    {

        $membresRepository = $this->getDoctrine()->getRepository(Membres::class);
        $expediteur = $this->getUser();
        $destinataire =$membresRepository->find($request->get('id')) ;

        $date = new \DateTime();
        if($request->getMethod()=="POST"){
            $messagesManager = $this->getDoctrine()->getManager();

            $message = new Messages();
            $message->setExpediteur($expediteur);
            $message->setDestinataire($destinataire);
            $message->setTitre($request->get("titre"));
            $message->setTexte($request->get("texte"));
            
            try{
                $messagesManager->persist($message);
                $messagesManager->flush();
            }catch(\Doctrine\ORM\EntityNotFoundException $e){
                return $this->render('prive/newmessage.html.twig', ['error' => "Request fail"]);
            }
            // redirection
            return $this->redirectToRoute('membre_list');
        }

        // Liste de tous les membres
        return $this->render('prive/newmessage.html.twig', 
            ['destinataire' => $destinataire]);
    }

    public function messagelist(Request $request){

        $msgRepository = $this->getDoctrine()->getRepository(Messages::class);
        $user = $this->getUser() ;

        // Membre est destinataire
        $msgExp = $msgRepository->findBy(['destinataire' => $user]) ;


        // Membre est expéditeur
        $msgDest = $msgRepository->findBy(['expediteur' => $user]) ;

        $messages_recus = $this
            ->getDoctrine()
            ->getRepository(Messages::class)
            ->findBy(['destinataire' => $user->getId()],['date' => 'ASC']);
            
            $messages_envoyes = $this
            ->getDoctrine()
            ->getRepository(Messages::class)
            ->findBy(['expediteur' => $user->getId()],['date' => 'ASC']);
            

        dump($messages_recus);
        dump($messages_envoyes);
        
        return $this->render('prive/messagerieliste.html.twig', 
        ['messages_recus' => $msgExp, 'messages_envoyes' => $msgDest]);
    }




    public function testNew(Request $request): Response
    {
        $membresRepository = $this->getDoctrine()->getRepository(Membres::class);
        $expediteur = $this->getUser();
        $destinataire =$membresRepository->find($request->get('id')) ;

        $date = new \DateTime();
        if($request->getMethod()=="POST"){
            $messagesManager = $this->getDoctrine()->getManager();

            $message = new Messages();
            $message->setExpediteur($expediteur);
            $message->setDestinataire($destinataire);
            $message->setTitre($request->get("titre"));
            $message->setTexte($request->get("message"));
            
            try{
                $messagesManager->persist($message);
                $messagesManager->flush();
            }catch(\Doctrine\ORM\EntityNotFoundException $e){
                return $this->render('tests/newmessage.html.twig', ['error' => "Request fail"]);
            }
            // redirection
            return $this->redirectToRoute('test_list');
        }

        // Liste de tous les membres
        return $this->render('tests/newmessage.html.twig', 
            ['destinataire' => $destinataire]);
    }

    public function testShow(Messages $message){
        $correspondant=array();
        $user = $this->getUser() ;

        if($user->getId() == $message->getDestinataire()->getId()){
            $correspondant['expediteur'] = $message->getExpediteur() ;            
            $correspondant['destinataire'] = $user->getPseudo() ;
            $correspondant['correspondant'] = "expediteur" ;
        }elseif($user->getId() == $message->getExpediteur()->getId()){
            $correspondant['expediteur'] = $user->getPseudo() ;            
            $correspondant['destinataire'] = $message->getDestinataire() ;            
            $correspondant['correspondant'] = "destinataire" ;
        }else{
            // die("Problème de lecture du message.");
        }
        dump($correspondant);

        return $this->render('tests/showmessage.html.twig', ['message' => $message, 'correspondant'=>$correspondant]);
    }

    public function testAllMessagerie(){
        // Method for testing purposes
        $messages = $this->getDoctrine()->getRepository(Messages::class)->findAll();

        return $this->render('tests/allmessages.html.twig', 
        ['messages' => $messages]);            

    }

    public function testMessagerie(Request $request){

        $msgRepository = $this->getDoctrine()->getRepository(Messages::class);
        $user = $this->getUser() ;

        // Membre est destinataire
        $msgExp = $msgRepository->findBy(['destinataire' => $user]) ;


        // Membre est expéditeur
        $msgDest = $msgRepository->findBy(['expediteur' => $user]) ;

        $messages_recus = $this
            ->getDoctrine()
            ->getRepository(Messages::class)
            ->findBy(['destinataire' => $user->getId()],['date' => 'ASC']);
            
            $messages_envoyes = $this
            ->getDoctrine()
            ->getRepository(Messages::class)
            ->findBy(['expediteur' => $user->getId()],['date' => 'ASC']);
            
        return $this->render('tests/messagerie.html.twig', 
        ['messages_recus' => $msgExp, 'messages_envoyes' => $msgDest]);
    }

    public function testGetMessage(){
        return false;
    }

}