<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students project Allocation and Management System</title>
    <link rel="stylesheet" href=" <?php echo 'Assets/vendor/bootstrap/css/bootstrap.min.css';?>" >
    <link rel="stylesheet" href=" <?php echo 'Assets/css/style.css';?>" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <script src="<?php echo 'Assets/jquery/jquery-3.5.1.js';?>"></script>
    <script src="<?php echo 'Assets/jquery/main_jquery.js';?>""></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </head>
    <body>
    <?php
    if(isset($_SESSION['auth-user'])){
        $result_session = $_SESSION['auth-user'];
        $admin_user = $result_session[0]['username'];
        $admin_check = $result_session[0]['admin_check'];
        $registration = $result_session[0]['reg_no'];
        require_once PAGE_PATH.'template_parts/home.php';
        
       
    }else{
        require_once 'Templates/template_parts/login_form.php';
    }
    ?>

   
    <script>

            $(document).ready(function(){
                var admin = <?php echo $admin_check;?>;
                if(admin == 0){
                    $(".project-link").hide();
                    $(".add-student").hide();
                    $(".delete").hide();
                    $(".add-user-button").html("Profile");
                    $(".add-admin-button").hide();
                    $(".add-user").hide();
                    $(".edit").click(function(){
                    var val =  $(this).attr('id');
                    // console.log(val);

                   
                    var td_value = $('.'+val).find('input');

                    for (let index = 4; index < td_value.length; index++) {
                        td_value[index].readOnly=true;
                    }
                    });
                    
                }
                else{
                    $(".upload-assignment").hide();
                }

                
                

               

            });

    </script>

   
    

    </body>
    </html>

