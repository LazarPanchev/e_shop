<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 20.12.2018 г.
 * Time: 11:19
 */

namespace AppBundle\Service\Tyre;


use AppBundle\Entity\Tyre;
use Symfony\Component\Form\FormInterface;

interface TyreServiceInterface
{
    public function findAll();

    public function findTyreByTyreId($tyreId);

    public function findOne(int $id);

    public function create(Tyre $tyre, string $fileName);

    public function delete(Tyre $tyre);

    public function edit($tyre, $fileName);

    public function findAllTyresWithPromotions();

    public function findTyresWithPromotionsByUserId($currentUserId);

    public function findOneWithPromotionsAndComments($tyreId);

    public function increaseViewCount($tyre);

    public function setPromotionsToPurchaseDetails($purchaseDetails);
}