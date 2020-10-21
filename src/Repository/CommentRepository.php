<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CommentRepository extends EntityRepository
{
    public function getEntityManager(): EntityManagerInterface
    {
        return parent::getEntityManager();
    }

    public function defaultForcePartialLoad(): string
    {
        return $this
            ->createQueryBuilder('comment')
            ->select('PARTIAL comment.{id, comment}')
            ->getQuery()
            ->getSQL();
    }

    public function forcePartialLoadEnabled(): string
    {
        return $this
            ->createQueryBuilder('comment')
            ->select('PARTIAL comment.{id, comment}')
            ->getQuery()
            ->setHint(Query::HINT_FORCE_PARTIAL_LOAD, true)
            ->getSQL();
    }

    public function forcePartialLoadDisabled(): string
    {
        return $this
            ->createQueryBuilder('comment')
            ->select('PARTIAL comment.{id, comment}')
            ->getQuery()
            ->setHint(Query::HINT_FORCE_PARTIAL_LOAD, false)
            ->getSQL();
    }
}
