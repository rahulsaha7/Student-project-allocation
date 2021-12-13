<?php

//d033e22ae348aeb5660fc2140aec35850c4da997

require_once '../../Include/init.php';

session_start();


function logout(){
   if(isset($_SESSION['auth-user'])){
       unset($_SESSION['auth-user']);
       echo "success";
   }
}


function check_user($user_id,$pass,$pass2 ){

   $sql = "SELECT * from auth where username = '$user_id' ";

   

   $db = new database();

   $db->query($sql);

   if($db->sql_query->rowCount() > 0){
      $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);

      // echo $result[0]['password'];
      // echo ($pass);


      if($pass == $result[0]['password']){

         
       /*  if($checkme == "true"){
            
            
            $cookie_name =$user_id;
            $cookie_value = $pass2;
            
            // setcookie("username",$cookie_name,time(),+600,"/"," ",true);

            if(isset($_COOKIE['username'])){
               // setcookie("passw",$cookie_value,time()+600,"/","",true);
               $_SESSION['auth-user'] = $user_id;
               echo "success";
           
         }
         }
         else{
            $_SESSION['auth-user'] = $user_id;
            echo "success";
         }*/

         
            
         $_SESSION['auth-user'] = $result;
         echo "success";  

      }else{
         echo "password is not matched";
      }
   }
   else{
      echo "User Id is not matched ";
   }

}




function data_initialize(){

   // if(isset($_COOKIE['username'])){
   //    $_SESSION['auth-user'] = $_COOKIE['username'];
   //    echo "success";
   // }
   // else{

   $values = $_POST['data'];

   $user = $values[0]['value'];
   $pass = $values[1]['value'];
   $pass2 = $pass;
   $pass = base64_encode($pass);

   // echo $pass;

   // $checkme = $_POST['checkme'];

   check_user($user,$pass,$pass2);
   // }
   
}


  if(isset($_POST['data'])){
     
      data_initialize();
    
  }
  else if(isset($_POST['call'])){
     logout();
  }
  else{
     echo "oops ! something went Wrong";
  }


?>