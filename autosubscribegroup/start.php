<?php

/**
 * Elgg autosubscribegroup plugin
 * This plugin allows new users to get joined to groups automatically when they register.
 *
 * @package autosubscribegroups
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author RONNEL Jérémy
 * @copyright (c) Elbee 2008
 * @link /www.notredeco.com
 *
 * for Elgg 1.8 by iionly (iionly@gmx.de)
 */

/**
 * Init
 *
 */
function autosubscribegroup_init() {
    //group plugin disabled : no need to go further...
    if (!elgg_is_active_plugin("groups")) {
        return;
    }

    //Listen to user registration
    elgg_register_event_handler('create', 'user', 'autosubscribegroup_join', 502);
}

/**
 * auto join group define in plugin settings
 *
 */
function autosubscribegroup_join($event, $object_type, $object) {

    if (($object instanceof ElggUser) && ($event == 'create') && ($object_type == 'user')) {
        //auto submit relationships between user & groups
        //retrieve groups ids from plugin
        $groups = elgg_get_plugin_setting('systemgroups');
        $groups = split(',', $groups);

        //for each group ids
        foreach($groups as $groupId) {
            //if group exist : submit to group
            if ($groupEnt = get_entity($groupId)) {
                //join group succeed ?
                if ($groupEnt->join($object)) {
                    // Remove any invite or join request flags
                    elgg_delete_metadata(array('guid' => $object->guid, 'metadata_name' => 'group_invite', 'metadata_value' => $groupEnt->guid, 'limit' => 0));
                    elgg_delete_metadata(array('guid' => $object->guid, 'metadata_name' => 'group_join_request', 'metadata_value' => $groupEnt->guid, 'limit' => 0));
                }
            }
        }
    }
}

elgg_register_event_handler('init', 'system', 'autosubscribegroup_init');
