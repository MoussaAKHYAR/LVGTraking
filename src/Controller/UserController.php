<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $user;
    private $em;
    public function __construct(UserRepository $user, ObjectManager $em)
    {
        $this->user = $user;
        $this->em = $em;

    }
    
    public function liste()
    {
        $users = $this->user->findAll();
        return $this->render('user/liste.html.twig', compact('users'));
    }

    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $role = ['ROLE_USER', $request->get('roles')];
            $user->setRoles($role);
            $this->em->flush();
            return $this->redirectToRoute('listeUser');
        }
        return $this->render('user/edit.html.twig',[
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    public function findId($id)
    {
        $users = $this->user->find($id);
        $mail = new PHPMailer(true);
        $users->setConfirmationToken(sha1(uniqid()));
        $users->setPasswordRequestedAt(new \DateTime());
        $this->em->flush();
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'ablodinho62238@gmail.com';                     // SMTP username
            $mail->Password   = '783077043';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('ablodinho62238@gmail.com', 'LVG_TRACKING');
            $mail->addAddress($users->getEmail());     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'Veuillez changer votre mot de passe en cliquant sur ce lien ->: <a href="http://localhost:8000/resetting/reset/'.$users->getConfirmationToken().'">cliquer ici</a> ';
            $mail->AltBody = 'Default text';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return $this->redirectToRoute('listeUser');
    }

    public function changePassword()
    {
        return $this->render('user/change.html.twig');
    }
    public function resetPassword()
    {
        $users = $this->user->findOneByEmail($_POST['email']);
        if ($users != null)
        {
            $mail = new PHPMailer(true);
            $users->setConfirmationToken(sha1(uniqid()));
            $users->setPasswordRequestedAt(new \DateTime());
            $this->em->flush();
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'ablodinho62238@gmail.com';                     // SMTP username
                $mail->Password   = '783077043';                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 465;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('ablodinho62238@gmail.com', 'LVG_TRACKING');
                $mail->addAddress($users->getEmail());     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'Pour changer votre mot de passe veuillez cliquer sur ce lien ->  : <a href="http://localhost:8000/resetting/reset/'.$users->getConfirmationToken().'">cliquer ici</a> ';
                $mail->AltBody = 'Default text';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}
