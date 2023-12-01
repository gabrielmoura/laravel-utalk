<?php

namespace Gabrielmoura\LaravelUtalk\Traits;

use Gabrielmoura\LaravelUtalk\Endpoints\Contact;

trait HasContact
{
    public function contact(): Contact
    {
        return new Contact();
    }
}
