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
    public function searchBySize(int $searchedWidth,int $searchedHeight,int $searchedDiameter);

    public function searchByBrand(Form $form);
}