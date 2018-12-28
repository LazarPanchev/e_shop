<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 17.12.2018 г.
 * Time: 17:02
 */

namespace AppBundle\Service\User;


use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Repository\RoleRepository;
use AppBundle\Repository\UserRepository;

class UserService implements UserServiceInterface
{
    const INITIAL_MONEY = 100;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;


    public function __construct(UserRepository $userRepository,
                                RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


    /**
     * @param User $user
     * @param string $encodePassword
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function register(User $user, string $encodePassword)
    {
        /** @var Role $userRole */
        $userRole = $this
            ->roleRepository
            ->findOneBy(['name' => 'ROLE_USER']);
        $user->addRole($userRole);
        $this->checkIsAdmin($user);

        $user->setPassword($encodePassword);
        if(null !== $user->getAvatar()){
            $avatar=$user->getAvatar() . '.jpg';
            $user->setAvatar($avatar);
        }else{
            $user->setAvatar('no_avatar.jpg');
        }

        if (null === $user->getMoney()) {
            $user->setMoney(self::INITIAL_MONEY);
        }

        $this->userRepository->save($user);
    }

    public function findValidUsers()
    {
        // TODO: Implement findValidUsers() method.
    }

    public function findByEmail(string $email)
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }


    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param User $user
     * @return void
     */
    private function checkIsAdmin(User $user){
        $users=$this->userRepository->findAll();

        if(count($users)==0){
            /** @var Role $roleAdmin */
            $roleAdmin=$this->roleRepository->findOneBy(['name'=>'ROLE_ADMIN']);
            $user->addRole($roleAdmin);
        }
    }

    public function findById($id)
    {
        return $this->userRepository->find($id);
    }
}