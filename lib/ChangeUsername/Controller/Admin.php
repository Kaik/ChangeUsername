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
 * Administrator-initiated actions for the Users module.
 */
class ChangeUsername_Controller_Admin extends Zikula_AbstractController
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
     * Redirects users to the "view" page.
     *
     * @return string HTML string containing the rendered view template.
     */
    public function main()
    {
        // Security check will be done in view()
        $this->redirect(ModUtil::url($this->name, 'admin', 'view'));
    }

    /**
     * Shows all items and lists the administration options.
     *
     * Parameters passed via GET:
     * --------------------------
     * numeric startnum The ordinal number at which to start displaying user records.
     * string  letter   The first letter of the user names to display.
     * string  sort     The field on which to sort the data.
     * string  sortdir  Either 'ASC' for an ascending sort (a to z) or 'DESC' for a descending sort (z to a).
     *
     * Parameters passed via POST:
     * ---------------------------
     * None.
     *
     * Parameters passed via SESSION:
     * ------------------------------
     * None.
     *
     * @return string HTML string containing the rendered template.
     *
     * @throws Zikula_Exception_Forbidden Thrown if the current user does not have moderate access, or if the method of accessing this function is improper.
     */
    public function view()
    {
        if (!SecurityUtil::checkPermission('ChangeUsername::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }


        // Assign the items to the template & return output
        return $this->view->fetch('changeusername_admin_modify.tpl');
    }

}
