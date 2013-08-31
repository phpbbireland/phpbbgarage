<?php
/**
*
* @package ucp
* @version $Id$
* @copyright (c) 2005 phpBB Garage
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* ucp_garage
* Changing user garage preferences
* @package ucp
*/
class ucp_garage
{
	var $u_action;

	function main($id, $mode)
	{
		/**
		* Setup global variables such as $db
		*/
		global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx;
		global $garage_config;

		/**
		* Setup variables
		*/
		$submit = (isset($_POST['submit'])) ? true : false;
		$error = $data = array();
		$s_hidden_fields = '';

		/**
		* Setup page variables such as title, template & available language strings
		*/
		$user->add_lang('mods/garage');

		/**
		* Perform a set action based on value for $mode
		* A mode will noramlly display a page
		*/
		switch ($mode)
		{
			/**
			* Handle user options
			*/
			case 'options':
				$data = array(
					'index_columns'=> request_var('index_columns', $user->data['ug_index_columns']),
				);

				if ($submit)
				{
					$sql_ary = array(
						'ug_index_columns'	=> $data['index_columns'],
					);

					$sql = 'UPDATE ' . USERS_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE user_id = ' . $user->data['user_id'];
					$db->sql_query($sql);

					meta_refresh(3, $this->u_action);
					$message = $user->lang['PREFERENCES_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
					trigger_error($message);
				}

				$template->assign_vars(array(
					'L_TITLE'		=> $user->lang['UCP_GARAGE_OPTIONS'],
					'S_INDEX_DISPLAY'	=> ($garage_config['enable_user_index_columns']) ? 1 : 0,
					'S_INDEX_COLUMNS'	=> $data['index_columns'],
					'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
					'S_UCP_ACTION'		=> $this->u_action)
				);

				$this->tpl_name = 'ucp_garage_' . $mode;
				$this->page_title = 'UCP_GARAGE_' . strtoupper($mode);
			break;

			/**
			* Handle notification options
			*/
			case 'notify':
				$data = array(
					'guestbook_email_notify'	=> request_var('guestbook_email_notify', $user->data['ug_guestbook_email_notify']),
					'guestbook_pm_notify'		=> request_var('guestbook_pm_notify', $user->data['ug_guestbook_pm_notify']),
					'email_optout'				=> request_var('email_optout', $user->data['ug_mod_email_optout']),
					'pm_optout'					=> request_var('pm_optout', $user->data['ug_mod_pm_optout']),
				);

				if ($submit)
				{
					$sql_ary = array(
						'ug_guestbook_email_notify'	=> $data['guestbook_email_notify'],
						'ug_guestbook_pm_notify'	=> $data['guestbook_pm_notify'],
						'ug_mod_email_optout'		=> $data['email_optout'],
						'ug_mod_pm_optout'			=> $data['pm_optout'],
					);

					$sql = 'UPDATE ' . USERS_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE user_id = ' . $user->data['user_id'];
					$db->sql_query($sql);

					meta_refresh(3, $this->u_action);
					$message = $user->lang['PREFERENCES_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
					trigger_error($message);
				}

				$template->assign_vars(array(
					'L_TITLE'					=> $user->lang['UCP_GARAGE_NOTIFY'],
					'S_DISPLAY_EMAIL_OPTOUT'	=> ($garage_config['enable_email_pending_notify'] && $garage_config['enable_email_pending_notify_optout'] && $auth->acl_get('m_garage_edit') ) ? 1 : 0,
					'S_DISPLAY_PM_OPTOUT'		=> ($garage_config['enable_pm_pending_notify'] && $garage_config['enable_pm_pending_notify_optout'] && $auth->acl_get('m_garage_edit')) ? 1 : 0,
					'S_GUESTBOOK_EMAIL_NOTIFY'	=> $data['guestbook_email_notify'],
					'S_GUESTBOOK_PM_NOTIFY'		=> $data['guestbook_pm_notify'],
					'S_EMAIL_OPTOUT'			=> $data['email_optout'],
					'S_PM_OPTOUT'				=> $data['pm_optout'],
					'S_HIDDEN_FIELDS'			=> $s_hidden_fields,
					'S_UCP_ACTION'				=> $this->u_action)
				);
				$this->tpl_name = 'ucp_garage_notify';
				$this->page_title = 'UCP_GARAGE_NOTIFY';
			break;
		}
	}
}

?>
