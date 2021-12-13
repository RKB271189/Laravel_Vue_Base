<?php

namespace App\ORM_Model\ORM_Base;

interface BaseInterface
{
    //Insert with bool return
    public function InsertRecord(array $params): bool;


    //Insert with array return
    public function CreateRecord(array $params, bool &$isinsert = true): array;


    //Update with bool return 
    public function UpdateRecord(array $params, $primarykey): bool;


    //Update with array return
    public function UpdateTapRecord(array $params, $primarykey, bool &$isupdate = true): array;


    //Find Record By Primary Key or Model Not Found Exception
    public function FindOrFail($primarykey, bool &$isfound = true): array;


    //Find Record By Single Column First Record or Model Not Found Exception
    public function FirstOrFail(bool &$isfound = true, ...$arguments): array;


    //Find By Primary key (No model found exception) returns null
    public function Find($primarykey, bool &$isfound = true): ?array;


    //Find by different single column and value and fix = sign for where clause
    public function Explore(bool &$isfound = true, ...$arguments): ?array;


    //Delete row with primary key (Will only be soft deleted)
    public function Delete($primarykey, bool &$isfound = true, int &$deletecount = 0): bool;


    //Get deleted records from the database
    public function OnlyDeleted($primarykey = 0, bool &$isfound = true): ?array;

    //Restore deleted record
    public function RestoreDeleted($primarykey, bool &$isfound = true): ?array;

    //Get table details
    public function Get(bool &$isfound = true): array;
}
