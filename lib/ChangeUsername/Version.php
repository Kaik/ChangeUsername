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
 * Provides metadata for this module to the Extensions module.
 */
class ChangeUsername_Version extends Zikula_AbstractVersion
{
    /**
     * Assemble and return module metadata.
     *
     * @return array Module metadata.
     */
    public function getMetaData()
    {
        return array(
            // Be careful about version numbers. version_compare() is used to handle special situations.
            // 0.9 < 0.9.0 < 1 < 1.0 < 1.0.1 < 1.2 < 1.18 < 1.20 < 2.0 < 2.0.0 < 2.0.1
            // From this version forward, please use the major.minor.point format below.
            'version'       => '1.0.0',

            'displayname'   => $this->__('ChangeUsername'),
            'description'   => $this->__('Provides an interface for configuring and administering registered user accounts. Incorporates all needed functionality, but can work in close unison with the third party profile module configured in the general settings of the site.'),

            // Module name that appears in URL
            'url'           => $this->__('changeusername'),

            // Dependencies
            'core_min'      => '1.3.0',

            // Security Schema
            'securityschema'=> array(
                'ChangeUsername::'           => 'Uname::User ID'
            ),
        );
    }

    /**
     * Define the hook bundles supported by this module.
     *
     * @return void
     */
    protected function setupHookBundles()
    {
        // Subscriber bundles
	}
}
