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
* phpBB Garage Dynorun Class
* @package garage
*/
class garage_dynorun
{
	var $classname = "garage_dynorun";

	/**
	* Insert new dynorun
	*
	* @param array $data single-dimension array holding the data for the new dynorun
	*
	*/
	function insert_dynorun($data)
	{
		global $vid, $db, $garage_config;

		$sql = 'INSERT INTO ' . GARAGE_DYNORUNS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'vehicle_id'	=> $vid,
			'dynocentre_id'	=> $data['dynocentre_id'],
			'bhp'			=> $data['bhp'] .'.'. $data['bhp_decimal'],
			'bhp_unit'		=> $data['bhp_unit'],
			'torque'		=> $data['torque'] .'.'. $data['torque_decimal'],
			'torque_unit'	=> (empty($data['torque_unit']))? $data['bhp_unit'] : $data['torque_unit'],
			'boost'			=> $data['boost'] .'.'. $data['boost_decimal'],
			'boost_unit'	=> (empty($data['boost_unit']))? 'PSI' : $data['boost_unit'],
			'nitrous'		=> $data['nitrous'],
			'peakpoint'		=> $data['peakpoint'] .'.'. $data['peakpoint_decimal'],
			'date_created'	=> time(),
			'date_updated'	=> time(),
			'pending'		=> ($garage_config['enable_dynorun_approval'] == '1') ? 1 : 0,
		));

		$db->sql_query($sql);

		return $db->sql_nextid();
	}

	/**
	* Updates a existing dynorun
	*
	* @param array $data single-dimension array holding the data to update the dynorun with
	*
	*/
	function update_dynorun($data)
	{
		global $db, $did, $vid, $garage_config;

		$update_sql = array(
			'vehicle_id'	=> $vid,
			'dynocentre_id'	=> $data['dynocentre_id'],
			'bhp'			=> $data['bhp'] .'.'. $data['bhp_decimal'],
			'bhp_unit'		=> $data['bhp_unit'],
			'torque'		=> $data['torque'] .'.'. $data['torque_decimal'],
			'torque_unit'	=> $data['torque_unit'],
			'boost'			=> $data['boost'] .'.'. $data['boost_decimal'],
			'boost_unit'	=> $data['boost_unit'],
			'nitrous'		=> $data['nitrous'],
			'peakpoint'		=> $data['peakpoint'] .'.'. $data['peakpoint_decimal'],
			'date_updated'	=> time(),
			'pending'		=> ($garage_config['enable_dynorun_approval'] == '1') ? 1 : 0
		);

		$sql = 'UPDATE ' . GARAGE_DYNORUNS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $update_sql) . "
			WHERE id = $did AND vehicle_id = $vid";


		$db->sql_query($sql);

		return;
	}

	/**
	* Delete dynorun and all images linked to it
	*
	* @param int $did dynorun id to delete
	*
	*/
	function delete_dynorun($did)
	{
		global $vid, $garage_image, $garage;

		$images	= $garage_image->get_dynorun_gallery($did);

		for ($i = 0, $count = sizeof($images);$i < $count; $i++)
		{
			$garage_image->delete_dynorun_image($images[$i]['image_id']);
		}

		$garage->update_single_field(GARAGE_QUARTERMILES_TABLE, 'dynorun_id', 'NULL', 'dynorun_id', $did);

		$garage->delete_rows(GARAGE_DYNORUNS_TABLE, 'id', $did);

		return ;
	}

	/**
	* Return count of dynoruns filtered by vehicle id
	*
	* @param int $vid vehicle id to count dynoruns for
	*
	*/
	function count_runs($vid)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'COUNT(d.id) as total',
			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
			),
			'WHERE'		=>  "d.vehicle_id = $vid"
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$data['total'] = (empty($data['total'])) ? 0 : $data['total'];

		return $data['total'];
	}

	/**
	* Check if an image is marked as highlight image for dynorun
	*
	* @param int $did dynorun id to check
	*
	*/
	function hilite_exists($did)
	{
		$hilite = 1;

		if ($this->count_dynorun_images($did) > 0)
		{
			$hilite = 0;
		}

		return $hilite;
	}

	/**
	* Count images linked to a dynorun
	*
	* @param int $did dynorun id to count images for
	*
	*/
	function count_dynorun_images($did)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'COUNT(dg.id) as total',
			'FROM'		=> array(
				GARAGE_DYNORUN_GALLERY_TABLE	=> 'dg',
			),
			'WHERE'		=> "dg.dynorun_id = $did"
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$data['total'] = (empty($data['total'])) ? 0 : $data['total'];
		return $data['total'];
	}

	/**
	* Return vehicle id of dynoruns
	*
	* @param int $did dynorun id to get vehicle id for
	*
	*/
	function get_vehicle_id_for_dynorun($did)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'v.id',
			'FROM'		=> array(
				GARAGE_VEHICLES_TABLE	=> 'v',
				GARAGE_DYNORUNS_TABLE	=> 'd',
			),
			'WHERE'		=>  "d.id = $did
				AND v.id = d.vehicle_id"
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return $data['id'];
	}

	/**
	* Return data for a specific dynorun
	*
	* @param int $did dynorun id to return data for
	*
	*/
	function get_dynorun($did)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'u.*, v.id, v.made_year, v.user_id, mk.make, md.model, d.bhp, d.bhp_unit, d.torque, d.torque_unit, d.boost, d.boost_unit, d.nitrous, d.peakpoint, i.attach_id as image_id, i.attach_file, d.id as did, v.made_year, mk.make, md.model, b.title, d.dynocentre_id',

			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
				GARAGE_VEHICLES_TABLE	=> 'v',
				GARAGE_MAKES_TABLE		=> 'mk',
				GARAGE_MODELS_TABLE		=> 'md',
				GARAGE_BUSINESS_TABLE	=> 'b',
				USERS_TABLE				=> 'u',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_DYNORUN_GALLERY_TABLE => 'dg'),
					'ON'	=> 'd.id = dg.dynorun_id'
				)
				,array(
					'FROM'	=> array(GARAGE_IMAGES_TABLE => 'i'),
					'ON'	=> 'i.attach_id = dg.image_id'
				)
			),
			'WHERE'		=>  "d.id = $did
				AND d.vehicle_id = v.id
				AND v.make_id = mk.id AND mk.pending =0
				AND v.model_id = md.id and md.pending = 0
				AND d.dynocentre_id = b.id
				AND v.user_id = u.user_id"
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		if (!empty($data))
		{
			$data['vehicle'] = "{$data['made_year']} {$data['make']} {$data['model']}";
			$bhp_pieces = explode(".", $data['bhp']);
			$data['bhp'] = $bhp_pieces[0];
			$data['bhp_decimal'] = $bhp_pieces[1];
			$torque_pieces = explode(".", $data['torque']);
			$data['torque'] = $torque_pieces[0];
			$data['torque_decimal'] = $torque_pieces[1];
			$boost_pieces = explode(".", $data['boost']);
			$data['boost'] = $boost_pieces[0];
			$data['boost_decimal'] = $boost_pieces[1];
			$peakpoint_pieces = explode(".", $data['peakpoint']);
			$data['peakpoint'] = $peakpoint_pieces[0];
			$data['peakpoint_decimal'] = $peakpoint_pieces[1];
		}
		$db->sql_freeresult($result);

		return $data;
	}

	/**
	* Return array for all pending dynoruns
	*/
	function get_pending_dynoruns()
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'v.id, v.made_year, v.user_id, mk.make, md.model, u.username, u.user_id,u.user_colour, b.title, d.bhp, d.bhp_unit, d.torque, d.torque_unit, d.boost, d.boost_unit, d.nitrous, round(d.peakpoint,0) as peakpoint, i.attach_id as image_id, d.id as did, v.made_year, mk.make, md.model',
			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
				GARAGE_VEHICLES_TABLE	=> 'v',
				GARAGE_MAKES_TABLE		=> 'mk',
				GARAGE_MODELS_TABLE		=> 'md',
				GARAGE_BUSINESS_TABLE	=> 'b',
				USERS_TABLE				=> 'u',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_DYNORUN_GALLERY_TABLE => 'dg'),
					'ON'	=> 'd.id = dg.dynorun_id'
				)
				,array(
					'FROM'	=> array(GARAGE_IMAGES_TABLE => 'i'),
					'ON'	=> 'i.attach_id = dg.image_id'
				)
			),
			'WHERE'		=>  "d.pending = 1
				AND d.vehicle_id = v.id
				AND v.make_id = mk.id AND mk.pending =0
				AND v.model_id = md.id and md.pending = 0
				AND d.dynocentre_id = b.id
				AND v.user_id = u.user_id"
		));

		$result = $db->sql_query($sql);
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

	/**
	* Return data for dynorun filtered by vehicle id and a BHP value
	*
	* @param int $vehicle_id vehicle id to filter on
	* @param string $bhp bhp value to filter on
	*
	*/
	function get_dynorun_by_vehicle_bhp($vehicle_id, $bhp)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'd.bhp, d.bhp_unit, d.torque, d.torque_unit, d.boost, d.boost_unit, d.nitrous, round(d.peakpoint,0) as peakpoint, v.id, v.made_year, v.user_id, mk.make, md.model, u.username, u.user_colour, b.title,  i.attach_id as image_id, d.id as did, v.made_year, mk.make, md.model',
			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
				GARAGE_VEHICLES_TABLE	=> 'v',
				GARAGE_MAKES_TABLE		=> 'mk',
				GARAGE_MODELS_TABLE		=> 'md',
				GARAGE_BUSINESS_TABLE	=> 'b',
				USERS_TABLE				=> 'u',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_DYNORUN_GALLERY_TABLE => 'dg'),
					'ON'	=> 'd.id = dg.dynorun_id'
				)
				,array(
					'FROM'	=> array(GARAGE_IMAGES_TABLE => 'i'),
					'ON'	=> 'i.attach_id = dg.image_id'
				)
			),
			'WHERE'		=>  "d.bhp = $bhp AND d.vehicle_id = $vehicle_id
				AND d.vehicle_id = v.id
				AND v.make_id = mk.id AND mk.pending =0
				AND v.model_id = md.id and md.pending = 0
				AND d.dynocentre_id = b.id
				AND v.user_id = u.user_id",
			'ORDER_BY'	=> "d.id"
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		if (!empty($data))
		{
			$data['vehicle'] = "{$data['made_year']} {$data['make']} {$data['model']}";
		}
		$db->sql_freeresult($result);

		return $data;
	}

	/**
	* Return array of top dynoruns
	*
	* @param int $limit number of rows to return
	*
	*/
	function get_top_dynoruns($limit = 30)
	{
		global $db, $garage;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'd.vehicle_id, MAX(d.bhp) as bhp',
			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
				GARAGE_VEHICLES_TABLE	=> 'v',
				GARAGE_MAKES_TABLE		=> 'mk',
				GARAGE_MODELS_TABLE		=> 'md',
				USERS_TABLE				=> 'u',
			),
			'WHERE'		=> "d.pending = 0
				AND d.vehicle_id = v.id
				AND v.make_id = mk.id AND mk.pending =0
				AND v.model_id = md.id and md.pending = 0
				AND v.user_id = u.user_id",
			'GROUP_BY'	=> 'd.vehicle_id',
			'ORDER_BY'	=> "bhp DESC"
		));

		$result = $db->sql_query_limit($sql, $limit, 0);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);

		return $data;
	}

	/**
	* Return array of dynoruns filtered by vehicle id
	*
	* @param int $vid vehicle id to filter on
	*
	*/
	function get_dynoruns_by_vehicle($vid)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'd.*, d.id as did, i.*, b.title',
			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
				GARAGE_BUSINESS_TABLE	=> 'b',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_DYNORUN_GALLERY_TABLE => 'dg'),
					'ON'	=> 'd.id = dg.dynorun_id'
				)
				,array(
					'FROM'	=> array(GARAGE_IMAGES_TABLE => 'i'),
					'ON'	=> 'i.attach_id = dg.image_id'
				)
			),
			'WHERE'		=>	"d.vehicle_id = $vid
				AND d.dynocentre_id = b.id",
			'GROUP_BY'	=>	'd.id',
			'ORDER_BY'	=>	'd.id'
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
	* Return array of dynoruns filtered by dynocentre id
	*
	* @param int $bid dynocentre id to filter on
	*
	*/
	function get_dynoruns_by_dynocentre_id($dc_id)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'd.*, d.id as did, i.*, b.title',
			'FROM'		=> array(
				GARAGE_DYNORUNS_TABLE	=> 'd',
				GARAGE_BUSINESS_TABLE	=> 'b',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_DYNORUN_GALLERY_TABLE => 'dg'),
					'ON'	=> 'd.id = dg.dynorun_id'
				)
				,array(
					'FROM'	=> array(GARAGE_IMAGES_TABLE => 'i'),
					'ON'	=> 'i.attach_id = dg.image_id'
				)
			),
			'WHERE'		=>	"d.dynocentre_id = $dc_id
				AND d.dynocentre_id = b.id",
			'GROUP_BY'	=>	'd.id',
			'ORDER_BY'	=>	'd.id'
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
	* Assign template variables to display top dynoruns
	*/
	function show_topdynorun()
	{
		global $required_position, $user, $template, $db, $SID, $lang, $phpEx, $phpbb_root_path, $garage_config, $board_config;

		if ( $garage_config['enable_top_dynorun'] != true )
		{
			return;
		}

		$template_block = 'block_'.$required_position;
		$template_block_row = 'block_'.$required_position.'.row';
		$template->assign_block_vars($template_block, array(
			'BLOCK_TITLE' => $user->lang['TOP_DYNO_RUNS'],
			'COLUMN_1_TITLE' => $user->lang['VEHICLE'],
			'COLUMN_2_TITLE' => $user->lang['OWNER'],
			'COLUMN_3_TITLE' => $user->lang['BHP-TORQUE-NITROUS'])
		);

		$limit = $garage_config['top_dynorun_limit'] ? $garage_config['top_dynorun_limit'] : 10;

		$runs = $this->get_top_dynoruns($limit);

		for($i = 0; $i < count($runs); $i++)
		{
			$vehicle_data = $this->get_dynorun_by_vehicle_bhp($runs[$i]['vehicle_id'], $runs[$i]['bhp']);

			$template->assign_block_vars($template_block_row, array(
				'U_COLUMN_1' 		=> append_sid("{$phpbb_root_path}garage/garage_vehicle.$phpEx", "mode=view_vehicle&amp;VID=".$vehicle_data['id']),
				'U_COLUMN_2' 		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=viewprofile&amp;u=".$vehicle_data['user_id']),
				'U_COLUMN_3' 		=> append_sid("{$phpbb_root_path}garage/garage_dynorun.$phpEx", "mode=view_dynorun&amp;VID=".$vehicle_data['id']."&amp;DID=".$vehicle_data['did']),
				'COLUMN_1_TITLE'	=> $vehicle_data['vehicle'],
				'COLUMN_2_TITLE'	=> $vehicle_data['username'],
				'COLUMN_3_TITLE'	=> $vehicle_data['bhp'] .' ' . $vehicle_data['bhp_unit'] . ' / ' . $vehicle_data['torque'] .' ' . $vehicle_data['torque_unit'] . ' / '. $vehicle_data['nitrous'],
				'USERNAME_COLOUR'	=> get_username_string('colour', $vehicle_data['user_id'], $vehicle_data['username'], $vehicle_data['user_colour']),
			));
	 	}

		$required_position++;
		return ;
	}
}

$garage_dynorun = new garage_dynorun();

?>
