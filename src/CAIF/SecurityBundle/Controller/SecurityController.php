<?php

namespace CAIF\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Routing\RequestContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use CAIF\SharedBundle\Entity\Person;

/**
 * Security Controller
 */
class SecurityController extends Controller
{
    /**
     * Login screen
     *
     * @Route("/login", name="caif_security_login")
     */
    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        $error = '';
        if ($helper->getLastAuthenticationError(false)) {
            $error = $helper->getLastAuthenticationError()->getMessageKey();
        }

        return $this->render('CAIFSecurityBundle::login.html.twig', [
            'username' => $helper->getLastUsername(),
            'error'    => $error,
        ]);
    }

    /**
     * User forgot password
     *
     * @Route("/forgot", name="caif_security_forgot")
     */
    public function forgotAction(Request $request)
    {
        $username = $request->request->get('_username');

        $repository = $this->getDoctrine()->getRepository('CAIFSharedBundle:Person');
        $person     = $repository->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('CAIFSharedBundle:Admin', 'a', 'WITH', 'a.id = p.id')
            ->leftJoin('CAIFSharedBundle:Host', 'h', 'WITH', 'h.id = p.id')
            ->leftJoin('CAIFSharedBundle:Student', 's', 'WITH', 's.id = p.id')
            ->where('a.email = :username')
            ->orWhere('h.email = :username')
            ->orWhere('s.email = :username')
            ->orWhere('p.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getSingleResult();

        /* if they have an account, reset pass and send them an email */
        if ($person !== null) {
            /* make/set temp password */
            $factory        = $this->get('security.encoder_factory');
            $encoder        = $factory->getEncoder($person);
            $hash           = time();
            $hash           = md5($hash);
            $hash           = substr(str_shuffle($hash), 0, 8);
            $uniquePassword = 'CAIF-'.$hash;
            $newPassword    = md5($uniquePassword);
            $person->setTempPassword($newPassword);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            /* email the user */
            $subject = 'CAIF Forgot Password';
            $from    = 'noreply@caifclemson.org';
            $to      = $person->getEmail();
            $message = 'A new password has been requested for your account. Please login and change your password.
                    <br>
                    Click here to change your password
                    <a href="caifclemson.org/forgotPassword/'.$uniquePassword.'">
                         caifclemson.org/forgotPassword/'.$uniquePassword.'
                    </a>
                    <br>
                    If you have recieved this in error, please ignore this message.';

            $emailService = $this->get('caif.shared.email');
            $emailService->sendEmail($subject, $from, $to, $message);

            /* store flash message */
            $this->addFlash('success', 'Your temporary password has been assigned. Please check your email ('.$person->getEmail().') for your temporary password.');
        } else {
            /* user does not have an account */
            $this->addFlash('error', 'Username or email not found');
        }

        return $this->loginAction($request);
    }


    /**
     * Forgot password login (login with the temp password)
     *
     * @Route("/forgotPassword/{tempPass}", name="caif_security_forgotPassword")
     */
    public function forgotPasswordAction($tempPass)
    {
        $person = $this->getDoctrine()->getRepository('CAIFSharedBundle:Person')
            ->findOneBy(['tempPassword' => md5($tempPass)]);

        if (count($person) > 0) {
            /* login the user with their roles */
            $token = new UsernamePasswordToken($person, null, 'secured_area', $person->getRoles());
            $this->get('security.context')->setToken($token);

            /* store flash message */
            $this->addFlash('info', 'Please update your password.');
        }

        return $this->redirectToRoute('caif_shared_profile_updatePassword', ['tempPass' => $tempPass]);
    }
}
