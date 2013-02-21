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
 * Access to actions initiated through AJAX for the Users module.
 */
class ChangeUsername_Controller_Ajax extends Zikula_Controller_AbstractAjax
{
    /**
     * Performs a user search based on the user name fragment entered so far.
     *
     * Parameters passed via POST:
     * ---------------------------
     * string fragment A partial user name entered by the user.
     *
     * @return string Zikula_Response_Ajax_Plain with list of users matching the criteria.
     */
    public function getUsers()
    {
        $this->checkAjaxToken();
        $view = Zikula_View::getInstance($this->name);

        if (SecurityUtil::checkPermission('Users::', '::', ACCESS_MODERATE)) {
            $fragment = $this->request->query->get('fragment', $this->request->request->get('fragment'));

            ModUtil::dbInfoLoad($this->name);
            $tables = DBUtil::getTables();

            $usersColumn = $tables['users_column'];

            $where = 'WHERE ' . $usersColumn['uname'] . ' REGEXP \'(' . DataUtil::formatForStore($fragment) . ')\'';
            $results = DBUtil::selectObjectArray('users', $where);

            $view->assign('results', $results);
        }

        $output = $view->fetch('users_ajax_getusers.tpl');

        return new Zikula_Response_Ajax_Plain($output);
    }
}
