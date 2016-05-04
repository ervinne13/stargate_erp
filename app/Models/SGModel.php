<?php

namespace App\Models;

use App\SG\SearchableByEncryptedId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SGModel extends Model {

    use SearchableByEncryptedId;

    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateModified';

    public function scopeWithFields($query, $fields) {
        return $query->select($fields);
    }

    public function scopeFindComposite($query, $values) {

        if (is_array($this->primaryKey)) {
            foreach ($this->primaryKey AS $key) {
                $query = $query->where($key, $values[$key]);
            }
        } else {
            foreach ($values AS $key => $value) {
                $query = $query->where($key, $value);
            }
        }

        return $query->first();
    }

    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $user              = Auth::user();
            $model->CreatedBy  = $user->U_User_id;
            $model->ModifiedBy = $user->U_User_id;
        });

        static::updating(function($model) {
            $user              = Auth::user();
            $model->ModifiedBy = $user->U_User_id;
        });
    }

    /**
     * Fix for laravel issue: https://github.com/laravel/framework/issues/5517
     * @param array $options
     * @return boolean
     */
    public function save(array $options = []) {
        if (!is_array($this->getKeyName())) {
            return parent::save($options);
        }

        // Fire Event for others to hook
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        // Prepare query for inserting or updating
        $query = $this->newQueryWithoutScopes();

        // Perform Update
        if ($this->exists) {
            if (count($this->getDirty()) > 0) {
                // Fire Event for others to hook
                if ($this->fireModelEvent('updating') === false) {
                    return false;
                }

                // Touch the timestamps
                if ($this->timestamps) {
                    $this->updateTimestamps();
                }

                //
                // START FIX
                //


                // Convert primary key into an array if it's a single value
                $primary = (count($this->getKeyName()) > 1) ? $this->getKeyName() : [$this->getKeyName()];

                // Fetch the primary key(s) values before any changes
                $unique = array_intersect_key($this->original, array_flip($primary));

                // Fetch the primary key(s) values after any changes
                $unique = !empty($unique) ? $unique : array_intersect_key($this->getAttributes(), array_flip($primary));

                // Fetch the element of the array if the array contains only a single element
                //$unique = (count($unique) <> 1) ? $unique : reset($unique);
                // Apply SQL logic
                $query->where($unique);

                //
                // END FIX
                //

                // Update the records
                $query->update($this->getDirty());

                // Fire an event for hooking into
                $this->fireModelEvent('updated', false);
            }
        }
        // Insert
        else {
            // Fire an event for hooking into
            if ($this->fireModelEvent('creating') === false)
                return false;

            // Touch the timestamps
            if ($this->timestamps) {
                $this->updateTimestamps();
            }

            // Retrieve the attributes
            $attributes = $this->attributes;

            if ($this->incrementing && !is_array($this->getKeyName())) {
                $this->insertAndSetId($query, $attributes);
            } else {
                $query->insert($attributes);
            }

            // Set exists to true in case someone tries to update it during an event
            $this->exists = true;

            // Fire an event for hooking into
            $this->fireModelEvent('created', false);
        }

        // Fires an event
        $this->fireModelEvent('saved', false);

        // Sync
        $this->original = $this->attributes;

        // Touches all relations
        if (array_get($options, 'touch', true))
            $this->touchOwners();

        return true;
    }

}
