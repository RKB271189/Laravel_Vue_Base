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
    public function FindOrFail($primarykey): array;

    //Find By Primary key (No model found exception) returns null
    public function Find($primarykey): ?array;

    //Delete row with primary key (Will only be soft deleted)
    public function Delete($primarykey);


    //Get deleted records from the database
    public function OnlyDeleted($primarykey, bool &$isfound = true): ?array;

    //Get all deleted records
    public function GetAllDeleted(bool &$isfound = true): ?array;

    //Restore deleted record
    public function RestoreDeleted($primarykey): ?array;

    //Get table details
    public function Get(): array;
}
