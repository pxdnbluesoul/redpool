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
        // Users: Create (You can always work with your own object)
        // Editors: View (view others), Update (Edit), Soft Delete, Restore
        // Administrators: Hard Delete

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
               'group_id' => DB::table('groups')->where('name', 'Crit Users')->pluck('id')->first(), // Parent group
               'member_type' => 'App\Group', // Child member type (User or Group)
               'member_id' => DB::table('groups')->where('name', 'Allow Crit (View)')->pluck('id')->first(), // Child group
               'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Users')->pluck('id')->first(), // Parent group
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
                'group_id' => DB::table('groups')->where('name', 'Group Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Users')->pluck('id')->first(), // Parent group
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

            // Group Membership delegation is an exceptional case due to the nature of security permissions. This is restricted to administrators.
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Create)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Update)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Group Membership (Soft Delete)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Administrators')->pluck('id')->first(), // Parent group
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
                'group_id' => DB::table('groups')->where('name', 'Page Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Page (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Users')->pluck('id')->first(), // Parent group
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
                'group_id' => DB::table('groups')->where('name', 'Paste Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Paste (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Users')->pluck('id')->first(), // Parent group
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
                'group_id' => DB::table('groups')->where('name', 'Upload Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Allow Upload (View)')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Users')->pluck('id')->first(), // Parent group
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
            // User administration behaves different from other object types and, like group membership, is a security concern.
            // Users may view other users but the concept of creating new users should be a privileged ability.
            [
                'group_id' => DB::table('groups')->where('name', 'User Users')->pluck('id')->first(), // Parent group
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
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Users')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Users')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Users')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Users')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Users')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Users')->pluck('id')->first(), // Child group
            	'metadata' => json_encode([], JSON_FORCE_OBJECT)
			],
            [
                'group_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Users')->pluck('id')->first(), // Child group
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
            // Add inheritance for Users/editors/administrators.
            [
                'group_id' => DB::table('groups')->where('name', 'Crit Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Crit Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Group Membership Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Group Membership Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Page Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Page Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Paste Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Paste Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Upload Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Upload Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'User Editors')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'User Users')->pluck('id')->first(), // Child group
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
                'member_id' => DB::table('groups')->where('name', 'Global Users')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Build Deny groups.
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Global deny groups.
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Specialized Global Deny ACLs by access type.
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (View)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (View)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Create)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Create)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Update)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Update)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Soft Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Soft Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Restore)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Restore)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Crit (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Group Membership (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Page (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Paste (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny Upload (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global (Hard Delete)')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Deny User (Hard Delete)')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Disabled users can't do anything.
            [
                'group_id' => DB::table('groups')->where('name', 'Deny Global')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Disabled')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
            // Banned users are considered disabled users.
            [
                'group_id' => DB::table('groups')->where('name', 'Disabled')->pluck('id')->first(), // Parent group
                'member_type' => 'App\Group', // Child member type (User or Group)
                'member_id' => DB::table('groups')->where('name', 'Banned')->pluck('id')->first(), // Child group
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ],
        ]);
    }
}
