<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 17.12.2018 г.
 * Time: 16:59
 */

namespace AppBundle\Service\User;


use AppBundle\Entity\User;

interface UserServiceInterface
{

//    public function register($username, $password, $birthPlace);
    public function register(User $user, string $encodePassword);

    public function findValidUsers();

    public function findByEmail(string $email);

    public function findAll();

    public function findById($id);
}