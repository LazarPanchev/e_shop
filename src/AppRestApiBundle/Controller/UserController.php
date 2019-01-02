<?php

namespace AppRestApiBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 * @Route("/users")
 * Class UserController
 * @package AppRestApiBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/", methods={"GET"}, name="rest_api_users")
     */
    public function usersAction()
    {
        $users = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($users, 'json');

        return new Response($json,
            Response::HTTP_OK,
            array('content-type' => 'application/json')
        );
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/deposit", methods={"PATCH"}, name="rest_api_users_deposit")
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function addMoneyAction(Request $request)
    {
        try {
            $user = $this->getUser();
                $amount =$request->request->get('amount');
//            return new Response(json_encode([floatval($amount['amount'])]));
            $deposit=floatval($amount['amount']);
            if($deposit>0){
                $userMoney=$user->getMoney();
                $user->setMoney($userMoney + $deposit);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return new Response(json_encode($deposit), Response::HTTP_OK);
            }else{
                return new Response(json_encode($deposit),
                    Response::HTTP_BAD_REQUEST,
                    array('content-type' => 'application/json')
                );
            }
        } catch (\Exception $ex) {
            return new Response(json_encode(['error' => $ex->getMessage()]),
                Response::HTTP_BAD_REQUEST,
                array('content-type' => 'application/json')
            );
        }
    }

}
