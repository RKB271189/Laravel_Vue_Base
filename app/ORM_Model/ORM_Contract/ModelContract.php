<?php

namespace App\ORM_Model\ORM_Contract;

interface ModelContract
{
    public function Save(array $params, bool &$issaved = true, bool $isreturn = true): ?array;

    public function Update($primarykey, array $params, bool &$issaved = true, bool $isreturn = true): ?array;

    public function Search($primarykey, bool &$isfound = true): ?array;

    public function SearchOrFail($primarykey, bool &$isfound = true): ?array;

    public function SearchFirstOrFail(bool &$isfound = true, ...$arguments): ?array;

    public function Remove($primarykey, bool &$isfound = true, int &$removecount = 0): bool;

    public function GetRestore(bool &$isfound = true): ?array;

    public function Restore($primarykey, bool &$isfound = true): ?array;

    public function Look(bool &$isfound = true, ...$arguments): ?array;

    public function Select(bool &$isfound = true): ?array;
}
