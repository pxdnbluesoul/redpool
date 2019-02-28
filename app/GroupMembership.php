<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupMembership extends Pivot
{
    public function parent()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function child()
    {
        return $this->morphTo('member');
    }
}
