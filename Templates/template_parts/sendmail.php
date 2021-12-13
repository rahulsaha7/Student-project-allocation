<?php 
session_start();
require_once '../../Include/init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['callp'])){
            $otp = $_POST['test_otp'];
            verify_otp($otp);
        }

        else{
       if(isset($_POST['test_email'])){
           $mail = $_POST['test_email'];
            $db = new database();
            $sql = "SELECT password from auth where username = '$mail' ";
            $db->query($sql);
            if($db->sql_query->rowCount() > 0){
                $result = $db->sql_query->fetchALL(PDO::FETCH_ASSOC);
                $subject="Email For Forgot Password".$result[0]['password'];
                $message=  "Your Password  =".base64_decode($result[0]['password']);
        
                $headers = "From:rsahagdrive@gmail.com";
               
                if(mail($mail,$subject,$message,$headers)){
                   
                        unset($_SESSION['email']);
                        $_SESSION['email']=$mail;
                        echo "successfull";
                    
                }else{
                    echo "can't send mail";
                }
                
                
            }else{
                echo "mail id not found";
            }
            $db->close_connection();
       }

    // }
    else{
        echo "Something went Wrong";
    }
}
}

?>