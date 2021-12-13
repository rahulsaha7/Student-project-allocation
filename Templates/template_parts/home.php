

<div class="container-fluid main-body">

<!-- flex-lg-row flex-xl-row flex-md-column flex-sm-column -->
    
    <section class="row flex-lg-row flex-xl-row flex-md-column flex-sm-column">
        
        <section class="col-12 col-sm-12 col-md-12  col-lg-12 col-xl-2 pl-0">
        <div class="sidemenu">
        <section class="menu-section ml-3">

        <div class="sidemenu-title">
           
            <nav class="navbar navbar-expand-lg sidemenu-title-div" >
              <h2 class=" sidemenu-title1" >Students Project Allocation System

              
              </h2>
             
              <a class="navbar-brand sidemenu-title2" >Menu</a>
            </nav>
        </div>


        <section class="menu mt-5 mb-5">
                <nav class="menu-items d-flex flex-row">
                
                  <ul class="menu-list">
                  

                  <li>
                    <a class="d-flex flex-row" href="<?php echo BASE_DIR.'/dashboard';?>">
                    <i class="fas fa-home"></i>
                      <span class="ml-3">  dashboard </span>
                     



                    </a>
                  </li>

                  <li class="project-link">
                    <a class="d-flex flex-row" href="<?php echo BASE_DIR.'/project';?>">
                    <i class="fas fa-project-diagram"></i> 
                    <span class="ml-3">  Projects </span>
      
                    </a>
                  </li>


                  <li>
                    <a class="d-flex flex-row" href="<?php echo BASE_DIR.'/student';?>">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="ml-3">  Students </span>
                    </a>
                  </li>


                  <li>
                    <!-- <a  class="d-flex flex-row" href="manage">
                    <i class="fas fa-ticket-alt"></i>
                      <span class="ml-3">   Manage </span>
                    </a> -->
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="ml-3"> <i class="fas fa-tasks"></i>  Manage 
                     </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a class="dropdown-item add-user-button" href="<?php echo BASE_DIR.'/Add-user';?>" type="button"> <i class="fas fa-user-plus"></i>Add User</a></li>
                        <li><a class="dropdown-item add-admin-button" href="<?php echo BASE_DIR.'/Add-admin';?>"" type="button"><i class="fas fa-user-shield"></i>Add Admin</a></li>
                       
                        </ul>
                    </div>
                  </li>


                 



                  </ul>

                </nav>
           
          </section>
                    
            
            
</section>
</div>
        </section>
        <section class="col-12 col-sm-12 col-md-12  col-lg-12 col-xl-10 main-content2" >
            <div class="row header-section ">
                <div class="col-12"> 
                
                <header class="header">

            


                <nav class="navbar navbar-expand-lg justify-content-between">
                <div class="title-div">
                    <h1 class="title">Students Project Allocation System</h1>
                </div> 
                
                <button class="navbar-toggler nav-button sidemenu-button" type="button" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span> 
                </button> 
            
                <button type="button" class="logout btn btn-outline-primary">

                    <span><i class="fas fa-sign-out-alt"></i></span>
                    <span>
(<?php echo $admin_user;?>)</span>

                </button>
            
                </nav>


                </header>
                
                </div>
                <div class="col-12  main-content">

                <?php echo $admin_check;?>


                
                          <?php if (isset($url) and $admin_check == 0) {
                            if( $url[0] == 'project'  or $url[0] == 'Add-admin')
                              require_once PAGE_PATH.'/template_parts/dashboard.php';
                            else
                              require_once PAGE_PATH.'/template_parts/'.$url[0].'.php';
                          }
                          else{
                            if(isset($url)){
                              echo $url[0];
                            require_once PAGE_PATH.'/template_parts/'.$url[0].'.php';
                            }
                            else
                            require_once PAGE_PATH.'/template_parts/dashboard.php';
                            
                          }
                          
                          ?>

                
                </div>       
                <!-- <div class="col-12  footer ">
                
                <div class="copyright-details">
                    <p style="color:white;">© 2020 Movie Mania Movies. All rights reserved | Design by <span><a href="testing_download.docx" style="font-size: medium;text-decoration:none;" download>Rahul Saha</a></span></p>
                </div>
                
                </div> -->
            </div>
        </section>
       
    </section> 


</div>
