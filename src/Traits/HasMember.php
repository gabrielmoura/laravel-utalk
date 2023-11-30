<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Member;

trait HasMember
{
    public function member(): Member
    {
        return new Member();
    }
}
