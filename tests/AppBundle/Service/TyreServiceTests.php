<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 10.1.2019 г.
 * Time: 8:37
 */

namespace Tests\AppBundle\Service;


use AppBundle\Entity\Tyre;
use AppBundle\Service\Tyre\TyreService;
use Doctrine\ORM\OptimisticLockException;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TyreServiceTests extends KernelTestCase
{
    /**
     * @var null|\Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;


    public function __construct()
    {
        parent::__construct();
        $kernel = self::bootKernel();
        $this->container=$kernel->getContainer();
    }

    /**
     */
    public function testFindOne_add_positiveNumber_expect_returnTyre()
    {
        $tyreService = $this->container->get(TyreService::class);
        try {
            $result = $tyreService->findOne(1);
        } catch (OptimisticLockException $e) {
            dump($e->getMessage());
            exit();
        }
        $this->assertEquals(Tyre::class, $result);
    }
}