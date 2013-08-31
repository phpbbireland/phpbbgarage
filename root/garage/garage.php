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

//Set The Page Title
$page_title = $user->lang['GARAGE'];

/**
* Setup variables
*/
$mode = request_var('mode', '');
$sort = request_var('sort', '');
$order = request_var('order', '');
$start = request_var('start', '');
$vid = request_var('VID', '');
$eid = request_var('EID', '');
$bid = request_var('BID', '');
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
switch ($mode)
{
	/**
	* Build page allowing user submit data
	* Have form action submit to required page
	*/
	case 'user_submit_data':

		//Build Page Header ;)
		page_header($page_title);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' 	=> 'garage/garage_header.html',
			'body'   	=> 'garage/garage_user_submit_data.html'
		));

		//Build Navlinks
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['ADD_USER_DATA']
		));

		//Checks All Required Data Is Present
		$params = array('primary' => '', 'secondary' => '');
		$data = $garage->process_vars($params);

		//Check The User Is Logged In...Else Send Them Off To Do So......And Redirect Them Back Just To Main Page Though!!!
		if ($user->data['user_id'] == ANONYMOUS)
		{
			login_box("{$phpbb_root_path}garage/garage.$phpEx");
		}

		if ($data['primary'] == "vehicle")
		{
			$params = array('VID' => '', 'made_year' => '', 'make_id' => '', 'mileage' => '', 'mileage_units' => '', 'price' => '', 'price_decimal' => '', 'currency' => '', 'engine_type' => '', 'url_image' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store = $garage->process_vars($params);
			$params = array('colour' => '', 'comments' => '');
			$store += $garage->process_mb_vars($params);

			if ($data['secondary'] == "make")
			{
				//Check This Feature Is Enabled & User Authorised
				if (!$garage_config['enable_user_submit_make'] || !$auth->acl_get('u_garage_add_make_model'))
				{
					redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=18"));
				}
				$template->assign_vars(array(
					'L_BUTTON_LABEL'		=> $user->lang['ADD_MAKE'],
					'S_USER_SUBMIT_MAKE'		=> true,
					'S_USER_SUBMIT_SUCCESSS'	=> false,
					'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=insert_make"),
				));
			}

			if ($data['secondary'] == "model")
			{
				//Check This Feature Is Enabled & User Authorised
				if (!$garage_config['enable_user_submit_model'] || !$auth->acl_get('u_garage_add_make_model'))
				{
					redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=18"));
				}
				$make = $garage_model->get_make($store['make_id']);

				$template->assign_vars(array(
					'L_BUTTON_LABEL'		=> $user->lang['ADD_MODEL'],
					'MAKE'				=> $make['make'],
					'S_USER_SUBMIT_MODEL'		=> true,
					'S_USER_SUBMIT_SUCCESSS'	=> false,
					'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=insert_model"),
				));
			}
		}
		elseif ($data['primary'] == "modification")
		{
			$params = array('VID' => '', 'MID' => '', 'category_id' => '', 'manufacturer_id' => '', 'product_id' => '', 'price' => 0, 'price_decimal' => 0, 'shop_id' => '', 'installer_id' => '', 'install_price' => 0, 'install_price_decimal' => 0, 'install_rating' => 0, 'product_rating' => 0, 'editupload' => '', 'image_id' => '', 'purchase_rating' => 0, 'url_image' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store	= $garage->process_vars($params);
			$params = array('comments' => '', 'install_comments' => '');
			$store	+= $garage->process_mb_vars($params);
			if (($data['secondary'] == "manufacturer") || ($data['secondary'] == "shop") || ($data['secondary'] == "garage"))
			{
				//Let Check The User Is Allowed Perform This Action
				if (!$auth->acl_get('u_garage_add_business'))
				{
					redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
				}
				if ($data['secondary'] == "garage")
				{
					$template->assign_vars(array(
						'S_BUSINESS_GARAGE'		=> true,
					));
				}
				if ($data['secondary'] == "shop")
				{
					$template->assign_vars(array(
						'S_BUSINESS_RETAIL'		=> true,
					));
				}
				if ($data['secondary'] == "manufacturer")
				{
					$template->assign_vars(array(
						'S_BUSINESS_PRODUCT'		=> true,
					));
				}
				$template->assign_vars(array(
					'L_BUTTON_LABEL'		=> $user->lang['ADD_NEW_BUSINESS'],
					'S_USER_SUBMIT_BUSINESS'	=> true,
					'S_USER_SUBMIT_SUCCESSS'	=> false,
					'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insert_business"),
				));
			}
			elseif ($data['secondary'] == "product")
			{
				unset($store['product_id']);
				//Check This Feature Is Enabled & User Authorised
				if (!$garage_config['enable_user_submit_product'] || !$auth->acl_get('u_garage_add_product'))
				{
					redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=18"));
				}
				$category = $garage->get_category($store['category_id']);
				$manufacturer = $garage_business->get_business($store['manufacturer_id']);

				$template->assign_vars(array(
					'CATEGORY' 					=> $category['title'],
					'MANUFACTURER' 				=> $manufacturer['title'],
					'L_BUTTON_LABEL'			=> $user->lang['ADD_PRODUCT'],
					'S_USER_SUBMIT_PRODUCT'		=> true,
					'S_USER_SUBMIT_SUCCESSS'	=> false,
					'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage_modification.$phpEx", "mode=insert_product"),
				));
			}
		}
		elseif ($data['primary'] == "premium")
		{
			$params = array('VID' => '', 'INS_ID' => '', 'premium' => '', 'premium_decimal' => '', 'cover_type_id' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			$params = array('comments' => '');
			$store 	+= $garage->process_mb_vars($params);
			//Let Check The User Is Allowed Perform This Action
			if (!$auth->acl_get('u_garage_add_business'))
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
			}
			$template->assign_vars(array(
				'L_BUTTON_LABEL'			=> $user->lang['ADD_NEW_BUSINESS'],
				'S_USER_SUBMIT_BUSINESS'	=> true,
				'S_BUSINESS_INSURANCE'		=> true,
				'S_USER_SUBMIT_SUCCESSS'	=> false,
				'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insert_business"),
			));
		}
		elseif ($data['primary'] == "dynorun")
		{
			$params = array('VID' => '', 'DID' => '', 'bhp' => '', 'bhp_decimal' => '', 'bhp_unit' => '', 'torque' => 0, 'torque_decimal' => 0, 'torque_unit' => '', 'boost' => 0, 'boost_decimal' => 0, 'boost_unit' => 'PSI', 'nitrous' => 0, 'peakpoint' => 0, 'peakpoint_decimal' => 0, 'url_image' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			//Let Check The User Is Allowed Perform This Action
			if (!$auth->acl_get('u_garage_add_business'))
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
			}
			$template->assign_vars(array(
				'L_BUTTON_LABEL'			=> $user->lang['ADD_NEW_BUSINESS'],
				'S_USER_SUBMIT_BUSINESS'	=> true,
				'S_BUSINESS_DYNOCENTRE'		=> true,
				'S_USER_SUBMIT_SUCCESSS'	=> false,
				'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insert_business"),
			));
		}
		elseif ($data['primary'] == "lap")
		{
			$params = array('VID' => '', 'LID' => '', 'condition_id' => '', 'type_id' => '', 'minute' => '', 'second' => '', 'millisecond' => '', 'url_image' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			/**
			* Check authorisation to perform action, redirecting to error screen if not
			*/
			if (!$garage_config['enable_tracktime'] || !$garage_config['enable_user_add_track'] || !$auth->acl_get('u_garage_add_track'))
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=18"));
			}
			$garage_template->mileage_dropdown();
			$template->assign_vars(array(
				'L_BUTTON_LABEL'		=> $user->lang['ADD_TRACK'],
				'S_USER_SUBMIT_TRACK'		=> true,
				'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}{$phpbb_root_path}garage/garage_track.$phpEx", "mode=insert_track"),
				'S_USER_SUBMIT_SUCCESSS'	=> false,
			));
		}
		elseif ($data['primary'] == "service")
		{
			$params	= array('VID' => '', 'SVID' => '', 'type_id' => '', 'price' => 0, 'price_decimal' => 0, 'rating' => 0, 'mileage' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			//Let Check The User Is Allowed Perform This Action
			if (!$auth->acl_get('u_garage_add_business'))
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
			}
			$template->assign_vars(array(
				'L_BUTTON_LABEL'			=> $user->lang['ADD_NEW_BUSINESS'],
				'S_USER_SUBMIT_BUSINESS'	=> true,
				'S_BUSINESS_GARAGE'			=> true,
				'S_USER_SUBMIT_ACTION'		=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insert_business"),
			));
		}

		foreach ($store as $key => $value)
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
	* Display search options page
	*/
	case 'search':

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_search'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Build Page Header ;)
		page_header($page_title);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' 	=> 'garage/garage_header.html',
			'body'   	=> 'garage/garage_search.html'
		));

		//Build Navlinks
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['SEARCH'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=search")
		));

		//Get Years As Defined By Admin In ACP
		$years 	= $garage->year_list();
		$manufacturers 	= $garage_business->get_business_by_type(BUSINESS_PRODUCT);
		$makes 		= $garage_model->get_all_makes();
		$categories = $garage->get_categories();

		//Build All Required Javascript And Arrays
		$garage_template->category_dropdown($categories);
		$garage_template->year_dropdown($years);
		$garage_template->make_dropdown($makes);
		$garage_template->manufacturer_dropdown($manufacturers);

		$template->assign_vars(array(
			'U_FIND_USERNAME'				=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&amp;form=search_garage&amp;field=username&amp;select_single=true'),
			'UA_FIND_USERNAME'				=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser&form=search_garage&field=username&select_single=true', false),
			'S_DISPLAY_SEARCH_INSURANCE'	=> $garage_config['enable_insurance'],
			'S_MODE_ACTION_SEARCH' 			=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=search_results"),
			'S_SEARCH_TAB_ACTIVE'			=> true,
		));

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

	break;

	/**
	* Browse, quartermile table, dynorun table & lap table pages Are really just a search, how cool is that :)
	*/
	case 'browse':
	case 'quartermile_table':
	case 'dynorun_table':
	case 'lap_table':
	case 'search_results':

		$required_permission = 'u_garage_search';

		//Handle Some Mode Specific Things Like Navlinks & Display Defaults
		if ($mode == 'browse')
		{
			$required_permission = 'u_garage_browse';
			//Build Navlinks
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $user->lang['BROWSE'],
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=$mode")
			));

			$template->assign_vars(array(
				'S_BROWSE_TAB_ACTIVE'	=> true,
			));
			$default_display = 'vehicles';
		}
		else if ($mode == 'quartermile_table')
		{
			$required_permission = 'u_garage_browse';
			//Build Navlinks
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $user->lang['QUARTERMILE_TABLE'],
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=$mode")
			));

			$template->assign_vars(array(
				'S_QUARTERMILE_TABLE_TAB_ACTIVE'	=> true,
			));
			$default_display = 'quartermiles';
		}
		elseif ($mode == 'dynorun_table')
		{
			$required_permission = 'u_garage_browse';
			//Build Navlinks
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $user->lang['DYNORUN_TABLE'],
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=$mode")
			));

			$template->assign_vars(array(
				'S_DYNORUN_TABLE_TAB_ACTIVE'	=> true,
			));
			$default_display = 'dynoruns';
		}
		elseif ($mode == 'lap_table')
		{
			$required_permission = 'u_garage_browse';
			//Build Navlinks
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $user->lang['LAP_TABLE'],
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=$mode")
			));

			$template->assign_vars(array(
				'S_LAP_TABLE_TAB_ACTIVE'	=> true,
			));
			$default_display = 'laps';
		}
		else
		{
			//Build Navlinks
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $user->lang['SEARCH'],
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=search")
			));

			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $user->lang['RESULTS']
			));
		}

		//Accept default display if already set, else default to vehicles
		$default_display = (empty($default_display)) ? 'vehicles' : $default_display;

		/*
		* Let Check The User Is Allowed Perform This Action
		*/
		if (!$auth->acl_get($required_permission))
		{
			/**
			* If Not Logged In Send Them To Login & Back, Maybe They Have Permission As A User
			*/
			if ($user->data['user_id'] == ANONYMOUS)
			{
				login_box("{$phpbb_root_path}garage/garage.$phpEx?mode=$mode");
			}
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Get All Data Posted And Make It Safe To Use
		$params	= array('search_year' => '', 'search_make' => '', 'search_model' => '', 'search_category' => '', 'search_manufacturer' => '', 'search_product' => '', 'search_username' => '', 'display_as' => $default_display, 'made_year' => '', 'make_id' => '', 'model_id' => '', 'category_id' => '', 'manufacturer_id' => '', 'product_id' => '');
		$data 	= $garage->process_vars($params);
		$params	= array('username' => '');
		$data 	+= $garage->process_mb_vars($params);

		//Set Required Values To Defaults If They Are Empty
		$start	= (empty($start)) ? '0' : $start;

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_search_results.html'
		));

		//Build Page Header ;)
		page_header($page_title);

		//Depending On Search Results Required We Have Different Data To Pass To Template Engine
		if ($data['display_as'] == 'vehicles')
		{
			$pagination_url = $total_vehicles = null;
			$results_data = $garage->perform_search($data, $total_vehicles, $pagination_url);
			$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}".$pagination_url), $total_vehicles, $garage_config['cars_per_page'], $start);
			$template->assign_vars(array(
				'S_DISPLAY_VEHICLE_RESULTS' 	=> true,
				'PAGINATION' 			=> $pagination,
				'PAGE_NUMBER' 			=> on_page($total_vehicles, $garage_config['cars_per_page'], $start),
				'TOTAL_VEHICLES'		=> ($total_vehicles == 1) ? $user->lang['VIEW_VEHICLE_PAGE'] : sprintf($user->lang['VIEW_VEHICLES_PAGE'], $total_vehicles),
			));
			$garage_template->vehicle_assignment($results_data, 'vehicle');
		}
		//Display Results As Modifications
		else if ($data['display_as'] == 'modifications')
		{
			$pagination_url = $total_modifications = null;
			$results_data = $garage->perform_search($data, $total_modifications, $pagination_url);
			$pagination = generate_pagination($pagination_url, $total_modifications, $garage_config['cars_per_page'], $start);

			$template->assign_vars(array(
				'S_DISPLAY_MODIFICATION_RESULTS'=> true,
				'PAGINATION' 			=> $pagination,
				'PAGE_NUMBER' 			=> on_page($total_modifications, $garage_config['cars_per_page'], $start),
				'TOTAL_MODIFICATIONS'		=> ($total_modifications == 1) ? $user->lang['VIEW_MODIFICATION_PAGE'] : sprintf($user->lang['VIEW_MODIFICATIONS_PAGE'], $total_modifications),
			));

			for ($i = 0, $count = sizeof($results_data); $i < $count; $i++)
			{
				//Provide Results To Template Engine
				$template->assign_block_vars('modification', array(
					'U_IMAGE'				=> ($results_data[$i]['attach_id']) ? append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=" . $results_data[$i]['attach_id']) : '',
					'U_VIEW_VEHICLE'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $results_data[$i]['vehicle_id']),
					'U_VIEW_PROFILE'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $results_data[$i]['user_id']),
					'U_VIEW_MODIFICATION'	=> append_sid("{$phpbb_root_path}garage/garage_modification.$phpEx", "mode=view_modification&amp;VID=" . $results_data[$i]['vehicle_id'] . "&amp;MID=" . $results_data[$i]['modification_id']),
					'IMAGE'					=> $user->img('garage_img_attached', 'MODIFICATION_IMAGE_ATTACHED'),
					'VEHICLE'				=> $results_data[$i]['vehicle'],
					'MODIFICATION'			=> $results_data[$i]['modification_title'],
					'CATEGORY'				=> $results_data[$i]['category_title'],
					'USERNAME'				=> $results_data[$i]['username'],
					'PRICE'					=> $results_data[$i]['price'],
					'RATING'				=> $results_data[$i]['product_rating'],
					'USERNAME_COLOUR'		=> get_username_string('colour', $results_data[$i]['user_id'], $results_data[$i]['username'], $results_data[$i]['user_colour']),
				));
			}
		}
		//Display Results As Premiums
		else if ($data['display_as'] == 'premiums')
		{
			$pagination_url = $total_premiums = null;
			$results_data = $garage->perform_search($data, $total_premiums, $pagination_url);
			$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}".$pagination_url), $total_premiums, $garage_config['cars_per_page'], $start);
			$template->assign_vars(array(
				'S_DISPLAY_PREMIUM_RESULTS' 	=> true,
				'PAGINATION' 					=> $pagination,
				'PAGE_NUMBER' 					=> on_page($total_premiums, $garage_config['cars_per_page'], $start),
				'TOTAL_PREMIUMS'				=> ($total_premiums == 1) ? $user->lang['VIEW_PREMIUM_PAGE'] : sprintf($user->lang['VIEW_PREMIUMS_PAGE'], $total_premiums),
			));
			//How about Something like
			//$garage_template->assign_premium_block($results_data);
			for ($i = 0, $count = sizeof($results_data); $i < $count; $i++)
			{
				//Provide Results To Template Engine
				$template->assign_block_vars('premium', array(
					'U_VIEW_VEHICLE'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $results_data[$i]['id']),
					'U_VIEW_PROFILE' 	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $results_data[$i]['user_id']),
					'U_VIEW_BUSINESS' 	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_insurance_business&amp;BID=" . $results_data[$i]['business_id']),
					'VEHICLE' 			=> $results_data[$i]['vehicle'],
					'USERNAME' 			=> $results_data[$i]['username'],
					'BUSINESS' 			=> $results_data[$i]['title'],
					'PRICE' 			=> $results_data[$i]['price'],
					'MOD_PRICE' 		=> $results_data[$i]['total_spent'],
					'PREMIUM' 			=> $results_data[$i]['premium'],
					'COVER_TYPE' 		=> $garage_insurance->get_cover_type($results_data[$i]['cover_type_id']),
					'USERNAME_COLOUR'	=> get_username_string('colour', $results_data[$i]['user_id'], $results_data[$i]['username'], $results_data[$i]['user_colour']),
				));
			}
		}
		//Display Results As Quartermiles
		else if ($data['display_as'] == 'quartermiles')
		{
			$pagination_url = $total_quartermiles = null;
			$results_data = $garage->perform_search($data, $total_quartermiles, $pagination_url);
			$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}".$pagination_url), $total_quartermiles, $garage_config['cars_per_page'], $start);

			$template->assign_vars(array(
				'S_DISPLAY_QUARTERMILE_RESULTS'	=> true,
				'PAGINATION' 			=> $pagination,
				'PAGE_NUMBER' 			=> on_page($total_quartermiles, $garage_config['cars_per_page'], $start),
				'TOTAL_QUARTERMILES'	=> ($total_quartermiles == 1) ? $user->lang['VIEW_QUARTERMILE_PAGE'] : sprintf($user->lang['VIEW_QUARTERMILES_PAGE'], $total_quartermiles),
			));

			for ($i = 0, $count = sizeof($results_data); $i < $count; $i++)
			{
				//Provide Results To Template Engine
				$template->assign_block_vars('quartermile', array(
					'U_IMAGE'			=> ($results_data[$i]['attach_id']) ? append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=" . $results_data[$i]['attach_id']) : '',
					'U_VIEWPROFILE'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $results_data[$i]['user_id']),
					'U_VIEWVEHICLE'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $results_data[$i]['id']),
					'U_QUART'			=> append_sid("{$phpbb_root_path}garage/garage_quartermile.$phpEx?mode=view_quartermile&amp;QMID=".$results_data[$i]['qmid']."&amp;VID=".$results_data[$i]['id']),
					'VEHICLE'			=> $results_data[$i]['vehicle'],
					'USERNAME'			=> $results_data[$i]['username'],
					'IMAGE'				=> $user->img('garage_img_attached', 'QUARTEMILE_IMAGE_ATTACHED'),
					'RT'				=> ($results_data[$i]['rt'] != "0.000") ? $results_data[$i]['rt'] : '-',
					'SIXTY'				=> ($results_data[$i]['sixty'] != "0.000") ? $results_data[$i]['sixty'] : '-',
					'THREE'				=> ($results_data[$i]['three'] != "0.000") ? $results_data[$i]['three'] : '-',
					'EIGHTH'			=> ($results_data[$i]['eighth'] != "0.000") ? $results_data[$i]['eighth'] : '-',
					'EIGHTHMPH'			=> ($results_data[$i]['eighthmph'] != "0.000") ? $results_data[$i]['eighthmph'] : '-',
					'THOU'				=> ($results_data[$i]['thou'] != "0.000") ? $results_data[$i]['thou'] : '-',
					'QUART'				=> ($results_data[$i]['quart'] != "0.000") ? $results_data[$i]['quart'] : '-',
					'QUARTMPH'			=> ($results_data[$i]['quartmph'] != "0.000") ? $results_data[$i]['quartmph'] : '-',
					'USERNAME_COLOUR'	=> get_username_string('colour', $results_data[$i]['user_id'], $results_data[$i]['username'], $results_data[$i]['user_colour']),
				));
			}
		}
		//Display Results As Dynoruns
		else if ($data['display_as'] == 'dynoruns')
		{
			$pagination_url = $total_dynoruns = null;
			$results_data = $garage->perform_search($data, $total_dynoruns, $pagination_url);
			$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}".$pagination_url), $total_dynoruns, $garage_config['cars_per_page'], $start);
			$template->assign_vars(array(
				'S_DISPLAY_DYNORUN_RESULTS' 	=> true,
				'PAGINATION' 					=> $pagination,
				'PAGE_NUMBER' 					=> on_page($total_dynoruns, $garage_config['cars_per_page'], $start),
				'TOTAL_DYNORUNS'				=> ($total_dynoruns == 1) ? $user->lang['VIEW_DYNORUN_PAGE'] : sprintf($user->lang['VIEW_DYNORUNS_PAGE'], $total_dynoruns),
			));
			for ($i = 0, $count = sizeof($results_data); $i < $count; $i++)
			{
				//Provide Results To Template Engine
				$template->assign_block_vars('dynorun', array(
					'U_IMAGE'			=> ($results_data[$i]['attach_id']) ? append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=" . $results_data[$i]['attach_id']) : '',
					'U_VIEWPROFILE'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $results_data[$i]['user_id']),
					'U_VIEWVEHICLE'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $results_data[$i]['vehicle_id']),
					'U_BHP'				=> append_sid("{$phpbb_root_path}garage/garage_dynorun.$phpEx?mode=view_dynorun&amp;DID=".$results_data[$i]['did']."&amp;VID=".$results_data[$i]['vehicle_id']),
					'IMAGE'				=> $user->img('garage_img_attached', 'QUARTEMILE_IMAGE_ATTACHED'),
					'USERNAME'			=> $results_data[$i]['username'],
					'VEHICLE'			=> $results_data[$i]['vehicle'],
					'DYNOCENTRE'		=> $results_data[$i]['title'],
					'BHP'				=> $results_data[$i]['bhp'],
					'BHP_UNIT'			=> $results_data[$i]['bhp_unit'],
					'TORQUE'			=> $results_data[$i]['torque'],
					'TORQUE_UNIT'		=> $results_data[$i]['torque_unit'],
					'BOOST'				=> $results_data[$i]['boost'],
					'BOOST_UNIT'		=> $results_data[$i]['boost_unit'],
					'NITROUS'			=> $results_data[$i]['nitrous'],
					'PEAKPOINT'			=> $results_data[$i]['peakpoint'],
					'USERNAME_COLOUR'	=> get_username_string('colour', $results_data[$i]['user_id'], $results_data[$i]['username'], $results_data[$i]['user_colour']),
				));
			}
		}
		//Display Results As Track Times
		else if ($data['display_as'] == 'laps')
		{
			$pagination_url = $total_laps = null;
			$results_data = $garage->perform_search($data, $total_laps, $pagination_url);
			$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}".$pagination_url), $total_laps, $garage_config['cars_per_page'], $start);
			$template->assign_vars(array(
				'S_DISPLAY_LAP_RESULTS' 	=> true,
				'PAGINATION' 			=> $pagination,
				'PAGE_NUMBER' 			=> on_page($total_laps, $garage_config['cars_per_page'], $start),
				'TOTAL_LAPS'			=> ($total_laps == 1) ? $user->lang['VIEW_LAP_PAGE'] : sprintf($user->lang['VIEW_LAPS_PAGE'], $total_laps),
			));
			for ($i = 0, $count = sizeof($results_data); $i < $count; $i++)
			{
				//Provide Results To Template Engine
				$template->assign_block_vars('lap', array(
					'TRACK'				=> $results_data[$i]['title'],
					'CONDITION'			=> $garage_track->get_track_condition($results_data[$i]['condition_id']),
					'TYPE'				=> $garage_track->get_lap_type($results_data[$i]['type_id']),
					'MINUTE'			=> $results_data[$i]['minute'],
					'SECOND'			=> $results_data[$i]['second'],
					'MILLISECOND'		=> $results_data[$i]['millisecond'],
					'IMAGE'				=> $user->img('garage_img_attached', 'IMAGE_ATTACHED'),
					'USERNAME'			=> $results_data[$i]['username'],
					'VEHICLE'			=> $results_data[$i]['vehicle'],
					'U_VIEWPROFILE'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $results_data[$i]['user_id']),
					'U_VIEWVEHICLE'		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $results_data[$i]['vehicle_id']),
					'U_IMAGE'			=> ($results_data[$i]['attach_id']) ? append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=". $results_data[$i]['attach_id']) : '',
					'U_TRACK'			=> append_sid("{$phpbb_root_path}{$phpbb_root_path}garage/garage_track.$phpEx?mode=view_track&amp;TID=".$results_data[$i]['track_id']."&amp;VID=". $results_data[$i]['vehicle_id']),
					'U_LAP'				=> append_sid("{$phpbb_root_path}{$phpbb_root_path}garage/garage_track.$phpEx?mode=view_lap&amp;LID=".$results_data[$i]['lid']."&amp;VID=". $results_data[$i]['vehicle_id']),
					'USERNAME_COLOUR'	=> get_username_string('colour', $results_data[$i]['user_id'], $results_data[$i]['username'], $results_data[$i]['user_colour']),
				));
			}
		}
		//Pass Selected Options So On Sort We Now What We Are Sorting ;)
		$template->assign_vars(array(
			'SEARCH_YEAR'			=> $data['search_year'],
			'SEARCH_MAKE'			=> $data['search_make'],
			'SEARCH_MODEL'			=> $data['search_model'],
			'SEARCH_CATEGORY'		=> $data['search_category'],
			'SEARCH_MANUFACTURER'	=> $data['search_manufacturer'],
			'SEARCH_PRODUCT'		=> $data['search_product'],
			'SEARCH_USERNAME'		=> $data['search_username'],
			'DISPLAY_AS'			=> $data['display_as'],
			'MADE_YEAR'				=> $data['made_year'],
			'MAKE_ID'				=> $data['make_id'],
			'MODEL_ID'				=> $data['model_id'],
			'CATEGORY_ID'			=> $data['category_id'],
			'MANUFACTURER_ID'		=> $data['manufacturer_id'],
			'PRODUCT_ID'			=> $data['product_id'],
			'USERNAME'				=> $data['username'],
			'S_MODE_ACTION'			=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=$mode"),
		));

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

		break;

	/**
	* View a iamge contained in the garage
	*/
	case 'view_image':

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Increment View Counter For This Image
		$garage->update_view_count(GARAGE_IMAGES_TABLE, 'attach_hits', 'attach_id', $image_id);

		//Pull Required Image Data From DB
		$data = $garage_image->get_image($image_id);

		//Check To See If This Is A Remote Image
		if (preg_match( "/^http:\/\//i", $data['attach_location']))
		{
			//Redirect Them To The Remote Image
			header("Location: " . $data['attach_location']);
			exit;
		}
		//Looks Like It's A Local Image...So Lets Display It
		else
		{
			//Let Handle Watermarking... ;)
			$watermark_ok = 0;
			if ($garage_config['enable_watermark'] == 1 && $garage_config['watermark_type'] == 'non_permanent')
			{
				$data['watermark_ext'] = strtolower( preg_replace( "/^.*\.(\S+)$/", "\\1", $garage_config['watermark_source']));

				switch ($data['watermark_ext'])
				{
					case 'png':
						$watermark = imagecreatefrompng( $phpbb_root_path . GARAGE_WATERMARK_PATH . $garage_config['watermark_source']);
						imageAlphaBlending($watermark, false);
						imageSaveAlpha($watermark, true);
					break;

					default:
						$watermark = false;
					break;
				}

				if ($watermark)
				{
					$data['width'] = $garage_image->get_image_width($data['attach_location']);
					$data['height'] = $garage_image->get_image_height($data['attach_location']);
					$data['watermark_width'] = imagesx($watermark);
					$data['watermark_height'] = imagesy($watermark);
					$data['dest_x'] = $data['width'] - $data['watermark_width'] - 5;
					$data['dest_y'] = $data['height'] - $data['watermark_height'] - 5;

					switch ($data['attach_ext'])
					{
						case '.png':
							$source = imagecreatefrompng($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_location']);
						break;
						case '.gif':
							$source = imagecreatefromgif($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_location']);
						break;
						case '.jpg':
						case '.jpeg':
							$source = imagecreatefromjpeg($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_location']);
						break;
						default:
							$img_src = false;
						break;
					}
					if ($source)
					{
						imagecopymerge($source, $watermark, $data['dest_x'], $data['dest_y'], 0, 0, $data['watermark_width'], $data['watermark_height'], 60);
						$watermark_ok = 1;
					}
				}
			}

			//Lets Display The Watermarked Image
			if ($watermark_ok)
			{
				switch ($data['attach_ext'])
				{
					case '.gif':
					case '.png':
						header('Content-type: image/png');
						imagepng($source);
						imagedestroy($source);
						imagedestroy($watermark);
					break;

					case '.jpg':
					case '.jpeg':
						header('Content-type: image/jpeg');
						imagejpeg($source);
						imagedestroy($source);
						imagedestroy($watermark);
					break;

					default:
						trigger_error('UNSUPPORTED_FILE_TYPE');
					break;
				}
			}
			//Looks Like We Need To Just Show The Original Image
			else
			{
				switch ($data['attach_ext'])
				{
					case '.png':
							header('Content-type: image/png');
					break;
					case '.gif':
							header('Content-type: image/gif');
					break;
					case '.jpg':
							header('Content-type: image/jpeg');
					break;
					default:
						trigger_error('UNSUPPORTED_FILE_TYPE');
				}
				readfile($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_location']);
			}
			exit;
		}

	/**
	* View all iamges contained in the garage
	*/
	case 'view_all_images':

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Set Required Values To Defaults If They Are Empty
		$start = (empty($start)) ? '0' : $start;

		//Build Page Header ;)
		page_header($page_title);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_view_images.html')
		);

		//Build Navlinks
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['IMAGES'],
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_all_images")
		));

		//Pull Required Image Data From DB
		$data = $garage_image->get_all_images($start, '100');

		//Process Each Image
		for ($i = 0, $count = sizeof($data); $i < $count; $i++)
		{
			//Produce Actual Image Thumbnail And Link It To Full Size Version..
			if (($data[$i]['attach_id']) && ($data[$i]['attach_is_image']) && (!empty($data[$i]['attach_thumb_location'])) && (!empty($data[$i]['attach_location'])))
			{
				$template->assign_block_vars('pic_row', array(
					'U_VIEW_PROFILE'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" .$data[$i]['user_id']),
					'U_VIEW_VEHICLE'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" .$data[$i]['garage_id']),
					'U_IMAGE'			=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=view_image&amp;image_id=" . $data[$i]['attach_id']),
					'IMAGE_TITLE'		=> $data[$i]['attach_file'],
					'IMAGE'				=> $phpbb_root_path . GARAGE_UPLOAD_PATH . $data[$i]['attach_thumb_location'],
					'VEHICLE' 			=> $data[$i]['vehicle'],
					'USERNAME' 			=> $data[$i]['username'],
					'USERNAME_COLOUR'	=> get_username_string('colour', $data[$i]['user_id'], $data[$i]['username'], $data[$i]['user_colour']),
				));
			}
			//Cleanup For Next Image
			$thumb_image = '';
			$image = '';
		}

		$template->assign_vars(array(
			'S_MODE_ACTION' => append_sid("{$phpbb_root_path}garage/garage.$phpEx?mode=view_all_images")
		));

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

		break;

	/**
	* Insurer review page
	*/
	case 'insurance_review':

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_view_insurance_business.html'
		));

		//Get All Data Posted And Make It Safe To Use
		$params		= array('start' => 0);
		$data 		= $garage->process_vars($params);
		$data['where']	= (!empty($bid)) ? "AND b.id = $bid" : '';

		//Get All Insurance Business Data
		$business = $garage_business->get_insurance_business($data['where'], $data['start']);

		//Build Page Header ;)
		page_header($page_title);

		//Display Correct Breadcrumb Links..
		$template->assign_block_vars('navlinks', array(
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insurance_review"),
			'FORUM_NAME' 	=> $user->lang['INSURANCE_SUMMARY']
		));

		//Display Correct Breadcrumb Links..
		if (!empty($bid))
		{
			$template->assign_block_vars('navlinks', array(
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insurance_review&amp;BID=" . $business[0]['id']),
				'FORUM_NAME' 	=> $business[0]['title']
			));
		}

	  		//Loop Processing All Insurance Business's Returned From First Select
		for ($i = 0, $count = sizeof($business);$i < $count; $i++)
	  	{
			$template->assign_block_vars('business_row', array(
				'U_VIEW_BUSINESS'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=insurance_review&amp;BID=" . $business[$i]['id']),
				'TITLE' 			=> $business[$i]['title'],
				'ADDRESS' 			=> $business[$i]['address'],
				'TELEPHONE' 		=> $business[$i]['telephone'],
				'FAX' 				=> $business[$i]['fax'],
				'WEBSITE' 			=> $business[$i]['website'],
				'EMAIL' 			=> $business[$i]['email'],
				'OPENING_HOURS' 	=> $business[$i]['opening_hours']
			));

			//Setup Template Block For Detail Being Displayed...
			$detail = (empty($bid)) ? 'business_row.more_detail' : 'business_row.insurance_detail';
			$template->assign_block_vars($detail, array());

			//Now Loop Through All Insurance Cover Types...
			$cover_types_id = array(TP, TPFT, COMP, CLAS, COMP_RED);
			for ($j = 0, $count2 = sizeof($cover_types_id);$j < $count2; $j++)
			{
				//Pull MIN/MAX/AVG Of Specific Cover Type By Business ID
				$premium_data = $garage_insurance->get_premiums_stats_by_business_and_covertype($business[$i]['id'], $cover_types_id[$j]);
				$template->assign_block_vars('business_row.cover_row', array(
					'COVER_TYPE'	=> $garage_insurance->get_cover_type($cover_types_id[$j]),
					'MINIMUM' 	=> $premium_data['min'],
					'AVERAGE' 	=> $premium_data['avg'],
					'MAXIMUM' 	=> $premium_data['max']
				));
			}

			//If Display Single Insurance Company We Then Need To Get All Premium Data
			if (!empty($bid))
			{
				//Pull All Insurance Premiums Data For Specific Insurance Company
				$insurance_data = $garage_insurance->get_premiums_by_business($business[$i]['id']);
				for ($k = 0, $count3 = sizeof($insurance_data);$k < $count3; $k++)
				{
					$template->assign_block_vars('business_row.insurance_detail.premiums', array(
						'U_VIEW_PROFILE'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $insurance_data[$k]['user_id']),
						'U_VIEW_VEHICLE'	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $insurance_data[$k]['vehicle_id']),
						'USERNAME'			=> $insurance_data[$k]['username'],
						'USERNAME_COLOUR'	=> get_username_string('colour', $insurance_data[$i]['user_id'], $insurance_data[$i]['username'], $insurance_data[$i]['user_colour']),
						'VEHICLE' 			=> $insurance_data[$k]['vehicle'],
						'PREMIUM' 			=> $insurance_data[$k]['premium'],
						'COVER_TYPE' 		=> $garage_insurance->get_cover_type($insurance_data[$k]['cover_type_id']),
					));
				}
			}
 		}

		if  (empty($bid))
		{
			// Get Insurance Business Data For Pagination
			$count = $garage_business->count_insurance_business_data($data['where']);
			$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}"), $count, $garage_config['cars_per_page'], $start);
			$template->assign_vars(array(
				'PAGINATION' 			=> $pagination,
				'PAGE_NUMBER' 			=> on_page($count, $garage_config['cars_per_page'], $start),
				'TOTAL_BUSINESS'		=> ($count == 1) ? $user->lang['VIEW_BUSINESS_PAGE'] : sprintf($user->lang['VIEW_BUSINESS\'S_PAGE'], $count),
				'S_INSURANCE_REVIEW_TAB_ACTIVE'	=> true,
			));
		}

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

		break;

	/**
	* Garage review page
	*/
	case 'garage_review':

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_browse'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header'=> 'garage/garage_header.html',
			'body' 	=> 'garage/garage_view_garage_business.html'
		));

		//Get All Data Posted And Make It Safe To Use
		$params = array('start' => 0);
		$data = $garage->process_vars($params);
		$data['where'] = (!empty($bid)) ? " AND b.id = $bid" : '';

		//Get Required Garage Business Data
		$business = $garage_business->get_garage_business($data['where'], $data['start']);

		//Build Page Header ;)
		page_header($page_title);

		//Display Correct Breadcrumb Links..
		$template->assign_block_vars('navlinks', array(
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=garage_review"),
			'FORUM_NAME' 	=> $user->lang['GARAGE_REVIEW']
		));

		//Setup Breadcrumb Trail Correctly...
		if (!empty($bid))
		{
			$template->assign_block_vars('navlinks', array(
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=garage_review&amp;BID=" . $business[0]['id']),
				'FORUM_NAME' 	=> $business[0]['title']
			));
		}

		//Process All Garages......
		for ($i = 0, $count = sizeof($business);$i < $count; $i++)
		{
			$template->assign_block_vars('business_row', array(
				'U_VIEW_BUSINESS'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=garage_review&amp;BID=" . $business[$i]['id']),
				'RATING' 			=> (empty($business[$i]['rating'])) ? 0 : $business[$i]['rating'],
				'TITLE' 			=> $business[$i]['title'],
				'ADDRESS' 			=> $business[$i]['address'],
				'TELEPHONE' 		=> $business[$i]['telephone'],
				'FAX' 				=> $business[$i]['fax'],
				'WEBSITE' 			=> $business[$i]['website'],
				'EMAIL' 			=> $business[$i]['email'],
				'MAX_RATING' 		=> $business[$i]['total_rating'],
				'OPENING_HOURS'		=> $business[$i]['opening_hours']
			));

			$template->assign_block_vars('business_row.customers', array());

			if (empty($bid))
			{
				$template->assign_block_vars('business_row.more_detail', array());
			}

			//Now Lets Go Get Mods Business Has Installed & Services Performed
			$bus_mod_data = $garage_modification->get_modifications_by_install_business($business[$i]['id']);
			$bus_srv_data = $garage_service->get_services_by_business($business[$i]['id']);

			$comments = null;
			for ($j = 0, $count2 = sizeof($bus_mod_data);$j < $count2; $j++)
			{
				$template->assign_block_vars('business_row.mod_row', array(
					'U_VIEW_PROFILE' 	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $bus_mod_data[$j]['user_id']),
					'U_VIEW_VEHICLE' 	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $bus_mod_data[$j]['vehicle_id']),
					'U_VIEW_ITEM'		=> append_sid("{$phpbb_root_path}garage/garage_modification.$phpEx", "mode=view_modification&amp;VID=" . $bus_mod_data[$j]['vehicle_id'] . "&amp;MID=" . $bus_mod_data[$j]['id']),
					'USERNAME' 			=> $bus_mod_data[$j]['username'],
					'USERNAME_COLOUR'	=> get_username_string('colour', $bus_mod_data[$j]['user_id'], $bus_mod_data[$j]['username'], $bus_mod_data[$j]['user_colour']),
					'VEHICLE' 			=> $bus_mod_data[$j]['vehicle'],
					'ITEM' 				=> $bus_mod_data[$j]['mod_title'],
					'RATING' 			=> $bus_mod_data[$j]['install_rating']
				));

				//Setup Comments For Installation Of Modification...
				if (!empty($bus_mod_data[$j]['install_comments']))
				{
					if ($comments != 'SET')
					{
						$template->assign_block_vars('business_row.comments', array());
					}
					$comments = 'SET';
					$template->assign_block_vars('business_row.customer_comments', array(
						'COMMENTS' => $bus_mod_data[$j]['username'] . ' -> ' . $bus_mod_data[$j]['install_comments']
					));
				}
			}

			for ($j = 0, $count3 = sizeof($bus_srv_data);$j < $count3; $j++)
			{
				$template->assign_block_vars('business_row.mod_row', array(
					'U_VIEW_PROFILE' 	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $bus_srv_data[$j]['user_id']),
					'U_VIEW_VEHICLE' 	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $bus_srv_data[$j]['vehicle_id']),
					'USERNAME' 			=> $bus_srv_data[$j]['username'],
					'USERNAME_COLOUR'	=> get_username_string('colour', $bus_srv_data[$j]['user_id'], $bus_srv_data[$j]['username'], $bus_srv_data[$j]['user_colour']),
					'VEHICLE' 			=> $bus_srv_data[$j]['vehicle'],
					'ITEM' 				=> $garage_service->get_service_type($bus_srv_data[$j]['type_id']),
					'RATING' 			=> $bus_srv_data[$j]['rating']
				));
			}

			//Reset Comments For Next Business..
			$comments = '';
			}

			if  (empty($bid))
			{
				//Get Count & Perform Pagination...
				$count = $garage_business->count_garage_business_data($data['where']);
				$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}"), $count, $garage_config['cars_per_page'], $start);

				$template->assign_vars(array(
					'PAGINATION' 			=> $pagination,
					'PAGE_NUMBER' 			=> on_page($count, $garage_config['cars_per_page'], $start),
					'TOTAL_BUSINESS'		=> ($count == 1) ? $user->lang['VIEW_BUSINESS_PAGE'] : sprintf($user->lang['VIEW_BUSINESS\'S_PAGE'], $count),
					'S_GARAGE_REVIEW_TAB_ACTIVE'	=> true,
				));
			}

			//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
			$garage_template->sidemenu();

			break;

		/**
		* Shop review page
		*/
		case 'shop_review':

			//Let Check The User Is Allowed Perform This Action
			if (!$auth->acl_get('u_garage_browse'))
			{
				redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
			}

			//Set Template Files In Use For This Mode
			$template->set_filenames(array(
				'header'=> 'garage/garage_header.html',
				'body' 	=> 'garage/garage_view_shop_business.html'
			));

			//Get All Data Posted And Make It Safe To Use
			$params		= array('start' => 0);
			$data 		= $garage->process_vars($params);
			$data['where']	= (!empty($bid)) ? " AND b.id = $bid" : '';

			//Get Required Shop Business Data
			$business = $garage_business->get_shop_business($data['where'], $data['start']);

			//Build Page Header ;)
			page_header($page_title);

			//Display Correct Breadcrumb Links..
			$template->assign_block_vars('navlinks', array(
				'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=shop_review"),
				'FORUM_NAME'	=> $user->lang['SHOP_REVIEW']
			));

			//Display Correct Breadcrumb Links..
			if (!empty($bid))
			{
				$template->assign_block_vars('navlinks', array(
					'U_VIEW_FORUM' 	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=shop_review&amp;BID=" . $business[0]['id']),
					'FORUM_NAME'	=> $business[0]['title']
				));
			}

			//Process All Shops......
			for ($i = 0, $count = sizeof($business);$i < $count; $i++)
			{
				$template->assign_block_vars('business_row', array(
					'U_VIEW_BUSINESS'	=> append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=shop_review&amp;BID=" . $business[$i]['id']),
					'RATING' 			=> (empty($business[$i]['rating'])) ? 0 : $business[$i]['rating'],
					'TITLE' 			=> $business[$i]['title'],
					'ADDRESS' 			=> $business[$i]['address'],
					'TELEPHONE' 		=> $business[$i]['telephone'],
					'FAX' 				=> $business[$i]['fax'],
					'WEBSITE' 			=> $business[$i]['website'],
					'EMAIL' 			=> $business[$i]['email'],
					'MAX_RATING' 		=> $business[$i]['total_rating'],
					'OPENING_HOURS'		=> $business[$i]['opening_hours']
				));

				$template->assign_block_vars('business_row.customers', array());

				if (empty($bid))
				{
						$template->assign_block_vars('business_row.more_detail', array());
				}

				//Now Lets Go Get All Mods All Business's Have Sold
				$bus_mod_data = $garage_modification->get_modifications_by_business($business[$i]['id']);

				$comments = null;
				for ($j = 0, $count2 = sizeof($bus_mod_data);$j < $count2; $j++)
				{
					$template->assign_block_vars('business_row.mod_row', array(
						'U_VIEW_PROFILE' 	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=" . $bus_mod_data[$j]['user_id']),
						'U_VIEW_VEHICLE' 	=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=" . $bus_mod_data[$j]['vehicle_id']),
						'U_VIEW_MODIFICATION'	=> append_sid("{$phpbb_root_path}garage/garage_modification.$phpEx", "mode=view_modification&amp;VID=" . $bus_mod_data[$j]['vehicle_id'] . "&amp;MID=" . $bus_mod_data[$j]['id']),
						'USERNAME' 		=> $bus_mod_data[$j]['username'],
						'USERNAME_COLOUR'	=> get_username_string('colour', $bus_mod_data[$j]['user_id'], $bus_mod_data[$j]['username'], $bus_mod_data[$j]['user_colour']),
						'VEHICLE' 		=> $bus_mod_data[$j]['vehicle'],
						'MODIFICATION' 		=> $bus_mod_data[$j]['mod_title'],
						'PURCHASE_RATING' 	=> $bus_mod_data[$j]['purchase_rating'],
						'PRODUCT_RATING' 	=> $bus_mod_data[$j]['product_rating'],
						'PRICE' 		=> $bus_mod_data[$j]['price'])
					);

					if (!empty($bus_mod_data[$j]['comments']))
					{
						if ($comments != 'SET')
						{
							$template->assign_block_vars('business_row.comments', array());
						}

						$comments = 'SET';
						$template->assign_block_vars('business_row.customer_comments', array(
							'COMMENTS' => $bus_mod_data[$j]['username'] . ' -> ' . $bus_mod_data[$j]['comments']
						));
					}
				}

				//Reset Comments For Next Business..
				$comments = '';
			}

			if (empty($bid))
			{
				//Get Count & Perform Pagination...
				$count = $garage_business->count_shop_business_data($data['where']);
				$pagination = generate_pagination(append_sid("{$phpbb_root_path}garage.php", "mode={$mode}"), $count, $garage_config['cars_per_page'], $start);
				$template->assign_vars(array(
					'PAGINATION' 			=> $pagination,
					'PAGE_NUMBER' 			=> on_page($count, $garage_config['cars_per_page'], $start),
					'TOTAL_BUSINESS'		=> ($count == 1) ? $user->lang['VIEW_BUSINESS_PAGE'] : sprintf($user->lang['VIEW_BUSINESS\'S_PAGE'], $count),
					'S_SHOP_REVIEW_TAB_ACTIVE'	=> true,
				));
			}

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

		break;

	/**
	* Insert new business into database
	*/
	case 'insert_business':

		//Let Check The User Is Allowed Perform This Action
		if (!$auth->acl_get('u_garage_add_business'))
		{
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=14"));
		}

		//Get All Data Posted And Make It Safe To Use
		$params = array('redirect' => '', 'telephone' => '', 'fax' => '', 'website' => '', 'email' => '', 'product' => '0', 'insurance' => '0', 'garage' => '0', 'retail' => '0', 'dynocentre' => '0', 'url_image' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '');
		$data 	= $garage->process_vars($params);
		$params = array('title' => '', 'address' => '', 'opening_hours' => '');
		$data 	+= $garage->process_mb_vars($params);

		//Check They Entered http:// In The Front Of The Link
		if ((!preg_match( "/^http:\/\//i", $data['website'])) && (!empty($data['website'])))
		{
			$data['website'] = "http://".$data['website'];
		}

		//Checks All Required Data Is Present
		$params = array('title');
		$garage->check_required_vars($params);

		//If Needed Update Garage Config Telling Us We Have A Pending Item And Perform Notifications If Configured
		if ($garage_config['enable_business_approval'])
		{
			//Perform Any Pending Notifications Requried
			$garage->pending_notification('unapproved_business');
		}

		//Create The Business Now...
		$business_id = $garage_business->insert_business($data);

		//Build Page Header ;)
		page_header($page_title);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' 	=> 'garage/garage_header.html',
			'body'   	=> 'garage/garage_user_submit_data.html')
		);

		if ($data['primary'] == "modification")
		{
			$params = array('VID' => '', 'MID' => '', 'category_id' => '', 'manufacturer_id' => '', 'product_id' => '', 'price' => 0, 'price_decimal' => 0, 'shop_id' => '', 'installer_id' => '', 'install_price' => 0, 'install_price_decimal' => 0, 'install_rating' => 0, 'product_rating' => 0, 'editupload' => '', 'image_id' => '', 'purchase_rating' => 0, 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store	= $garage->process_vars($params);
			$params = array('comments' => '', 'install_comments' => '');
			$store	+= $garage->process_mb_vars($params);
			if ($data['secondary'] == "manufacturer")
			{
				$store['manufacturer_id'] = $business_id;
			}
			elseif ($data['secondary'] == "shop")
			{
				$store['shop_id'] = $business_id;
			}
			elseif ($data['secondary'] == "garage")
			{
				$store['installer_id'] = $business_id;
			}
			$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_modification.$phpEx", "mode=add_modification");
			if ($data['tertiary'] == "edit")
			{
				$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_modification.$phpEx", "mode=edit_modification&amp;VID={$store['VID']}&amp;MID={$store['MID']}");
			}
		}
		elseif ($data['primary'] == "premium")
		{
			$params = array('VID' => '', 'INS_ID' => '', 'premium' => '', 'premium_decimal' => '', 'cover_type_id' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			$params = array('comments' => '');
			$store 	+= $garage->process_mb_vars($params);
			$store['business_id'] = $business_id;
			$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_premium.$phpEx", "mode=add_premium");

			if ($data['tertiary'] == "edit")
			{
				$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_premium.$phpEx", "mode=edit_premium&amp;VID={$store['VID']}&amp;INS_ID={$store['INS_ID']}");
			}
		}
		elseif ($data['primary'] == "dynorun")
		{
			$params = array('VID' => '', 'DID' => '', 'bhp' => '', 'bhp_decimal' => '', 'bhp_unit' => '', 'torque' => 0, 'torque_decimal' => 0, 'torque_unit' => '', 'boost' => 0, 'boost_decimal' => 0, 'boost_unit' => 'PSI', 'nitrous' => 0, 'peakpoint' => 0, 'peakpoint_decimal' => 0, 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			$store['dynocentre_id'] = $business_id;
			$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_dynorun.$phpEx", "mode=add_dynorun");

			if ($data['tertiary'] == "edit")
			{
				$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_dynorun.$phpEx", "mode=edit_dynorun&amp;VID={$store['VID']}&amp;DID={$store['DID']}");
			}
		}
		elseif ($data['primary'] == "service")
		{
			$params	= array('VID' => '', 'SVID' => '', 'type_id' => '', 'price' => 0, 'price_decimal' => 0, 'rating' => 0, 'mileage' => '', 'primary' => '', 'secondary' => '', 'tertiary' => '', 'redirect' => '');
			$store 	= $garage->process_vars($params);
			$store['garage_id'] = $business_id;
			$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_service.$phpEx", "mode=add_service");

			if ($data['tertiary'] == "edit")
			{
				$user_submit_action = append_sid("{$phpbb_root_path}garage/garage_service.$phpEx", "mode=edit_service&amp;VID={$store['VID']}&amp;SVID={$store['SVID']}");
			}
		}

		$template->assign_vars(array(
			'L_BUTTON_LABEL'			=> $user->lang['RETURN_TO_ITEM'],
			'S_USER_SUBMIT_SUCCESS'		=> true,
			'S_USER_SUBMIT_ACTION'		=> $user_submit_action,
		));

		foreach ($store as $key => $value)
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
	* Page to display an error nicely to the user
	*/
	case 'error':

		//Build Page Header ;)
		page_header($page_title);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_error.html'
		));

		//Build Navlinks
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['ERROR']
		));

		$template->assign_vars(array(
			'ERROR_MESSAGE' => $user->lang['GARAGE_ERROR_' . $eid]
		));

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();

	break;

	/**
	* Called by AJAX toolkit to build product model options
	*/
	case 'get_model_list':
		//Get All Data Posted And Make It Safe To Use
		$params = array('make_id' => '', 'model_id' => '');
		$data = $garage->process_vars($params);

		echo "obj.options[obj.options.length] = new Option('".$user->lang['SELECT_MODEL']."', '', false, false);\n";
		echo "obj.options[obj.options.length] = new Option('------', '', false, false);\n";

		if (!empty($data['make_id']))
		{
			//Get Models Belonging To This Make
			$models = $garage_model->get_all_models_from_make($data['make_id']);

			//Populate Options For Dropdown
			for ($i = 0, $count = sizeof($models);$i < $count; $i++)
			{
				if ($data['model_id'] == $models[$i]['id'])
				{
					echo "obj.options[obj.options.length] = new Option('".addslashes($models[$i]['model'])."','".$models[$i]['id']."', true, true);\n";
				}
				else
				{
					echo "obj.options[obj.options.length] = new Option('".addslashes($models[$i]['model'])."','".$models[$i]['id']."', false, false);\n";
				}
			}
		}
	exit;

	/**
	* Called by AJAX toolkit to build product dropdown options
	*/
	case 'get_product_list':
		//Get All Data Posted And Make It Safe To Use
		$params = array('manufacturer_id' => '' , 'category_id' => '', 'product_id' => '');
		$data = $garage->process_vars($params);

		echo "obj.options[obj.options.length] = new Option('".$user->lang['SELECT_PRODUCT']."', '', false, false);\n";
		echo "obj.options[obj.options.length] = new Option('------', '', false, false);\n";

		if (!empty($data['manufacturer_id']))
		{
			//Get Products Belonging To This Manufacturer With Filtering On Category For Modification Page
			if (!empty($data['category_id']))
				$products = $garage_modification->get_products_by_manufacturer($data['manufacturer_id'], $data['category_id']);
			//Get Products Belonging To This Manufacturer With No Filtering On Category For Search Page
			else
			{
				$products = $garage_modification->get_products_by_manufacturer($data['manufacturer_id']);
			}

			//Populate Options For Dropdown
			for ($i = 0, $count = sizeof($products);$i < $count; $i++)
			{
				if ($data['product_id'] == $products[$i]['id'])
				{
					echo "obj.options[obj.options.length] = new Option('".addslashes($products[$i]['title'])."','".$products[$i]['id']."', true, true);\n";
				}
				else
				{
					echo "obj.options[obj.options.length] = new Option('".addslashes($products[$i]['title'])."','".$products[$i]['id']."', false, false);\n";
				}
			}
		}
	exit;

	/**
	* Page to display a users personal vehicles and option to create new one if authorised
	*/
	case 'user_garage':
		//Build Page Header ;)
		page_header($page_title);

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header' => 'garage/garage_header.html',
			'body'   => 'garage/garage_users_garage.html')
		);

		//Build Navlinks
		$template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $user->lang['YOUR_GARAGE'])
		);

		$template->assign_vars(array(
			'S_USER_GARAGE_TAB_ACTIVE'	=> true,
		));

		/*$user_vehicles = $garage_vehicle->get_vehicles_by_user($user->data['user_id']);
		for ($i = 0; $i < count($user_vehicles); $i++)
		{
			  	$template->assign_block_vars('user_vehicles', array(
	   				'U_VIEW_VEHICLE'=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx?mode=view_own_vehicle&amp;VID=" . $user_vehicles[$i]['id']),
	   				'VEHICLE' 	=> $user_vehicles[$i]['vehicle'],
			));
		}*/

		//Display Page...In Order Header->Menu->Body->Footer (Foot Gets Parsed At The Bottom)
		$garage_template->sidemenu();
	break;

	/**
	* Default statistics page
	*/
	default:
		/*
		* Let Check The User Is Allowed Perform This Action
		*/
		if (!$auth->acl_get('u_garage_browse'))
		{
			/**
			* If Not Logged In Send Them To Login & Back, Maybe They Have Permission As A User
			*/
			if ($user->data['user_id'] == ANONYMOUS)
			{
				login_box("{$phpbb_root_path}garage/garage.$phpEx");
			}
			redirect(append_sid("{$phpbb_root_path}garage/garage.$phpEx", "mode=error&amp;EID=15"));
		}

		//Build Page Header ;)
		page_header($page_title);

		//Display Page...In Order Header->Menu->Body->Footer
		$garage_template->sidemenu();

		//Display If Needed Featured Vehicle
		$garage_vehicle->show_featuredvehicle();

		$required_position = 1;
		//Display All Boxes Required
		$garage_vehicle->show_newest_vehicles();
		$garage_vehicle->show_updated_vehicles();
		$garage_modification->show_newest_modifications();
		$garage_modification->show_updated_modifications();
		$garage_modification->show_most_modified();
		$garage_vehicle->show_most_spent();
		$garage_vehicle->show_most_viewed();
		$garage_guestbook->show_lastcommented();
		$garage_quartermile->show_topquartermile();
		$garage_dynorun->show_topdynorun();
		$garage_vehicle->show_toprated();
		$garage_track->show_toplap();

		//Show Top Rated Month Vehicle
		$garage_vehicle->show_month_toprated_vehicle();

		$template->assign_vars(array(
			'S_INDEX_COLUMNS' 		=> ($garage_config['enable_user_index_columns'] && ($user->data['ug_index_columns'] != $garage_config['index_columns'])) ? $user->data['ug_index_columns'] : $garage_config['index_columns'],
			'S_MAIN_TAB_ACTIVE'		=> true,
			'TOTAL_VEHICLES' 		=> $garage_vehicle->count_total_vehicles(),
			'TOTAL_VIEWS' 			=> $garage->count_total_views(),
			'TOTAL_MODIFICATIONS' 	=> $garage_modification->count_total_modifications(),
			'TOTAL_COMMENTS'  		=> $garage_guestbook->count_total_comments(),
		));

		//Set Template Files In Use For This Mode
		$template->set_filenames(array(
			'header'	=> 'garage/garage_header.html',
			'menu' 		=> 'garage/garage_menu.html',
			'body' 		=> 'garage/garage.html',
		));
	break;
}

$garage_template->version_notice();

$template->set_filenames(array(
	'garage_footer' => 'garage/garage_footer.html')
);

page_footer();
?>
