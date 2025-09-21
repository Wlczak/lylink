<?php

namespace Lylink\Traits;

trait Authorizable
{
    public function isAuthorized(): bool
    {
        return $this->authorized;
    }

    private bool $authorized;
}
