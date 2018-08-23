<?php


namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Membres;
use App\Entity\Messagerie;
use App\Entity\Messages;


class MessagesController extends Controller
{
    public function testNew(Request $request): Response
    {
        $membresRepository = $this->getDoctrine()->getRepository(Membres::class);
        $expediteur = $this->getUser();
        $destinataire =$membresRepository->find($request->get('id')) ;

        if($request->getMethod()=="POST"){
            $messagesManager = $this->getDoctrine()->getManager();

            $message = new Messagerie();
            $message->setIdExpediteur($expediteur);
            // $message->setIdExpediteur($membresRepository->find($request->get("expediteur")));
            $message->setIdDestinataire($destinataire);
            // $message->setIdExpediteur($request->get("expediteur"));
            // $message->setIdDestinataire($request->get("destinataire"));
            $message->setDate();
            $message->setCreated();
            $message->setTitre($request->get("titre"));
            $message->setMessage($request->get("message"));
            
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

    public function testShow(Messagerie $message){
        // Apparemment, en passant un id en argument sf4 s'arrange 
        // pour que show() reçoive un objet Membre complet.
        return $this->render('tests/showmessage.html.twig', ['message' => $message]);
    }

    public function testAllMessagerie(){
        // Method for testing purposes
        $messages = $this->getDoctrine()->getRepository(Messages::class)->findAll();
        
        return $this->render('tests/allmessages.html.twig', 
        ['messages' => $messages]);            

    }

    public function testMessagerie(Request $request){
        // $messagesManager = $this->getDoctrine()->getManager();

        $user = $this->getUser() ;
        $messages_recus = $this
            ->getDoctrine()
            ->getRepository(Messagerie::class)
            ->findBy(['id_destinataire' => $user->getId()],['date' => 'ASC']);
            
            $messages_envoyes = $this
            ->getDoctrine()
            ->getRepository(Messagerie::class)
            ->findBy(['id_expediteur' => $user->getId()],['date' => 'ASC']);
            
        
        // look for multiple Product objects matching the name, ordered by price

        return $this->render('tests/messagerie.html.twig', 
        ['messages_recus' => $messages_recus, 'messages_envoyes' => $messages_envoyes]);
    }


    public function testGetMessage(){
        return false;
    }

}