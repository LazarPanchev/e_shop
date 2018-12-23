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

interface CommentServiceInterface
{
    public function addComment(Comment $comment, int $tyreId, User $user);

    public function findComments(int $tyreId);

}