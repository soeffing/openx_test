<?php

/*
+---------------------------------------------------------------------------+
| OpenX v2.8                                                                |
| ==========                                                                |
|                                                                           |
| Copyright (c) 2003-2009 OpenX Limited                                     |
| For contact details, see: http://www.openx.org/                           |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id: CampaignServiceImpl.php 81439 2012-05-07 23:59:14Z chris.nutting $
*/

/**
 * @package    OpenX
 * @author     Andriy Petlyovanyy <apetlyovanyy@lohika.com>
 *
 */

// Base class BaseLogonService
require_once MAX_PATH . '/www/api/v2/common/BaseServiceImpl.php';

// Campaign Dll class
// require_once MAX_PATH . '/lib/OA/Dll/Campaign.php';

/**
 * The CampaignServiceImpl class extends the BaseServiceImpl class to enable
 * you to add, modify, delete and search the campaign object.
 *
 */
class MaintenanceServiceImpl extends BaseServiceImpl
{
    /**
     *
     * @var OA_Dll_Campaign $_dllCampaign
     */
    // var $_dllCampaign;

    /**
     *
     * The CampaignServiceImpl method is the constructor for the CampignServiceImpl class.
     */
    function MaintenanceServiceImpl()
    {
        $this->BaseServiceImpl();
       // $this->_dllCampaign = new OA_Dll_Campaign();
    }

    function runMaintenance($sessionId)
    {      
    if ($this->verifySession($sessionId)) {

            return true;

        } else {

            return false;
        }
    }   

}


?>