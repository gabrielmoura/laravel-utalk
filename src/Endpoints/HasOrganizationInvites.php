<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasOrganizationInvites
{
    public function organizationInvites(): OrganizationInvites
    {
        return new OrganizationInvites();
    }
}
