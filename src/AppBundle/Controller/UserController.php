<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Service\Purchase\PurchaseServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var PurchaseServiceInterface
     */
    private $purchaseService;

    public function __construct(UserServiceInterface $userService, PurchaseServiceInterface $purchaseService)
    {
        $this->userService = $userService;
        $this->purchaseService=$purchaseService;
    }

    /**
     * @Route("/register", name="users_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $email = $user->getEmail();
                $desiredUser = $this->userService->findByEmail($email);
                if (null != $desiredUser) {
                    $this->addFlash("error", "Username with email: $email already taken!");
                    $user->setEmail('');
                    return $this->render('user/register.html.twig',
                        ['form' => $form->createView(),
                            'user' => $user]);
                }
                $encodePassword = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPassword());

                $this->userService->register($user, $encodePassword);
                $this->addFlash("success", "User successfully created.");

                return $this->redirectToRoute("security_login");
            }
            return $this->render('user/register.html.twig',
                ['form' => $form->createView(),
                    'user' => $user]);

        }
        return $this->render('user/register.html.twig',
            ['form' => $form->createView(),
                'user' => $user]);

    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/profile/{id}", name="users_profile")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function profileAction($id)
    {
        /** @var User $currentUser */
        $currentUser = $this
            ->userService
            ->findById($id);
        if ($currentUser === null ||
            $currentUser->getId() !== $this->getUser()->getId()) {
            return $this->redirectToRoute('homepage');
        }
        $purchases= $this->purchaseService->findPurchaseByUser($currentUser->getId());
        return $this->render('user/profile.html.twig',
            ['user' => $currentUser,
                'purchases'=>$purchases]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/deposit/{id}", name="users_deposit")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function depositAction($id)
    {
        /** @var User $currentUser */
        $currentUser = $this
            ->userService
            ->findById($id);
        if ($currentUser === null || $currentUser->getId() !== $this->getUser()->getId()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/deposit.html.twig',
            ['user' => $currentUser]);
    }
}
