<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Zikula
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * The system-level and database-level functions for user-initiated actions for the Users module.
 */
 
 /*
namespace ChangeUsername\Api;


use Zikula_View;
use UserUtil;
use SecurityUtil;
use ModUtil;
use Zikula_Exception_Forbidden;
use Users\Constant as UsersConstant;
use DataUtil;
use DateUtil;
use System;
use Users\Controller\FormData\NewUserForm;
use Zikula_Hook_ValidationProviders;
use Zikula_Exception_Fatal;
use Users\Controller\FormData\ModifyUserForm;
use DBUtil;
use LogUtil;
use DateTimeZone;
use DateTime;
use Users\Controller\FormData\ModifyRegistrationForm;
use Users\Controller\FormData\ConfigForm;
use FileUtil;
use Zikula\Core\Event\GenericEvent;
use Exception;
use Zikula_Session;
use Zikula\Core\Hook\ProcessHook;
use Zikula\Core\Hook\ValidationProviders;
use Zikula\Core\Hook\ValidationHook; 
 

use System\Users\Constant as UsersConstant;
*/

 
class ChangeUsername_Api_User extends Zikula_AbstractApi
{
	
	
	public function getUserNameErrors($reginfo)
	{
	
		
	    if (!isset($reginfo['uname']) || empty($reginfo['uname'])) {
            $Error = $this->__('You must provide a user name.');
        } elseif (mb_strlen($reginfo['uname']) > 25) {
            $Error = $this->__f('The user name you entered is too long. The maximum length is %1$d characters.', array(25));
        } elseif (!System::varValidate($reginfo['uname'], 'uname')) {
            $Error = $this->__('The user name you entered contains unacceptable characters. A valid user name consists of lowercase letters, numbers, underscores, periods, and/or dashes.');
        } else {
            $tempValid = true; 
            $illegalUserNames = ModUtil::getVar('Users', 'reg_Illegalusername');
                if (!empty($illegalUserNames)) {
                    $pattern = array('/^(\s*,\s*|\s+)+/D', '/\b(\s*,\s*|\s+)+\b/D', '/(\s*,\s*|\s+)+$/D');
                    $replace = array('', '|', '');
                    $illegalUserNames = preg_replace($pattern, $replace, preg_quote($illegalUserNames, '/'));
                    if (preg_match("/^({$illegalUserNames})/iD", $reginfo['uname'])) {
                        $Error = $this->__('The user name you entered is reserved. It cannot be used.');
                        $tempValid = false;
                    }
                }


        	if ($tempValid) {

        	$unameUsageCount = UserUtil::getUnameUsageCount($reginfo['uname'], $reginfo['uid']);

        	if ($unameUsageCount) {
                    $Error = $this->__('The user name you entered has already been registered.');
                    $tempValid = false;
                }
        	}
            unset($tempValid);
       }

	return $Error;
	}


	public function updateUsername($newuser)
	{
	/*
			$event = new GenericEvent($user, array(), new ValidationProviders());
            $this->getDispatcher()->dispatch('module.users.ui.validate_edit.modify_user', $event);
            $validators = $event->getData();

            $hook = new ValidationHook($validators);
            $this->dispatchHooks('users.ui_hooks.user.validate_edit', $hook);
            $validators = $hook->getValidators();

            if (!$errorFields && !$validators->hasErrors()) {
	 * 
	
	   */
	   // Get database setup
        $pntable = DBUtil::getTables();
        $userscolumn = $pntable['users_column'];
			
		$originalUserID = UserUtil::getVar('uid');
	  
       	if ($newuser) {
				  // UserUtil::setVar does not allow uname to be changed.
		          // UserUtil::setVar('uname', $user['uname'], $originalUser['uid']);
				  
            	  $object = array('uname' => $newuser);
            	  $where = "WHERE $userscolumn[uid] = $originalUserID";
                  DBUtil::updateObject($object, 'users', $where, 'uid');
				  
				  return true;
	   }
		
       return false;
	}
	
	
    /**
     * Get available user menu links.
     *
     * @return array An array of menu links.
     */
    public function getLinks()
    {

        $links = array();

        return $links;
    }

}
