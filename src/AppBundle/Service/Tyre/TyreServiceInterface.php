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

    public function findOne(int $id);

    public function findById(int $id);

    public function create(Tyre $tyre, string $fileName);

    public function delete(Tyre $tyre);
}