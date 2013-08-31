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
* phpBB Garage Blog Class
* @package garage
*/
class garage_blog
{
	var $classname = "garage_blog";

	/**
	* Insert blog entry
	*
	* @param array $data single-dimension array holding the data to create blog entry
	*
	*/
	function insert_blog($data)
	{
		global $vid, $db, $garage_config, $garage_vehicle;

		$sql = 'INSERT INTO ' . GARAGE_BLOGS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'vehicle_id'		=> $vid,
			'user_id'			=> $garage_vehicle->get_vehicle_owner_id($vid),
			'blog_title'		=> $data['blog_title'],
			'blog_text'			=> $data['blog_text'],
			'blog_date'			=> time(),
			'bbcode_bitfield'	=> $data['bbcode_bitfield'],
			'bbcode_uid'		=> $data['bbcode_uid'],
			'bbcode_options'	=> $data['bbcode_options'],
		));

		$db->sql_query($sql);

		return $db->sql_nextid();
	}

	/**
	* Update existing blog entry
	*
	* @param array $data single-dimension array holding the data to update the blog entry
	*
	*/
	function update_blog($data)
	{
		global $db, $bid, $vid, $garage_config, $garage_vehicle;

		$update_sql = array(
			'user_id'			=> $garage_vehicle->get_vehicle_owner_id($vid),
			'blog_title'		=> $data['blog_title'],
			'blog_text'			=> $data['blog_text'],
			'bbcode_bitfield'	=> $data['bbcode_bitfield'],
			'bbcode_uid'		=> $data['bbcode_uid'],
			'bbcode_options'	=> $data['bbcode_options'],
		);

		$sql = 'UPDATE ' . GARAGE_BLOGS_TABLE . '
			SET ' . $db->sql_build_array('UPDATE', $update_sql) . "
			WHERE id = $bid AND vehicle_id = $vid";

		$db->sql_query($sql);

		return;
	}

	/**
	* Delete existing blog entry
	*
	* @param int $id id of blog entry to delete
	*
	*/
	function delete_blog($id)
	{
		global $db, $garage_image, $garage;

		$data = $this->get_blog($id);
		$garage->delete_rows(GARAGE_BLOGS_TABLE, 'id', $id);

		return;
	}

	/**
	* Return blog entry
	*
	* @param int $bid blog id to get
	*
	* @return array
	*/
	function get_blog($bid)
	{
		global $db;

		$data = array();

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'b.*',
			'FROM'		=> array(
				GARAGE_BLOGS_TABLE	=> 'b',
			),
			'WHERE'		=>	"b.id = $bid ",
			'ORDER_BY'	=>	'b.id DESC'
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return $data;
	}

	/**
	* Return array of blog entries filterd by vehicle
	*
	* @param int $vid vehicle id to filter on
	*
	* @return array
	*/
	function get_blogs_by_vehicle($vid)
	{
		global $db;

		$data = array();

		$sql = $db->sql_build_query('SELECT',
			array(
			'SELECT'	=> 'b.*, u.username',
			'FROM'		=> array(
				GARAGE_BLOGS_TABLE	=> 'b',
				USERS_TABLE			=> 'u',
			),
			'WHERE'		=>	"b.vehicle_id = $vid
				AND b.user_id = u.user_id",
			'ORDER_BY'	=>	'b.id DESC'
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
	* Assign template vars required to display a vehicle blog
	*
	* @param int $vehicle_id vehicle id to display blog for
	*
	*/
	function display_blog($vehicle_id, $owned)
	{
		global $template, $garage_vehicle, $garage, $user, $phpEx, $auth, $phpbb_root_path, $config;

		$template->assign_block_vars('blog', array());

		$data = $this->get_blogs_by_vehicle($vehicle_id);

		for ($i=0; $i < $tmp = count($data); $i++)
		{
			$blog_text = generate_text_for_display($data[$i]['blog_text'], $data[$i]['bbcode_uid'], $data[$i]['bbcode_bitfield'], $data[$i]['bbcode_options']);

			$template->assign_block_vars('blog.entry', array(
				'U_EDIT'		=> (($owned == 'YES') || ($owned == 'MODERATE')) ? append_sid("{$phpbb_root_path}garage/garage_blog.$phpEx?mode=edit_blog&amp;BID=". $data[$i]['id'] . "&amp;VID=$vehicle_id") : '',
				'U_DELETE'		=> ((($owned == 'YES') || ($owned == 'MODERATE')) && ((($auth->acl_get('u_garage_delete_blog'))) || ($auth->acl_get('m_garage_delete')))) ? 'javascript:confirm_delete_blog(' . $vehicle_id . ',' . $data[$i]['id'] . ')' : '',
				'BLOG_TITLE'	=> $data[$i]['blog_title'],
				'BLOG_DATE'		=> $user->format_date($data[$i]['blog_date']),
				'BLOG_TEXT'		=> $blog_text,
			));
		}

		$template->assign_vars(array(
			'S_MODE_BLOG_ACTION'	=> append_sid("{$phpbb_root_path}garage/garage_blog.$phpEx", "mode=insert_blog&amp;VID=$vehicle_id"))
		);
	}
}
$garage_blog = new garage_blog();
?>
