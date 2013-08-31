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
*/
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

/**
* phpBB Garage Service History Class
* @package garage
*/
class garage_service
{
	var $classname = "garage_service";

	/**
	* Insert new service history
	*
	* @param array $data single-dimension array holding the data for the new service history
	*
	*/
	function insert_service($data)
	{
		global $vid, $db;

		$sql = 'INSERT INTO ' . GARAGE_SERVICE_HISTORY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'vehicle_id'	=> $vid,
			'garage_id'		=> $data['garage_id'],
			'type_id'		=> $data['type_id'],
			'price'			=> $data['price'] .'.'. $data['price_decimal'],
			'rating'		=> $data['rating'],
			'mileage'		=> $data['mileage'],
			'date_created'	=> time(),
			'date_updated'	=> time(),
		));

		$db->sql_query($sql);

		return $db->sql_nextid();
	}

	/**
	* Updates a service history
	*
	* @param array $data single-dimension array holding the data to update the service history with
	*
	*/
	function update_service($data)
	{
		global $db, $vid, $svid;

		$update_sql = array(
			'vehicle_id'	=> $vid,
			'garage_id'		=> $data['garage_id'],
			'type_id'		=> $data['type_id'],
			'price'			=> $data['price'] .'.'. $data['price_decimal'],
			'rating'		=> $data['rating'],
			'mileage'		=> $data['mileage'],
			'date_updated'	=> time()
		);

		$sql = 'UPDATE ' . GARAGE_SERVICE_HISTORY_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $update_sql) . "
			WHERE id = $svid  AND vehicle_id = $vid";

		$db->sql_query($sql);

		return;
	}

	/**
	* Delete service history
	*
	* @param int $svid service history id to delete
	*
	*/
	function delete_service($svid)
	{
		global $garage, $garage_image;

		$garage->delete_rows(GARAGE_SERVICE_HISTORY_TABLE, 'id', $svid);

		return ;
	}

	/**
	* Return data for a specific service history
	*
	* @param int $svid service history id to return data for
	*
	*/
	function get_service($svid)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 's.*, b.title',
			'FROM'		=> array(
				GARAGE_SERVICE_HISTORY_TABLE	=> 's',
				GARAGE_BUSINESS_TABLE		=> 'b',
			),
			'WHERE'	=> "s.id = $svid
				AND s.garage_id = b.id"
		));

      		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		if (!empty($data))
		{
			$price_pieces = explode(".", $data['price']);
			$data['price'] = $price_pieces[0];
			$data['price_decimal'] = $price_pieces[1];
		}
		$db->sql_freeresult($result);

		return $data;
	}

	/**
	* Return array of service histories for specific vehicle
	*
	* @param int $vid vehicle id to return service histories for
	*
	*/
	function get_services_by_vehicle($vid)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 's.*, b.title',
			'FROM'		=> array(
				GARAGE_SERVICE_HISTORY_TABLE	=> 's',
				GARAGE_BUSINESS_TABLE		=> 'b',
			),
			'WHERE'	=> "s.vehicle_id = $vid
				AND s.garage_id = b.id",
			'ORDER_BY'	=> "s.mileage DESC"
		));

	       	$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);

		return $data;
	}

	/**
	* Return language string for service history type id
	*
	* @param int $id service history type id to return language for
	*
	*/
	function get_service_type($id)
	{
		global $user;

		if ($id == SERVICE_MAJOR)
		{
			return $user->lang['SERVICE_MAJOR'];
		}
		else if ($id == SERVICE_MINOR)
		{
			return $user->lang['SERVICE_MINOR'];
		}
	}

	/**
	* Returns array with limited number of service histories from specific business
	*
	* @param int $business_id business id to get data for
	* @param int $start starting row for data selection
	* @param int $limit number to limit rows returned
	*
	*/
	function get_services_by_business($business_id, $start = 0 , $limit = 20)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> "s.*, u.username, u.user_id, u.user_colour, mk.make, md.model, v.made_year, b.id as business_id, v.made_year, mk.make, md.model",
			'FROM'		=> array(
				GARAGE_SERVICE_HISTORY_TABLE	=> 's',
				GARAGE_BUSINESS_TABLE			=> 'b',
				GARAGE_VEHICLES_TABLE			=> 'v',
				GARAGE_MAKES_TABLE				=> 'mk',
				GARAGE_MODELS_TABLE				=> 'md',
				USERS_TABLE						=> 'u',
			),
			'WHERE'		=> "s.garage_id = b.id
				AND b.garage = 1
				AND b.pending = 0
				AND b.id = $business_id
				AND s.vehicle_id = v.id
				AND v.user_id = u.user_id
				AND v.make_id = mk.id AND mk.pending = 0
				AND v.model_id = md.id AND md.pending = 0",
			'ORDER_BY'	=> "s.id, s.date_created DESC"
		));

		$result = $db->sql_query_limit($sql, $limit, $start);
		while ($row = $db->sql_fetchrow($result))
		{
			if (!empty($row))
			{
				$row['vehicle'] = "{$row['made_year']} {$row['make']} {$row['model']}";
			}
			$data[] = $row;
		}

		$db->sql_freeresult($result);

		return $data;
	}
}

$garage_service = new garage_service();

?>
