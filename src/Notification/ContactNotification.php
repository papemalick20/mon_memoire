<?php
 namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Twig\Environment;

class ContactNotification {
     /**
      * @var MailerInterface
      */
      private $mailer;

      /**
       * @var Environment
       */
      private $twig;

    
       public function notify(Contact $contact, MailerInterface $mailer, Environment $twig){
        $message = (new TemplatedEmail())
        ->from('papemalickt792@gmail.com')
        ->to('emorocoly21@gmail.com')
        ->subject('contact au sujet de votre annonce')
        ->htmlTemplate('emails/contact.html.twig')
        ->context([
            'firstname'=> 'firstname',
            'lastname'=> 'lastname',
            'phone'=> 'phone',
            'message'=> 'message'
            
        ]);
        $mailer->send($message);
       

       
        

       }
       
  }