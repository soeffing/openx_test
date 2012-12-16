<?php

/*
+---------------------------------------------------------------------------+
| OpenX v${RELEASE_MAJOR_MINOR}                                                                |
| =======${RELEASE_MAJOR_MINOR_DOUBLE_UNDERLINE}                                                                |
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
$Id$
*/

// Require the initialisation file
require_once '../../init-delivery.php';

// Required files
require_once MAX_PATH . '/lib/max/Delivery/adSelect.php';
require_once MAX_PATH . '/lib/max/Delivery/flash.php';
require_once MAX_PATH . '/lib/max/Delivery/cache.php';

MAX_commonSendContentTypeHeader('text/html');

//Register any script specific input variables
MAX_commonRegisterGlobalsArray(array('timeout'));
$timeout  = !empty($timeout) ? $timeout : 0;

if ($zoneid > 0) {
    // Get the zone from cache
    $aZone = MAX_cacheGetZoneInfo($zoneid);
} else {
    // Direct selection, or problem with admin DB
    $aZone = array();
    $aZone['zoneid'] = $zoneid;
    $aZone['append'] = '';
    $aZone['prepend'] = '';
}

// Get the banner from cache
$aBanner = MAX_cacheGetAd($bannerid);
// add the zone capping info in the $aZone array to the $aBanner array 
// so it can be included into the log url for correct capping in the function function _adRenderBuildLogURL
// 'block_zone' => '120', 'cap_zone' => '2', 'session_cap_zone' => '0', 'zoneid' => 71

// -> this can be found in the _adSelectCommon function in al.php
// the info here ensures proper zone capping

// $aLinkedAd['zoneid'] = $zoneId;
// $aLinkedAd['bannerid'] = $aLinkedAd['ad_id'];
// $aLinkedAd['storagetype'] = $aLinkedAd['type'];
// $aLinkedAd['campaignid'] = $aLinkedAd['placement_id'];
// $aLinkedAd['zone_companion'] = $aZoneLinkedAdInfos['zone_companion'];
// $aLinkedAd['block_zone'] = @$aZoneInfo['block_zone'];
// $aLinkedAd['cap_zone'] = @$aZoneInfo['cap_zone'];
// $aLinkedAd['session_cap_zone'] = @$aZoneInfo['session_cap_zone'];
// $aLinkedAd['affiliate_id'] = @$aZoneInfo['publisher_id'];

$aBanner['zoneid'] = $aZone['zone_id'];
$aBanner['bannerid'] = $aBanner['ad_id'];
$aBanner['storagetype'] = $aBanner['type'];
$aBanner['campaignid'] = $aBanner['placement_id'];
$aBanner['zone_companion'] = FALSE;
$aBanner['block_zone'] = $aZone['block_zone'];
$aBanner['cap_zone'] = $aZone['cap_zone'];
$aBanner['session_cap_zone'] = $aZone['session_cap_zone'];


$prepend = !empty($aZone['prepend']) ? $aZone['prepend'] : '';
$html = MAX_adRender($aBanner, $zoneid, $source, $target, $ct0, $withtext);
$append = !empty($aZone['append']) ? $aZone['append'] : '';


// trying to set cookies at the end
// MAX_cookieFlush();

// replace the macros


// usually called in Max_adselect but 
$GLOBALS['ULI']['OAID'] = MAX_cookieGetUniqueViewerID();

$search = array('{timestamp}','{random}','{target}','{url_prefix}','{bannerid}','{zoneid}','{source}', '{pageurl}', '{width}', '{height}', '{websiteid}', '{campaignid}', '{advertiserid}', '{referer}', '{OAID}', '{pageViewId}');
$replace = array($time, $GLOBALS['ULI']['random'] , $target, $urlPrefix, $aBanner['ad_id'], $zoneid, $source,  $GLOBALS['loc'], $aBanner['width'], $aBanner['height'], $websiteid, $aBanner['campaign_id'], $aBanner['client_id'], $referer, $GLOBALS['ULI']['OAID']  ,$GLOBALS['ULI']['random']);

$append = str_replace($search, $replace, $append);


$title = !empty($aBanner['alt']) ? $aBanner['alt'] : 'Ad by Adooza';
echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<title>$title</title>";
if ($timeout > 0) {
$timeoutMs = $timeout * 1000;
echo "
<script type='text/javascript'>
<!--// <![CDATA[
  window.setTimeout(\"window.close()\",$timeoutMs);
// ]]> -->
</script>";
}
if ($aBanner['contenttype'] == 'swf') {
echo MAX_flashGetFlashObjectExternal();
}
echo "
<style type='text/css'>
body {margin:0; height:100%; width:100%}
</style>
</head>
<body>
{$prepend}{$html}{$append}
</body>
</html>";

?>