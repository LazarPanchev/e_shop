<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        /** @var User $currentUser */
        $currentUser=$this
            ->getUser();

        if($currentUser && $currentUser->getIsBanned()===true){
//            $this->addFlash('error', 'Access forbidden. Please contact the administration.');
            return $this->redirect($this->generateUrl('security_logout'));
        }
        return $this->render('default/index.html.twig',
            ['user'=>$currentUser]);
    }

    /**
     * @Route("/about", name="about_page")
     */
    public function aboutAction()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/contact", name="contact_page")
     */
    public function contactAction()
    {
        return $this->render('default/contact.html.twig');
    }
}
