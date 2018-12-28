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

    public function searchBySize($request)
    {
        $width = $request->query->get('width');
        $height = $request->query->get('height');
        $diameter = $request->query->get('diameter');
        $sortingMethod=['diameter'=>'ASC','width'=>'ASC'];
        if($width===''){
            if($height===''){
                if($diameter===''){
                    return $this->searchRepository->findAll();
                }
                return $this->searchRepository->findBy(['width'=>$width],$sortingMethod);
            }
            if($diameter===''){
                return $this->searchRepository->findBy(['height'=>$height],$sortingMethod);
            }
            return $this->searchRepository->findBy(['height'=>$height,'diameter'=>$diameter],$sortingMethod);
        }

        if($height===''){
            if($diameter===''){
                return $this->searchRepository->findBy(['width'=>$width],$sortingMethod);
            }
            return $this->searchRepository->findBy(['width'=>$width,'diameter'=>$diameter],$sortingMethod);
        }

        if($diameter===''){
            return $this->searchRepository->findBy(['width'=>$width,'height'=>$height],$sortingMethod);
        }

        return $this->searchRepository->findBy(['width'=>$width,'height'=>$height,'diameter'=>$diameter],$sortingMethod);
    }

    public function searchByBrand($request)
    {
        $searchedWord=$request->query->get('searchedWord');
        return $this
            ->searchRepository
            ->findByBrand($searchedWord);
    }
}