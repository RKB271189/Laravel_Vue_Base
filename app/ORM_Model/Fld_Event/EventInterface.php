<?php

namespace App\ORM_Model\Fld_Event;

interface EventInterface
{
    public function notification(string $message, $userprimarykey);
}
