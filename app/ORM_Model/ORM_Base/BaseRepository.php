<?php

namespace App\ORM_Model\ORM_Base;

use App\ORM_Model\ORM_Base\BaseInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseInterface
{  
    protected $table;
    /**
     * Initiating table to use it throughout all model repository
     */
    public function __construct(Model $model)
    {
        $this->table = $model;
    }
    /**
     * Insert new records with return type bool
     * @return bool
     */
    //Insert with bool return
    public function InsertRecord(array $params): bool
    {
        return $this->table->insert($params);
    }
    /**
     * Insert new record with return type array (returns saved data/row)
     * @return array
     */
    //Insert with array return
    public function CreateRecord(array $params, bool &$isinsert = true): array
    {

        $collection = $this->table->create($params);
        return $collection->toArray();
    }
    /**
     * Update record with return type bool
     * @return bool
     */
    //Update with bool return
    public function UpdateRecord(array $params, $primarykey): bool
    {

        $collection = $this->table->findOrFail($primarykey);
        $collection->fill($params);
        return $collection->save();
    }
    /**
     * Update record with return type array (returns saved data or row)
     * @return array
     */
    //Update with array return
    public function UpdateTapRecord(array $params, $primarykey, bool &$isinsert = true): array
    {

        $collection = $this->table->findOrFail($primarykey);
        $record = tap($collection)->update($params);
        return $record->toArray();
    }
    /**
     * Find value or throw exception (Use when sure about findings)
     * @return array
     */
    //Find Record By Primary Key or Fail (Model not found Exception)
    public function FindOrFail($primarykey): array
    {
        $collection = $this->table->findOrFail($primarykey);
        return $collection->toArray();
    }
    /**
     * Find by primary with no model not found exception returns null
     * @return null|array
     */
    public function Find($primarykey): ?array
    {
        $collection = $this->table->find($primarykey);
        return ($collection) ? $collection->toArray() : null;
    }
    /**
     * Soft Deleting record only if trait SoftDelete is used in model
     * @return bool
     */
    public function Delete($primarykey)
    {
        $collection = $this->table->findorfail($primarykey);
        return $collection->delete();
    }
    /**
     * Get deleted record based on primary key
     * @param $primarykey int
     * @return null|array
     */
    public function OnlyDeleted($primarykey, bool &$isfound = true): ?array
    {
        $collection = $this->table->onlyTrashed()->find($primarykey);
        return ($collection) ? $collection->toArray() : null;
    }
    /**
     * Get deleted record    
     * @return null|array
     */
    public function GetAllDeleted(bool &$isfound = true): ?array
    {
        $collection = $this->table->onlyTrashed()->get();
        return ($collection) ? $collection->toArray() : null;
    }
    /**
     * Restore the deleted row and return data
     * @param $primarykey int
     * @return null|array
     */
    public function RestoreDeleted($primarykey): ?array
    {
        $collection = $this->table->withTrashed()->find($primarykey);
        if ($collection) $collection->restore();
        return ($collection) ? $collection->toArray() : null;
    }
    /**
     * Get table details all row
     * @return array
     */
    public function Get(): array
    {
        $collection = $this->table->get();
        return ($collection) ? $collection->toArray() : null;
    }
}
