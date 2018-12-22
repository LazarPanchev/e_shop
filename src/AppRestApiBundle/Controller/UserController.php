<?php

namespace AppRestApiBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
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
     * @Route("/deposit/{id}", methods={"PATCH"}, name="rest_api_users_deposit")
     * @param int $id
     * @param Request $request
     * @return JsonResponse|Response
     */
//    public function addMoneyAction(int $id, Request $request)
//    {
//        try {
//            $user = $this
//                ->getDoctrine()
//                ->getRepository(User::class)
//                ->find($id);
////            $data=$request->request->all();
////            $amount=floatval($data['amount']);
//                    $data = $request->request->all();
//                $amount = floatval($data['data']);
//            if($amount>0){
//                $userMoney=$user->getMoney();
//                $user->setMoney($userMoney + $amount);
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($user);
//                $em->flush();
//                return new Response(null, Response::HTTP_OK);
//            }else{
//                return new Response('',
//                    Response::HTTP_BAD_REQUEST,
//                    array('content-type' => 'application/json')
//                );
//            }
//        } catch (\Exception $ex) {
//            return new Response(json_encode(['error' => $ex->getMessage()]),
//                Response::HTTP_BAD_REQUEST,
//                array('content-type' => 'application/json')
//            );
//        }
//    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function editAction(Request $request, int $id)
    {

    }
}
