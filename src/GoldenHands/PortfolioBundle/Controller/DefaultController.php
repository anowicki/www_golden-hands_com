<?php

namespace GoldenHands\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    
    /**
     * @Route("/send", name="send_massage")
     * @Template()
     */
    public function sendAction(Request $request) {
            
    // Check for empty fields
    if(empty($_POST['name'])  		||
       empty($_POST['email']) 		||
       empty($_POST['phone']) 		||
       empty($_POST['message'])	||
       !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
       {
            echo "No arguments Provided!";
            echo 'false';
            exit();
       }
	
        $name = $_POST['name'];
        $email_address = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        // Create the email and send the message
        $email_subject = "Website Contact Form:  $name";
        $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
        $emails[] = 'andrzejnowicki.ns@gmail.com';
        
            
        $swift_message = \Swift_Message::newInstance();
        $swift_message->setSubject($email_subject);
        $swift_message->setBody($email_body);
        $swift_message->setFrom($email_address);
        $swift_message->setTo($emails);
        
        $this->get('mailer')->send($swift_message);
        echo 'true';
        exit();
        
      
    
    }
    
}
