<?php

namespace App\ORM_Model\Fld_Product;

use App\ORM_Model\ORM_Contract\ModelContract;

interface ProductInterface extends ModelContract
{
    public function Restore($primarykey): ?array;

    public function GetRestore(): ?array;
}
