<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    public function members() {
        return $this->belongsToMany('App\User')->using('App\GroupMembership');
    }

    public function memberships()
    {
        return $this->morphMany('App\GroupMembership', 'member');
    }
}