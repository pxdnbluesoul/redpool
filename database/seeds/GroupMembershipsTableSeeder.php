<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\User;

class GroupMembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // This must run after both the Users and Groups seeder or it'll fail.
        // If you use `php artisan db:seed` then it will always execute in the proper order.
        // I don't want to statically assign ID numbers as that's very brittle and any changes to the seeders will break
        // the hierarchy, so we use selects here calling the users/groups by name instead.
        // This is probably an expensive file to run but you should only have to do it once to go live.

        // ACL GROUP STRUCTURING

        // We will create the logical hierarchy from the bottom up, working from the least privileged commands and
        // moving to the most, so in order, View, Create, Update, Soft Delete, Restore, and Hard Delete.

        // We have three levels of broad membership that control the access level:
        // Viewer: View
        // Editor: Create, Update, Soft Delete, Restore
        // Administrator: Hard Delete

        // Administrator is a member of Editor, and Editor is a member of Viewer, so permissions are inherited.

        // Each object type also has allow and deny rules for each access level. You can assign a user or group to those
        // groups, though a Deny always takes precedence. Additionally, each individual object carries its own metadata
        // attributes and thus can have exceptions for both Allow and Deny rules.

        // The order of execution for determining access is:
        // 1. If the user is a member of a Deny group for the specified object type and access level, deny the request.
        // 2. If the object has explicitly denied the user, deny the request.
        // 3. If the object has explicitly denied a group the user is a member of, deny the request.
        // 4. If the user created the object, allow the request.
        // 5. If the user is a member of an Allow group for the specified object type and access level, allow the request.
        // 6. If the object has explicitly allowed the user, allow the request.
        // 7. If the object has explicitly allowed a group the user is a member of, allow the request.
        // 8. Otherwise, deny the request.

        DB::table('group_membership')->insert([
            [
               'group_id' => DB::table('groups')->where('name', 'Crit Viewers')->pluck('id')->first(), // Parent group
               'member_type' => 'App\Group', // Child member type (User or Group)
               'member_id' => DB::table('groups')->where('name', 'Allow Crit (View)')->pluck('id')->first(), // Child group
               'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Crit (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Crit (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Crit (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Crit (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Crit (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            // Rinse and repeat for the other object types.
            [
                'group_id' => DB::table('groups')->where('name', 'Group Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'User Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow User (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow User (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow User (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow User (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow User (Restore)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'User Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow User (Hard Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            // Nest the Global Groups
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Viewers')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Administrators')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Administrators')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Administrators')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Administrators')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Administrators')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Administrators')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Add inheritance for viewers/editors/administrators.
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'User Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Globals
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Global Viewers')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            
            // Add first (seeded) user to Global Administrators.
            [
                'group_id' => DB::table('groups')->where('name', 'Global Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\User', // Child member type (User or Group)
                'member_id' => 1, // Child user
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ]
        ]);
        // Finally, calculate effective permissions for the first user. This may take a while.
        $admin = User::find(1);
        $admin->recursememberships();
    }
}
