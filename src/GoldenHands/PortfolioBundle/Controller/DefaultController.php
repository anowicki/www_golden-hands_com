<?php

namespace GoldenHands\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
        
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
        
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
        $email_subject = "Website Contact Form:  $name \n\n\n";
        $email_body = $email_subject . "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
        


        $fs = new Filesystem();

        $file = '/mail/'.mt_rand().'.txt';
        try {
            $fs->touch($file);
            $fs->dumpFile($file, $email_body);
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at ".$e->getPath();
        }
            

  
        echo 'true';
        exit();
        
      
    
    }
    
}
