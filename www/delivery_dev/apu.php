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

// No Caching
MAX_commonSetNoCacheHeaders();

//Register any script specific input variables
MAX_commonRegisterGlobalsArray(
    array(
        'left',
        'top',
        'popunder',
        'timeout',
        'delay',
        'toolbars',
        'location',
        'menubar',
        'status',
        'resizable',
        'scrollbars'
    )
);

// Set defaults for script specific input variables
if (!isset($left))       $left       = 0;
if (!isset($top))        $top        = 0;
if (!isset($popunder))   $popunder   = 0;
if (!isset($timeout))    $timeout    = 0;
if (!isset($delay))      $delay      = 0;
if (!isset($toolbars))   $toolbars   = 0;
if (!isset($location))	 $location   = 0;
if (!isset($menubar))	 $menubar    = 0;
if (!isset($status))	 $status     = 0;
if (!isset($resizable))  $resizable  = 0;
if (!isset($scrollbars)) $scrollbars = 0;

// Get the banner
$row = MAX_adSelect($what, $campaignid, $target, $source, $withtext, $charset, $context, true, $ct0, $GLOBALS['loc'], $GLOBALS['referer']);

// trying to set cookies at the end -> definitely necessary necessary anymore!!!!  (UPDATES the capping cookies...very essential!!!!)
MAX_cookieFlush();

$row['zoneid'] = 0;
if (isset($zoneid)) {
    $row['zoneid'] = $zoneid;
}

// Do not pop a window if not banner was found..
if (!$row['bannerid']) {
    exit;
}

$contenturl = MAX_commonGetDeliveryUrl($conf['file']['content']) . "?bannerid={$row['bannerid']}&zoneid={$row['zoneid']}&target={$target}&withtext={$withtext}&source=".urlencode($source)."&timeout={$timeout}&ct0={$ct0}";

/*-------------------------------------------------------*/
/* Build the code needed to pop up a window              */
/*-------------------------------------------------------*/

$contenturl = MAX_commonGetDeliveryUrl($conf['file']['content']) . "?bannerid={$row['bannerid']}&zoneid={$row['zoneid']}&target={$target}&withtext={$withtext}&source=".urlencode($source)."&timeout={$timeout}&ct0={$ct0}";
MAX_commonSendContentTypeHeader("application/x-javascript");
echo "
var MAX_errorhandler = null;

if (window.captureEvents && Event.ERROR)
  window.captureEvents (Event.ERROR);

// Error handler to prevent 'Access denied' errors
function MAX_onerror(e) {
  window.onerror = MAX_errorhandler;
  return true;
}

function MAX_{$row['bannerid']}_pop() {
  MAX_errorhandler = window.onerror;
  window.onerror = MAX_onerror;

  
  // Open the window if needed
  //window.MAX_{$row['bannerid']}=window.open('$contenturl', 'MAX_{$row['bannerid']}', 'height='+{$row['height']}+', width='+{$row['width']}+', toolbar=".($toolbars == 1 ? 'yes' : 'no').",location=".($location == 1 ? 'yes' : 'no').",menubar=".($menubar == 1 ? 'yes' : 'no').",status=".($status == 1 ? 'yes' : 'no').",resizable=".($resizable == 1 ? 'yes' : 'no').",scrollbars=".($scrollbars == 1 ? 'yes' : 'no')."');
 // window.MAX_{$row['bannerid']}.resizeTo(1200 , 2500);
 

  ADOOZA_CONTENTURL = '$contenturl';
  ADOOZA_POP_HEIGHT = '{$row['height']}';
  ADOOZA_POP_WIDTH =  '{$row['width']}';
}


function MAX_{$row['bannerid']}_regular_pop() {
  MAX_errorhandler = window.onerror;
  window.onerror = MAX_onerror;

  ADOOZA_CONTENTURL = '$contenturl';
  ADOOZA_POP_HEIGHT = '{$row['height']}';
  ADOOZA_POP_WIDTH =  '{$row['width']}';
  
  if (adooza_counter<2) {
  adooza_counter = 2;
   var adooza_pop = window.open(ADOOZA_CONTENTURL, '', 'height='+ADOOZA_POP_HEIGHT+', width='+ADOOZA_POP_WIDTH+', scrollbars=1' );
   adooza_pop.blur();
   window.focus();
 }

}";

//echo "
//    MAX_{$row['bannerid']}.location='$contenturl';";


if ($GLOBALS['combi'] == 1) {
     
   echo "MAX_{$row['bannerid']}_pop();";

}

else 

{

   echo "

   function addEventHandler(elem,eventType,handler) {
     if (elem.addEventListener)
       elem.addEventListener (eventType,handler,false);
     else if (elem.attachEvent)
       elem.attachEvent ('on'+eventType,handler); 
}

   var d = document;
   sEventType = 'click';
   adooza_counter = 1;
   addEventHandler(d,sEventType,MAX_{$row['bannerid']}_regular_pop);
   

   ";

}

// xdebug_stop_trace();

?>
