<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CommentRepository;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class IndexController
{
    private CommentRepository $commentRepository;

    private Environment $twig;

    public function __construct(CommentRepository $commentRepository, Environment $twig)
    {
        $this->commentRepository = $commentRepository;
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        // Define a default HINT to remove "c0_.user_id AS user_id_2" in SQL queries
        $this
            ->commentRepository
            ->getEntityManager()
            ->getConfiguration()
            ->setDefaultQueryHint(Query::HINT_FORCE_PARTIAL_LOAD, true);

        dump(
            'defaultForcePartialLoad(): c0_.user_id AS user_id_2 should NOT BE there and IS NOT there: default hint are taken int account.',
            $this->commentRepository->defaultForcePartialLoad(),
            'forcePartialLoadEnabled(): c0_.user_id AS user_id_2 should NOT BE there and IS NOT there: default hint is overriden manually.',
            $this->commentRepository->forcePartialLoadEnabled(),
            'forcePartialLoadDisabled(): c0_.user_id AS user_id_2 should BE there and IS there: default hint is overriden manually.',
            $this->commentRepository->forcePartialLoadDisabled()
        );

        // c0_.user_id AS user_id_2 is in the query but should not be
        $this->commentRepository->find(1);

        // c0_.user_id AS user_id_2 is in the query but should not be
        $this->commentRepository->findAll();

        // c0_.user_id AS user_id_2 is in the query but should not be
        $this->commentRepository->findBy(['id' => 1]);

        // c0_.user_id AS user_id_2 is in the query but should not be
        $this->commentRepository->findOneBy(['id' => 1]);

        return new Response($this->twig->render('index.html.twig'));
    }
}
