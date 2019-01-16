<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
use AppBundle\Entity\Tyre;
use AppBundle\Entity\User;
use AppBundle\Form\TyreType;
use AppBundle\Service\Comment\CommentServiceInterface;
use AppBundle\Service\Promotion\PromotionServiceInterface;
use AppBundle\Service\Tyre\TyreServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tyres")
 * Class TyreController
 * @package AppBundle\Controller
 */
class TyreController extends Controller
{
    const PAGE_LIMIT = 4;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var TyreServiceInterface
     */
    private $tyreService;

    /**
     * @var PromotionServiceInterface
     */
    private $promotionService;

    public function __construct(TyreServiceInterface $tyreService,
                                UserServiceInterface $userService,
                                PromotionServiceInterface $promotionService)
    {
        $this->tyreService = $tyreService;
        $this->userService = $userService;
        $this->promotionService = $promotionService;
    }

    /**
     * @Route("/", name="tyres_mainPage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainPageAction()
    {

        return $this->render('tyre/main.html.twig');
    }

    /**
     * @Route("/viewAll", name="tyres_view_all")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAllAction(Request $request)
    {
        $tyres = $this
            ->tyreService
            ->findAllTyresWithPromotions();
        $this->promotionService->setPromotions($tyres);

        return $this->handlePaginationProcess($tyres, $request);
    }

    /**
     * @Route("/myTyres", name="tyres_view_mine")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function myTyresAction(Request $request)
    {
        $currentUserId = $this
            ->getUser()
            ->getId();
        $tyres = $this->tyreService->findTyresWithPromotionsByUserId($currentUserId);
        $this->promotionService->setPromotions($tyres);
        return $this->handlePaginationProcess($tyres, $request);
    }


    /**
     * @Route("/view/{tyreId}", name="tyres_view_one")
     * @param int $tyreId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewOneAction(int $tyreId)
    {
        /** @var Tyre $tyre */
        $tyre = $this->tyreService->findOneWithPromotionsAndComments($tyreId);

        if(null===$tyre){
            $this->addFlash('error', 'Tyre not exist!');
            return $this->redirectToRoute('homepage');
        }

        $this->tyreService->increaseViewCount($tyre);
        $this->promotionService->setPromotionsOneTyre($tyre);
        $comments = $tyre->getComments();
        $allPromotions = $tyre->getSeller()->getPromotions();
        $promotions = $this->promotionService->checkPromotionsAreActive($allPromotions);
        return $this->render("tyre/one.html.twig",
            [
                'tyre' => $tyre,
                'comments' => $comments,
                'promotions' => $promotions
            ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/create", name="tyres_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $tyre = new Tyre();
        /** @var Form $form */
        $form = $this->createForm(TyreType::class, $tyre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $currentUser */
            $currentUser = $this->getUser();
            $tyre->setSeller($currentUser);
            $fileName = $this->handlePictureProcess($form);
            if (null === $fileName) {
                return $this->render('tyre/create.html.twig',
                    ['tyre' => $tyre, 'form' => $form->createView()]);
            }

            $this
                ->tyreService
                ->create($tyre, $fileName);

            if (!in_array('ROLE_EDITOR', $currentUser->getRoles())) {
                $role = $this
                    ->getDoctrine()
                    ->getRepository(Role::class);
                $editorRole = $role->findOneBy(['name' => 'ROLE_EDITOR']);
                $currentUser->addRole($editorRole);
                $this->userService->save($currentUser);
            }

            $this->addFlash('success', "Add tyre for sale successful.");
            return $this->redirectToRoute('tyres_view_mine');
        }

        return $this->render("tyre/create.html.twig",
            ['form' => $form->createView(), 'tyre' => $tyre]);

    }

    /**
     * @Route("/edit/{id}", name="tyres_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(int $id, Request $request)
    {
        /** @var Tyre $tyre */
        $tyre = $this->tyreService->findOne($id);
        $this->checkForCurrentUser($tyre);

        /** @var Form $form */
        $form = $this->createForm(TyreType::class, $tyre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileName = $this->handlePictureProcess($form);
            if (null === $fileName) {
                return $this->render('tyre/edit.html.twig',
                    ['tyre' => $tyre, 'form' => $form->createView()]);
            }
            $this->tyreService->edit($tyre, $fileName);
            $this->addFlash('success', "Tyre edited successfully.");
            return $this->redirectToRoute('tyres_view_one',['tyreId'=>$id]);
        }
        return $this->render('tyre/edit.html.twig',
            ['form' => $form->createView(), 'tyre' => $tyre]);
    }


    /**
     * @Route("/delete/{id}", name="tyres_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(int $id, Request $request)
    {
        /** @var Tyre $tyre */
        $tyre = $this->tyreService->findOne($id);
        $this->checkForCurrentUser($tyre);

        $form = $this->createForm(TyreType::class, $tyre);
        $form->handleRequest($request);
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        if (!$currentUser->isAdmin() && !$currentUser->isSeller($tyre)) {
            return $this->redirectToRoute('homepage');
        }
        $this->tyreService->delete($tyre);
        $this->addFlash('success', 'The tyre was successfully deleted!');
        return $this->redirectToRoute('tyres_view_mine');
    }


    private function handlePictureProcess(Form $form)
    {
        /** @var UploadedFile $file */
        $file = $form->getData()->getImage();

        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        try {
            $file->move($this->getParameter('tyre_directory'),
                $fileName);
            return $fileName;
        } catch (FileException $exception) {
            $this->addFlash('error', 'Error occurred while process your request!');
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @param $tyre
     * @return bool|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function checkForCurrentUser($tyre)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        if (!$currentUser->isSeller($tyre) && !$currentUser->isAdmin()) {
            return $this->redirectToRoute('homepage');
        }
        return true;
    }

    private function handlePaginationProcess($tyres, $request)
    {
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tyres, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            self::PAGE_LIMIT/*limit per page*/
        );
        return $this->render("tyre/all.html.twig",
            ['pagination' => $pagination]);

    }
}
