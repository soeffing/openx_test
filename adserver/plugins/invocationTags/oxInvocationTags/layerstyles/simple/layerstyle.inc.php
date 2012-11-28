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
$Id: layerstyle.inc.php 33995 2009-03-18 23:04:15Z chris.nutting $
*/

/*-------------------------------------------------------*/
/* Return misc capabilities                              */
/*-------------------------------------------------------*/



function MAX_layerGetLimitations() {



  $agent = $GLOBALS['_MAX']['CLIENT'];

  $compatible = $agent['browser'] == 'ie' && $agent['maj_ver'] < 5 ||
          $agent['browser'] == 'mz' && $agent['maj_ver'] < 1 ||
          $agent['browser'] == 'fx' && $agent['maj_ver'] < 1 ||
          $agent['browser'] == 'op' && $agent['maj_ver'] < 5
          ? false : true;

  //$richmedia  = $agent['platform'] == 'Win' ? true : false;
  $richmedia = true;

  return array (
    'richmedia'  => $richmedia,
    'compatible' => $compatible
  );
}



/*-------------------------------------------------------*/
/* Output JS code for the layer                          */
/*-------------------------------------------------------*/

function MAX_layerPutJs($output, $uniqid)
{
  global $align, $valign, $closetime, $padding;
  global $shifth, $shiftv, $closebutton;

  // Register input variables
  MAX_commonRegisterGlobalsArray(array('align', 'valign', 'closetime', 'padding',
               'shifth', 'shiftv', 'closebutton'));


  if (!isset($padding)) $padding = 0;
  if (!isset($shifth)) $shifth = 0;
  if (!isset($shiftv)) $shiftv = 0;
  if (!isset($closebutton)) $closebutton = 'f';

  // Calculate layer size (inc. borders)
  $layer_width = $output['width'] + 2 + $padding*2;
  $layer_height = $output['height'] + 2 + ($closebutton == 't' ? 11 : 0) + $padding*2;

   $margin_left = $output['width'] / 2 ;
   $margin_top = $output['height'] / 2 ;

?>

function MAX_findObj(n, d) {
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
  d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i>d.layers.length;i++) x=MAX_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MAX_getClientSize() {
  if (window.innerHeight >= 0) {
    return [window.innerWidth, window.innerHeight];
  } else if (document.documentElement && document.documentElement.clientWidth > 0) {
    return [document.documentElement.clientWidth,document.documentElement.clientHeight]
  } else if (document.body.clientHeight > 0) {
    return [document.body.clientWidth,document.body.clientHeight]
  } else {
    return [0, 0]
  }
}




function MAX_adlayers_place_<?php echo $uniqid; ?>()
{
  var top_div = MAX_findObj('Top_MAX_<?php echo $uniqid; ?>');
  var big_div = MAX_findObj('Big_MAX_<?php echo $uniqid; ?>');
    var layer_div = MAX_findObj('Layer_MAX_<?php echo $uniqid; ?>');

   if (!top_div)
     return false;
 
   _s='style'
 
  // var clientSize = MAX_getClientSize()
  // ih = clientSize[1]
  // iw = clientSize[0]

  if(document.all && !window.opera)
  {
  //  sl = document.body.scrollLeft || document.documentElement.scrollLeft;
    st = document.body.scrollTop || document.documentElement.scrollTop;
    of = 0;
  }
  else
  {
    //  sl = window.pageXOffset;
    var st = window.pageYOffset;

    if (window.opera)
      of = 0;
    else
      of = 16;
  }

    // opera & IE check

    top_div[_s].top = st+"px";
    big_div[_s].top = st+"px";

    var layer_height = layer_div[_s].height;
  
   // layer_div[_s].top = "50%";


   var half_layer_height = parseInt(layer_div[_s].height) / 2;

   layer_div[_s].top=  st + 40 + half_layer_height +"px";

   // st_layer = st + (layer_div[_s].height );

   // layer_div[_s].top = st_layer+"px";
   // alert(st);

//  c[_s].visibility = MAX_adlayers_visible_<?php echo $uniqid; ?>;
//    c[_s].display = MAX_adlayers_display_<?php echo $uniqid; ?>;
//    if (MAX_adlayers_display_<?php echo $uniqid; ?> == 'none') {
//        c.innerHTML = '&nbsp;';
//    }
}


// BEGIN OF OWN SCRIPT

 var top_div = document.getElementById('Top_MAX_<?php echo $uniqid; ?>');
 var big_div = document.getElementById('Big_MAX_<?php echo $uniqid; ?>');
 var layer_div = document.getElementById('Layer_MAX_<?php echo $uniqid; ?>');
 var duration = 1500; /* fade duration in millisecond */


 function Adooza_SetOpa(Opa) {
   top_div.style.opacity = Opa;
   layer_div.style.opacity = Opa;
 }

 function Adooza_big_div_SetOpa(Opa) {
   big_div.style.opacity = Opa;
 }

  function adooza_fadeOut(callback) {
    for (i = 0; i <= 1; i += 0.01) {
       setTimeout("Adooza_SetOpa(" + (1 - i) +")", i * duration);
       setTimeout("Adooza_big_div_SetOpa(" + (1 - i) +")", i * duration);
    }
    setTimeout("adooza_remove()", duration);
  }
 
  function adooza_remove(){
  
      big_div.parentNode.removeChild(big_div);
      layer_div.parentNode.removeChild(layer_div);
      top_div.parentNode.removeChild(top_div);
 }

  function adooza_fadeIn() {
    for (i = 0; i <= 1; i += 0.01) {
     setTimeout("Adooza_SetOpa(" + i +")", i * duration);
    }
   }

   function adooza_big_div_fadeIn() {
    for (i = 0; i <= 0.9; i += 0.01) {
     setTimeout("Adooza_big_div_SetOpa(" + i +")", i * duration);
    }
   }



// layer reloaded -> write html of Layer once the DOM is loaded

  // Backgroun big div

   big_div = document.createElement('div');    
   big_div.id = 'Big_MAX_<?php echo $uniqid ?>'; 
   big_div.style.borderTopWidth = '0px';   
   big_div.style.borderRightWidth = '0px';  
   big_div.style.borderBottomWidth = '0px';  
   big_div.style.borderLeftWidth = '0px';  
  // big_div.style.borderStyle = 'initial';   
  // big_div.style.borderColor = 'initial';   
  // big_div.style.borderImage = 'initial';   
   big_div.style.paddingTop = '0px';  
   big_div.style.paddingRight = '0px';   
   big_div.style.paddingBottom = '0px';   
   big_div.style.paddingLeft = '0px';   
   big_div.style.marginTop = '0px';   
   big_div.style.marginRight = '0px';   
   big_div.style.marginBottom = '0px';   
   big_div.style.marginLeft = '0px';  
   big_div.style.display = 'block';   
   big_div.style.right = '0px';  
   big_div.style.backgroundColor = 'rgb(0, 0, 0)';   
   big_div.style.zIndex = '100993';   
   big_div.style.top = '0px';   
   big_div.style.left = '0px';   
   big_div.style.position = 'absolute';  
   big_div.style.width = '100%';  
   big_div.style.opacity = '0';  
   big_div.style.height = '100%';   


  // Top Div - Balken

   var top_div = document.createElement('div'); 
   top_div.id = 'Top_MAX_<?php echo $uniqid ?>'; 
   top_div.style.paddingTop = '0px'; 
   top_div.style.paddingRight = '0px'; 
   top_div.style.paddingBottom = '0px';
   top_div.style.paddingLeft = '0px'; 
   top_div.style.marginTop = '0px';
   top_div.style.marginRight = '0px'; 
   top_div.style.marginBottom = '0px'; 
   top_div.style.marginLeft = '0px'; 
   top_div.style.borderTopWidth = '0px'; 
   top_div.style.borderRightWidth = '0px'; 
   top_div.style.borderLeftWidth = '0px'; 
  // top_div.style.borderStyle = 'initial'; 
  // top_div.style.borderColor = 'initial'; 
  // top_div.style.borderImage = 'initial'; 
   top_div.style.backgroundColor = 'transparent'; 
   top_div.style.borderBottomWidth = '0px'; 
   top_div.style.borderBottomStyle = 'solid'; 
   top_div.style.borderBottomColor = 'rgb(30, 30, 30)';  
   top_div.style.position= 'absolute'; 
   top_div.style.left= '0px'; 
   top_div.style.width= '100%'; 
   top_div.style.height= '42px'; 
   top_div.style.zIndex= '136579'; 
   top_div.style.top= '0px'; 
   top_div.style.opacity= '0';

   //left top div with "Adooza" link inside

   left_top_div = document.createElement('div'); 
   left_top_div.style.borderTopWidth = '0px'; 
   left_top_div.style.borderRightWidth = '0px'; 
   left_top_div.style.borderBottomWidth = '0px'; 
   left_top_div.style.borderLeftWidth = '0px'; 
 //  left_top_div.style.borderStyle = 'initial'; 
 //  left_top_div.style.borderColor = 'initial'; 
 //  left_top_div.style.borderImage = 'initial'; 
   left_top_div.style.marginTop = '0px'; 
   left_top_div.style.marginRight = '0px'; 
   left_top_div.style.marginBottom = '0px'; 
   left_top_div.style.marginLeft = '0px'; 
   left_top_div.style.paddingTop = '0px'; 
   left_top_div.style.paddingRight = '0px'; 
   left_top_div.style.paddingBottom = '0px'; 
   left_top_div.style.paddingLeft = '0px'; 
   left_top_div.style.textAlign = 'left'; 
   left_top_div.style.top = '10px'; 
   left_top_div.style.left = '8px'; 
   left_top_div.style.position = 'absolute'; 
   left_top_div.style.width = '200px'; 
   left_top_div.style.zIndex = '136837'; 

   // adooza Link

   var adooza_link = document.createElement('a');
   adooza_link.href='http://adooza.com'; 
   adooza_link.style.color = '#cfcfcf';
   adooza_link.style.font = 'bold 14px Verdana';
   adooza_link.style.textDecoration = 'none'; 
   adooza_link.target = '_blank';
   adooza_link.innerHTML = 'Adooza';

   // right top div with "close" link inside

   right_top_div = document.createElement('div'); 
   right_top_div.style.marginTop = '0px'; 
   right_top_div.style.marginRight = '0px'; 
   right_top_div.style.marginBottom = '0px'; 
   right_top_div.style.marginLeft = '0px'; 
   right_top_div.style.borderTopWidth = '0px'; 
   right_top_div.style.borderRightWidth = '0px'; 
   right_top_div.style.borderBottomWidth = '0px'; 
   right_top_div.style.borderLeftWidth = '0px'; 
 //  right_top_div.style.borderStyle = 'initial'; 
  // right_top_div.style.borderColor = 'initial'; 
  // right_top_div.style.borderImage = 'initial'; 
   right_top_div.style.paddingTop = '0px'; 
   right_top_div.style.paddingRight = '0px'; 
   right_top_div.style.paddingBottom = '0px'; 
   right_top_div.style.paddingLeft = '0px'; 
   right_top_div.style.textAlign = 'right'; 
   right_top_div.style.position = 'absolute'; 
   right_top_div.style.zIndex = '149784'; 
   right_top_div.style.right = '8px'; 
   right_top_div.style.width = '200px'; 
   right_top_div.style.top = '10px';

   // close link

   var close_link = document.createElement('a');
   close_link.href='javascript:void(0)';  
   
   close_link.style.color = '#cfcfcf';
   close_link.style.font = 'bold 14px Verdana';
   close_link.style.textDecoration = 'none';
   close_link.innerHTML =  'CLOSE X';
   close_link.onclick= function(){ Adooza_Interstitial_<?php echo $uniqid ?> ('close'); } 

  // LayerAd Div
   var layer_div = document.createElement('iframe');  
   layer_div.id = 'Layer_MAX_<?php echo $uniqid ?>'; // id=Layer_MAX_.$uniqid. 
   layer_div.style.backgroundColor = 'rgb(255, 255, 255)'; 
   layer_div.style.marginRight = '0px';
   layer_div.style.marginBottom = '0px'; 
   layer_div.style.position = 'absolute'; 
   layer_div.style.top = '50%';
   layer_div.style.marginTop = '-<?php echo $margin_top ?>px'; 
   layer_div.style.left = '50%'; 
   layer_div.style.marginLeft = '-<?php echo $margin_left ?>px'; 
   layer_div.style.paddingTop = '0px'; 
   layer_div.style.paddingRight = '0px';
   layer_div.style.paddingBottom = '0px';
   layer_div.style.paddingLeft = '0px'; 
   layer_div.style.width = '<?php echo $output['width'] ?>px';
   layer_div.style.borderTopWidth = '0px';
   layer_div.style.borderRightWidth = '0px'; 
   layer_div.style.borderBottomWidth = '0px'; 
   layer_div.style.borderLeftWidth = '0px'; 
  // layer_div.style.borderStyle = 'initial'; 
  // layer_div.style.borderColor = 'initial'; 
  // layer_div.style.borderImage = 'initial';
   layer_div.style.height = '<?php echo $output['height'] ?>px';
   layer_div.style.zIndex = '600000'; 
   layer_div.style.opacity = '0';
  layer_div.src ='<?php echo $GLOBALS['contenturl'] ?>';
   layer_div.scrolling = 'no';
   
   
   // appending all the document

   left_top_div.appendChild(adooza_link);
  // 
   top_div.appendChild(left_top_div);
   top_div.appendChild(right_top_div);
  

kick_off = function() {
               
       
                 
                Adooza_Interstitial_<?php echo $uniqid; ?> = function MAX_simplepop_<?php echo $uniqid; ?>(what) {
                   
                 // var c = MAX_findObj('Top_MAX_<?php echo $uniqid; ?>');
               
                 // if (!c)
                //   return false;
               
               //  if (c.style)
              //     c = c.style;
               
                 switch(what)
                 {
                   case 'close':
                       adooza_fadeOut();
                      
                           // div_beacon = document.createElement('div');
                           // div_beacon.id = 'beacon_<?php echo $GLOBALS['random'] ?>';
                           // div_beacon.style.position = 'absolute';
                           // div_beacon.style.left = '0px';
                           // div_beacon.style.top = '0px';
                           // div_beacon.style.visibility = 'hidden';

                         // log_imp = document.createElement('img');
                         // log_imp.id = 'adooza_logging_beacon'
                         // log_imp.style.height = '0px';
                         // log_imp.style.width = '0px';
                         // log_imp.src = '<?php echo $GLOBALS['logUrl_Layer'] ?> ';
                         // log_imp.style.position = 'absolute';
                         // log_imp.style.visibility = 'hidden';
                         // div_beacon.appendChild(log_imp);
                         // document.body.appendChild(div_beacon);

                     window.clearInterval(MAX_adlayers_timerid_<?php echo $uniqid; ?>);
                     break;
               
                   case 'open':
                        document.body.appendChild(big_div);
                        document.body.appendChild(layer_div);
                        document.body.appendChild(top_div);
                        adooza_fadeIn();
                        adooza_big_div_fadeIn();
                        setTimeout("right_top_div.appendChild(close_link);", 2500);
                        // setTimeout("adooza_big_div_fadeIn()", 1000);
                           // alert('open');
                       // call popup now to avoid popup blocker
                       
               
                     MAX_adlayers_timerid_<?php echo $uniqid; ?> = window.setInterval('MAX_adlayers_place_<?php echo $uniqid; ?>()', 10);
               
                        <?php
                        
                        if (isset($closetime) && $closetime > 0)
                          echo "\t\t\treturn window.setTimeout('MAX_simplepop_".$uniqid."(\\'close\\')', ".($closetime * 1000).");";
                        
                        ?>
                        
                              break;
                 }
                   }

                Adooza_Interstitial_<?php echo $uniqid; ?>('open');
              
               
    
   
};

// var test = alert('sksks');
// //
// //window.onload = test;
// //window.onunload = alert('unload');
// 
// // addLoadEvent(function(){alert('loaded');});
// 
// 
 function addLoadEvent(func) {
   if (window.addEventListener)
     window.addEventListener("load", func, false);
   else if (window.attachEvent)
     window.attachEvent("onload", func);
   else { // fallback
     var old = window.onload;
     window.onload = function() {
       if (old) old();
       func();
     };
   }
 }
// 

// addLoadEvent(kick_off);

function contentLoaded(win, fn) {

        var done = false, top = true,

        doc = win.document, root = doc.documentElement,

        add = doc.addEventListener ? 'addEventListener' : 'attachEvent',
        rem = doc.addEventListener ? 'removeEventListener' : 'detachEvent',
        pre = doc.addEventListener ? '' : 'on',

        init = function(e) {
                if (e.type == 'readystatechange' && doc.readyState != 'complete') return;
                (e.type == 'load' ? win : doc)[rem](pre + e.type, init, false);
                if (!done && (done = true)) fn.call(win, e.type || e);
        },

        poll = function() {
                try { root.doScroll('left'); } catch(e) { setTimeout(poll, 50); return; }
                init('poll');
        };

        if (doc.readyState == 'complete') fn.call(win, 'lazy');
        else {
                if (doc.createEventObject && root.doScroll) {
                        try { top = !win.frameElement; } catch(e) { }
                        if (top) poll();
                }
                doc[add](pre + 'DOMContentLoaded', init, false);
                doc[add](pre + 'readystatechange', init, false);
                win[add](pre + 'load', init, false);
        }

}


contentLoaded(window, kick_off)

// DEFINING VARIABLES FOR INTERSTITIAL


// END OF SCRIPT

 var MAX_adlayers_timerid_<?php echo $uniqid; ?>;
 var MAX_adlayers_display_<?php echo $uniqid; ?>;
// var MAX_adlayers_visible_<?php echo $uniqid; ?>;

// MAX_simplepop_<?php echo $uniqid; ?>('open');
<?php
}



/*-------------------------------------------------------*/
/* Return HTML code for the layer                        */
/*-------------------------------------------------------*/

function MAX_layerGetHtml($output, $uniqid)
{
  global $target;
  global $align, $padding, $closebutton;
  global $backcolor, $bordercolor;
  global $nobg, $noborder;

  $conf = $GLOBALS['_MAX']['CONF'];

  // Register input variables
  MAX_commonRegisterGlobalsArray(array('align', 'padding', 'closebutton',
               'backcolor', 'bordercolor',
               'nobg', 'noborder'));


  if (!isset($padding)) $padding = '2';
  if (!isset($closebutton)) $closebutton = 'f';
  if (!isset($backcolor)) $backcolor = 'FFFFFF';
  if (!isset($bordercolor)) $bordercolor = '000000';
  if (!isset($nobg)) $nobg = 'f';
  if (!isset($noborder)) $noborder = 'f';


   $margin_left = $output['width'] / 2 ;
   $margin_top = $output['height'] / 2 ;
     $frame_height = $output['height'] + 22;
     $frame_width = $output['width'] + 22;
     $layer_width = $output['width'];
     $layer_height = $output['height'];

  // Calculate layer size (inc. borders)
  // $layer_width = $output['width'] + 2 + $padding*2;
  // $layer_height = $output['height'] + 2 + ($closebutton == 't' ? 11 : 0) + $padding*2;

  // Create imagepath
  $imagepath = 'http://' . $conf['webpath']['images'] . '/layerstyles/simple/';

  // return HTML code
  return '

       <style type="text/css">
          
         #Big_MAX_'.$uniqid.' {
           background: black;
           background-image: -webkit-gradient(radial, 50% 50%, 0, 45px 45px, 30, color-stop(33.333%, #00ffff), color-stop(100%, #1e90ff));
           background-image: -webkit-radial-gradient(circle, white, black);
           background-image: -moz-radial-gradient(circle, white, black);
           background-image: -o-radial-gradient(circle, white, black);
           background-image: -ms-radial-gradient(circle, white, black);
           background-image: radial-gradient(circle, white, black);
         
           // background-image: -webkit-radial-gradient(50% 50%, #000 80%, #1e90ff 30px);
           // background-image: -webkit-radial-gradient(circle, white 5px, black);
           // background-image: -moz-radial-gradient(50% 50%, #000 80%, #1e90ff 30px);
           // background-image: -o-radial-gradient(50% 50%, #000 80%, #1e90ff 30px);
           // background-image: -ms-radial-gradient(50% 50%, #000 80%, #1e90ff 30px);
           // background-image: radial-gradient(50% 50%, #000 80%, #1e90ff 30px);
          }  
         
         
         </style>

';


}

?>