<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            // SCP-centric Groups
            ['name' => 'Everyone', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Banned', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Disabled', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Administrators', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Moderators', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Operational Staff', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Junior Staff', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Chat Administrators', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Chat Staff', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'IRC Operators', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'INT Ambassadors', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Community Outreach Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Site Criticism Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Forum Criticism Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Disciplinary Committee Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Harassment Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Internet Outreach Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Licensing Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Rewrite Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Technical Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Wikiwalk Team Captains', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Community Outreach', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Site Criticism Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Forum Criticism Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Disciplinary Committee', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Harassment Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Internet Outreach', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Licensing Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Rewrite Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Technical Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            ['name' => 'Wikiwalk Team', 'metadata' => json_encode(['Group Type' => 'Role'], JSON_FORCE_OBJECT)],
            // Generic ACL Groups Below
            ['name' => 'Global Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Crit Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Group Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Group Membership Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Page Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Paste Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Upload Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'User Administrators', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Global Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Crit Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Group Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Group Membership Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Page Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Paste Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Upload Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'User Editors', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Global Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Crit Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Group Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Group Membership Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Page Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Paste Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Upload Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'User Users', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Global (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Crit (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group Membership (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Page (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Paste (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Upload (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow User (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Global (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Crit (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group Membership (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Page (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Paste (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Upload (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow User (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Global (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Crit (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group Membership (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Page (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Paste (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Upload (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow User (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Global (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Crit (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group Membership (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Page (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Paste (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Upload (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow User (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Global (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Crit (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group Membership (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Page (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Paste (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Upload (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow User (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Global (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Crit (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Group Membership (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Page (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Paste (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow Upload (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Allow User (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User (View)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User (Create)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User (Update)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User (Soft Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User (Restore)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User (Hard Delete)', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Global', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Crit', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Group Membership', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Page', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Paste', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny Upload', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],
            ['name' => 'Deny User', 'metadata' => json_encode(['Group Type' => 'ACL'], JSON_FORCE_OBJECT)],

        ]);
    }
}
