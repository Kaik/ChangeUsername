<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Zikula
 * @subpackage Users
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Access to (non-administrative) user-initiated actions for the Users module.
 *
 * Note: $this->throw...() functions are not used because they hide where the
 * exception actually happened. (The exception thrown in the superclass is recorded
 * as the file and line were the exception occurred.
 */
class ChangeUsername_Controller_User extends Zikula_AbstractController
{
    /**
     * Post initialise.
     *
     * Run after construction.
     *
     * @return void
     */
    protected function postInitialize()
    {
        // Disable caching by default.
        $this->view->setCaching(Zikula_View::CACHE_DISABLED);
    }

    /**
     * Render and display the user's account panel. If he is not logged in, then redirect to the login screen.
     *
     * @return string The rendered template.
     *
     * @throws Zikula_Exception_Forbidden if the current user does not have adequate permissions to perform
     *          this function.
     */
    public function main()
    {
        // Security check
        $this->redirectUnless(UserUtil::isLoggedIn(), ModUtil::url($this->name, 'user', 'login', array('returnpage' => urlencode(ModUtil::url($this->name, 'user', 'main')))));

        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_READ)) {
            throw new Zikula_Exception_Forbidden();
        }

        return $this->view->fetch('changeusername_user_main.tpl');
    }
	
	    /**
     * Update the username.
     *
     * Parameters passed via GET:
     * --------------------------
     * None.
     *
     * Parameters passed via POST:
     * ---------------------------
     * string newemail      The new e-mail address to store for the user.
     * string newemailagain The new e-mail address repeated for verification.
     *
     * Parameters passed via SESSION:
     * ------------------------------
     * None.
     *
     * @return bool True on success, otherwise false.
     */
    public function updateuname()
    {
        if (!UserUtil::isLoggedIn()) {
            throw new Zikula_Exception_Forbidden();
        }

        $this->checkCsrfToken();

        $uid = UserUtil::getVar('uid');

        $newname = $this->request->request->get('newname', '');

        $unameError = ModUtil::apiFunc($this->name, 'user', 'getUserNameErrors', array(
            'uid'           => $uid,
            'uname'         => $newname
        ));


        if (!empty($unameError)) {
            $this->registerError($unameError); 
            $this->redirect(ModUtil::url($this->name, 'user', 'main'));
        }

        // save 
        $ok = ModUtil::apiFunc($this->name, 'user', 'updateUsername',$newname);

        if (!$ok) {
            $this->registerError($this->__('Error! There was a problem saving your new user name'))
                    ->redirect(ModUtil::url($this->name, 'user', 'main'));
        }

        $this->registerStatus($this->__f('Done! Your new user name is %s', array($newname)))
                ->redirect(ModUtil::url('Users', 'user', 'main'));
    }
	
	
}