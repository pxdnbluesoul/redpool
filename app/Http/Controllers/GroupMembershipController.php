<?php

namespace App\Http\Controllers;

use App\GroupMembership;
use Illuminate\Http\Request;
use App\User;
use App\Group;

class GroupMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', GroupMembership::class);

        foreach($request->groups as $group) {
            $groupmembership = new GroupMembership;
            $groupmembership->group_id = $group;
            if ($request->member_type == "User") { $groupmembership->member_type = "App\User"; }
            elseif ($request->member_type == "Group") { $groupmembership->member_type = "App\Group"; }
            else { abort(400); }
            $groupmembership->member_id = $request->member_id;
            $groupmembership->metadata = json_encode("", JSON_FORCE_OBJECT);
            $groupmembership->save();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupMembership  $groupMembership
     * @return \Illuminate\Http\Response
     */
    public function show(GroupMembership $groupMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupMembership  $groupMembership
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupMembership $groupMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupMembership  $groupMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupMembership $groupMembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupMembership  $groupMembership
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupMembership $groupMembership)
    {
        //
    }
}
