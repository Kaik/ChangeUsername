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
 * The Account API provides links for modules on the "user account page"; this class provides them for the Users module.
 */
class ChangeUsername_Api_Account extends Zikula_AbstractApi
{
    /**
     * Return an array of items to show in the the user's account panel.
     *
     * @param mixed $args Not used.
     *
     * @return array Indexed array of items.
     */
    public function getAll($args)
    {
        $items = array();

        $items['0'] = array(
            'url'   => ModUtil::url($this->name, 'user', 'main'),
            'module'=> $this->name,
            'title' => $this->__('Change user name'),
            'icon'  => 'changename.png'
        );

        // Return the items
        return $items;
    }
}
