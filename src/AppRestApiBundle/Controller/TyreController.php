<?php

namespace AppRestApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tyres")
 * Class TyreController
 * @package AppRestApiBundle\Controller
 */
class TyreController extends Controller
{
    /**
     * @Route("/{tyreId}", methods={"GET"})
     * @param $tyreId
     * @return Response
     */
    public function getTyreAction($tyreId)
    {
        $tyre=$this
            ->getDoctrine()
            ->getRepository("AppBundle:Tyre")
            ->find($tyreId);

        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($tyre, 'json');

        return new Response($json,
            Response::HTTP_OK,
            array('content-type' => 'application/json')
        );
    }
}
