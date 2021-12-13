<div class="project-page " style="color:white;">



    <section class="d-flex flex-xl-row flex-column">

        <section class="add-project"> 
            <section class="recent_title">

                <h3 >Add Project</h3>

            </section>   

            <div class="border-right-0 border-left-0 border-bottom-0 border border-primary">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" id="add-project-form">

                <div class="mb-3">
                     <label for="project-name" class="form-label">Project Name</label>
                     <input class="form-control form-control" type="text" placeholder="Project Name" id="project-name"  name="pname" required="">
                     <label for="project-case-study" class="form-label">Project Case Study</label>
                     <input class="form-control " type="text" placeholder="Project Name" id="project-case-study"  name="pcasestudy" required="">
                     <label for="No Of Projects" class="form-label">Project Instances</label>
                     <input class="form-control " type="int" placeholder="Project Instances" id="No Of Projects"  name="pinstances" required="">
                     <span style="color:red">* please use Integer values (ex : 1)</span>
                     <br>
                     <label for="deadline" class="form-label">Deadline</label>
                     <input class="form-control " type="text" placeholder="Deadline" id="deadline"  name="pdeadline" required="">
                     <button class="btn btn-outline-primary" type="submit">Submit   </button>
                     
                     </div>


                </form>

            </div>

        </section>
        <section class="project-list ml-3"> 

            <section class="recent_title ml-3 d-flex justify-content-between">

                <h3 class="recent-title-h3" >Project List</h3>
                <div class="list-search">
                    <input class="form-control project-search mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
                       
                 </div>

            </section>

            <section class="show-project-list border-right-0 border-left-0 border-bottom-0 border border-primary" >

            <table class="table table-bordered table-dark">

<thead>

<tr role=row class="table-header-row">

   
    <th>
        Project name 
    </th>
    <th>
        Project Case Study
    </th>
    <th>
        Project Id
    </th>
    <th>
        Deadline
    </th>
    <th>
        Allocation Instances
    </th>
    <th>
            Options
    </th>

</tr>

</thead>

<tbody class="ml-2 project-list-data">

<?php

$limit = 10;
$page_no=1;
$max_no_of_pages=10;
$no_of_pages=10;

// if(isset($url)){
//     $page_no = $url[1];
//     echo $url;
// }



$offset = ($page_no-1) *($limit);
if($admin_check == 10){
    $sql = "SELECT * from  project";    
}
else if($admin_check == 1){
    $sql = "SELECT * from  project where admin_user = '$admin_user' limit $offset,$limit";
}
else{
    $sql = "SELECT * from  project where admin_user = '$admin_user' and admin_check = 0 limit $offset,$limit";
}

$db = new database();

$db->query($sql);

$count = $db->sql_query->rowCount();
// $no_of_pages = ceil($count / $limit);

$no_of_pages = 10;
if($db->sql_query->rowCount() > 0){
    $result = $db->sql_query->fetchAll(PDO::FETCH_ASSOC);

   

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
}else{
    echo "No data available";
}
$db->close_connection();
?>

</tbody>

</table>



            
            </section>



        </section>

    </section>
    

</div>