<?php
/**
 * Created by PhpStorm.
 * User: Lazar
 * Date: 23.12.2018 г.
 * Time: 16:40 ч.
 */

namespace AppBundle\Service\Comment;


use AppBundle\Entity\Comment;
use AppBundle\Entity\Tyre;
use AppBundle\Entity\User;
use AppBundle\Repository\CommentRepository;
use AppBundle\Repository\TyreRepository;

class CommentService implements CommentServiceInterface
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var TyreRepository
     */
    private $tyreRepository;

    public function __construct(CommentRepository $commentRepository,
                                TyreRepository $tyreRepository)
    {
        $this->commentRepository=$commentRepository;
        $this->tyreRepository=$tyreRepository;
    }

    /**
     * @param int $tyreId
     * @return array
     */
    public function findComments(int $tyreId)
    {
        return $this->commentRepository->findByIdASC($tyreId);
    }


    /**
     * @param Comment $comment
     * @param int $tyreId
     * @param User $user
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addComment(Comment $comment,int $tyreId, User $user)
    {
        /** @var Tyre $tyre */
        $tyre=$this->tyreRepository->find($tyreId);
        $comment->setTyre($tyre);
        $comment->setAuthor($user);
        $this->commentRepository->save($comment);
    }
}