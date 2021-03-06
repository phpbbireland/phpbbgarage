<?php
/** 
*
* garage [German]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Garage
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/*
* DO NOT CHANGE 
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

/*
* Language keys for auto-inclusion for UCP Module titles
*/
$lang = array_merge($lang, array(
	'UCP_GARAGE'				=> 'Garage',
	'UCP_GARAGE_OPTIONS'			=> 'Allgemeine Einstellungen bearbeiten',
	'UCP_GARAGE_NOTIFY'			=> 'Benachrichtigungseinstellungen bearbeiten',
));

?>
