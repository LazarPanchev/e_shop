<?php
/**
 * Created by PhpStorm.
 * User: Lazar
 * Date: 25.12.2018 г.
 * Time: 21:10 ч.
 */

namespace AppBundle\Service\Search;


use AppBundle\Repository\SearchRepository;
use Symfony\Component\Form\Form;

class SearchService implements SearchServiceInterface
{
    /**
     * @var SearchRepository
     */
    private $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository=$searchRepository;
    }

    public function searchBySize(int $searchedWidth,int $searchedHeight,int $searchedDiameter)
    {
        return $this->searchRepository->findBySize($searchedWidth,$searchedHeight,$searchedDiameter);
    }

    public function searchByBrand(Form $form)
    {
        $searchedWord= $form->getData()['Brand'];
        return $this->searchRepository->findByBrand($searchedWord);
    }
}