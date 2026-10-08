<?php

namespace Wexample\SymfonyMediaDemo\Controller\Pages;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyDesignSystem\Attribute\MenuItem;
use Wexample\SymfonyForms\Attribute\EntityFormProcessor;
use Wexample\SymfonyHelpers\Helper\VariableHelper;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;
use Wexample\SymfonyMediaDemo\Entity\DemoArticle;
use Wexample\SymfonyMediaDemo\Repository\DemoArticleRepository;
use Wexample\SymfonyMediaDemo\Service\FormProcessor\DemoArticleFormProcessor;
use Wexample\SymfonyMediaDemo\Traits\SymfonyMediaDemoBundleClassTrait;
use Wexample\SymfonyMediaDs\Controller\Pages\MediaLibraryController;

/**
 * An article picking its cover and its attachments in the library, through
 * symfony-media-ds's field, which opens the library in a modal.
 */
#[Route(path: '/media/article/', name: 'media_demo_')]
final class MediaDemoController extends AbstractPagesController
{
    use SymfonyMediaDemoBundleClassTrait;

    final public const string ROUTE_INDEX = VariableHelper::INDEX;

    final public const string ROUTE_ARTICLE = 'article';

    #[Route(path: '', name: self::ROUTE_INDEX)]
    #[MenuItem(MediaLibraryController::MENU_GROUP, 1)]
    public function index(DemoArticleRepository $articleRepository): Response
    {
        return $this->renderPage(self::ROUTE_INDEX, [
            'article' => $articleRepository->findOrCreateDemoArticle(),
        ]);
    }

    #[EntityFormProcessor(DemoArticleFormProcessor::class, DemoArticle::class)]
    #[Route(path: '{id}/edit', name: self::ROUTE_ARTICLE)]
    public function article(FormInterface $demoArticleForm): Response
    {
        return $this->renderPage(self::ROUTE_ARTICLE, [
            'article' => $demoArticleForm->getData(),
            'form_article' => $demoArticleForm->createView(),
        ]);
    }
}
