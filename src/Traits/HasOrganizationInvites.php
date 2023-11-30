<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\OrganizationInvites;

trait HasOrganizationInvites
{
    public function organizationInvites(): OrganizationInvites
    {
        return new OrganizationInvites();
    }
}
