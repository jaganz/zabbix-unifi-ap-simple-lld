#!/usr/bin/php5 

<?php
/*REQUIRE: php-curl*/

  require('api/class.unifi.php');
  
  $USR    = 'ardasolutions';
  $PWD    = 'cepeivoob(oith';
  $URL    = 'https://192.168.0.151:8443';
  $SITE   = 'default';
  $UNIVER = '4.8.20';

  $curl_info  = curl_version();

/*START*/
  $site_id = $SITE;

  $unifidata = new unifiapi($USR, $PWD, $URL, $site_id, $UNIVER);
  $loginresults = $unifidata->login();
  if ($loginresults == 1) {
    $siteaps = $unifidata->list_aps();
    
    echo '{ "data":['."\n"; 
    for ($i = 0; $i < sizeof($siteaps); $i++){
      if ( $i == (sizeof($siteaps) - 1)) {
        echo '  { "{#APHNAME}" : "h_'. str_replace(' ', '', $siteaps[$i]->name) .'", "{#APNAME}" : "'. $siteaps[$i]->name .'", "{#APIP}" : "'. $siteaps[$i]->ip .'"}'."\n";
      }else{
        echo '  { "{#APHNAME}" : "h_'. str_replace(' ', '', $siteaps[$i]->name) .'", "{#APNAME}" : "'. $siteaps[$i]->name .'", "{#APIP}" : "'. $siteaps[$i]->ip .'"}'.",\n";
      }


    }
   echo ' ]'."\n";
   echo '}'."\n";
  }
  else {
     echo "NON FUNZIONO";
  }


  //STOP
  $logout_results = $unifidata->logout();
?>
