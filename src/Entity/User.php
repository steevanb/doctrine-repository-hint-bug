<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User
{
    private $id;

    protected $name;

    /** @var Collection */
    protected $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function setComments(iterable $comments): self
    {
        $this->clearComments();
        /** @var Comment $comment */
        foreach ($comments as $comment) {
            $this->addComment($comment);
        }

        return $this;
    }

    public function addComment(Comment $comment): self
    {
        if ($this->comments->contains($comment) === false) {
            $this->comments->add($comment);
            $comment->setUser($this);
        }

        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            $comment->setUser(null);
        }

        return $this;
    }

    public function clearComments(): self
    {
        foreach ($this->getComments() as $comment) {
            $this->removeComment($comment);
        }
        $this->comments->clear();

        return $this;
    }
}
