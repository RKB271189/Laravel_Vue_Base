<?php

namespace App\ORM_Model\Fld_User;

use App\ORM_Model\ORM_Base\BaseRepository;
use App\User;

final class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        $this->table = $model;
        parent::__construct($model);
    }
    /**
     * Compulsory method
     * Save and return if isreturn=true else only save
     * @return null|array
     */
    public final function Save(array $params, bool $isreturn = true): ?array
    {
        $records = [];
        if ($isreturn) {
            $records = $this->CreateRecord($params, $issaved);
        } else {
            $this->InsertRecord($params);
        }
        return $records;
    }
    /**
     * Compulsory Method
     * Update and return if isreturn=true else only save
     * @return null|array
     */
    public final function Update($primarykey, array $params, bool $isreturn = true): ?array
    {
        $records = [];
        if ($isreturn) {
            $records = $this->UpdateTapRecord($params, $primarykey, $issaved);
        } else {
            $this->UpdateRecord($params, $primarykey);
        }
        return $records;
    }
    /**
     * Compulsory Method
     * Search Record with primary key but no model not found exception
     * @return null|array     
     */
    public final function Search($primarykey): ?array
    {
        $records = $this->Find($primarykey);
        return $records;
    }
    /**
     * Compulsory Method
     * Search record with primary key or fail will throw model not found exception
     * @return null|array
     */
    public final function SearchOrFail($primarykey): ?array
    {
        $records = $this->FindOrFail($primarykey);
        return $records;
    }
    /**
     * Compulsory Method
     * Getting all records
     * @return null|array
     */
    public final function Select(): ?array
    {

        $records = $this->Get();
        return $records;
    }
    /**  
     * Compulsory method            
     * Soft deleting records using primary key and Soft Delete functionality
     * @return bool
     */
    public final function Remove($primarykey)
    {
        return $this->Delete($primarykey);
    }
    /** Extra added methods as required */
    /*************************************/
    /**
     * Restoring soft deleted rows/records
     * @return null|array
     */
    public final function Restore($primarykey): ?array
    {
        return $this->RestoreDeleted($primarykey);
    }
    /**
     * Get all the deleted row details
     * @return null|array
     */
    public function GetRestore(): ?array
    {
        return $this->GetAllDeleted();
    }
}
