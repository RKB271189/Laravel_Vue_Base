<?php

namespace App\ORM_Model\ORM_Base;

use App\ORM_Model\ORM_Base\BaseInterface;
use App\Usables_Extensions\WriteRead;
use Exception;
use Illuminate\Database\Eloquent\Model;
use OutOfBoundsException;

abstract class BaseRepository implements BaseInterface
{
    use WriteRead;
    protected $table;
    /**
     * Initiatind table to use it throughout all model repository
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
        try {
            return $this->table->insert($params);
        } catch (Exception $ex) {
            $this->WriteModelException($ex);
            return false;
        }
    }
    /**
     * Insert new record with return type array (returns saved data/row)
     * @return array
     */
    //Insert with array return
    public function CreateRecord(array $params, bool &$isinsert = true): array
    {
        try {
            $collection = $this->table->create($params);
            return $collection->toArray();
        } catch (Exception $ex) {
            $isinsert = false;
            $this->WriteModelException($ex);
            return [];
        }
    }
    /**
     * Update record with return type bool
     * @return bool
     */
    //Update with bool return
    public function UpdateRecord(array $params, $primarykey): bool
    {
        try {
            $collection = $this->table->findOrFail($primarykey);
            $collection->fill($params);
            return $collection->save();
        } catch (Exception $ex) {
            $this->WriteModelException($ex);
            return false;
        }
    }
    /**
     * Update record with return type array (returns saved data or row)
     * @return array
     */
    //Update with array return
    public function UpdateTapRecord(array $params, $primarykey, bool &$isinsert = true): array
    {
        try {
            $collection = $this->table->findOrFail($primarykey);
            $record = tap($collection)->update($params);
            return $record->toArray();
        } catch (Exception $ex) {
            $isinsert = false;
            $this->WriteModelException($ex);
            return [];
        }
    }
    /**
     * Find value or throw exception (Use when sure about findings)
     * @return array
     */
    //Find Record By Primary Key or Fail (Model not found Exception)
    public function FindOrFail($primarykey, bool &$isfound = true): array
    {
        try {
            $collection = $this->table->findOrFail($primarykey);
            return $collection->toArray();
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return [];
        }
    }
    /**
     * Find vrowalue by where condition if not found throw Exception (Use when sure about findings)
     * @return array
     * @param $arguments=['columnname','sign(=,<,>)','value']
     */
    //Find First Row or Fail (Model Not Found Exception)
    public function FirstOrFail(bool &$isfound = true, ...$arguments): array
    {
        try {
            if (count($arguments) < 3 || count($arguments) > 3) {
                throw new OutOfBoundsException("Required arguments should contain three (3) arguments. First Column(string),Sign(String:<,>,=),Value for where condition");
            } else {
                $column = $arguments[0];
                $sign = $arguments[1];
                $value = $arguments[2];
                $collection = $this->table->where($column, $sign, $value)->firstOrFail();
                return $collection->toArray();
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return [];
        }
    }
    /**
     * Find by primary with no model not found exception returns null
     * @return null|array
     */
    public function Find($primarykey, bool &$isfound = true): ?array
    {
        try {
            $collection = $this->table->find($primarykey);
            if ($collection === null) {
                return null;
            }
            return $collection->toArray();
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Search by different column and value with fix = sign
     * @param ...$arguments=column name , value fix = sign for where claus
     * @return null|array 
     */
    public function Explore(bool &$isfound = true, ...$arguments): ?array
    {
        try {
            if (count($arguments) < 2 || count($arguments) > 2) {
                throw new OutOfBoundsException("Required arguments should contain three (2) arguments. First Column(string),Value for where condition");
            } else {
                $column = $arguments[0];
                $value = $arguments[1];
                $collection = $this->table->where($column, $value)->get();
                if ($collection === null) {
                    return null;
                } else {
                    return $collection->toArray();
                }
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Soft Deleting record only if trait SoftDelete is used in model
     * @return bool
     */
    public function Delete($primarykey, bool &$isfound = true, int &$deletecount = 0): bool
    {
        try {
            $collection = $this->table->findOrFail($primarykey);
            if ($collection === null) {
                return false;
            } else {
                $delete = $collection->delete();
                if ($delete === 0) {
                    return false;
                } else {
                    $deletecount = $delete;
                    return true;
                }
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return false;
        }
    }
    /**
     * Get the deleted row from the database pass first parameter as primary key if get only one record
     * @param $primarykey int
     * @return null|array
     */
    public function OnlyDeleted($primarykey = 0, bool &$isfound = true): ?array
    {
        try {
            if ($primarykey === 0) {
                $collection = $this->table->onlyTrashed()->get();
            } else {
                $collection = $this->table->onlyTrashed()->find($primarykey);
            }
            if ($collection === null) {
                return null;
            } else {
                return $collection->toArray();
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Restore the deleted row and return data
     * @param $primarykey int
     * @return null|array
     */
    public function RestoreDeleted($primarykey, bool &$isfound = true): ?array
    {
        try {
            $collection = $this->table->withTrashed()->find($primarykey);
            if ($collection === null) {
                return null;
            } else {
                $collection->restore();
                return $collection->toArray();
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Get table details all row
     * @return array
     */
    public function Get(bool &$isfound = true): array
    {
        try {
            $collection = $this->table->get();
            if ($collection === null) {
                return [];
            } else {
                return $collection->toArray();
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return [];
        }
    }
}
