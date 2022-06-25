<?php
/*
 * Plugin Name: WPDEFT MEDIA SCAPE
 * Version: 1.0
 * Plugin URI: https://wpdeft.com/
 * Description: Add email attachments
 * Author: MOHAMMAD
 * Author URI: https://wpdeft.com/
 */


function test_phpmailer_init( $phpmailer )
{
	
    
    return $phpmailer;
}
//add_action( 'phpmailer_init', 'test_phpmailer_init' );
//add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors( $wp_error ){
  echo '<pre>';
        print_r($wp_error);
    echo '</pre>';
}
        function wpdeft_remove_attachment( $parms ) { 


          

      if ( count($parms['attachments']) && (stripos( $parms['attachments'][0], 'WP_Estimation_Form')) )  {
        
        $path_1 =  explode('/wp-content/',$parms['attachments'][0]);
        
        $file_name = basename($parms['attachments'][0], ".pdf");
        
        $file_name_new = str_replace(' ','-',$file_name).'.pdf';
        
        $new_file_path = dirname($parms['attachments'][0]).'/'.$file_name_new;
        
        $file_url = get_site_url().'/wp-content/'.$path_1[1];
        
        copy($parms['attachments'][0],$new_file_path);
        
        $path_2 =  explode('/wp-content/',$new_file_path);
        
        $new_file_url = get_site_url().'/wp-content/'.$path_2[1];

        $parms['content'] =  $parms['content'].'<br> Attached Invoice -: '.$new_file_url;

        unset($parms['attachments']);
      }
      return $parms;
    }
    add_filter('wp_mail', 'wpdeft_remove_attachment',10,1);


        