<?php
/*********************global functions to be accessed in all pages**/
function set_msg($msg,$type=null){
   $_SESSION['msg'] = $msg;
   $_SESSION['type'] = $type;//success,warning,danger
}//end set_msg()
 
function get_msg(){
    if($_SESSION['msg']){
      $type = isset($_SESSION['type'])?$_SESSION['type']:'success';
      echo '<div class="alert alert-'.$type.'">';
        echo $_SESSION['msg'];
      echo '</div>';
      //now remove msg & type from session
      unset($_SESSION['msg']);
      unset($_SESSION['type']);
    }//endif isset session[msg]
}//end get_msg()
?>