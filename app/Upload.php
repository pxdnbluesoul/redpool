<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // Pull a metadata field by key and return it in php-friendly format.
    // May be any of the json types on return.
    // Throws an OutOfBoundsException on no matching key since JSON could return null, false, 0, etc.
    public function getMetadata(string $key)
    {
        $metadata = json_decode($this->metadata, true);
        if ($metadata == null) { throw new \OutOfBoundsException("No metadata set on object."); }
        if(!array_key_exists($key, $metadata)) { throw new \OutOfBoundsException("Key not present in metadata."); }
        else { return $metadata[$key]; }
    }

    // Update a single metadata field.
    // Requires the key to look up and an arbitrary value to set, but needs to be a JSON-convertible type.
    // So int, bool, string, array, null, or object (nested array).
    // You may also pass the force parameter true to skip looking up the existence of the key in metadata.
    public function setMetadata(string $key, $value, bool $force = false)
    {
        $metadata = json_decode($this->metadata, true);
        if ($force == false) { if(!array_key_exists($key, $metadata)) {
            throw new \OutOfBoundsException("Key not present in metadata."); }
        }
        $metadata[$key] = $value;
        $this->metadata = json_encode($metadata);
        $this->save();
        return true;
    }
}
