<?php
   /*
   Plugin Name: Exhibition Printer
   Plugin URI: http://dbis.rwth-aachen.de/cms
   Description: A plugin to help printing posts with cover page and table of contents using Google Cloud Print service
   Version: 0.1
   Author: Adam Gavronek
   Author URI: gavronek@dbis.rwth-aachen.de
   */
  /**
   * Code contributed to the Learning Layers project
   * http://www.learning-layers.eu
   * Development is partly funded by the FP7 Programme of the European Commission under
   * Grant Agreement FP7-ICT-318209.
   * Copyright (c) 2014, RWTH Aachen University.
   * For a list of contributors see the AUTHORS file at the top-level directory of this distribution.
   *
   * Licensed under the Apache License, Version 2.0 (the "License");
   * you may not use this file except in compliance with the License.
   * You may obtain a copy of the License at
   *
   * http://www.apache.org/licenses/LICENSE-2.0
   *
   * Unless required by applicable law or agreed to in writing, software
   * distributed under the License is distributed on an "AS IS" BASIS,
   * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   * See the License for the specific language governing permissions and
   * limitations under the License.
  */
  
function exhib_print() {
    if( isset( $_POST['doprint'] ) && $_POST['doprint'] == true ) {
      $print_jobs = [];

      //Get user's name
      global $current_user;
      get_currentuserinfo();
      $name = $current_user->display_name;

      //Enqueue cover page
      $print_jobs[0]["url"] = plugins_url( 'cover.php' , __FILE__ )."?name=" . $name;
      $print_jobs[0]["title"] = "Cover page";
      $print_jobs[0]["type"] = "url";

      //Enqueue table of contents page
      $tableofcontents = "";
      foreach (wpfp_get_users_favorites() as $post_id) {
        $productname = get_the_title($post_id);
        $tableofcontents .= $productname . ";";
      }

      $print_jobs[1]["url"] = plugins_url( 'tableofcontents.php' , __FILE__ )."?name=" . $name . "&content=" . $tableofcontents;
      $print_jobs[1]["title"] = "Table of contents";
      $print_jobs[1]["type"] = "url";

      //Enqueue favorite items
      $counter = 2;
      foreach (wpfp_get_users_favorites() as $post_id) {
        $print_jobs[$counter]["url"] = get_permalink($post_id);
        $print_jobs[$counter]["title"] = get_the_title($post_id);
        $print_jobs[$counter]["type"] = "url";
        $counter++;
      }

      print_with_google($print_jobs);
    }
}

function print_with_google($data_to_print) {
  $email = "rwth.acis.alice@gmail.com";
  $pw = "54321#pcb";
  require_once 'GoogleCloudPrint.php';
  $gcp = new GoogleCloudPrint();
   // Login to Google, email address and password is required
   if($gcp->loginToGoogle($email, $pw)) {
       // Login is successfull so now fetch printers
       $printers = $gcp->getPrinters();      
       $printerid = "";
       if(count($printers)==0) {         
           return "no_printers";
       }
       else {
           // Print directly to google docs
           $printerid = '__google__docs'; //Print to GDocs	   
	   //$printerid = '7883402d-dadc-a960-c9a6-0727ed4964f8'; //Print to HP4700
       }

       // Send documents to the printer
       // Save data as $data_to_print[i]['title'] && $data_to_print[i]['url']
       foreach ($data_to_print as $printjob) {
           $resarray = $gcp->sendPrintToPrinter($printerid, $printjob['title'], $printjob['url'], $printjob['type']);
       }
       
       if($resarray['status']==true) {
           return 'ok';
       }
       else {
           return 'printing_failed';
       }       
   }
   else {
       return 'login_failed';
   }
   return 'unexepected';
}
add_action( 'init', 'exhib_print' );

function sButton() {
   //$link = plugins_url( 'exhibition_printer.php' , __FILE__ );
   $link = get_permalink();
   return '<form method="post" action="'.$link.'"><input type="hidden" name="doprint" value="true"><input type="submit" value="Print" style="margin-left: 30px;"></form>';
}
add_shortcode('ex_print_button', 'sButton');

?>