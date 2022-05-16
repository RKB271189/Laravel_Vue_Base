<?php

namespace App\ORM_Model\Fld_User;

use App\ORM_Model\ORM_Contract\ModelContract;

interface UserInterface extends ModelContract
{
    public function Restore($primarykey): ?array;

    public function GetRestore(): ?array;
}
