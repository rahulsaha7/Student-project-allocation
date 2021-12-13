<div class="Add-Admin-Page" style="color:white;">



    <section class="d-flex flex-xl-row flex-column">

        <section class="add-admin"> 
            <section class="recent_title">

                <h3>Add Admin</h3>

            </section>   

            <div class="border-right-0 border-left-0 border-bottom-0 border border-primary">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="add-admin-form">

                <div class="mb-3">
                     <label for="admin-user-name" class="form-label">Email Id for Admin</label>
                     <input class="form-control form-control" type="email" placeholder="Email Id" id="admin-user-name"  name="auser" required="">
                     <label for="pass-word" class="form-label">Password</label>
                     <input class="form-control " type="password" placeholder="PassWord" id="pass-word"  name="apass" required="">
                     
                     <button class="btn btn-primary" type="submit">Submit   </button>
                     
                     </div>


                </form>

            </div>

        </section>
        <section class="project-list ml-3"> 

            <section class="recent_title ml-3 d-flex justify-content-between">

            <h3 class="recent-title-h3" >Admin List</h3>
                <div class="list-search">
                    <input class="form-control project-search mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
                       
                 </div>

            </section>

            <section class="show-project-list border-right-0 border-left-0 border-bottom-0 border border-primary">

            <table class="table table-bordered table-dark">

<thead>

<tr role=row class="table-header-row">

   

    <th>
        S/N
    </th>
    <th>
        User Id
    </th>
    <th>
        Password
    </th>
    <th>
        Options
    </th>
   

</tr>

</thead>

<tbody class="admin-list-data">
<?php
if($admin_check == 1)
$sql2 = "SELECT * from  auth where admin_check = 1 and admin_user = '$admin_user'";
else if($admin_check == 10){
    $sql2 = "SELECT * from  auth where admin_check = 1"; 
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
    ?>

</tbody>

</table>
            
            </section>



        </section>

    </section>
    

</div>