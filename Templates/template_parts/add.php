<?php

require_once '../../Include/init.php';

session_start();


function add_project($values1,$admin_user2,$admin_check2){
    if($admin_check2 == 0){
        echo "you are not an admin";
    }else{
    $db = new database();
    $sql = "SELECT project_id from project ORDER BY project_id desc limit 1";
    $db->query($sql);
    // print_r($values1);
    $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);
    $pro_id = $result[0]['project_id'];
    $sql = "INSERT into project (id,admin_user,project_name,project_case,project_id,deadline,allocation) values (?,?,?,?,?,?,?)";
    $values =              array(null,$admin_user2,$values1[0]['value'],$values1[1]['value'],$pro_id+1,$values1[3]['value'],$values1[2]['value']);
    

    

    $db->query_value($sql,$values);
    if($db->sql_query->rowCount() > 0){
        echo "successfull";
    }else{
        echo "not successfull";
    }
    $db->close_connection();
}

}


function add_student($values1,$admin_user2,$admin_check2){
    if($admin_check2 == 0){
        echo "you are not an admin";
    }else{
    $db = new database();
    $pro_name = $values1[4]['value'];
    $sql = "SELECT id from project where project_name = '$pro_name'";
    $db->query($sql);
    if($db->sql_query->rowCount() > 0){
        $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);
        $pro_id =  $result[0]['id'];
        $reg = $values1[1]['value'];
        $sql = "SELECT reg_no from auth where reg_no = '$reg'";
        $db->query($sql);

        if($db->sql_query->rowCount() > 0){
        
        $sql = "SELECT  project_id from student where project_id = '$pro_id' and reg_no = '$reg' ";

        $db->query($sql);

        if($db->sql_query->rowCount() <= 0){

        $sql = "INSERT into student (student_id,admin_user,name,reg_no,department,sem,project,project_case,date,project_id) values (?,?,?,?,?,?,?,?,?,?)";
        $values =           array(null,$admin_user2,$values1[0]['value'],$values1[1]['value'],$values1[2]['value'],$values1[3]['value'],$values1[4]['value'],$values1[5]['value'],date("d/m/Y"),$pro_id);
        $db->query_value($sql,$values);
        if($db->sql_query->rowCount() > 0){
            echo "successfull";
            $sql = "UPDATE project set allocation = allocation-1  where id = $pro_id";
            $db->query($sql);
        }else{
            echo "not successfull";
        }
    
        }else{
            echo "You have already assigned the project to the student";
        }
    }
    else{
        echo "looks like you haven't created user id for this \n Please create user id for this user ";
    }
}
    else{
            echo "project not found";
    }
    
    $db->close_connection();

} 

    
}


function add_user($values1,$admin_user2,$admin_check2){

    if($admin_check2 == 0){
        echo "you are not an admin";
    }else{
   
    $db = new database();

    $sql = "SELECT username from auth where username = ? or reg_no = ?";
    $values2 = array($values1[0]['value'],$values1[1]['value']);    

    $db->query_value($sql,$values2);
    if($db->sql_query->rowCount() > 0){
        echo "Username Already Exists or Registration Number aleardy Exists";
    }else{
       

    $pass= $values1[2]['value'];
    $pass = base64_encode($pass);

    $sql = "INSERT into auth (username,password,reg_no,admin_user) values (?,?,?,?)";
    
    $values = array($values1[0]['value'],$pass,$values1[1]['value'],$admin_user2);

    $db->query_value($sql,$values);
    if($db->sql_query->rowCount() > 0){
        echo "successfull";
    }else{
        echo "not successfull";
    }
    $db->close_connection();
}
    }

}

function add_admin($values1,$admin_check2,$admin_user2){
    if($admin_check2 == 0){
        echo "you are not an admin";
    }else{
    $db = new database();

    $sql = "SELECT username from auth where username = ?";
    $values2 = array($values1[0]['value']);    

    $db->query_value($sql,$values2);
    if($db->sql_query->rowCount() > 0){
        echo "Username Already Exists";
    }else{
    

    $pass= $values1[1]['value'];
    $pass = base64_encode($pass);

    $sql = "INSERT into auth (username,password,admin_check,admin_user) values (?,?,?,?)";
    
    $values = array($values1[0]['value'],$pass,1,$values1[0]['value']);
    

    $db->query_value($sql,$values);
    if($db->sql_query->rowCount() > 0){
        echo "successfull";
    }else{
        echo "not successfull";
    }
    $db->close_connection();
}
    }
       
}


function update_student($values1,$admin_check2,$admin_user){


    if($admin_check2 == 0){
    $sql = "update student set name = ?, reg_no = ?,department = ?, sem=? where reg_no = ? ";
    $values = array($values1[0],$values1[1],$values1[2],$values1[3],$values1[1]);
    
    }
    else{
        $sql = "update student set name = ?, reg_no = ?,department = ?, sem=?, project = ?,project_case = ?,date=? where reg_no = ? and admin_user = ? ";
//    $sql = "update student set name = 'Rahul Saha', reg_no = '20352043',department = 'MCA', sem='Second Sem', project = 'web',project_case = 'Accessibility Check',deadline='05/06/2021',date='23/05/2021' where reg_no = '20352043'";
   $values = array($values1[0],$values1[1],$values1[2],$values1[3],$values1[5],$values1[6],$values1[7],$values1[1],$admin_user);
    }
   $db = new database();

    $db->query_value($sql,$values);
    if($db->sql_query->rowCount() > 0){
        echo "successfull";
    }else{
        echo "not successfull";
    }
    $db->close_connection();

}

function update_project($values1){

    

    
    
            $allocation = $values1[4];
    if($values1[4] == 'Unavailable' || $values1[2] == 'unavailable' )
            $allocation = 0;

//YWRtaW4=   




  
//user2@gmail.com //0

//demo5 1


    
    $sql = "update project set project_name = ?, project_case = ?,deadline = ?,allocation = ? where project_id = ? ";
//    $sql = "update student set name = 'Rahul Saha', reg_no = '20352043',department = 'MCA', sem='Second Sem', project = 'web',project_case = 'Accessibility Check',deadline='05/06/2021',date='23/05/2021' where reg_no = '20352043'";
   $values = array($values1[0],$values1[1],$values1[3],$allocation,$values1[2]);
   $db = new database();

    $db->query_value($sql,$values);
    if($db->sql_query->rowCount() > 0){
        echo "successfull";
    }else{
        echo "not successfull";
    }
    $db->close_connection();
    

}

function update_user($values1){

   
   
    $old_user = $_POST['olded_user'];
    

    $db = new database();


    if($old_user != $values1[1]){
    $sql = "SELECT username from auth where username = ?";
    $values2 = array($values1[1]);    

    $db->query_value($sql,$values2);
    if($db->sql_query->rowCount() > 0){
        echo "Username Already Exists";
    }else{

        $pass= $values1[2];
        $pass = base64_encode($pass);
     $sql = "update auth set username = ?, password = ? where username = ? ";
     $values = array($values1[1],$pass,$old_user);
  
      $db->query_value($sql,$values);
      if($db->sql_query->rowCount() > 0){
          echo "successfull";
          unset($_SESSION['auth-user']);
      }else{
          echo "not successfull";
      }
      $db->close_connection();
    }
}else{
    $pass= $values1[2];
    $pass = base64_encode($pass);
 $sql = "update auth set username = ?, password = ? where username = ? ";
//    $sql = "update student set name = 'Rahul Saha', reg_no = '20352043',department = 'MCA', sem='Second Sem', project = 'web',project_case = 'Accessibility Check',deadline='05/06/2021',date='23/05/2021' where reg_no = '20352043'";
 $values = array($values1[1],$pass,$old_user);

  $db->query_value($sql,$values);
  if($db->sql_query->rowCount() > 0){
      echo "successfull";
  }else{
      echo "not successfull";
  }
  $db->close_connection();
}
  
  }





  function delete_project($values1){

        $sql =  "SELECT id FROM `project` WHERE `project_id` = $values1";
        $db = new database();
        $db->query($sql);
        if($db->sql_query->rowCount() > 0){
            

            $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);
            $sql =  "SELECT * FROM `student` WHERE `student`.`project_id` = ?";

            $values = array($result[0]['id']);

            $db->query_value($sql,$values);

            if($db->sql_query->rowCount() > 0){

            $sql =  "DELETE FROM `student` WHERE `student`.`project_id` = ?";

            $values = array($result[0]['id']);

            $db->query_value($sql,$values);

            if($db->sql_query->rowCount() > 0){
                $sql =  "DELETE FROM `project` WHERE `project`.`id` = ?";
                $values = array($result[0]['id']);
                $db->query_value($sql,$values);
                if($db->sql_query->rowCount() > 0){
                    echo "successfull";
                }else{  
                    echo "Can't Delete the Row \n Looks like something went wrong";
                }
            }else{
                echo "OPPs! Can't Delete Student Row";
            }
        }
        else{
            $sql =  "DELETE FROM `project` WHERE `project`.`id` = ?";
            $values = array($result[0]['id']);
            $db->query_value($sql,$values);
            if($db->sql_query->rowCount() > 0){
                echo "successfull";
            }else{  
                echo "Can't Delete the Row \n Looks like something went wrong";
            }
        }

        }else{
            echo "Can't Delete";
        }
        $db->close_connection();
      }



function delete_student($values1,$admin_user){

    $sql = "SELECT project_id  from student where reg_no = ? and  admin_user = ? ";
    //    $sql = "update student set name = 'Rahul Saha', reg_no = '20352043',department = 'MCA', sem='Second Sem', project = 'web',project_case = 'Accessibility Check',deadline='05/06/2021',date='23/05/2021' where reg_no = '20352043'";
       $values = array($values1);
       array_push($values,$admin_user);

       $db = new database();
    
        $db->query_value($sql,$values);
        if($db->sql_query->rowCount() > 0){

            
            $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);

            echo $result[0]['project_id'];
            $sql = "update project set allocation = ? where id = ? ";

            $values = array(1,$result[0]['project_id']);

            $db->query_value($sql,$values);



            if($db->sql_query->rowCount() > 0){
               $sql = "DELETE FROM `student` WHERE `student`.`reg_no` = ? and admin_user = ?";

               $values = array($values1);

               array_push($values,$admin_user);

               $db->query_value($sql,$values);

            if($db->sql_query->rowCount() > 0){
                echo "successfull";
            }else{
                echo "Can't Delete Student Row";
            }
            }

            else{
                echo "Opps!Something went Wrong";
            }
        }else{
            
            echo "Opps! Looks Like Student Data is not available";
        }
        $db->close_connection();

}


function delete_user($values1){
    $sql = "DELETE FROM `auth` WHERE `auth`.`username` = ?";
    $db = new database();
    $values = array($values1);
    $db->query_value($sql,$values);
    if($db->sql_query->rowCount() > 0){
        echo "successfull";
    }else{
        echo "Can't delete this user";
    }
}




        class Add
        {
            protected $sql;
            protected $call;
            protected $values1;
            protected $values2;
            protected $result;

            function __construct(){
                   if(isset($_POST['call'])){ 
                    $this->call = $_POST['call'];
                    $this->values1 = $_POST['value'];
                    if(isset($_SESSION['auth-user'])){
                        $result_session2 = $_SESSION['auth-user'];
                        $admin_user2 = $result_session2[0]['username'];
                        $admin_check2 = $result_session2[0]['admin_check'];
                    }
                   }

                switch ($this->call) {
                    case 'add_project':
                        add_project($this->values1,$admin_user2,$admin_check2);
                        break;
                    case 'add_student':
                        add_student($this->values1,$admin_user2,$admin_check2);
                        break; 
                    case 'add_user':
                        add_user($this->values1,$admin_user2,$admin_check2);
                        break; 
                    case 'add_admin':
                        add_admin($this->values1,$admin_check2,$admin_user2);
                        break; 
                    case 'STUDENT NAME':
                        update_student($this->values1,$admin_check2,$admin_user2);
                        break;
                    case 'PROJECT NAME':
                         update_project($this->values1);
                        break;
                    case 'S/N':
                        update_user($this->values1);
                        break;
                    case 'delete_project':
                       
                        delete_project($this->values1);
                        break;
                    case 'delete_student':
                        delete_student($this->values1,$admin_user2);
                        break;
                    case 'delete_user':
                        delete_user($this->values1);
                        break;

                    
                    default:
                        echo "oops! something went wrong";
                        break;
                }

                   

            }
            
        };
        
    $obj = new Add();

?>