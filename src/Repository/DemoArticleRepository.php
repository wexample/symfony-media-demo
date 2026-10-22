<?php

namespace Wexample\SymfonyMediaDemo\Repository;

use Wexample\SymfonyHelpers\Repository\AbstractRepository;
use Wexample\SymfonyMediaDemo\Entity\DemoArticle;
use Wexample\SymfonyMediaDemo\Entity\Traits\Manipulator\DemoArticleEntityManipulatorTrait;

/**
 * @method DemoArticle|null find($id, $lockMode = null, $lockVersion = null)
 */
class DemoArticleRepository extends AbstractRepository
{
    use DemoArticleEntityManipulatorTrait;

    public const string SLUG = 'welcome';

    /**
     * A demo has no fixtures: the article is made the first time the page is
     * opened, and found on every visit after.
     */
    public function findOrCreateDemoArticle(): DemoArticle
    {
        $article = $this->find(DemoArticle::idFor(self::SLUG));

        if (null === $article) {
            $article = new DemoArticle(self::SLUG, 'An article with a cover and attachments');
            $this->getEntityManager()->persist($article);
            $this->getEntityManager()->flush();
        }

        return $article;
    }
}
