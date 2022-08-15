<?php

namespace App\Page;

use App\Controller\PlayerController;
use Page;

class PlayerPage extends Page
{
    public function getControllerName()
    {
        return PlayerController::class;
    }
}
