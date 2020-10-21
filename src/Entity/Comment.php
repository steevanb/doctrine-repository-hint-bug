<?php

declare(strict_types=1);

namespace App\Entity;

class Comment
{
    private $id;

    protected $comment;

    /** @var ?User */
    protected $user;

    public function setUser(User $user = null): self
    {
        $this->user = $user;
        if ($user instanceof User) {
            $user->addComment($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
