<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class UserController
 * @package AppBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService=$userService;
    }

    /**
     * @Route("/", name="admin_home")
     */
    public function indexAction()
    {
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/users", name="admin_users")
     */
    public function showUsersAction()
    {
        $users=$this->userService->findAll();
        return $this->render('admin/users.html.twig',
            ['users'=>$users]);
    }

    /**
     * @Route("/ban/{userId}", name="admin_banUser")
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function banUserAction($userId){
        /** @var User $user */
        $user=$this->userService->findById($userId);
        $user->setIsBanned('1');
        $this->userService->save($user);
        return $this->redirectToRoute('admin_home');
    }

    /**
     * @Route("/unban/{userId}", name="admin_unbanUser")
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function unbanUserAction($userId){
        /** @var User $user */
        $user=$this->userService->findById($userId);
        $user->setIsBanned('0');
        $this->userService->save($user);
        return $this->redirectToRoute('admin_home');
    }
}
