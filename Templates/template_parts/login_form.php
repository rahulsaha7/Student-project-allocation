<?php if(isset($_COOKIE)){
  // print_r($_COOKIE);
      if(isset($_COOKIE['username'])){
        $user_name = $_COOKIE['username'];
        $password = $_COOKIE['password'];
      }else{
        $user_name = "";
        $password = "";
      }
}
  ?>

<div class="container-fluid body1">

    <div class="message">

            
            
            <div class="access-show-div">

            <p class="access-show mb-3">
                
            </p>
            </div>
            <div class="error-show-div mt-3">
            <p class="error_show">
              
            </p>
            </div>
    </div>

<section class="row">
  <div class="col-12 user-login-form">
    <div class="heading-login-div d-flex flex-column flex-xl-row flex-lg-row  justify-content-center align-items-center">

        <section>
        

            <h1>Students Project Allocation  System</h1>
        </section>
        <section class="login-box">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" class="forgotpassform" id="forgot-pass-form">
    <label for="forgot-password" class="form-label" style="color:white;">Email address</label>
    <input type="email" class="form-control forgot_email" placeholder="Email" name="email" id="forgotpassword" required="">
    <button type="submit"  class="btn btn-primary email-send-button">Submit</button>
    <button  class="btn btn-primary Cancel">Cancel</button>
</form>


<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" class="loginform" id="lg-form">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" style="color:white;">Email address</label>
    <input type="email" class="form-control" placeholder="Username" name="user_id" id="exampleInputEmail1" value="<?php echo $user_name;?>" aria-describedby="emailHelp" required="">
   
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" style="color:white;">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password;?>" id="exampleInputPassword1" required="">
  </div>
  <div class="mb-3 form-check">
   
  </div>
  <button type="submit"  class="btn btn-primary login-button">Submit</button>
  <button type="reset" class="btn btn-primary">Cancel</button>
</form>
<div class="forget-password mt-2">

    <button class="btn btn-secondary forgot-pass-button">Forgot Password</button>
</div>
</section>


    </div>


</section>

</div>

</div>
       
   

    