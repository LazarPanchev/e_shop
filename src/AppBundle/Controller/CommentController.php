<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Tyre;
use AppBundle\Entity\User;
use AppBundle\Form\CommentType;
use AppBundle\Service\Comment\CommentServiceInterface;
use AppBundle\Service\Purchase\PurchaseServiceInterface;
use AppBundle\Service\Tyre\TyreServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends Controller
{
    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * @var TyreServiceInterface
     */
    private $tyreService;

    /**
     * @var PurchaseServiceInterface
     */
    private $purchaseService;


    public function __construct(CommentServiceInterface $commentService,
                                TyreServiceInterface $tyreService,
                                PurchaseServiceInterface $purchaseService)
    {
        $this->commentService=$commentService;
        $this->tyreService=$tyreService;
        $this->purchaseService=$purchaseService;
    }

    /**
     * @Route("/tyre/{tyreId}/comment", name="add_comment", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @param int $tyreId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addComment(Request $request, int $tyreId)
    {
        /** @var User $user */
        $user=$this->getUser();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);


        $this->commentService->addComment($comment,$tyreId, $user);
        return $this->redirectToRoute('tyres_view_one',
            ['id'=>$tyreId]);
    }
}
