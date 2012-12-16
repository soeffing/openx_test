<?php

/*
+---------------------------------------------------------------------------+
| OpenX v2.8                                             |
| ==========                            |
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
$Id: CampaignXmlRpcService.php 81439 2012-05-07 23:59:14Z chris.nutting $
*/

/**
 * @package    OpenX
 * @author     Andriy Petlyovanyy <apetlyovanyy@lohika.com>
 *
 * The campaign XML-RPC service enables XML-RPC communication with the campaign object.
 *
 */

// Require the initialisation file.
// require_once '../../../../init.php';

// Require the XML-RPC classes.
// require_once MAX_PATH . '/lib/pear/XML/RPC/Server.php';

// Require the base class, BaseCampaignService.
 require_once MAX_PATH . '/www/api/v2/common/BaseMaintenanceService.php';

// Require the XML-RPC utilities.
 require_once MAX_PATH . '/www/api/v2/common/XmlRpcUtils.php';

// Require the CampaignInfo helper class.
// require_once MAX_PATH . '/lib/OA/Dll/Campaign.php';


/**
 * The CampaignXmlRpcService class extends the BaseCampaignService class.
 *
 */
class MaintenanceXmlRpcService extends BaseMaintenanceService
{
    /**
     * The CampaignXmlRpcService constructor calls the base service constructor
     * to initialise the service.
     *
     */
    // function CampaignXmlRpcService()
    // {
        // $this->BaseCampaignService();
    // }

    /**
     * The addCampaign method adds details for a new campaign to the campaign
     * object and returns either the campaign ID or an error message.
     *
     * @access public
     *
     * @param XML_RPC_Message &$oParams
     *
     * @return generated result (data or error)
     */
    function runMaintenance($sessionId)
    {   

     if ($this->_oMaintenanceServiceImp->runMaintenance($sessionId)) {
            return XmlRpcUtils::integerTypeResponse(5);
        } else {
            // shell_exec('ls -l\n');
            exec('php ../../../../scripts/maintenance/maintenance.php');
           // return XmlRpcUtils::stringTypeResponse($new_path);
        }

    }

    
}

?>
