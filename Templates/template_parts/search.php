<?php
require_once '../../Include/init.php';
session_start();


function project_search($values1,$admin_user2){
    // echo "ENtered to project with value".$values1;

$sql = "SELECT * from  project where project_name like '%$values1%' and admin_user = '$admin_user2' limit 10";

$db = new database();

$db->query($sql);

if($db->sql_query->rowCount() > 0){
    $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);

    if(!$result){
        echo "<h1>Something went wrong , please connect to the administrator</h1>";
        $db->close_connection();
    }
    else{
    for ($i=0; $i < $db->sql_query->rowCount() ; $i++) { 
       
        
?>

<tr class="<?php echo'row-'.$i;?>">

        <td>
        
            <?php echo $result[$i]['project_name'];?>
        </td>
        <td>
        <?php echo $result[$i]['project_case'];?>
        </td>
        <td>
        <?php echo $result[$i]['project_id'];?>
        </td>
        <td>
        <?php echo $result[$i]['deadline'];?>
        </td>
        <td>
        <?php
        if($result[$i]['allocation'])
            echo $result[$i]['allocation'];
        else
            echo "Unavailable";
        
        ?>
        </td>
        <td class="d-flex flex-row">
            <button class="edit btn btn-outline-primary" id="<?php echo 'row-'.$i;?>" ><i class="far fa-edit"></i>Edit</button>
            <button class="delete delete-project btn btn-outline-primary" id="<?php echo 'row-'.$i.'button';?>"><i class="far fa-trash-alt"></i>Delete</button>
            <button class="Cancel btn btn-outline-primary" style="display:none;" id="<?php echo 'row-'.$i.'button';?>"><i class="fas fa-slash"></i>Cancel</button>
        </td>

        

    </tr>

<?php
    }
}
}else{
    echo "No Data is Available";
}
$db->close_connection();
}



function student_search($values1,$admin_check2,$admin_user2){
    if($admin_check2 == 0){
   
        $sql2 = "SELECT * FROM `student` WHERE reg_no = (SELECT reg_no from auth where reg_no = '$registration') ";  
    }else{
        $sql2 = "SELECT * from student where name like '%$values1%' and admin_user = '$admin_user2' limit 10";
        
    }
    
    
    
    $db2 = new database();
    
    $db2->query($sql2);
    
    if($db2->sql_query->rowCount() > 0){
        $result2 = $db2->sql_query->fetchAll(PDO::FETCH_ASSOC);
        
        $db3 = new database();
    
        for ($j=0; $j < $db2->sql_query->rowCount() ; $j++) { 
            $pro_id = $result2[$j]['project_id'];
            $sql3 = "SELECT deadline from project where id = $pro_id";
            $db3->query($sql3);
            $result3 = $db3->sql_query->fetchAll(PDO::FETCH_ASSOC);
            $db3->close_connection();
    
    ?>
    
        <tr class="mt-2 <?php echo'row-'.$j;?>">
            <td class="row-data">
                <?php echo $result2[$j]['name'];?>
            </td>
            <td class="row-data">
            <?php echo $result2[$j]['reg_no'];?>
            </td>
            <td class="row-data">
            <?php echo $result2[$j]['department'];?>
            </td>
            <td class="row-data">
            <?php echo $result2[$j]['sem'];?>
            </td>
            <td class="row-data"> 
            <?php echo $result2[$j]['project'];?>
            </td>
            <td class="row-data">
            <?php echo $result2[$j]['project_case'];?>
            </td>
            <td class="row-data">
            <?php echo $result2[$j]['date'];?>
            </td class="row-data">
            <td class="row-data-end">
            <?php echo $result3[0]['deadline'];?>
            </td>
           
            <td class="d-flex flex-row">
                <button class="edit btn btn-outline-primary" id="<?php echo 'row-'.$j;?>" ><i class="far fa-edit"></i>Edit</button>
                <button class="delete delete-student btn btn-outline-primary" id="<?php echo 'row-'.$j.'button';?>"><i class="far fa-trash-alt"></i>Delete</button>
                <button class="Cancel btn btn-outline-primary" style="display:none;" id="<?php echo 'row-'.$j.'button';?>"><i class="fas fa-slash"></i>Cancel</button>
            </td>
    
            
    
        </tr>
        <?php
                            }
                                }
                            else{
                               echo "NO DATA AVILABLE";  
                            }
                            
                            $db2->close_connection();
                            
}



function admin_search($values1,$admin_user2){

$sql2 = "SELECT * from  auth where username like '%$values1%' and admin_check = 1 and admin_user = '$admin_user2' limit 10";

$db2 = new database();

$db2->query($sql2);

if($db2->sql_query->rowCount() > 0){
    $result2 = $db2->sql_query->fetchAll(PDO::FETCH_ASSOC);

   

    for ($j=0; $j < $db2->sql_query->rowCount() ; $j++) { 

?>

    <tr class="<?php echo'row-'.$j;?>">
            <td>
             <?php echo $j+1;?>
            </td>
        <td>
            <?php echo $result2[$j]['username'];?>
        </td>
        <td>
            <?php echo base64_decode($result2[$j]['password']);?>   
        </td>
        
        <td class="d-flex flex-row">
            <button class="edit btn btn-outline-primary" id="<?php echo 'row-'.$j;?>" ><i class="far fa-edit"></i>Edit</button>
            <button class="delete delete-user btn btn-outline-primary" id="<?php echo 'row-'.$j.'button';?>"><i class="far fa-trash-alt"></i>Delete</button>
            <button class="Cancel btn btn-outline-primary" style="display:none;" id="<?php echo 'row-'.$j.'button';?>"><i class="fas fa-slash"></i>Cancel</button>
        </td>

        

    </tr>

    <?php
                        }
                            }
                        else{
                           echo "NO DATA AVILABLE";  
                        }
                        $db2->close_connection();
}


function user_search($values1,$admin_check2,$admin_user2){
    
    if($admin_check2 == 0){
        $sql2 = "SELECT * from  auth where username = '$admin_user2' AND  admin_check = 0";
    }else{
    $sql2 = "SELECT * from  auth where username like '%$values1%' and admin_check = 0 and admin_user = '$admin_user2' limit 10";
    }
    
    $db2 = new database();
    
    $db2->query($sql2);
    
    if($db2->sql_query->rowCount() > 0){
        $result2 = $db2->sql_query->fetchAll(PDO::FETCH_ASSOC);
    
       
    
        for ($j=0; $j < $db2->sql_query->rowCount() ; $j++) { 
    
    ?>
    
    <tr class="<?php echo'row-'.$j;?>">
                <td>
                        <?php echo $j+1;?>
                </td>
            <td>
                <?php echo $result2[$j]['username'];?>
            </td>
            <td>
                <?php echo base64_decode($result2[$j]['password']);?>
            </td>
            <td>
             <?php echo $result2[$j]['reg_no'];?>
            </td>
            
            <td class="d-flex flex-row">
                <button class="edit btn btn-outline-primary" id="<?php echo 'row-'.$j;?>" ><i class="far fa-edit"></i>Edit</button>
                <button class="delete delete-user btn btn-outline-primary" id="<?php echo 'row-'.$j.'button';?>"><i class="far fa-trash-alt"></i>Delete</button>
                <button class="Cancel btn btn-outline-primary" style="display:none;" id="<?php echo 'row-'.$j.'button';?>"><i class="fas fa-slash"></i>Cancel</button>
            </td>
    
            
    
        </tr>
    
        <?php
                            }
                                }
                            else{
                               echo "NO DATA AVILABLE";  
                            }
                            $db2->close_connection();
}



class search
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
            case 'User List':
                user_search($this->values1,$admin_user2,$admin_check2);
                break;
            case 'Admin List':
                admin_search($this->values1,$admin_user2);
                break; 
            case 'Project List':
                project_Search($this->values1,$admin_user2);
                break; 
            case 'Student List':
                student_search($this->values1,$admin_check2,$admin_user2);
                break; 
            
            default:
                echo "oops! something went wrong";
                break;
        }

           

    }
    
};

$obj = new search();

?>