<?php declare(strict_types=1);

namespace Handlers;

use Components\Template;

class Reservations extends Handler
{
    public function handle(): string
    {
        return (new Template('reservations'))->render();
    }
}