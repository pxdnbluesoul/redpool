<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\User;

class ExtraGroupMembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_membership')->insert([
            // Add first (seeded) user to Global Administrators.
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\User', // Child member type (User or Group)
                'member_id' => 1, // Child user
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Give some practical ACLs for use in the SCP staff structure.
            [
                'group_id' => DB::table('groups')->where('name', 'Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Build teams...
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Community Outreach Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Community Outreach Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Community Outreach')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Site Criticism Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Site Criticism Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Site Criticism Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Forum Criticism Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Forum Criticism Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Forum Criticism Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Disciplinary Committee Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Disciplinary Committee Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Disciplinary Committee')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Harassment Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Harassment Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Harassment Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Internet Outreach Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Internet Outreach Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Internet Outreach')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Licensing Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Licensing Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Licensing Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Rewrite Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Rewrite Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Rewrite Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Technical Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Technical Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Technical Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Wikiwalk Team Captains')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Wikiwalk Team Captains')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Wikiwalk Team')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Build basic staff hierarchy...
            [
                'group_id' => DB::table('groups')->where('name', 'Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Moderators')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Moderators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Operational Staff')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Operational Staff')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Junior Staff')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Chat Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Chat Staff')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // And allow users to create their own things.
            [
                'group_id' => DB::table('groups')->where('name', 'Junior Staff')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Everyone')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Chat Staff')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Everyone')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Everyone')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
        ]);
        // Finally, calculate effective permissions for the first user. This may take a while.
        $admin = User::find(1);
        $admin->recursememberships();
    }
}
