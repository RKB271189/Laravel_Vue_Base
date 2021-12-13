<?php

namespace App\ORM_Model\Fld_User;

use App\ORM_Model\ORM_Base\BaseRepository;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use OutOfBoundsException;

final class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        $this->table = $model;
        parent::__construct($model);
    }
    /**
     * Save and return if isreturn=true else only save
     * @return null|array
     */
    public final function Save(array $params, bool &$issaved = true, bool $isreturn = true): ?array
    {
        try {
            if ($isreturn) {
                $records = $this->CreateRecord($params, $issaved);
                if (!$issaved && $records === null) {
                    throw new Exception("Exception thrown : " . static::class . " Model Save (Create Record) failed");
                } else {
                    return $records;
                }
            } else {
                $issaved = $this->InsertRecord($params);
                if (!$issaved) {
                    throw new Exception("Exception thrown : " . static::class . " Model Save (Insert Record) failed");
                }
                return null;
            }
        } catch (Exception $ex) {
            $issaved = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Update and return if isreturn=true else only save
     * @return null|array
     */
    public final function Update($primarykey, array $params, bool &$issaved = true, bool $isreturn = true): ?array
    {
        try {
            if ($isreturn) {
                $records = $this->UpdateTapRecord($params, $primarykey, $issaved);
                if (!$issaved && $records === null) {
                    throw new Exception("Exception thrown : " . static::class . " Model Update (Update Tap Record) failed");
                } else {
                    return $records;
                }
            } else {
                $issaved = $this->UpdateRecord($params, $primarykey);
                if (!$issaved) {
                    throw new Exception("Exception thrown : User Model Update (Update Record) failed");
                }
                return null;
            }
        } catch (Exception $ex) {
            $issaved = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Search Record with primary key but no model not found exception
     * @return null|array     
     */
    public final function Search($primarykey, bool &$isfound = true): ?array
    {
        try {
            $records = $this->Find($primarykey, $isfound);
            if ($records === null && !$isfound) {
                throw new Exception("Exception thrown : " . static::class . " Model Search (Find) failed");
            } else {
                return $records;
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Search record with primary key or fail will throw model not found exception
     * @return null|array
     */
    public final function SearchOrFail($primarykey, bool &$isfound = true): ?array
    {
        try {
            $records = $this->FindOrFail($primarykey, $isfound);
            if ($records === null && !$isfound) {
                throw new ModelNotFoundException("Exception thrown : " . static::class . " Model for Search Or Fail (Find or Fail) failed");
            } else {
                return $records;
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     *  Search value by using first or fail eloquent orm method
     *  @param ...$arguments=     (Here it is not array pass three arguments or it will throw error)
     *  @return null|array 
     */
    public final function SearchFirstOrFail(bool &$isfound = true, ...$arguments): ?array
    {
        try {
            if (count($arguments) < 3 || count($arguments) > 3) {
                throw new OutOfBoundsException("Exception thrown : " . static::class . " Model for Method - SearchFirstOrFail argument supplied for first or fail");
            } else {
                $records = $this->FirstOrFail($isfound, ...$arguments);
                if ($records === null && !$isfound) {
                    throw new ModelNotFoundException("Exception thrown : " . static::class . " Model for Method - SearchFirstOrFail");
                } else {
                    return $records;
                }
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**          
     * Soft deleting records using primary key and Soft Delete functionality
     * @return bool
     */
    public final function Remove($primarykey, bool &$isfound = true, int &$removecount = 0): bool
    {
        try {
            $isdelete = $this->Delete($primarykey, $isfound, $removecount);
            if (!$isdelete && !$isfound) {
                throw new ModelNotFoundException("Exception thrown : " . static::class . " Model Remove (Delete) failed");
            } else {
                if (!$isdelete && $removecount === 0) {
                    return false;
                } else {
                    if ($isdelete && $removecount > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return false;
        }
    }
    /**
     * Get all the deleted row details
     * @return null|array
     */
    public function GetRestore(bool &$isfound = true): ?array
    {
        try {
            $records = $this->OnlyDeleted(0, $isfound);
            if (!$isfound) {
                throw new Exception("Exception thrown : " . static::class . " Unable to find deleted records");
            } else {
                return $records;
            }
        } catch (Exception $ex) {
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Restoring soft deleted rows/records
     * @return null|array
     */
    public final function Restore($primarykey, bool &$isfound = true): ?array
    {
        try {
            $records = $this->RestoreDeleted($primarykey, $isfound);
            if ($records === null && !$isfound) {
                throw new ModelNotFoundException("Exception thrown : " . static::class . " Model Remove (Delete) failed");
            } else {
                return $records;
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Get details from 1 column name and its value for exmple (email,email@gmail.com)
     * @param ...$arguments column name and value
     * @return null|array
     */
    public final function Look(bool &$isfound = true, ...$arguments): ?array
    {
        try {
            if (count($arguments) < 2 || count($arguments) > 2) {
                throw new OutOfBoundsException("Exception thrown : " . static::class . " Model for Method - Look invalid argument supplied");
            } else {
                $records = $this->Explore($isfound, ...$arguments);
                if ($records === null && !$isfound) {
                    throw new InvalidArgumentException("Exception thrown : " . static::class . " Model Look for column value. But database exception thrown");
                } else {
                    return $records;
                }
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
    /**
     * Getting all records
     * @return null|array
     */
    public final function Select(bool &$isfound = true): ?array
    {
        try {
            $records = $this->Get($isfound);
            if ($records === null) {
                return null;
            } else {
                return $records;
            }
        } catch (Exception $ex) {
            $isfound = false;
            $this->WriteModelException($ex);
            return null;
        }
    }
}
