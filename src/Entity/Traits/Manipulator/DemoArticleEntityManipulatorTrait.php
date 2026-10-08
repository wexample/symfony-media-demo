<?php

namespace Wexample\SymfonyMediaDemo\Entity\Traits\Manipulator;

use Wexample\SymfonyHelpers\Entity\Traits\Manipulator\EntityManipulatorTrait;
use Wexample\SymfonyMediaDemo\Entity\DemoArticle;

trait DemoArticleEntityManipulatorTrait
{
    use EntityManipulatorTrait;

    public static function getEntityClassName(): string
    {
        return DemoArticle::class;
    }
}
