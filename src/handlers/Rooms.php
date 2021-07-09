<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;

class Rooms extends Handler
{
    public function handle(): string
    {
        return (new Template('rooms'))->render();
    }
}