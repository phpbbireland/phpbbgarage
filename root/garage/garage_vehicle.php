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
require($phpbb_root_path . 'includes/mods/class_garage_business.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_dynorun.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_image.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_insurance.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_modification.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_quartermile.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_template.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_vehicle.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_guestbook.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_model.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_track.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_service.' . $phpEx);
require($phpbb_root_path . 'includes/mods/class_garage_blog.' . $phpEx);
require($phpbb_root_path . 'includes/functions_display.' . $phpEx);

/**
* Setup variables
*/
$mode = request_var('mode', '');
$sort = request_var('sort', '');
$start = request_var('start', '');
$order = request_var('order', '');
$cid = request_var('CID', '');
$vid = request_var('VID', '');
$image_id = request_var('image_id', '');
$vid = (!empty($cid)) ? $cid : $vid;

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

switch ($mode)
{
	/**
	* Display page to create new vehicle
	*/
	case 'insert_make':

		//User Is Annoymous...So Not Allowed To Create A Vehicle
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("garage.$phpEx?mode=user_submit_make");
		}

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_add_make_model'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		//Get All Data Posted And Make It Safe To Use
		$params = array('VID' => '', 'made_year' => '', 'mileage' => '', 'mileage_units' => '', 'price' => '', 'price_decimal' => '', 'currency' => '', 'engine_type' => '', 'url_image' => '', 'tertiary' => '', 'redirect' => '');
		$data = $garage->process_vars($params);
		$params = array('make' => '', 'colour' => '', 'comments' => '');
		$data += $garage->process_mb_vars($params);

		//Checks All Required Data Is Present
		$params = array('make');
		$garage->check_required_vars($params);

		//Check Make Does Not Already Exist
		if ($garage_model->count_make($data['make']) > 0)
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx?mode=error&amp;EID=27", true));
		}

		//Create The Make
		$make_id = $garage_model->insert_make($data);
		$data['make_id'] = $make_id;

		//Perform Any Pending Notifications Requried
		$garage->pending_notification('unapproved_makes');

		//Now rather than redirect.. we build a page with all data
		page_header($user->lang['GARAGE']);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' 	=> 'garage/garage_header.html',
			'body'   	=> 'garage/garage_user_submit_data.html')
		);

		$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=add_vehicle");
		if ($data['tertiary'] == "edit")
		{
			$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID={$data['VID']}");
		}

		$template->assign_vars(array(
			'L_BUTTON_LABEL'		=> $user->lang['RETURN_TO_ITEM'],
			'S_USER_SUBMIT_SUCCESS'		=> true,
			'S_USER_SUBMIT_ACTION'		=> $user_submit_action,
		));

		foreach ($data as $key => $value)
		{
			if (empty($value))
			{
				continue;
			}
			$template->assign_block_vars('hidden_data', array(
				'VALUE'	=> $value,
				'NAME'	=> $key,
			));
		}

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

	break;
	/**
	* Display page to create new vehicle
	*/
	case 'insert_model':

		//Check The User Is Logged In...Else Send Them Off To Do So......And Redirect Them Back!!!
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{$phpbb_root_path}garage/garage.$phpEx?mode=user_submit_model");
		}

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_add_make_model'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		//Get All Data Posted And Make It Safe To Use
		$params = array('VID' => '', 'make_id' => '', 'made_year' => '', 'mileage' => '', 'mileage_units' => '', 'price' => '', 'price_decimal' => '', 'currency' => '', 'engine_type' => '', 'url_image' => '', 'tertiary' => '', 'redirect' => '');
		$data = $garage->process_vars($params);
		$params = array('model' => '', 'colour' => '', 'comments' => '');
		$data += $garage->process_mb_vars($params);

		//Checks All Required Data Is Present
		$params = array('make_id', 'model');
		$garage->check_required_vars($params);

		//If Needed Update Garage Config Telling Us We Have A Pending Item And Perform Notifications If Configured
		$garage->pending_notification('unapproved_models');

		//Create The Model
		$model_id = $garage_model->insert_model($data);
		$data['model_id'] = $model_id;

		//Now rather than redirect.. we build a page with all data
		page_header($user->lang['GARAGE']);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' 	=> 'garage/garage_header.html',
			'body'   	=> 'garage/garage_user_submit_data.html')
		);

		$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=add_vehicle");
		if ($data['tertiary'] == "edit")
		{
			$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID={$data['VID']}");
		}

		$template->assign_vars(array(
			'L_BUTTON_LABEL'			=> $user->lang['RETURN_TO_ITEM'],
			'S_USER_SUBMIT_SUCCESS'		=> true,
			'S_USER_SUBMIT_ACTION'		=> $user_submit_action,
		));

		foreach ($data as $key => $value)
		{
			if (empty($value))
			{
				continue;
			}
			$template->assign_block_vars('hidden_data', array(
				'VALUE'	=> $value,
				'NAME'	=> $key,
			));
		}

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

	break;

	/**
	* Display page to create new vehicle
	*/
	case 'add_vehicle':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{$phpbb_root_path}garage/garage_vehicle.$phpEx?mode=add_vehicle");
		}

		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_add_vehicle'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Check vehicle quota
		*/
		if ($garage_vehicle->count_user_vehicles() >= $garage_vehicle->get_user_add_quota())
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=5"));
		}

		/**
		* Get years & makes data from DB
		*/
		$years = $garage->year_list();
		$makes = $garage_model->get_all_makes();

		/**
		* Lets try new way of remembering any data entered before user heads to create some needed item(s)
		*/
		$params = array('made_year' => '', 'make_id' => $garage_config['default_make_id'], 'model_id' => $garage_config['default_model_id'], 'mileage' => '', 'mileage_units' => '', 'price' => '', 'price_decimal' => '', 'currency' => '', 'engine_type' => '', 'url_image' => '');
		$data = $garage->process_vars($params);
		$params = array('colour' => '', 'comments' => '');
		$data += $garage->process_mb_vars($params);
		$data['make'] = $data['make_id'];
		$data['model'] = $data['model_id'];

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header'	=> 'garage/garage_header.html',
			'body'		=> 'garage/garage_vehicle.html')
		);
		$garage_template->attach_image('vehicle');
		$garage_template->make_dropdown($makes, $data['make_id']);
		$garage_template->engine_dropdown($data['engine_type']);
		$garage_template->currency_dropdown($data['currency']);
		$garage_template->mileage_dropdown($data['mileage_units']);
		$garage_template->year_dropdown($years, $data['made_year']);
		$template->assign_vars(array(
			'L_TITLE'				=> $user->lang['CREATE_NEW_VEHICLE'],
			'L_BUTTON'				=> $user->lang['CREATE_NEW_VEHICLE'],
			'U_USER_SUBMIT_MAKE'	=> "javascript:add_make()",
			'U_USER_SUBMIT_MODEL'	=> "javascript:add_model()",
			'MAKE'					=> $data['make'],
			'MAKE_ID'				=> $data['make_id'],
			'MODEL'					=> $data['model'],
			'MODEL_ID'				=> $data['model_id'],
			'COLOUR'				=> $data['colour'],
			'MILEAGE'				=> $data['mileage'],
			'PRICE'					=> $data['price'],
			'PRICE_DECIMAL'			=> $data['price_decimal'],
			'COMMENTS'				=> $data['comments'],
			'URL_IMAGE'				=> $data['url_image'],
			'S_DISPLAY_SUBMIT_MAKE'	=> $garage_config['enable_user_submit_make'],
			'S_DISPLAY_SUBMIT_MODEL'=> $garage_config['enable_user_submit_model'],
			'S_MODE_USER_SUBMIT'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=user_submit_data"),
			'S_MODE_ACTION'			=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=insert_vehicle"))
		);
		$garage_template->sidemenu();
	break;

	/**
	* Insert new vehicle
	*/
	case 'insert_vehicle':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{$phpbb_root_path}garage/garage_vehicle.$phpEx?mode=add_vehicle");
		}

		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_add_vehicle'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Count vehicles already existing for user
		*/
		$user_vehicle_count = $garage_vehicle->count_user_vehicles();

		/**
		* Check vehicle quota
		*/
		if ($user_vehicle_count >= $garage_vehicle->get_user_add_quota())
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=5"));
		}

		/**
		* Get all required/optional data and check required data is present
		*/
		$params	= array('made_year' => '', 'make_id' => '', 'model_id' => '', 'mileage' => 0, 'mileage_units' => '', 'price' => 0, 'price_decimal' => 0, 'currency' => '', 'engine_type' => 0);
		$data	= $garage->process_vars($params);
		$params	= array('colour' => '', 'comments' => '');
		$data	+= $garage->process_mb_vars($params);
		$params = array('made_year', 'make_id', 'model_id');
		$garage->check_required_vars($params);

		/**
		* Determine if vehicle is users first
		*/
		$data['main_vehicle'] = ($user_vehicle_count == 0) ? 1 : 0;

		/**
		* Perform required DB work to create vehicle
		*/
		$vid = $garage_vehicle->insert_vehicle($data);

		/**
		* Handle any images
		*/
		if ($garage_image->image_attached())
		{
			if ($garage_image->below_image_quotas())
			{
				$image_id = $garage_image->process_image_attached('vehicle', $vid);
				$hilite = $garage_vehicle->hilite_exists($vid);
				$garage_image->insert_vehicle_gallery_image($image_id, $hilite);
			}
			else if ($garage_image->above_image_quotas())
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=4"));
			}
		}

		/**
		* Perform notification if required
		*/
		if ($garage_config['enable_vehicle_approval'])
		{
			$garage->pending_notification('unapproved_vehicles');
		}

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"));
	break;

	/**
	* Display page to edit an existing vehicle
	*/
	case 'edit_vehicle':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{$phpbb_root_path}garage/garage_vehicle.$phpEx?mode=edit_vehicle&amp;VID=$vid");
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Get any changed data incase we are arriving from creating a mark or model
		*/
		$params	= array('made_year' => '', 'make_id' => '', 'model_id' => '', 'mileage' => 0, 'mileage_units' => '', 'price' => 0, 'price_decimal' => 0, 'currency' => '', 'engine_type' => 0, 'redirect' => '');
		$store	= $garage->process_vars($params);
		$params	= array('colour' => '', 'comments' => '');
		$store	+= $garage->process_mb_vars($params);

		/**
		* Get vehicle, gallery, years & makes data from DB
		*/
		$data 		= $garage_vehicle->get_vehicle($vid);
		$gallery_data	= $garage_image->get_vehicle_gallery($vid);
		$years		= $garage->year_list();
		$makes 		= $garage_model->get_all_makes();

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header'	=> 'garage/garage_header.html',
			'body'		=> 'garage/garage_vehicle.html')
		);
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $data['vehicle'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"))
		);
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['EDIT_VEHICLE'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID=$vid"))
		);
		$garage_template->make_dropdown($makes, (!empty($store['make_id'])) ? $store['make_id'] : $data['make_id']);
		$garage_template->engine_dropdown((!empty($store['engine_type'])) ? $store['engine_type'] : $data['engine_type']);
		$garage_template->currency_dropdown((!empty($store['currency'])) ? $store['currency'] : $data['currency']);
		$garage_template->mileage_dropdown((!empty($store['mileage_units'])) ? $store['mileage_units'] : $data['mileage_unit']);
		$garage_template->year_dropdown($years, (!empty($store['made_year'])) ? $store['made_year'] : $data['made_year']);
		$garage_template->attach_image('vehicle');
		$template->assign_vars(array(
			'L_TITLE'				=> $user->lang['EDIT_VEHICLE'],
			'L_BUTTON'				=> $user->lang['EDIT_VEHICLE'],
			'U_EDIT_DATA'			=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID=$vid"),
			'U_MANAGE_GALLERY'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=manage_vehicle_gallery&amp;VID=$vid"),
			'U_USER_SUBMIT_MAKE'	=> "javascript:add_make('edit')",
			'U_USER_SUBMIT_MODEL'	=> "javascript:add_model('edit')",
			'VID' 					=> $vid,
			'MAKE_ID'				=> (!empty($store['make_id'])) ? $store['make_id'] : $data['make_id'],
			'MODEL_ID'				=> (!empty($store['model_id'])) ? $store['model_id'] : $data['model_id'],
			'COLOUR'				=> (!empty($store['colour'])) ? $store['colour'] : $data['colour'],
			'MILEAGE'				=> (!empty($store['mileage'])) ? $store['mileage'] : $data['mileage'],
			'PRICE'					=> (!empty($store['price'])) ? $store['price'] : $data['price'],
			'PRICE_DECIMAL'			=> (!empty($store['price_decimal'])) ? $store['price_decimal'] : $data['price_decimal'],
			'COMMENTS'				=> (!empty($store['comments'])) ? $store['comments'] : $data['comments'],
			'REDIRECT'				=> $store['redirect'],
			'S_DISPLAY_SUBMIT_MAKE'	=> $garage_config['enable_user_submit_make'],
			'S_DISPLAY_SUBMIT_MODEL'=> $garage_config['enable_user_submit_make'],
			'S_MODE_USER_SUBMIT' 	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=user_submit_data"),
			'S_MODE_ACTION'			=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=update_vehicle"),
			'S_IMAGE_MODE_ACTION'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=insert_vehicle_image"),
		));
		for ($i = 0, $count = sizeof($gallery_data);$i < $count; $i++)
		{
			$template->assign_block_vars('pic_row', array(
				'U_IMAGE'		=> (($gallery_data[$i]['attach_id']) && ($gallery_data[$i]['attach_is_image']) && (!empty($gallery_data[$i]['attach_thumb_location'])) && (!empty($gallery_data[$i]['attach_location']))) ? append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=" . $gallery_data[$i]['attach_id']) : '',
				'U_REMOVE_IMAGE'=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=remove_vehicle_image&amp;&amp;VID=$vid&amp;image_id=" . $gallery_data[$i]['attach_id']),
				'U_SET_HILITE'	=> ($gallery_data[$i]['hilite'] == 0) ? append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=set_vehicle_hilite&amp;image_id=" . $gallery_data[$i]['attach_id'] . "&amp;VID=$vid") : '',
				'IMAGE'			=> $phpbb_root_path . GARAGE_UPLOAD_PATH . $gallery_data[$i]['attach_thumb_location'],
				'IMAGE_TITLE'	=> $gallery_data[$i]['attach_file'])
			);
		}
		$garage_template->sidemenu();
	break;

	/**
	* Update existing vehicle
	*/
	case 'update_vehicle':
		/**
		* Check user logged in, else redirecting to login with return address to get them back
		*/
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{$phpbb_root_path}garage/garage_vehicle.$phpEx?mode=edit_vehicle&amp;VID=$vid");
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Get all required/optional data and check required data is present
		*/
		$params = array('made_year' => '', 'make_id' => '', 'model_id' => '', 'mileage' => 0, 'mileage_units' => '', 'price' => 0, 'price_decimal' => 0, 'currency' => '', 'engine_type' => 0, 'redirect' => '');
		$data = $garage->process_vars($params);
		$params = array('colour' => '', 'comments' => '');
		$data += $garage->process_mb_vars($params);
		$params = array('made_year', 'make_id', 'model_id');
		$garage->check_required_vars($params);

		/**
		* Perform required DB work to update vehicle
		*/
		$garage_vehicle->update_vehicle($data);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* Perform notification if required
		*/
		if ($garage_config['enable_vehicle_approval'])
		{
			$garage->pending_notification('unapproved_vehicles');
		}

		/**
		* All work complete for mode, so redirect to correct page
		*/
		if ($data['redirect'] == 'MCP')
		{
			redirect(append_sid("{$phpbb_root_path}mcp.$phpEx", "i=garage&amp;mode=unapproved_vehicles"));
		}
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"));
	break;

	/**
	* Delete existing vehcile
	*/
	case 'delete_vehicle':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_delete_vehicle'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to delete vehicle
		*/
		$garage_vehicle->delete_vehicle($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=main_menu"));
	break;

	/**
	* Display page to view vehicle
	*/
	case 'view_vehicle':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_view_vehicle.html')
		);
		$garage_vehicle->display_vehicle('NO');
		$garage_template->sidemenu();

		/**
		* Handle template declarations & assignments
		*/
		$garage->update_view_count(GARAGE_VEHICLES_TABLE, 'views', 'id', $vid);
	break;

	/**
	* Display page to view vehicle
	*/
	case 'test':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage_test.html')
		);
		$garage_vehicle->display_vehicle('NO');
		$garage_template->sidemenu();

		/**
		* Handle template declarations & assignments
		*/
		$garage->update_view_count(GARAGE_VEHICLES_TABLE, 'views', 'id', $vid);
	break;

	/**
	* Display page to view vehicle including owner controls
	*/
	case 'view_own_vehicle':
		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_view_vehicle.html')
		);
		$garage_template->sidemenu();
		$garage_vehicle->display_vehicle('YES');
	break;

	/**
	* Display page to view vehicle including moderator controls
	*/
	case 'moderate_vehicle':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('m_garage_edit'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_view_vehicle.html')
		);
		$garage_vehicle->display_vehicle('MODERATE');
		$garage_template->sidemenu();
	break;

	/**
	* Set vehicle as main user vehicle
	*/
	case 'set_main_vehicle':
		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to set main vehicle
		*/
		$garage->update_single_field(GARAGE_VEHICLES_TABLE, 'main_vehicle', 0 ,'user_id', $garage_vehicle->get_vehicle_owner_id($vid));
		$garage->update_single_field(GARAGE_VEHICLES_TABLE, 'main_vehicle', 1, 'id', $vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_own_vehicle&amp;VID=$vid"));
	break;

	/**
	* Insert image into vehicle
	*/
	case 'insert_vehicle_image':
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
				$image_id = $garage_image->process_image_attached('vehicle', $vid);
				$hilite = $garage_vehicle->hilite_exists($vid);
				$garage_image->insert_vehicle_gallery_image($image_id, $hilite);
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
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID=$vid#images"));
	break;

	/**
	* Set highlight image for vehicle
	*/
	case 'set_vehicle_hilite':
		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to set hightlight image
		*/
		$garage->update_single_field(GARAGE_VEHICLE_GALLERY_TABLE, 'hilite', 0, 'vehicle_id', $vid);
		$garage->update_single_field(GARAGE_VEHICLE_GALLERY_TABLE, 'hilite', 1, 'image_id', $image_id);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID=$vid#images"));
	break;

	/**
	* Delete vehicle image
	*/
	case 'remove_vehicle_image':
		/**
		* Check vehicle ownership, only owners & moderators with correct permissions get past here
		*/
		$garage_vehicle->check_ownership($vid);

		/**
		* Perform required DB work to delete dynorun image
		*/
		$garage_image->delete_vehicle_image($image_id);

		/**
		* Updates timestamp on vehicle, indicating it has been updated.
		* Updated vehicles are displayed on statistics page
		*/
		$garage_vehicle->update_vehicle_time($vid);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=edit_vehicle&amp;VID=$vid#images"));
	break;

	/**
	* Rate vehicle
	*/
	case 'rate_vehicle':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_rate'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=17"));
		}

		/**
		* Get all required/optional data and check required data is present
		*/
		$params = array('vehicle_rating' => '');
		$data = $garage->process_vars($params);
		$params = array('vehicle_rating');
		$garage->check_required_vars($params);

		/**
		* Get vehicle data from DB
		*/
		$vehicle_data = $garage_vehicle->get_vehicle($vid);

		/**
		* Create unqiue negative user number for guests
		*/
		srand($garage->make_seed());
		$data['user_id'] = ( $user->data['user_id'] == ANONYMOUS ) ? '-' . (rand(2,99999)) : $user->data['user_id'];

		/**
		* Not allowed rate your own vehicle
		*/
		if ( $vehicle_data['user_id'] == $data['user_id'] )
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=21"));
		}

		/**
		* Perform required DB work to insert or update vehicle rating
		*/
		if ($garage_vehicle->user_already_rated_vehicle($vid))
		{
			$garage_vehicle->update_vehicle_rating($data);
		}
		else
		{
			$garage_vehicle->insert_vehicle_rating($data);
		}

		/**
		* Perform required DB work to update vehicle weighted rating
		*/
		$weighted_rating = $garage_vehicle->calculate_weighted_rating($vid);
		$garage_vehicle->update_weighted_rating($vid, $weighted_rating);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=$vid"));
	break;

	/**
	* Delete existing rating for vehicle
	*/
	case 'delete_vehicle_rating':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('m_garage_rating'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=17"));
		}

		/**
		* Get all required/optional data and check required data is present
		*/
		$params = array('RTID' => '');
		$data = $garage->process_vars($params);
		$params = array('RTID');
		$garage->check_required_vars($params);

		/**
		* Perform required DB work to delete rating
		*/
		$garage->delete_rows(GARAGE_RATING_TABLE, 'id', $data['RTID']);

		/**
		* Perform required DB work to update vehicle weighted rating
		*/
		$weighted_rating = $garage_vehicle->calculate_weighted_rating($vid);
		$garage_vehicle->update_weighted_rating($vid, $weighted_rating);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=moderate_vehicle&amp;VID=$vid", true));
	break;

	/**
	* Reset all ratings for vehicle
	*/
	case 'reset_vehicle_rating':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('m_garage_rating'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=17"));
		}

		/**
		* Perform required DB work to delete all ratings for vehicle
		*/
		$data = $garage_vehicle->get_vehicle_rating($vid);
		for ($i = 0, $count = sizeof($data);$i < $count; $i++)
		{
			$garage->delete_rows(GARAGE_RATING_TABLE, 'id', $data['id']);
		}

		/**
		* Perform required DB work to update vehicle weighted rating
		*/
		$weighted_rating = $garage_vehicle->calculate_weighted_rating($vid);
		$garage_vehicle->update_weighted_rating($vid, $weighted_rating);

		/**
		* All work complete for mode, so redirect to correct page
		*/
		redirect(append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=moderate_vehicle&amp;VID=$vid", true));
	break;

	/**
	* Vehicle Of The Month
	*/
	case 'votm':
		/**
		* Check authorisation to perform action, redirecting to error screen if not
		*/
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=17"));
		}

		/**
		* Get make, model & year data from web server
		* If no make or model use default configuration
		*/
		$year	= request_var('YEAR', '');

		/**
		* Handle template declarations & assignments
		*/
		page_header($user->lang['GARAGE']);
		$template->set_filenames(array(
			'header'	=> 'garage/garage_header.html',
			'body'		=> 'garage/garage_votm.html')
		);

		$first_rating = $garage_vehicle->get_earliest_rating();

		$time = localtime(time(), 1) ;
		$start_year = date("Y", $first_rating['rate_date']);
		$current_year = $time['tm_year'] + 1900;

		if ( $start_year > $current_year )
		{
			echo "OH NO TIME MACHINE";
			return;
		}

		$tab_id = 0;
		for ($year = $current_year; $year >= $start_year; $year--)
		{
			$template->assign_block_vars('year', array(
				'YEAR'		=> $year,
				'TAB_ID'	=> $tab_id,
			));

			if($tab_id == 0)
			{
				$template->assign_vars(array(
					'S_LOWEST_TAB_AVAILABLE'	=> 0,
				));
			}

			for ( $month = 12; $month >= 1; $month-- )
			{
				$vehicle_data = $garage_vehicle->get_month_toprated_vehicle($month, $year);

				$thumb_image = null;
				if ((empty($vehicle_data['attach_id']) == false) && ($vehicle_data['attach_is_image'] == 1))
				{
					if ( (empty($vehicle_data['attach_thumb_location']) == false) && ($vehicle_data['attach_thumb_location'] != $vehicle_data['attach_location']) && (@file_exists($phpbb_root_path . GARAGE_UPLOAD_PATH."/".$vehicle_data['attach_thumb_location'])) )
					{
						$thumb_image = $phpbb_root_path . GARAGE_UPLOAD_PATH . $vehicle_data['attach_thumb_location'];
					}
				}
				$template->assign_block_vars('year.month', array(
					'MONTH'				=> $month,
					'THUMB'				=> $thumb_image,
					'VEHICLE'			=> $vehicle_data['vehicle'],
					'USERNAME'			=> $vehicle_data['username'],
					'IMAGE_TITLE'		=> $vehicle_data['attach_file'],
					'U_VIEW_IMAGE'		=> append_sid("{$phpbb_root_path}garage/garage.$phpEx?mode=view_image&amp;image_id=".$vehicle_data['attach_id']),
					'U_VIEW_VEHICLE'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx?mode=view_vehicle&amp;VID=".$vehicle_data['vehicle_id']),
					'U_VIEW_PROFILE'	=> append_sid("memberlist.$phpEx?mode=viewprofile&amp;u=".$vehicle_data['user_id']),
					'USERNAME_COLOUR'	=> get_username_string('colour', $vehicle_data['user_id'], $vehicle_data['username'], $vehicle_data['user_colour']),
					'RATING'			=> $vehicle_data['total_ratings'],
				));
			}
			$tab_id++;
		}

		$garage_template->sidemenu();

	break;

	default:
		;//
	break;

}
$garage_template->version_notice();

$template->set_filenames(array(
	'garage_footer' => 'garage/garage_footer.html')
);

page_footer();
?>
