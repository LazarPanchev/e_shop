<?php

namespace AppBundle\Controller;

use AppBundle\Service\Search\SearchServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends Controller
{
    const PAGE_LIMIT = 4;
    /**
     * @var SearchServiceInterface
     */
    private $searchService;

    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;

    }

    /**
     * @Route("/tyres/search/{searchedWidth}/{searchedHeight}/{searchedDiameter}", name="tyres_search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(int $searchedWidth,int $searchedHeight,int $searchedDiameter, Request $request)
    {
//        /** @var Form $form */
//        $form = $this->createFormSize();
//        $form->handleRequest($request);
        $tyres=$this->searchService->searchBySize($searchedWidth,$searchedHeight,$searchedDiameter);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tyres, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            self::PAGE_LIMIT/*limit per page*/
        );
        return $this->render("tyre/all.html.twig",
            ['pagination' => $pagination]);

//        return $this->render('tyre/search.html.twig',
//            [
//                'form' => $form->createView()
//            ]);
    }

    /**
     * @Route("/tyres/search/size", name="tyres_search_size")
     * @param $form
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchBySize($form, $request)
    {

    }

    /**
     * @Route("tyres/search/brand",name="tyres_search_brand")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
//    public function searchByBrand(Request $request)
//    {
//        $formBrand = $this->createFormBrand();
//        $formBrand->handleRequest($request);
//        $tyres = $this
//            ->searchService
//            ->searchByBrand($formBrand);
//        return $this->handlePaginationProcess($tyres, $request);
//    }


//    private function createFormBrand()
//    {
//        /** @var Form $form */
//        $form = $this
//            ->createFormBuilder()
//            ->add('Brand', TextType::class,
//                ['attr' => ['placeholder' => 'Brand']])
//            ->add('search', SubmitType::class)
//            ->getForm();
//        return $form;
//    }

    private function createFormSize()
    {
        $form = $this
            ->createFormBuilder()
            ->add('width', ChoiceType::class,
                ['choices' => ['Choose a Width' => '', '115' => '115', '125' => '125', '135' => '135', '145' => '145', '155' => '155', '165' => '165',
                    '175' => '175', '185' => '185', '195' => '195', '205' => '205', '215' => '215', '225' => '225', '235' => '235',
                    '245' => '245', '255' => '255', '265' => '265', '275' => '275', '285' => '285', '295' => '295', '305' => '305',
                    '315' => '315', '325' => '325']])
            ->add('height', ChoiceType::class,
                ['choices' => ['Choose a Height' => '', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55', '60' => '60',
                    '65' => '65', '70' => '70', '75' => '75', '80' => '80']])
            ->add('diameter', ChoiceType::class,
                ['choices' => ['Choose a Diameter' => '', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16',
                    '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22',
                    '23' => '23', '24' => '24']])
            ->add('search', SubmitType::class)
            ->getForm();
        return $form;
    }
}
