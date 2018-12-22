<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tyre;
use AppBundle\Entity\User;
use AppBundle\Form\TyreType;
use AppBundle\Service\Tyre\TyreServiceInterface;
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

    private $tyreService;

    public function __construct(TyreServiceInterface $tyreService)
    {
        $this->tyreService = $tyreService;
    }

    /**
     * @Route("/", name="tyres_view_all")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAllAction(Request $request)
    {
        $tyres = $this
            ->tyreService
            ->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tyres, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            self::PAGE_LIMIT/*limit per page*/
        );
        return $this->render("tyre/all.html.twig",
            ['pagination' => $pagination]);
    }

    /**
     * @Route("/view/{id}", name="tyres_view_one")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewOneAction(int $id)
    {
        $tyre = $this->findTyre($id);

        return $this->render("tyre/one.html.twig",
            ['tyre' => $tyre]);
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
        $form = $this->createForm(TyreType::class, $tyre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

            $this->addFlash('success', "Add tyre successful.");
            return $this->redirectToRoute('tyres_view_all');
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
        $tyre = $this->findTyre($id);
        $this->checkForCurrentUser($tyre);

        $form = $this->createForm(TyreType::class, $tyre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $fileName = $this->handlePictureProcess($form);
                if (null === $fileName) {
                    return $this->render('tyre/edit.html.twig',
                        ['tyre' => $tyre, 'form' => $form->createView()]);
                }
                $this->tyreService->create($tyre, $fileName);
                $this->addFlash('success', "Tyre edited successfully.");
                return $this->redirectToRoute('tyres_view_all');
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
        $tyre=$this->findTyre($id);
        $this->checkForCurrentUser($tyre);

        $form = $this->createForm(TyreType::class, $tyre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $this->tyreService->delete($tyre);
            return $this->redirectToRoute('tyres_view_all');
        }

        return $this->render('tyre/delete.html.twig',
            ['tyre' => $tyre, 'form' => $form->createView()]);

    }

    /**
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function myTyresAction()
    {

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
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function findTyre($id){
        $tyre = $this->tyreService->findOne($id);
        if (null ===$tyre) {
            return $this->redirectToRoute('homepage');
        }

        return $tyre;
    }

    /**
     * @param $tyre
     * @return bool|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function checkForCurrentUser($tyre){
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        if (!$currentUser->isSeller($tyre) && !$currentUser->isAdmin()) {
            return $this->redirectToRoute('homepage');
        }
        return true;
    }
}
