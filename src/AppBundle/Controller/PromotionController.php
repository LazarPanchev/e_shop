<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Promotion;
use AppBundle\Entity\PromotionsTyres;
use AppBundle\Form\PromotionsTyresType;
use AppBundle\Form\PromotionType;
use AppBundle\Service\Promotion\PromotionServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PromotionController
 * @Route("/promotions")
 * @package AppBundle\Controller
 */
class PromotionController extends Controller
{
    /**
     * @var PromotionServiceInterface
     */
    private $promotionService;


    public function __construct(PromotionServiceInterface $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/add/{id}", name="promotions_add")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addPromotionAction(Request $request, $id)
    {
        $promotion = new Promotion();
        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $this
                ->promotionService
                ->addPromotion($promotion, $id);
            if ($message !== '') {
                $this->addFlash("error", $message);
            } else {
                $this->addFlash('success', 'Add Promotion successful.');
                return $this->redirectToRoute("users_profile",
                    ['id' => $id]);
            }
        }

        return $this->render('promotion/add.html.twig',
            ['form' => $form->createView(),
                'promotion' => $promotion]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/add/tyre/{tyreId}", name="promotions_add_tyre")
     * @param $tyreId
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addTyreToPromotion($tyreId, Request $request)
    {
        $promotionId = $request->request->get('promotionId');
        $promotion = $this->promotionService->findPromotionById($promotionId);
        if (null === $promotion) {
            $this->addFlash('error', 'Promotion not exist!');
            return $this->redirectToRoute('tyres_view_mine');
        }


        $result = $this->promotionService->addTyreToPromotion($promotion, $tyreId);

        if ($result == false) {
            $this->addFlash('error', 'Tyre not exist');
            return $this->redirectToRoute('tyres_view_mine');
        }
        $this->addFlash('success','Tyre add to promotion successful!');
        return $this->redirectToRoute('tyres_view_one',['id'=>$tyreId]);

    }
}
