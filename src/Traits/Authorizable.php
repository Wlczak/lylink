<?php

namespace Lylink\Traits;

trait Authorizable
{
    public function isAuthorized(): bool
    {
        return true;
    }

    private bool $authorized;
}
