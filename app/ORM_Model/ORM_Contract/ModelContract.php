<?php

namespace App\ORM_Model\ORM_Contract;

/**
 * All cumpulosory method to be implemented by models
 */
interface ModelContract
{
    //Implement method to store record
    public function Save(array $params, bool $isreturn = true): ?array;

    //Implement method to update record
    public function Update($primarykey, array $params, bool $isreturn = true): ?array;

    //Implement method to remove record
    public function Remove($primarykey);

    //Impement method to get all records (When fetching details for drop-down)
    public function Select(): ?array;

    //Implement method to search records using primary key
    public function Search($primarykey): ?array;

    //Implemnt method to serach records using primary key but fails if not found
    public function SearchOrFail($primarykey): ?array;
}
