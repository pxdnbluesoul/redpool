<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupMembership extends Pivot
{
    public function users()
    {
       return $this->morphedByMany('App\User', 'member');
    }

    public function groups()
    {
        return $this->morphedByMany('App\Group', 'member');
    }
}
