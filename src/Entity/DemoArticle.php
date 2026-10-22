<?php

namespace Wexample\SymfonyMediaDemo\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Wexample\SymfonyHelpers\Entity\AbstractEntity;
use Wexample\SymfonyMedia\Entity\Media;
use Wexample\SymfonyMediaDemo\Repository\DemoArticleRepository;

/**
 * An entity using the library the way an application does: a cover, one
 * media (ManyToOne), and attachments, several (ManyToMany). Plain relations:
 * the library knows nothing of who uses its media.
 */
#[ORM\Entity(repositoryClass: DemoArticleRepository::class)]
#[ORM\Table(name: 'demo_media_article')]
class DemoArticle extends AbstractEntity
{
    public const string ID_NAMESPACE = '8b4e1f27-3c9a-5d06-a1e8-6f2b9c7d4a15';

    #[ORM\Column(type: Types::STRING, length: 255)]
    protected string $title;

    #[ORM\ManyToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    protected ?Media $cover = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class)]
    #[ORM\JoinTable(name: 'demo_media_article_attachment')]
    protected Collection $attachments;

    public function __construct(
        string $slug,
        string $title
    ) {
        parent::__construct();

        $this->title = $title;
        $this->attachments = new ArrayCollection();
        $this->setId(self::idFor($slug));
    }

    public static function idFor(string $slug): Uuid
    {
        return Uuid::v5(Uuid::fromString(self::ID_NAMESPACE), $slug);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCover(): ?Media
    {
        return $this->cover;
    }

    public function setCover(?Media $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    /**
     * @param iterable<Media> $attachments
     */
    public function setAttachments(iterable $attachments): static
    {
        $this->attachments = new ArrayCollection([...$attachments]);

        return $this;
    }
}
