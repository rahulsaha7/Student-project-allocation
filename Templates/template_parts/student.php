<div class="Student Page " style="color:white;">



    <section class="d-flex flex-xl-row flex-column">

        <section class="add-student"> 
            <section class="recent_title">

                <h3  >Add Student</h3>

            </section>   

            <div class="border-right-0 border-left-0 border-bottom-0 border border-primary ">

                <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="add-student-form mt-2">

                <div class="mb-3">
                     <label for="student-name" class="form-label">Student Name</label>
                     <input class="form-control form-control" type="text" placeholder="Student Name" id="student-name"  name="sname" required="">
                     <label for="student-reg-no" class="form-label">Student Reg No</label>
                     <input class="form-control " type="text" placeholder="Student Reg Name" id="student-reg-no"  name="srg" required="">
                     <label for="Department" class="form-label">Department</label>
                     <input class="form-control " type="text" placeholder="Department" id="Department"  name="dept" required="">
                     
                     <label for="Semester" class="form-label">Semester</label>
                     <input class="form-control " type="text" placeholder="Semester" id="Semester"  name="sem" required="">
                     <label for="project-lists" class="form-label">Project List :</label>
                   
                    <select class="custom-select mr-sm-2" name="project-list" id="project-lists" required="">
                        <option value="" selected disabled>Choose a project</option>
                        <?php 
                            $sql = "SELECT * from  project where allocation >= 1 and admin_user = '".$admin_user."'";

                            $db = new database();
                            
                            $db->query($sql);
                            if($db->sql_query->rowCount() > 0){
                                $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);
                            
                               
                            
                                for ($i=0; $i < $db->sql_query->rowCount() ; $i++) { 
                        ?>
                        <option value="<?php echo $result[$i]['project_name'];?>"><?php echo $result[$i]['project_name'];?></option>
                    <?php
                        }
                            }
                        else{
                           ?>
                            <option value="" selected disabled>No New Project</option>
                        <?php  
                        }
                        $db->close_connection();
                    ?>
                    </select>
                    <br>
                    <label for="project-cases" class="form-label">Project Case :</label><select class="custom-select mr-sm-2" name="project-case" id="project-cases" required="">
                        <option  value="" selected disabled>Choose  project case</option>
                        <?php 
                            $sql3 = "SELECT * from  project where allocation >= 1 and admin_user = '".$admin_user."'";

                            $db3 = new database();
                            
                            $db3->query($sql3);
                            if($db3->sql_query->rowCount() > 0){
                                $result3= $db3->sql_query->fetchAll(PDO::FETCH_ASSOC);
                            
                               
                            
                                for ($k=0; $k < $db3->sql_query->rowCount() ; $k++) { 
                        ?>
                        <option value="<?php echo $result3[$k]['project_case'];?>"><?php echo $result3[$k]['project_case'];?></option>
                    <?php
                        }
                            }
                        else{
                           ?>
                            <option value="" selected disabled>No New Project</option>
                        <?php  
                        }
                        $db3->close_connection();
                    ?>
                    </select>
                     <button class="btn btn-outline-primary" type="submit">Submit   </button>
                     
                     </div>


                </form>

            </div>

        </section>

        <section class="upload-assignment">
                <section>
                        <h3>Upload File</h3>
                </section>

                <div class="border-right-0 border-left-0 border-bottom-0 border border-primary ">
                <form   method="post" id="upload-file-form" class="testing_file mt-2" enctype="multipart/form-data">
                <label  for="inputGroupFile01">Choose file</label>
                    <input type="file" name = "assignment" id="inputGroupFile01" required="">
                    <input type="hidden" name = "registration_no" value="<?php echo $registration;?>" required="">
                    <select class="custom-select mr-sm-2" name="plfs"  required="   ">
                    <option value="" selected disabled>Choose a project</option>
                    <?php

                        $sql_s = "SELECT project from student where reg_no = '$registration'";
                       
                        $dbs = new database();
                            
                        $dbs->query($sql_s);
                        if($dbs->sql_query->rowCount() > 0){
                            $results= $dbs->sql_query->fetchAll(PDO::FETCH_ASSOC);
                            
                              
                            
                            for ($p=0; $p < $dbs->sql_query->rowCount() ; $p++) {   

                        
                    ?>
                        <option value="<?php echo $results[$p]['project'];?>"><?php echo $results[$p]['project'];?></option>
                    <?php
                            }
                        }else{
                            ?>
                            <option value="" selected disabled>No New Project</option>
                        <?php
                        }
                        $dbs->close_connection();;
                    ?>
                    </select>
                    <button type="submit" value="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>

        </section>

        <section class="project-list ml-3"> 

            <section class="recent_title ml-3 d-flex justify-content-between">

                <h3 class="recent-title-h3" >Student List</h3>
                <div class="list-search">
                    <input class="form-control project-search mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
                 </div>

            </section>

            <section class="show-project-list border-right-0 border-left-0 border-bottom-0 border border-primary">

            <table class="table table-bordered table-dark">

<thead >

<tr role=row class="table-header-row">

   
    <th scope="col" >
        Student name 
    </th>
    <th scope="col">
        Reg No
    </th>
    <th scope="col">
        Department
    </th>
    <th scope="col">
        Semester
    </th>
    <th>
        Projct File
    </th>
    <th scope="col">
        Project
    </th>
    <th scope="col">
        Project Case
    </th>
    <th scope="col">
        Date Added
    </th>
    <th scope="col">
        Dead Line
    </th>
    <th scope="col">
        Options
    </th>

</tr>



</thead>

<tbody class="student-list-data">
<?php  

if($admin_check == 0){
   
    $sql2 = "SELECT * FROM `student` WHERE reg_no = (SELECT reg_no from auth where reg_no = '$registration') ";  
}else if($admin_check == 10){
    $sql2 = "SELECT * from  student";
}
else{
   
    $sql2 = "SELECT * from student where admin_user = '$admin_user' ";
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
        <?php
            if($result2[$j]['project_file']!='N/A'){
        ?>
        <a href="<?php echo $result2[$j]['project_file'];?>" style="color:white;" download>Project Submitted</a>
        <?php
            }else{
                 echo "N/A";
            }
        ?>
        
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
                        $db3->close_connection();
                    ?>

</tbody>

</table>
            
            </section>



        </section>

    </section>
    

</div>