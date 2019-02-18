<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    public function getMetadata(string $key)
    {
        $metadata = json_decode($this->metadata, true);
        if(!array_key_exists($key, $metadata)) { throw new \OutOfBoundsException("Key not present in metadata."); }
        else { return $metadata[$key]; }
    }
}
