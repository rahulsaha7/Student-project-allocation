<?php
require_once '../../Include/init.php';
   if($_SERVER['REQUEST_METHOD']=='POST') {

    //Fetch 

    if(isset($_FILES['assignment'])){
        $file_name = $_FILES['assignment']['name'];
        $temp_name = $_FILES['assignment']['tmp_name'];
         $path2 = "../../Assets/assignments/".$_POST['registration_no'];
         $folder = "../../Assets/assignments/".$_POST['registration_no']."/".$file_name;
               
                // if(move_uploaded_file($temp_name,$folder)){
                    $project = $_POST['plfs'];
                    $sql = "SELECT project_id from student where project = '$project'";
                    $db = new database();
                    $db->query($sql);
                    if($db->sql_query->rowCount() > 0){
                        //Check Whether Deadline is Crossed or Not 

                        //Take Deadline from the database via Project_id ;
                        //if Deadline is not crossed then okey 
                        //Else Print A Message that deadline is missed.
                        $results = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);
                        $project_id = $results['0']['project_id'];

                        $date = date("d/m/Y");

                        $sql = "SELECT deadline from project where id = '$project_id'";
                        $db->query($sql);
                        $results = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);
                        // echo $results[0]['deadline'];
                        if($date < $results[0]['deadline']){

                        if(!file_exists($path2)){
                            mkdir($path2,0744,true);
                        }
                    if(move_uploaded_file($temp_name,$folder)){
                       $folder = "Assets/assignments/".$_POST['registration_no']."/".$file_name;
                       
                        $sql = "UPDATE student set project_file = '$folder' where project_id  =  $project_id";
                        $db->query($sql);
                        if($db->sql_query->rowCount() > 0){
                                echo "sucessfull";
                        }else{
                            echo "not sucessfull";
                        }
                    }else{
                            echo "can't upload file";
                    }
                    
                    }else{
                        echo "Deadline Ended";
                    }
                }
                else
                   
                    echo "no project found";

                   
            
   
   }else{

   }

}


?>