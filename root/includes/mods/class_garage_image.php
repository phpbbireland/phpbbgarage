<?php
/***************************************************************************
 *                              class_garage_image.php
 *                            -------------------
 *   begin                : Friday, 06 May 2005
 *   copyright            : (C) Esmond Poynton
 *   email                : esmond.poynton@gmail.com
 *   description          : Provides Vehicle Garage System For phpBB
 *
 *   $Id: class_garage_image.php 140 2006-06-08 10:41:34Z poyntesm $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

class garage_image
{
	var $classname = "garage_image";

	/*========================================================================*/
	// Gets User Image Upload Quota
	// Usage: get_user_upload_image_quota(array(group_membership));
	/*========================================================================*/
	function get_user_upload_image_quota($groups)
	{
		global $user, $garage_config, $garage;
	
		//If No Specific Group Value Exists Use Default Value
		if (empty($garage_config['private_upload_quota']))
		{
			return $garage_config['max_upload_images'];
		}
		//It Appears Some Groups Have Private Permissions & Quotas We Will Need To Check Them
		else
		{
			//Lets Get The Private Upload Groups & Quotas
			$private_upload_groups = @explode(',', $garage_config['private_upload_perms']);
			$private_upload_quotas = @explode(',', $garage_config['private_upload_quota']);

			//Process All Groups You Are Member Of To See If Any Are Granted Permission & Quota
			for ($i = 0, $count = sizeof($groups);$i < $count; $i++)
			{
				if (in_array($groupdata[$i]['group_id'], $private_upload_groups))
				{
					//Your A Member Of A Group Granted Permission - Find Array Key & Get Quota
					$index = array_search($groups[$i]['group_id'], $private_upload_groups);
					$quota[$i] = $private_upload_quotas[$index];
				}
			}

			//Your Were Not Granted Any Private Permissions..Return Default Value
			if  (empty($quota))
			{
				return $garage_config['max_upload_images'];
			}

			//Return The Highest Quota You Were Granted
			return max($quota);
		}
	}
	/*========================================================================*/
	// Gets User Remote Image Quota
	// Usage: get_user_upload_image_quota(array(group_membership);
	/*========================================================================*/
	function get_user_remote_image_quota($groups)
	{
		global $user, $garage_config, $garage;
	
		//If No Specific Group Value Exists Use Default Value
		if (empty($garage_config['private_remote_quota']))
		{
			return $garage_config['max_remote_images'];
		}
		//It Appears Some Groups Have Private Permissions & Quotas We Will Need To Check Them
		else
		{
			//Lets Get The Private Upload Groups & Remote Quotas
			$private_upload_groups = @explode(',', $garage_config['private_upload_perms']);
			$private_remote_quotas = @explode(',', $garage_config['private_remote_quota']);

			//Process All Groups You Are Member Of To See If Any Are Granted Permission & Quota
			for ($i = 0, $count = sizeof($groups);$i < $count; $i++)
			{
				if (in_array($groups[$i]['group_id'], $private_upload_groups))
				{
					//Your A Member Of A Group Granted Permission - Find Array Key & Get Quota
					$index = array_search($groups[$i]['group_id'], $private_upload_groups);
					$quota[$i] = $private_remote_quotas[$index];
				}
			}

			//Your Were Not Granted Any Private Permissions..Return Default Value
			if  (empty($quota))
			{
				return $garage_config['max_remote_images'];
			}

			//Return The Highest Quota You Were Granted
			return max($quota);
		}
	}

	/*========================================================================*/
	// Gets Group Image Upload Quota - Used Only In ACP Page
	// Usage: get_group_upload_image_quota('group id');
	/*========================================================================*/
	function get_group_upload_image_quota($gid)
	{
		global $garage_config;

		//If No Specific Group Value Exists Use Default Value
		if (empty($garage_config['private_upload_quota']))
		{
			return $garage_config['max_upload_images'];
		}
		//It Appears Some Groups Have Private Permissions & Quotas We Will Need To Check Them
		else
		{
			//Lets Get The Private Upload Groups & Quotas
			$private_upload_groups	= @explode(',', $garage_config['private_upload_perms']);
			$private_upload_quota 	= @explode(',', $garage_config['private_upload_quota']);

			//Find The Matching Index In Second Array For The Group ID
			if (($index = array_search($gid, $private_upload_groups)) === false)
			{
				//Group Has No Private Upload Permissions...So Give It The Default Incase They Turn It On
				return $garage_config['max_upload_images'];
			} 

			//Return The Groups Quota
			return $private_upload_quota[$index];
		}
	}

	/*========================================================================*/
	// Gets Group Remote Image Quota - Used Only In ACP Page
	// Usage: get_group_remote_image_quota('group id');
	/*========================================================================*/
	function get_group_remote_image_quota($gid)
	{
		global $garage_config;

		//If No Specific Group Value Exists Use Default Value
		if (empty($garage_config['private_remote_quota']))
		{
			return $garage_config['max_remote_images'];
		}
		//It Appears Some Groups Have Private Permissions & Quotas We Will Need To Check Them
		else
		{
			//Lets Get The Private Upload Groups & Quotas
			$private_upload_groups	= @explode(',', $garage_config['private_upload_perms']);
			$private_remote_quota 	= @explode(',', $garage_config['private_remote_quota']);

			//Find The Matching Index In Second Array For The Group ID
			if (($index = array_search($gid, $private_upload_groups)) === false)
			{
				//Group Has No Private Upload Permissions...So Give It The Default Incase They Turn It On
				return $garage_config['max_remote_images'];
			} 

			//Return The Groups Quota
			return $private_remote_quota[$index];
		}
	}

	/*========================================================================*/
	// Inserts Existing Image Into Vehicle Gallery
	// Usage: insert_vehicle_gallery_image('image id', 1|0);
	/*========================================================================*/
	function insert_vehicle_gallery_image($image_id, $hilite)
	{
		global $db, $cid;

		$sql = 'INSERT INTO ' . GARAGE_VEHICLE_GALLERY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'garage_id'	=> $cid,
			'image_id'	=> $image_id,
			'hilite'	=> $hilite)
		);

		$db->sql_query($sql);

		return;
	}

	/*========================================================================*/
	// Inserts Existing Image Into Modification Gallery
	// Usage: insert_modification_gallery_image('image id', 1|0);
	/*========================================================================*/
	function insert_modification_gallery_image($image_id, $hilite)
	{
		global $db, $cid, $mid;

		$sql = 'INSERT INTO ' . GARAGE_MODIFICATION_GALLERY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'garage_id'		=> $cid,
			'modification_id'	=> $mid,
			'image_id'		=> $image_id,
			'hilite'		=> $hilite)
		);

		$db->sql_query($sql);

		return;
	}

	/*========================================================================*/
	// Inserts Existing Image Into Quartermile Gallery
	// Usage: insert_quartermile_gallery_image('image id', 1|0);
	/*========================================================================*/
	function insert_quartermile_gallery_image($image_id, $hilite)
	{
		global $db, $cid, $qmid;

		$sql = 'INSERT INTO ' . GARAGE_QUARTERMILE_GALLERY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'garage_id'	=> $cid,
			'quartermile_id'=> $qmid,
			'image_id'	=> $image_id,
			'hilite'	=> $hilite)
		);

		$db->sql_query($sql);

		return;
	}

	/*========================================================================*/
	// Inserts Existing Image Into Dynorun Gallery
	// Usage: insert_dynorun_gallery_image('image id', 1|0);
	/*========================================================================*/
	function insert_dynorun_gallery_image($image_id, $hilite)
	{
		global $db, $cid, $rrid;

		$sql = 'INSERT INTO ' . GARAGE_DYNORUN_GALLERY_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'garage_id'	=> $cid,
			'dynorun_id'	=> $rrid,
			'image_id'	=> $image_id,
			'hilite'	=> $hilite)
		);

		$db->sql_query($sql);

		return;
	}

	/*========================================================================*/
	// Check GD Version Available
	// Usage: gd_version_check();
	/*========================================================================*/
	function gd_version_check($user_ver = 0)
	{
		if (!extension_loaded('gd'))
		{
			return;
		}
	
		static $gd_ver = 0;
		//Just Accept The Specified Setting If It's 1
		if ($user_ver == 1) 
		{
			$gd_ver = 1;
		       	return 1; 
		}
		//Use The Static Variable If function Was Called Previously
		if ($user_ver !=2 && $gd_ver > 0 ) 
		{ 
			return $gd_ver;
		}
		//Use The gd_info() Function If Possible
		if (function_exists('gd_info')) 
		{
			$ver_info = gd_info();
			preg_match('/\d/', $ver_info['GD Version'], $match);
			$gd_ver = $match[0];
			return $match[0];
		}
		//If phpinfo() is disabled use a specified / fail-safe choice...
		if (preg_match('/phpinfo/', ini_get('disable_functions'))) 
		{
			$gd_ver = ($user_ver == 2) ? 2 : 1;

			return $gd_ver;
		}
		//Otherwise Use phpinfo()
		ob_start();
		phpinfo(8);
		$info = ob_get_contents();
		ob_end_clean();
		$info = stristr($info, 'gd version');
		preg_match('/\d/', $info, $match);
		$gd_ver = $match[0];
		return $match[0];
	}

	/*========================================================================*/
	// Return True/False Depending On If Any Images Need Handling
	// Usage: image_attached();
	/*========================================================================*/
	function image_attached()
	{
		global $HTTP_POST_FILES, $HTTP_POST_VARS;

		//Look For Image To Handle From Either Upload Or Remotely Linked
		if ( ((isset($HTTP_POST_FILES['FILE_UPLOAD'])) AND ($HTTP_POST_FILES['FILE_UPLOAD']['name'])) OR ((!preg_match("/^http:\/\/$/i", $HTTP_POST_VARS['url_image'])) AND (!empty($HTTP_POST_VARS['url_image']))) )
		{
			return true;
		}

		//No Image To Handle So Return False	
		return false;
	}

	/*========================================================================*/
	// Return True/False Depending On If Image Is Remote
	// Usage: image_is_remote();
	/*========================================================================*/
	function image_is_remote()
	{
		global $HTTP_POST_VARS;

		//Lets Make Sure It's Not Just A Default http:// 
		$url_image = str_replace("\'", "''", trim($HTTP_POST_VARS['url_image']));
		if ( preg_match( "/^http:\/\/$/i", $url_image ) )
		{
			$url_image = "";
		}

		//Is Image Remote
		if ( !empty($url_image) )
		{
			return true;
		}

		//Image Is Not Remote So Return False	
		return false;
	}

	/*========================================================================*/
	// Return True/False Depending On If Image Is Locally Uploaded
	// Usage: image_is_local();
	/*========================================================================*/
	function image_is_local()
	{
		global $HTTP_POST_FILES;

		//Is Image Local
		if ( (isset($HTTP_POST_FILES['FILE_UPLOAD'])) AND (!empty($HTTP_POST_FILES['FILE_UPLOAD']['name'])) )
		{
			return true;
		}

		//Image Is Not Local So Return False	
		return false;
	}

	/*========================================================================*/
	// Handle Image Upload And Thumbnail Creation For Remote/Local Images
	// Usage: process_image_attached('type', 'id');
	/*========================================================================*/
	function process_image_attached($type, $id)
	{
		global $user, $images, $phpEx, $phpbb_root_path, $garage_config, $HTTP_POST_FILES, $HTTP_POST_VARS, $garage, $cid, $auth;

		if ( (!$auth->acl_get('u_garage_upload_image')) OR (!$auth->acl_get('u_garage_remote_image')) )
		{
			return;
		}

		//Setup $garage_config['gd_version']
		if ($gd_version = $this->gd_version_check())
	       	{
			$garage_config['gd_version'] = 0;
	   		if ($gd_version == 2) 
			{
				$garage_config['gd_version'] = 2;
	   		}
			else if ( $gd_version == 1 )
			{
				$garage_config['gd_version'] = 1;
			}
		}

		//Check Directory Exists...And If Not Let User Know To Contact Administrator With Helpful Pointer
		if (!file_exists($phpbb_root_path. GARAGE_UPLOAD_PATH))
		{
			redirect(append_sid("garage.$phpEx", "mode=error&amp;EID=24"));
		}
		//Check Its Writeable '16895' Is Octal For drwxrwxrwx.... Let User Know To Contact Admin With Helpful Pointer
		if (!fileperms($phpbb_root_path. GARAGE_UPLOAD_PATH) == '16895')
		{
			redirect(append_sid("garage.$phpEx", "mode=error&amp;EID=25"));
		}

		//Check For Both A Remote Image & Image Upload..Not Allowed
		if ( ($this->image_is_remote()) AND ($this->image_is_local()) )
		{
			redirect(append_sid("garage.$phpEx", "mode=error&amp;EID=11"));
		}
		//Process The Remote Image
		else if ( $this->image_is_remote() )
		{
			$data['location'] = str_replace("\'", "''", trim($HTTP_POST_VARS['url_image']));

			//Stop dynamic images and display correct error message
			if ( preg_match( "/[?&;]/", $data['location'] ) )
			{
				redirect(append_sid("garage.$phpEx", "mode=error&amp;EID=9"));
			}
			//Does Remote File Exist?
			if ( !$this->remote_file_exists($data['location']) ) 
			{
				redirect(append_sid("garage.$phpEx", "mode=error&amp;EID=10"));
			}
	
			$data['date']	= time();
			$data['ext'] 	= strtolower( preg_replace( "/^.*\.(\S+)$/", "\\1", $data['location'] ) );
			$data['file'] 	= preg_replace( "/^.*\/(.*\.\S+)$/", "\\1", $data['location'] );

			switch ($data['ext'])
			{
				case 'jpeg':
				case 'jpg':
					$data['ext'] = '.jpg';
					$data['is_image'] = '1';
					break;
				case 'png':
					$data['ext'] = '.png';
					$data['image'] = '1';
					break;
				case 'gif':
					$data['ext'] = '.gif';
					$data['is_image'] = '1';
					break;
				default:
					redirect(append_sid("garage.$phpEx", "mode=error&amp;EID=12"));
			}
	
			//Build File Names	
			$data['tmp_name'] 	= 'garage_' . $type . '-' . $id . '-' . $data['date'] . $data['ext'];
			$data['thumb_location'] = 'garage_' . $type . '-' . $id . '-' . $data['date'] . '_thumb' . $data['ext'];
			$data['garage_id'] 	= ($type == 'vehicle') ? $id : $cid;
	
			//Download Remote Image To Our Temporary File
			$this->download_remote_image($data['location'], $data['tmp_name']);

			//Create The Thumbnail If We Have GD On The Server
			if ( $garage_config['gd_version'] > 0 )
			{
				//Create The Thumbnail
				$this->create_thumbnail($data['tmp_name'], $data['thumb_location'], $data['ext']);

				//Get Thumbnail Width & Height
				$data['thumb_width']	= $this->get_image_width($data['thumb_location']);
				$data['thumb_height'] 	= $this->get_image_height($data['thumb_location']);
				$data['thumb_filesize'] = $this->get_image_filesize($data['thumb_location']);
			}
			//No GD So Use Default Image
			else
			{
				$data['thumb_location']	= $phpbb_root_path . $images['garage_no_thumb'];
				$data['thumb_width'] 	= '145';
				$data['thumb_height'] 	= '35';
			}

			//Remove Our Temporary File As We No Longer Need It..
			@unlink($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['tmp_name']);
	
			//Insert The Image Into The DB Now We Are Finished
			$image_id = $this->insert_image($data);
	
			return $image_id;
		}
		//Uploaded Image Not Remote Image
		else if ( $this->image_is_local() )
		{
			$data['filesize']	= $HTTP_POST_FILES['FILE_UPLOAD']['size'];
			$data['tmp_name'] 	= $HTTP_POST_FILES['FILE_UPLOAD']['tmp_name'];
			$data['file']		= trim(stripslashes($HTTP_POST_FILES['FILE_UPLOAD']['name']));
			$data['date'] 		= time();
			$imagesize 		= getimagesize($HTTP_POST_FILES['FILE_UPLOAD']['tmp_name']);
			$data['filetype'] 	= $imagesize[2];
	
			if ($data['filesize'] == 0) 
			{
				redirect(append_sid("garage.$phpEx?mode=error&EID=6", true));
			}
	
			if ($data['filesize'] / 1024 > $garage_config['max_image_kbytes'])
			{
				redirect(append_sid("garage.$phpEx?mode=error&EID=7", true));
			}
	
			//Check File Type 
			switch ($data['filetype'])
			{
				case '1':
					$data['ext'] = '.gif';
					$data['is_image'] = '1';
					break;
				case '2':
					$data['ext'] = '.jpg';
					$data['is_image'] = '1';
					break;
				case '3':
					$data['ext'] = '.png';
					$data['is_image'] = '1';
					break;
				default:
					message_die(GENERAL_ERROR, $lang['Not_Allowed_File_Type_Vehicle_Created_No_Image'] . "<br />Your File Type Was " .$data['filetype']);
			}
	
			//Generate Required Filename & Thumbname
			$data['garage_id'] 	= ($type == 'vehicle') ? $id : $cid;
			$data['location'] 	= 'garage_' . $type . '-' . $id . '-' . $data['date'] . $data['ext'];
			$data['thumb_location'] = 'garage_' . $type . '-' . $id . '-' . $data['date'] . '_thumb' . $data['ext'];
	
			//Move File To Upload Directory...We Know Directory Exists From Earlier Checks...
			$move_file = 'copy';
			$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
			if ( @$ini_val('open_basedir') != '' )
			{
				if ( @phpversion() < '4.0.3' )
				{
					message_die(GENERAL_ERROR, 'open_basedir is set and your PHP version does not allow move_uploaded_file<br /><br />Please contact your server admin', '', __LINE__, __FILE__);
				}
				$move_file = 'move_uploaded_file';
			}
	
			$move_file($data['tmp_name'], $phpbb_root_path . GARAGE_UPLOAD_PATH . $data['location']);
			@chmod($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['location'], 0777);
	
			//Lets Get Image Width & Height
			$data['width'] 	= $this->get_image_width($data['location']);
			$data['height'] = $this->get_image_width($data['location']);

			//Check If Image Breaches Site Rules...If So Delete And Let User Know...	
			if ( ($data['width'] > $garage_config['max_image_resolution']) or ($data['height'] > $garage_config['max_image_resolution']) )
			{
				@unlink($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['location']);
				redirect(append_sid("garage.$phpEx?mode=error&EID=8", true));
			}

			//Create The Thumbnail For This Image
			if ( $garage_config['gd_version'] > 0 )
			{
				$this->create_thumbnail($data['location'], $data['thumb_location'], $data['ext']);

				//Get Thumbnail Width & Height
				$data['thumb_width'] 	= $this->get_image_width($data['thumb_location']);
				$data['thumb_height'] 	= $this->get_image_height($data['thumb_location']);
				$data['thumb_filesize'] = $this->get_image_filesize($data['thumb_location']);
			}
			else
			{
				$data['thumb_location'] = $phpbb_root_path . $images['garage_no_thumb'];
				$data['thumb_width'] = '145';
				$data['thumb_height'] = '35';
			}
	
			//Insert The Image Into The DB Now We Are Finished
			$image_id = $this->insert_image($data);
	
			return $image_id;
		}
	}

	/*========================================================================*/
	// Insert Image Into DB
	// Usage: insert_image(array());
	/*========================================================================*/
	function insert_image($data)
	{
		global $db;

		$sql = 'INSERT INTO ' . GARAGE_IMAGES_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'garage_id'		=> $data['garage_id'],
			'attach_location'	=> $data['location'],
			'attach_hits'		=> '0',
			'attach_ext'		=> $data['ext'],
			'attach_file'		=> $data['file'],
			'attach_thumb_location'	=> $data['thumb_location'],
			'attach_thumb_width'	=> $data['thumb_width'],
			'attach_thumb_height'	=> $data['thumb_height'],
			'attach_is_image'	=> $data['is_image'],
			'attach_date'		=> time(),
			'attach_filesize'	=> $data['filesize'],
			'attach_thumb_filesize'	=> $data['thumb_filesize'])
		);

		$db->sql_query($sql);
		
		return $db->sql_nextid();
	}
	
	/*========================================================================*/
	// Create Thumbnail From Sourcefile 
	// Usage: create_thumbnail('source file', 'destination file', 'file type');
	/*========================================================================*/
	function create_thumbnail($source_file_name, $thumb_file_name, $file_ext)
	{
		global $phpbb_root_path, $garage_config;
	
		$gd_errored = false;

		switch ($file_ext)
		{
			case '.jpg':
				$read_function = 'imagecreatefromjpeg';
				break;
			case '.png':
				$read_function = 'imagecreatefrompng';
				break;
			case '.gif':
				$read_function = 'imagecreatefromgif';
				break;
		}

		$width 	= $this->get_image_width($source_file_name);
		$height = $this->get_image_height($source_file_name);
	
		$src = @$read_function( $phpbb_root_path . GARAGE_UPLOAD_PATH  . $source_file_name );
	
		if (!$src)
		{
			$gd_errored = true;
			$thumb_file_name = '';
		}
		else if( ($width > $garage_config['thumbnail_resolution']) or ($height > $garage_config['thumbnail_resolution']) )
		{
			//Resize it
			if ($width > $height)
			{
				$thumb_width	= $garage_config['thumbnail_resolution'];
				$thumb_height 	= $garage_config['thumbnail_resolution'] * ($height/$width);
			}
			else
			{
				$thumb_height 	= $garage_config['thumbnail_resolution'];
				$thumb_width 	= $garage_config['thumbnail_resolution'] * ($width/$height);
			}

			$thumb = ($garage_config['gd_version'] == 1) ? @imagecreate($thumb_width, $thumb_height) : @imagecreatetruecolor($thumb_width, $thumb_height);
			$resize_function = ($garage_config['gd_version'] == 1) ? 'imagecopyresized' : 'imagecopyresampled';
			@$resize_function($thumb, $src, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);

		}
		//Source Is Bigger Than Thumb...So Just Use Source..
		else
		{
			$thumb = $src;
		}

		//No Problems So Far So Lets Create The Actual Thumbnail File Next...
		if (!$gd_errored)
		{
			//Different Call Based On Image Type...
			switch ($file_ext)
			{
				case '.jpg':
					@imagejpeg($thumb, $phpbb_root_path . GARAGE_UPLOAD_PATH . $thumb_file_name, 80);
					break;
				case '.png':
					@imagepng($thumb, $phpbb_root_path . GARAGE_UPLOAD_PATH . $thumb_file_name);
					break;
				case '.gif':
					@imagegif($thumb, $phpbb_root_path . GARAGE_UPLOAD_PATH . $thumb_file_name);
					break;
			}
			@chmod($phpbb_root_path . GARAGE_UPLOAD_PATH . $thumb_file_name, 0777);
		} 

		//We should ALWAYS clear the RAM used by this.
		imagedestroy($thumb);
		imagedestroy($src);

		return;
	}

	/*========================================================================*/
	// Return The Width Of An Image
	// Usage: get_image_width('source file');
	/*========================================================================*/
	function get_image_width($source_file_name)
	{
		global $phpbb_root_path;

		$imagesize = getimagesize($phpbb_root_path . GARAGE_UPLOAD_PATH . $source_file_name);

		return $imagesize[0];
	}

	/*========================================================================*/
	// Return The Height Of An Image
	// Usage: get_image_height('source file');
	/*========================================================================*/
	function get_image_height($source_file_name)
	{
		global $phpbb_root_path;

		$imagesize = getimagesize($phpbb_root_path . GARAGE_UPLOAD_PATH . $source_file_name);

		return $imagesize[1];
	}

	/*========================================================================*/
	// Return The Filesize Of An Image
	// Usage: get_image_filesize('source file');
	/*========================================================================*/
	function get_image_filesize($source_file_name)
	{
		global $phpbb_root_path;

		return filesize($phpbb_root_path . GARAGE_UPLOAD_PATH . $source_file_name);
	}

	/*========================================================================*/
	// Return The Disk Space Used By Any User..
	// Usage: get_image_space_used('user_id');
	/*========================================================================*/
	function get_image_space_used($user_id)
	{
		//Set Inital Counter To Zero
		$space = 0;

		//Get All Space Used By Uploaded & Remote Images
		$uploaded_image_data 	= $this->get_user_upload_images($user_id);
		$remote_image_data 	= $this->get_user_remote_images($user_id);

		//For Uploaded Images We Need The Image + Thumbnail Size
		for ($i = 0, $count = sizeof($uploaded_image_data); $i < $count; $i++)
		{
			$space =  $space + ( $uploaded_image_data[$i]['attach_filesize'] + $uploaded_image_data[$i]['attach_thumb_filesize'] );
		}
		//For Remote Images We Only Have Thumbnails To Factor In
		for ($i = 0, $count = sizeof($remote_image_data); $i < $count; $i++)
		{
			$space =  $space + $remote_image_data[$i]['attach_thumb_filesize'] ;
		}
	
		return $space;
	}
	
	/*========================================================================*/
	// Delete Image Including Actual File & Thumbnail
	// Usage:  delete_image('image id');
	/*========================================================================*/
	function delete_image($image_id)
	{
		global $phpbb_root_path, $garage;
	
		//Right User Wants To Delete An Image Lets Get All Info
		$data = $this->get_image($image_id);
	
		if ( (!empty($data['attach_location'])) OR (!empty($data['attach_thumb_location'])) )
		{
			//Right Image Exists So Lets Delete From DB First
			$garage->delete_rows(GARAGE_IMAGES_TABLE, 'attach_id', $image_id);

			//Delete Thumbnail	
			if (file_exists($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_thumb_location']))
			{
				@unlink($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_thumb_location']);
			}

			//If Its A Local Image Delete The Source File As Well
			if ( !preg_match( "/^http:\/\//i", $data['attach_location']) )
			{
				if (file_exists($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_location']))
				{
					@unlink($phpbb_root_path . GARAGE_UPLOAD_PATH . $data['attach_location']);
				}
			}
		}
	
		return;
	}
	
	/*========================================================================*/
	// Delete A Gallery Image
	// Usage: delete_gallery_image('image id');
	/*========================================================================*/
	function delete_gallery_image($image_id)
	{
		global $cid, $garage_vehicle, $garage;

		//Delete DB Entry & Files
		$this->delete_image($image_id);

		//If Hilite Image Reset DB Field For Vehicle
		$data = $garage_vehicle->get_vehicle($cid);
		if ( $data['image_id']  == $image_id)
		{
			$garage->update_single_field(GARAGE_VEHICLES_TABLE,'image_id','NULL','image_id',$image_id);
		}

		//Remove From Gallery DB Table
		$garage->delete_rows(GARAGE_GALLERY_TABLE, 'image_id', $image_id);

		return;
	}
	
	/*========================================================================*/
	// Check The Remote File Actually Exists
	// Usage: remote_file_exists('url location');
	/*========================================================================*/
	function remote_file_exists($url)
	{
		$head = '';
		$url_p = parse_url ($url);
	
	       	if (isset ($url_p['host']))
		{
			$host = $url_p['host']; 
		}
	        else
		{
	             	return false;
	        }
	
		$path = (isset ($url_p['path'])) ? $url_p['path'] : '';

	        $fp = @fsockopen ($host, 80, $errno, $errstr, 20);
	        if (!$fp)
		{
	        	return false;
	        }
	        else
	        {
	        	$parse = parse_url($url);
	               	$host = $parse['host'];
	
			@fputs($fp, 'HEAD '.$url." HTTP/1.1\r\n");
	               	@fputs($fp, 'HOST: '.$host."\r\n");
	               	@fputs($fp, "Connection: close\r\n\r\n");
	               	$headers = '';
	               	while (!@feof ($fp))
	               	{ 
				$headers .= @fgets ($fp, 128); 
			}
	       	}
		@fclose ($fp);

	       	$arr_headers = explode("\n", $headers);
	       	if (isset ($arr_headers[0]))    
		{
	       		if(strpos ($arr_headers[0], '200') !== false)
	       		{ 
				return true; 
			}
	       		if( (strpos ($arr_headers[0], '404') !== false) || (strpos ($arr_headers[0], '509') !== false) || (strpos ($arr_headers[0], '410') !== false))
			{ 
				return false; 
			}
	       		if( (strpos ($arr_headers[0], '301') !== false) || (strpos ($arr_headers[0], '302') !== false))
			{
	               		preg_match("/Location:\s*(.+)\r/i", $headers, $matches);
	               		if(!isset($matches[1]))
				{
	               			return false;
				}
	               		$nextloc = $matches[1];
				return $this->remote_file_exists($nextloc);
	       		}
		}

	        //If we are still here then we got an unexpected header
	        return false;
	}
	
	/*========================================================================*/
	// Select Single Image Data From DB
	// Usage: get_image('image id');
	/*========================================================================*/
	function get_image($image_id)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'i.*',
			'FROM'		=> array(
				GARAGE_IMAGES_TABLE	=> 'i',
			),
			'WHERE'		=>  "i.attach_id = $image_id"
		));

		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return $data;
	}

	/*========================================================================*/
	// Select Random Image(s) Data From DB
	// Usage: get_random_image('image numbers');
	/*========================================================================*/
	function get_random_image($required = 5)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'i.*',
			'FROM'		=> array(
				GARAGE_IMAGES_TABLE	=> 'i',
			),
			'ORDER_BY'	=>  "rand()"
		));

		$result = $db->sql_query_limit($sql, $required);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);
	
		return $data;
	}

	/*========================================================================*/
	// Select All Image Data From DB
	// Usage: get_all_images();
	/*========================================================================*/
	function get_all_images()
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'i.*',
			'FROM'		=> array(
				GARAGE_IMAGES_TABLE	=> 'i',
			),
			'ORDER_BY'	=>  "i.attach_id ASC"
		));

		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);
	
		return $data;
	}

	/*========================================================================*/
	// Select Gallery Data From Single Vehicle From DB
	// Usage: get_gallery('vehicle id');
	/*========================================================================*/
	function get_gallery($cid)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'gl.*, i.*',
			'FROM'		=> array(
				GARAGE_GALLERY_TABLE	=> 'gl',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_IMAGES_TABLE => 'i'),
					'ON'	=> 'i.attach_id = gl.image_id'
				)
			),
			'WHERE'		=>  "gl.garage_id = $cid",
			'GROUP_BY'	=>  "gl.id"
		));

      		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);

		return $data;
	}

	/*========================================================================*/
	// Select All Uploaded Images From User
	// Usage: get_user_upload_images('user id');
	/*========================================================================*/
	function get_user_upload_images($user_id)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'i.*',
			'FROM'		=> array(
				GARAGE_IMAGES_TABLE	=> 'i',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_VEHICLES_TABLE => 'g'),
					'ON'	=> 'g.id = i.garage_id'
				)
			),
			'WHERE'		=>  "g.user_id = $user_id AND i.attach_location NOT LIKE 'http://%'"
		));

      		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);
	
		return $data;
	}

	/*========================================================================*/
	// Select All Remote Images From User
	// Usage: get_user_remote_images('user id');
	/*========================================================================*/
	function get_user_remote_images($user_id)
	{
		global $db;

		$data = null;

		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'i.*',
			'FROM'		=> array(
				GARAGE_IMAGES_TABLE	=> 'i',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(GARAGE_VEHICLES_TABLE => 'g'),
					'ON'	=> 'g.id = i.garage_id'
				)
			),
			'WHERE'		=>  "g.user_id = $user_id AND i.attach_location LIKE 'http://%'"
		));

      		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$data[] = $row;
		}
		$db->sql_freeresult($result);
	
		return $data;
	}

	/*========================================================================*/
	// Below Image Quotas
	// Usage: below_image_quotas();
	/*========================================================================*/
	function below_image_quotas()
	{
		global $phpbb_root_path, $phpEx, $user;

		include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

		//Get All Users Images So We Can Workout Current Quota Usage
		$user_upload_image_data = $this->get_user_upload_images($user->data['user_id']);
		$user_remote_image_data = $this->get_user_remote_images($user->data['user_id']);

		//Get Users Group Memberships Now As We Should Do This Only Once
		$group_memberships = group_memberships(false, array($user->data['user_id']), false);

		//Check For Remote & Local Image Quotas
		if ( (($this->image_is_remote() ) AND (sizeof($user_remote_image_data) < $this->get_user_remote_image_quota($group_memberships))) OR (($this->image_is_local() ) AND (sizeof($user_upload_image_data) < $this->get_user_upload_image_quota($group_memberships))) )
		{
			return true;
		}
	}

	/*========================================================================*/
	// Above Or Equal Image Quotas
	// Usage: above_image_quotas();
	/*========================================================================*/
	function above_image_quotas()
	{
		global $phpbb_root_path, $phpEx, $user;

		include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

		//Get All Users Images So We Can Workout Current Quota Usage
		$user_upload_image_data = $this->get_user_upload_images($user->data['user_id']);
		$user_remote_image_data = $this->get_user_remote_images($user->data['user_id']);

		//Get Users Group Memberships Now As We Should Do This Only Once
		$group_memberships = group_memberships(false, array($user->data['user_id']), false);

		//You Have Reached Your Image Quota
		if ( (($this->image_is_remote() ) AND (sizeof($user_remote_image_data) >= $this->get_user_remote_image_quota($group_memberships))) OR (($this->image_is_local() ) AND (sizeof($user_upload_image_data) >= $this->get_user_upload_image_quota($group_memberships))) )
		{
			return true;
		}
	}

	/*========================================================================*/
	// Count All Images In The Garage
	// Usage: count_total_images();
	/*========================================================================*/
	function count_total_images()
	{
		return sizeof($this->get_all_images());
	}

	/*========================================================================*/
	// Download Remote Image
	// Usage: download_remote_image('Image URL', 'Destination File Name');
	/*========================================================================*/
	function download_remote_image($remote_url, $destination_file)
	{
		global $garage_config, $phpbb_root_path;

		//If Allowed By Host Use fopen....
	        if ( ini_get('allow_url_fopen') )
		{
			$infile	= @fopen ($remote_url, "rb");
                	$outfile= @fopen ( $phpbb_root_path . GARAGE_UPLOAD_PATH . $destination_file, "wb");

	                //Set Our Custom Timeout
       		        socket_set_timeout($infile, $garage_config['remote_timeout']);

               		while (!@feof ($infile)) 
			{
	               		@fwrite($outfile, @fread ($infile, 4096));
			}
	                @fclose($outfile);
		        @fclose($infile);
		}
		//Not Allowed Use fopen So Use fsockopen...So Everyone Is Happy
		else
		{
			$infile = $this->fsockopen_url($remote_url);
			$outfile= @fopen($phpbb_root_path . GARAGE_UPLOAD_PATH . $destination_file,"w+");
			@fwrite($outfile,$infile);
			@fclose($outfile);
			@fclose($infile);
		}
                @fclose($outfile);
	        @fclose($infile);

		@chmod($phpbb_root_path . GARAGE_UPLOAD_PATH . $destination_file, 0777);

		return;
	}

	/*========================================================================*/
	// Rebuild Thumbnails
	// Usage: rebuild_thumbs('start point', 'per cycle', 'already completed', 'log file');
	/*========================================================================*/
	function rebuild_thumbs($start, $limit, $done, $file) 
	{
	
		global $userdata, $db, $SID, $lang, $phpEx, $phpbb_root_path, $garage_config, $garage;
	
		$output = array();
		$end = $start + $cycle;
		//Setup Log File Location
		if (!empty($file))
		{
	        	$log_file   = $phpbb_root_path . GARAGE_UPLOAD_PATH . $file;
		}
	
		//Count Total Images So We Know How Many Need Processing
		$total = $this->count_total_images();
	
		// Loop through the images avoiding limit
		$sql = $db->sql_build_query('SELECT', 
			array(
			'SELECT'	=> 'i.*',
			'FROM'		=> array(
				GARAGE_IMAGES_TABLE	=> 'i',
			),
			'WHERE'		=>  "i.attach_is_image = 1",
			'ORDER_BY'	=>  "i.attach_id ASC"
		));
	
		$result = $db->sql_query_limit($sql, $limit, $start);
	
		//We Must Be Complete As We Have No More Images To Process
		if ( $db->sql_numrows($result) < 1 )
		{
			$message = '<meta http-equiv="refresh" content="4;url=' . append_sid("admin_garage_tools.$phpEx") . '">' . $lang['Rebuild_Thumbnails_Complete'] . "<br /></br>" . sprintf($lang['Click_Return_Tools'], "<a href=\"" . append_sid("admin_garage_tools.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	
			message_die(GENERAL_MESSAGE, $message);
		}
	
		//Work Out If Logging Is Appending Or Creating A File
	        if ( (empty($log_file) == false) AND ( $done == 0 ) )
		{
			//Just Starting So Write From Start..Produce A Message..Then Set To Appebd
			$log_type = 'wb';
			$garage->write_logfile($log_file, $log_type, '', 0);
			$log_type = 'ab';
		}
		else if ( (empty($log_file) == false) AND ( $done > 0 ) )
		{
			//We Will Append Since This Is Not The Start
			$log_type = 'ab';
		}
	
	        while ( $image_row = $db->sql_fetchrow($result) )
	      	{
			//Write Log Message
			$garage->write_logfile($log_file, $log_type, $lang['Processing_Attach_ID'] . $image_row['attach_id'], 0);
	
	       	        //The Process Is Different For Local v Remote Files
	               	if ( preg_match("/^http:\/\//i", $image_row['attach_location']) )
	                {
				//This is a remote image!
				$location = $image_row['attach_location'];
				$file_name = preg_replace( "/^(.+?)\..+?$/", "\\1", $image_row['attach_file'] );
	
	                    	//Generate Temp File Name
	       	            	$tmp_file_name = $file_name . '-' . time() . $image_row['attach_ext'];
	
	               	    	//Generate Thumbnail Filename
	                    	if ( (empty($image_row['attach_thumb_location'])) OR ($image_row['attach_thumb_location'] == "remote") )
	       	            	{
	       		    		//Use The 'attach_file' field To Create Thumbnail Filename 
	                       		$thumb_file_name = $file_name . time() . '_thumb' . $image_row['attach_ext'];
				} 
				else
			       	{
	                       		//We already Know The Thumbnail Filename :)
		                        $thumb_file_name = $image_row['attach_thumb_location'];
	               		}
	
		                $garage->write_logfile($log_file, $log_type, $lang['Remote_Image'] . $image_row['attach_location'], 1);
	    	                $garage->write_logfile($log_file, $log_type, $lang['File_Name'] . $file_name, 2);
	               		$garage->write_logfile($log_file, $log_type, $lang['Temp_File_Name'] . $tmp_file_name, 2);
	
	                    	// Make sure it exists, or we'll get nasty errors!
	               		if ( $this->remote_file_exists($image_row['attach_location']) )
				{
					// Download the remote image to our temporary file
					$this->download_remote_image($image_row['attach_location'], $tmp_file_name);
	
					//Create The New Thumbnail
					$this->create_thumbnail($tmp_file_name, $thumb_file_name, $image_row['attach_ext']);
	
					//Get Thumbnail Width & Height
					$image_width = $this->get_image_width($thumb_file_name);
					$image_height = $this->get_image_height($thumb_file_name);
					$image_filesize = $this->get_image_filesize($thumb_file_name);
		
					//Update the DB With New Thumbnail Details
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_location', $thumb_file_name, 'attach_id', $image_row['attach_id']);
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_width', $image_width, 'attach_id', $image_row['attach_id']);
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_height', $image_height, 'attach_id', $image_row['attach_id']);
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_filesize', $image_filesize, 'attach_id', $image_row['attach_id']);
	
			                // Remove our temporary file!
					@unlink($phpbb_root_path . GARAGE_UPLOAD_PATH . $tmp_file_name);
	
	                        	// Add the status message
					$output[] = $lang['Rebuilt'] . $image_row['attach_location'] . ' -> '.$thumb_file_name;
	
	                        	$garage->write_logfile($log_file, $log_type, $lang['Thumb_File'] . $thumb_file_name, 1);
	                    	}
				else
				{
	                        	// Tell them that the remote file doesn't exists
	                        	$output[] = "<b><font color='red'>ERROR</font></b>".$lang['File_Does_Not_Exist']."(".$image_row['attach_file'].")";
	                        	$garage->write_logfile($log_file, $log_type, $lang['File_Does_Not_Exist'], 1);
	                    	}
	                }
			else
			{
				$source_file = $phpbb_root_path . GARAGE_UPLOAD_PATH . $image_row['attach_location'];
	
	               	    	//Generate Thumbnail Filename
	                    	if ( empty($image_row['attach_thumb_location']) )
	                    	{
	                       		// We are going to use the attach_id to create our _thumb
			                //   file name since this image did not have a thumb before.
	                	        $thumb_file_name = preg_replace( "/^(.+?)\..+?$/", "\\1", $image_row['attach_location'] );
	                       		$thumb_file_name .= '_thumb' . $image_row['attach_ext'];
	                    	}
				else
				{
	                        	//We Already Know The Thumbnail Filename :)
	                        	$thumb_file_name = $image_row['attach_thumb_location'];
	                    	}
	
				//Make Sure The File Actually Exists Before Processing It
				if (file_exists($phpbb_root_path . GARAGE_UPLOAD_PATH . $image_row['attach_location']))
				{
					//Create The New Thumbnail
					$this->create_thumbnail($image_row['attach_location'], $thumb_file_name, $image_row['attach_ext']);
	
					//Get Thumbnail Width & Height
					$image_width = $this->get_image_width($thumb_file_name);
					$image_height = $this->get_image_height($thumb_file_name);
					$image_filesize = $this->get_image_filesize($thumb_file_name);
		
					//Update the DB With New Thumbnail Details
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_location', $thumb_file_name, 'attach_id', $image_row['attach_id']);
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_width', $image_width, 'attach_id', $image_row['attach_id']);
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_height', $image_height, 'attach_id', $image_row['attach_id']);
					$garage->update_single_field(GARAGE_IMAGES_TABLE, 'attach_thumb_filesize', $image_filesize, 'attach_id', $image_row['attach_id']);
	
		                    	//Add The Status Message
	        	            	$output[] = $lang['Rebuilt'] . $image_row['attach_location'].' -> '.$thumb_file_name;
	
	                	    	$garage->write_logfile($log_file, $log_type, $lang['Thumb_File'] . $thumb_file_name, 1);
				}
				//Original Source File Is Missing
				else
				{
	        	            	$output[] = $lang['Source_Unavailable'] . $image_row['attach_location'];
	                	    	$garage->write_logfile($log_file, $log_type, $lang['No_Source_File'], 1);
				}
			} // End if remote/local 
	              	$done++;
		}
	
		$message = '<meta http-equiv="refresh" content="5;url=' . append_sid("admin_garage_tools.$phpEx?mode=rebuild_thumbs&amp;start=$end&amp;cycle=$cycle&amp;file=$file&amp;done=$done") . '">'."<div align=\"left\"><b>".$lang['Started_At']."$start <br />".$lang['Ended_At']."$end <br />".$lang['Have_Done']."$done<br />".$lang['Need_To_Process']."$total <br />".$lang['Log_To']."$log_file <br /></b></b><br /><br />".implode( "<br />", $output )."<br /></br>";
	
		message_die(GENERAL_MESSAGE, $message);
	}
}

$garage_image = new garage_image();

?>
