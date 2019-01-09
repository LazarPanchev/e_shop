<?php

namespace AppBundle\Controller;

use AppBundle\Service\Search\SearchServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * SearchController constructor.
     * @param SearchServiceInterface $searchService
     */
    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;

    }

    /**
     * @Route("/tyres/search", name="tyres_search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $searchedWord=$request->get('search');
        if($searchedWord!==null){
            return $this->redirect($this
                ->generateUrl('tyres_search_brand',
                    ['searchedWord' => $searchedWord]));
        }
        /** @var Form $form */
        $form = $this->createFormSize();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $width = $form->getData()['Width'];
            $height = $form->getData()['Height'];
            $diameter = $form->getData()['Diameter'];
            return $this->redirect($this
                ->generateUrl('tyres_search_size',
                    ['width' => $width, 'height' => $height, 'diameter' => $diameter]));
        }

        return $this->render('tyre/search.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/tyres/search/size", name="tyres_search_size")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchBySize(Request $request)
    {
        $tyres = $this
            ->searchService
            ->searchBySize($request);

        return $this->handlePaginationProcess($tyres,$request);
    }

    /**
     * @Route("/tyres/search/brand", name="tyres_search_brand")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchByBrand(Request $request){
        $tyres = $this
            ->searchService
            ->searchByBrand($request);

        return $this->handlePaginationProcess($tyres, $request);
    }

    /**
     * @Route("tyres/search/quick/brand/{brand}", name="tyres_search_quick_brand")
     * @param $brand
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function quickSearchByBrand($brand, Request $request){
        $tyres= $this
            ->searchService
            ->quickSearchByBrand($brand);

        return $this->handlePaginationProcess($tyres, $request);
    }

    /**
     * @Route("tyres/search/quick/category/{category}", name="tyres_search_quick_category")
     * @param $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function quickSearchByCategory($category, Request $request){
        $tyres= $this
            ->searchService
            ->quickSearchByCategory($category);

        return $this->handlePaginationProcess($tyres, $request);
    }

    /**
     * @Route("tyres/search/quick/size/{width}/{height}/{diameter}", name="tyres_search_quick_size")
     * @param $width
     * @param $height
     * @param $diameter
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function quickSearchBySize($width,$height,$diameter, Request $request){
        $tyres= $this
            ->searchService
            ->quickSearchBySize($width,$height,$diameter);

        return $this->handlePaginationProcess($tyres, $request);
    }


    /**]
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createFormSize()
    {
        $form = $this
            ->createFormBuilder()
            ->add('Width', ChoiceType::class,
                ['choices' => ['All' => '', '115' => '115', '125' => '125', '135' => '135', '145' => '145', '155' => '155', '165' => '165',
                    '175' => '175', '185' => '185', '195' => '195', '205' => '205', '215' => '215', '225' => '225', '235' => '235',
                    '245' => '245', '255' => '255', '265' => '265', '275' => '275', '285' => '285', '295' => '295', '305' => '305',
                    '315' => '315', '325' => '325']])
            ->add('Height', ChoiceType::class,
                ['choices' => ['All' => '', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55', '60' => '60',
                    '65' => '65', '70' => '70', '75' => '75', '80' => '80']])
            ->add('Diameter', ChoiceType::class,
                ['choices' => ['All' => '', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16',
                    '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22',
                    '23' => '23', '24' => '24']])
            ->add('search', SubmitType::class)
            ->getForm();
        return $form;
    }

    private function handlePaginationProcess($tyres,$request){
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
