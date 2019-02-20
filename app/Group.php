<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    public function members() {
        return $this->belongsToMany('App\User')->using('App\GroupMembership');
    }

    public function memberships()
    {
        return DB::table('group_membership')->where([['member_type', 'App\Group'],['group_id', $this->id]]);
    }
}