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

?>

<p>
<?php echo elgg_echo('autosubscribe:list')."<br>"; ?>
<?php
	echo elgg_view('input/text', array('name' => 'params[systemgroups]', 'value' => $vars['entity']->systemgroups));
	echo "<br>"
?>
</p>
