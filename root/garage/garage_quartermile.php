<?php
/**
*
* @package garage
* @version $Id$
* @copyright (c) 2005 phpBB Garage
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);

/**
* Set root path & include standard phpBB files required
*/
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);
require($phpbb_root_path . 'includes/functions_display.' . $phpEx);

/**
* Setup user session, authorisation & language
*/
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('mods/garage'));

/**
* Check For Garage Install Files
*/
$garage->check_installation_files();

/**
* Build All Garage Classes e.g $garage_images->
*/
require($phpbb_root_path . 'includes/mods/class_garage_dynorun.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_image.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_quartermile.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_template.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_vehicle.' . $phpEx);

/**
* Setup variables
*/
$mode = request_var('mode', '');
$vid = request_var('VID', '');
$qmid = request_var('QMID', '');
$image_id = request_var('image_id', '');

/**
* Build inital navlink..we use the standard phpBB3 breadcrumb process
*/
$template->assign_block_vars('navlinks', array(
	'FORUM_NAME'	=> $user->lang['GARAGE'],
	'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx"))
);

/**
* Display the moderator control panel link if authorised
*/
if ($garage->mcp_access())
{
	$template->assign_vars(array(
		'U_MCP'	=> append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=garage', true, $user->session_id),
	));
}

/**
* Perform a set action based on value for $mode
*/
switch( $mode )
{
	/**
	* Display page to create new quartermile
	*/
	case 'add_quartermile':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("garage_quartermile.$phpEx?mode=add_quartermile&amp;VID=$vid");
		}

		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_add_quartermile') || $garage_config['enable_quartermile'] == '0')
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Get dynocentres & vehicle data from DB
		*/
		$vehicle =$garage_vehicle->get_vehicle($vid);
		$dynoruns = $garage_dynorun->get_dynoruns_by_vehicle($vid);

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_quartermile.html')
		);
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $vehicle['vehicle'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"))
		);
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['ADD_QUARTERMILE'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=add_quartermile&amp;VID=$vid"))
		);
		if (sizeof($dynoruns))
		{
			$template->assign_vars(array(
				'S_DISPLAY_DYNORUNS' => true)
			);
			$garage_template->dynorun_dropdown($dynoruns);
		}
		$garage_template->attach_image('quartermile');
		$template->assign_vars(array(
			'L_TITLE'  			=> $user->lang['ADD_NEW_TIME'],
			'L_BUTTON'  			=> $user->lang['ADD_NEW_TIME'],
			'VID' 				=> $vid,
			'S_MODE_ACTION' 		=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=insert_quartermile"))
         	);
		$garage_template->sidemenu();
	break;

	/**
	* Insert new quartermile
	*/
	case 'insert_quartermile':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_add_quartermile') || !$garage_config['enable_quartermile'])
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Get all required/optional data and check required data is present
		*/
		$params	= array('rt' => 0, 'rt_decimal' => 0, 'sixty' => 0, 'sixty_decimal' => 0, 'three' => 0, 'three_decimal' => 0, 'eighth' => 0, 'eighth_decimal' => 0, 'eighthmph' => 0, 'eighthmph_decimal' => 0, 'thou' => 0, 'thou_decimal' => 0, 'quart' => '', 'quart_decimal' => '', 'quartmph' => 0, 'quartmph_decimal' => 0, 'dynorun_id' => 0);
		$data 	= $garage->process_vars($params);
		$params = array('quart', 'quart_decimal');
		$garage->check_required_vars($params);

		/**
		* Perform required DB work to create quartermile
		*/
		$qmid = $garage_quartermile->insert_quartermile($data);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* Handle any images
		*/
		if ($garage_image->image_attached() )
		{
			if ( $garage_image->below_image_quotas() )
			{
				$image_id = $garage_image->process_image_attached('quartermile', $qmid);
				$hilite = $garage_quartermile->hilite_exists($qmid);
				$garage_image->insert_quartermile_gallery_image($image_id, $hilite);
			}
			else if ( $garage_image->above_image_quotas() )
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=4"));
			}
		}
		else if ( ($garage_config['enable_quartermile_image_required'] == '1') && ($data['quart'] <= $garage_config['quartermile_image_required_limit']))
		{
			$garage_quartermile->delete_quartermile($qmid);
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=26"));
		}

		/**
		* Perform notification if required
		*/
		if ( $garage_config['enable_quartermile_approval'] )
		{
			$garage->pending_notification('unapproved_quartermiles');
		}

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"));
	break;

	/**
	* Display page to edit existing quartermile
	*/
	case 'edit_quartermile':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("garage_quartermile.$phpEx?mode=edit_quartermile&amp;QMID=$qmid&amp;VID=$vid");
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Get vehicle, dynorun count, quartermile & gallery data from DB
		*/
		$vehicle_data 	= $garage_vehicle->get_vehicle($vid);
		$dynoruns = $garage_dynorun->get_dynoruns_by_vehicle($vid);
		$data = $garage_quartermile->get_quartermile($qmid);
		$gallery_data = $garage_image->get_quartermile_gallery($qmid);

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_quartermile.html')
		);
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $vehicle_data['vehicle'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"))
		);
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['EDIT_QUARTERMILE'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID=$vid&amp;QMID=$qmid"))
		);
		if (($data['dynorun_id'] > 0) && (sizeof($dynoruns) > 0))
		{
			$bhp_statement = $data['bhp'] . $user->lang['DECIMAL_SEPERATOR'] . $data['bhp_decimal'] . ' BHP @ ' . $data['bhp_unit'];
			$template->assign_vars(array(
				'S_DISPLAY_DYNORUNS' => true)
			);
			#$garage_template->dynorun_dropdown($dynoruns, $data['dynorun_id'], $bhp_statement, $vid);
			$garage_template->dynorun_dropdown($dynoruns, $data['dynorun_id']);
		}
		else if (($data['dynorun_id'] == 0) && (sizeof($dynoruns) > 0))
		{
			$template->assign_vars(array(
				'S_DISPLAY_DYNORUNS' => true)
			);
			$garage_template->dynorun_dropdown($dynoruns);
		}
		$garage_template->attach_image('quartermile');
		$template->assign_vars(array(
			'L_TITLE'				=> $user->lang['EDIT_TIME'],
			'L_BUTTON'				=> $user->lang['EDIT_TIME'],
			'U_EDIT_DATA' 			=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=edit_quartermile&amp;VID=$vid&amp;QMID=$qmid"),
			'U_MANAGE_GALLERY' 		=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=edit_quartermile&amp;VID=$vid&amp;QMID=$qmid#images"),
			'VID'					=> $vid,
			'QMID'					=> $qmid,
			'RT'					=> $data['rt'],
			'RT_DECIMAL'			=> $data['rt_decimal'],
			'SIXTY'					=> $data['sixty'],
			'SIXTY_DECIMAL'			=> $data['sixty_decimal'],
			'THREE' 				=> $data['three'],
			'THREE_DECIMAL' 		=> $data['three_decimal'],
			'EIGHTH' 				=> $data['eighth'],
			'EIGHTH_DECIMAL' 		=> $data['eighth_decimal'],
			'EIGHTHMPH' 			=> $data['eighthmph'],
			'EIGHTHMPH_DECIMAL'		=> $data['eighthmph_decimal'],
			'THOU' 					=> $data['thou'],
			'THOU_DECIMAL' 			=> $data['thou_decimal'],
			'QUART' 				=> $data['quart'],
			'QUART_DECIMAL' 		=> $data['quart_decimal'],
			'QUARTMPH' 				=> $data['quartmph'],
			'QUARTMPH_DECIMAL'		=> $data['quartmph_decimal'],
			'REDIRECT'				=> request_var('redirect', ''),
			'S_MODE_ACTION' 		=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=update_quartermile"),
			'S_IMAGE_MODE_ACTION' 	=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=insert_quartermile_image"),
		));
		for ($i = 0, $count = sizeof($gallery_data);$i < $count; $i++)
		{
			$template->assign_block_vars('pic_row', array(
				'U_IMAGE'			=> (($gallery_data[$i]['attach_id']) && ($gallery_data[$i]['attach_is_image']) && (!empty($gallery_data[$i]['attach_thumb_location'])) && (!empty($gallery_data[$i]['attach_location']))) ? append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=" . $gallery_data[$i]['attach_id']) : '',
				'U_REMOVE_IMAGE'	=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=remove_quartermile_image&amp;VID=$vid&amp;QMID=$qmid&amp;image_id=" . $gallery_data[$i]['attach_id']),
				'U_SET_HILITE'		=> ($gallery_data[$i]['hilite'] == 0) ? append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=set_quartermile_hilite&amp;image_id=" . $gallery_data[$i]['attach_id'] . "&amp;VID=$vid&amp;QMID=$qmid") : '',
				'IMAGE' 			=> $phpbb_root_path . GARAGE_UPLOAD_PATH . $gallery_data[$i]['attach_thumb_location'],
				'IMAGE_TITLE' 		=> $gallery_data[$i]['attach_file'])
			);
		}
		$garage_template->sidemenu();
	break;

	/**
	* Update existing quartermile
	*/
	case 'update_quartermile':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{phpbb_root_path}garage/garage_quartermile.$phpEx?mode=edit_quartermile&amp;QMID=$qmid&amp;VID=$vid");
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Get all required/optional data and check required data is present
		*/
		$params = array('rt' => 0, 'rt_decimal' => 0, 'sixty' => 0, 'sixty_decimal' => 0, 'three' => 0, 'three_decimal' => 0, 'eighth' => 0, 'eighth_decimal' => 0, 'eighthmph' => 0, 'eighthmph_decimal' => 0, 'thou' => 0, 'thou_decimal' => 0, 'quart' => '', 'quart_decimal' => '', 'quartmph' => 0, 'quartmph_decimal' => 0, 'dynorun_id' => 0, 'editupload' => '', 'image_id' => '', 'redirect' => '');
		$data = $garage->process_vars($params);
		$params = array('quart', 'quart_decimal');
		$garage->check_required_vars($params);

		/**
		* Perform required DB work to update quartermile
		*/
		$garage_quartermile->update_quartermile($data);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* Perform notification if required
		*/
		if ($garage_config['enable_quartermile_approval'])
		{
			$garage->pending_notification('unapproved_quartermiles');
		}

		/**
		* If editted by MCP redirect back to MCP
		*/
		if ($data['redirect'] == 'MCP')
		{
			redirect(append_sid("{$phpbb_root_path}mcp.$phpEx", "i=garage&amp;mode=unapproved_quartermiles"));
		}

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"));
	break;

	/**
	* Delete existing quartermile
	*/
	case 'delete_quartermile':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_delete_quartermile'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to delete quartermile
		*/
		$garage_quartermile->delete_quartermile($qmid);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"));
	break;

	/**
	* Insert image into quartermile
	*/
	case 'insert_quartermile_image':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if ((!$auth->acl_get('u_garage_upload_image')) OR (!$auth->acl_get('u_garage_remote_image')))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=16"));
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Handle any images
		*/
		if ($garage_image->image_attached())
		{
			if ($garage_image->below_image_quotas())
			{
				$image_id = $garage_image->process_image_attached('quartermile', $qmid);
				$hilite = $garage_quartermile->hilite_exists($qmid);
				$garage_image->insert_quartermile_gallery_image($image_id, $hilite);
			}
			else if ($garage_image->above_image_quotas())
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=4"));
			}
		}

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=edit_quartermile&amp;VID=$vid&amp;QMID=$qmid#images"));
	break;

	/**
	* Set highlight image for quartermile
	*/
	case 'set_quartermile_hilite':
		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to set hightlight image
		*/
		$garage->update_single_field(GARAGE_QUARTERMILE_GALLERY_TABLE, 'hilite', 0, 'quartermile_id', $qmid);
		$garage->update_single_field(GARAGE_QUARTERMILE_GALLERY_TABLE, 'hilite', 1, 'image_id', $image_id);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=edit_quartermile&amp;VID=$vid&amp;QMID=$qmid#images"));
	break;

	/**
	* Delete quartermile image
	*/
	case 'remove_quartermile_image':
		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to delete quartermile image
		*/
		$garage_image->delete_quartermile_image($image_id);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx", "mode=edit_quartermile&amp;VID=$vid&amp;QMID=$qmid#images"));
	break;

	/**
	* Display page to view quartermile
	*/
	case 'view_quartermile':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		/**
		* Get dynorun & gallery data from DB
		*/
		$data = $garage_quartermile->get_quartermile($qmid);
		$gallery_data = $garage_image->get_quartermile_gallery($qmid);

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage_view_quartermile.html'
		));

		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $data['vehicle'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=$vid"))
		);

		for ($i = 0; $i < count($gallery_data); $i++)
		{
			if ((empty($gallery_data[$i]['attach_thumb_location']) == false) && ($gallery_data[$i]['attach_thumb_location'] != $gallery_data[$i]['attach_location']))
			{
				$template->assign_vars(array(
					'S_DISPLAY_GALLERIES' 	=> true,
				));

				$template->assign_block_vars('quartermile_image', array(
					'U_IMAGE' 		=> append_sid('garage.'.$phpEx.'?mode=view_image&amp;image_id='. $gallery_data[$i]['attach_id']),
					'IMAGE_NAME'	=> $gallery_data[$i]['attach_file'],
					'IMAGE_SOURCE'	=> $phpbb_root_path . GARAGE_UPLOAD_PATH . $gallery_data[$i]['attach_thumb_location'])
				);
			}
		}

		$template->assign_vars(array(
			'U_VIEW_PROFILE' 	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $data['user_id']),
			'USERNAME' 			=> $data['username'],
			'USERNAME_COLOUR'	=> get_username_string('colour', $data['user_id'], $data['username'], $data['user_colour']),
			'YEAR' 				=> $data['made_year'],
			'MAKE' 				=> $data['make'],
			'MODEL' 			=> $data['model'],
            'AVATAR_IMG' 		=> ($user->optionget('viewavatars')) ? get_user_avatar($data['user_avatar'], $data['user_avatar_type'], $data['user_avatar_width'], $data['user_avatar_height']) : '',
            'DATE_UPDATED'		=> $user->format_date($data['date_updated']),
            'RT' 				=> $data['rt'] . $user->lang['DECIMAL_SEPERATOR'] . $data['rt_decimal'],
            'SIXTY' 			=> $data['sixty'] . $user->lang['DECIMAL_SEPERATOR'] . $data['sixty_decimal'],
            'THREE'	 			=> $data['three'] . $user->lang['DECIMAL_SEPERATOR'] . $data['three_decimal'],
            'EIGHTH' 			=> $data['eighth'] . $user->lang['DECIMAL_SEPERATOR'] . $data['eighth_decimal'],
            'EIGHTHMPH' 		=> $data['eighthmph'] . $user->lang['DECIMAL_SEPERATOR'] . $data['eighthmph_decimal'],
            'THOU'	 			=> $data['thou'] . $user->lang['DECIMAL_SEPERATOR'] . $data['thou_decimal'],
			'QUART' 			=> $data['quart'] . $user->lang['DECIMAL_SEPERATOR'] . $data['quart_decimal'],
			'QUARTMPH' 			=> $data['quartmph'] . $user->lang['DECIMAL_SEPERATOR'] . $data['quartmph_decimal'],
		));
		$garage_template->sidemenu();
	break;
}
$garage_template->version_notice();

$template->set_filenames(array(
	'garage_footer' => 'garage_footer.html')
);

page_footer();
?>
