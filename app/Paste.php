<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    public function getMetadata(string $key)
    {
        $metadata = json_decode($this->metadata, true);
        if(!array_key_exists($key, $metadata)) { throw new \OutOfBoundsException("Key not present in metadata."); }
        else { return $metadata[$key]; }
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
