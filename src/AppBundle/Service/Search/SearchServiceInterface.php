<?php
/**
 * Created by PhpStorm.
 * User: Lazar
 * Date: 25.12.2018 г.
 * Time: 21:10 ч.
 */

namespace AppBundle\Service\Search;


use Symfony\Component\Form\Form;

interface SearchServiceInterface
{
    public function searchBySize($request);

    public function searchByBrand($request);

    public function quickSearchByBrand($brand);

    public function quickSearchBySize($width, $height, $diameter);

    public function quickSearchByCategory($category);
}