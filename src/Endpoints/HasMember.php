<?php

namespace Gabrielmoura\LaravelUtalk\Endpoints;

trait HasMember
{
    public function member(): Member
    {
        return new Member();
    }
}
