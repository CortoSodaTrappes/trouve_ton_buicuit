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
    public function testNew(Request $request): Response
    {
        echo "<pre>" ; var_dump($request->getMethod()); echo "</pre>" ;
        $membresRepository = $this->getDoctrine()->getRepository(Membres::class);

            if($request->getMethod()=="POST"){

                $messagesManager = $this->getDoctrine()->getManager();

                $message = new Messagerie();
                $message->setIdExpediteur($membresRepository->find($request->get("expediteur")));
                $message->setIdDestinataire($membresRepository->find($request->get("destinataire")));
                // $message->setIdExpediteur($request->get("expediteur"));
                // $message->setIdDestinataire($request->get("destinataire"));
                $message->setDate();
                $message->setCreated();
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
                ['membres' => $membresRepository->findAll()]);
        }
}