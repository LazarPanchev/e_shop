<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $currentUser=$this
            ->getUser();
        return $this->render('default/index.html.twig',
            ['user'=>$currentUser]);
    }
}
