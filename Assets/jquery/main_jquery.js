$(document).ready(function(){

    var old_user;

    $(".login-button").on({
            click:function(e){
                login(e);
            }
    });

    function login(e){
        
        e.preventDefault();

        var values = $(".loginform").serializeArray();

       

        var test = $(".form-check-input").prop('checked');

        console.log(typeof(test));
        
       
        var call="login";

        $.post('Templates/template_parts/login.php',{
            data:values,
            checkme:test
        },function(data,status){
            $(".message").css("display","block");
            if(data == "success"){
                
                $(".error_show").html("Wait , Till we go to home page");
                $(".access-show").html("Access Granted");
                $(".error_show").show().delay(4200);
                $(".access-show-div").show().delay(4000);

                $(".access-show-div").hide(2000);
                
                
                setTimeout(function() {
                    window.location.reload();
                }, 5000);
                
            }
            else{
                $(".error_show").html(data);
                $(".access-show").html("Access Denied");
                $(".error_show").show().delay(5000);
                $(".access-show-div").show().delay(4000);
                $(".access-show-div").hide(2000);
                $(".error_show").hide(2500);
            }
        });


    }

    $(".logout").click(function(){

            var call = "logout";

            if(confirm('Are you sure')){
                $.post('Templates/template_parts/login.php',{
                    call:call
                },function(data,status){
                    if(data == 'success'){
                        alert("logOut Successfull");
                        window.location.reload();
                    }else{
                        alert("Oops ! Something Went Wrong");
                    }
                });
            }

    });

    /*

    $(".sidemenu-button").click(function(){

        var el = $('.sidemenu-button');
  
       
  
        var p = el.attr("class");
  
       
  
        if(  p!="navbar-toggler nav-button sidemenu-button"){
            $(".sidemenu").css("display","none");
            $(".main-content").css("left","0px");
            var ep = $('.sidemenu-close-button');
            ep.addClass('sidemenu-button');
            ep.removeClass('sidemenu-close-button');
      }
  
  
        else if(p=="navbar-toggler nav-button sidemenu-button"){
  
          $(".sidemenu").css("display","block");
          $(".main-content").css("left","200px");
         
          el.removeClass('sidemenu-button');
          el.addClass('sidemenu-close-button');
        }
        
  
       
         
  
      });*/
  


    $(".sidemenu-button").click(function(){

        var el = $('.sidemenu-button');
  
       
  
        var p = el.attr("class");
  
       
  
        if(  p!="navbar-toggler nav-button sidemenu-button"){
            $(".sidemenu").hide();
            $(".main-content2").css("left","0px");
            var ep = $('.sidemenu-close-button');
            ep.addClass('sidemenu-button');
            ep.removeClass('sidemenu-close-button');
      }
  
  
        else if(p=="navbar-toggler nav-button sidemenu-button"){
  
            $(".sidemenu").show();
            $(".main-content2").css("left","200px");
           
            el.removeClass('sidemenu-button');
            el.addClass('sidemenu-close-button');
        }
  
       
         
  
      });

      $("#add-project-form").on({
            submit:function(e){
                add_project(e);
            }
      });

      function add_project(e){
          e.preventDefault();
          var call = "add_project";
          var values = $("#add-project-form").serializeArray();


          $.post('Templates/template_parts/add.php',{
                call:call,
                value:values
          },function(data,status){
            if(data == "successfull"){
                alert("submit successfull");
                window.location.reload();
                }else{
                    alert(data); 
                }
          });

      }


      $(".add-student-form").on({
        submit:function(e){
            add_student(e);
        }
  });

  function add_student(e){
      e.preventDefault();
      var call = "add_student";
      var values = $(".add-student-form").serializeArray();


      $.post('Templates/template_parts/add.php',{
            call:call,
            value:values
      },function(data,status){
            if(data == "successfull"){
            alert("submit successfull");
            window.location.reload();
            }else{
                alert(data); 
            }
      });

  }


  $(".add-user-form").on({
    submit:function(e){
        add_user(e);
    }
});

function add_user(e){
  e.preventDefault();
  var call = "add_user";
  var values = $(".add-user-form").serializeArray();


  $.post('Templates/template_parts/add.php',{
        call:call,
        value:values
  },function(data,status){
        if(data == "successfull"){
        alert("submit successfull");
        window.location.reload();
        }else{
            alert(data); 
        }
  });

}

$(".add-admin-form").on({
    submit:function(e){
        add_admin(e);
    }
});

function add_admin(e){
  e.preventDefault();
  var call = "add_admin";
  var values = $(".add-admin-form").serializeArray();


  $.post('Templates/template_parts/add.php',{
        call:call,
        value:values
  },function(data,status){
        if(data == "successfull"){
        alert("submit successfull");
        window.location.reload();
        }else{
            alert(data); 
        }
  });

}


$(".edit").click(function(){

    // console.log("hello");

   var test2 =  $(this).attr('id');
//    var test3 =  $(".edit");

    $('.'+test2).each(function(){
        
        var td_value = $('.'+test2).find('td');
        
        old_user = td_value[1].innerText;
        
        for (let index = 0; index < td_value.length-1; index++) {
            
            var html = '<input class="form-control " type="text"   name="name'+index+'" value="'+td_value[index].innerText+'" required="">';
            td_value[index].innerHTML=html;
        
        }
        
        $('#'+test2).html('Save');
        $('#'+test2).addClass('Save'); 
        $('.edit').unbind('click');
        $('#'+test2).removeClass('edit'); 
        
        $(".Cancel").show();
        $(".delete").hide();
       

        // var html = '<input class="form-control " type="text"   name="" value="'+td_value+'" required="">';
        // td_value_td.html(html);
    });

    $('.Save').click(function(){
        var table_name = $(".table-header-row").find('th');
        var call = table_name[0].innerText;
        

        var test2 =  $(this).attr('id');
        var td_value = $('.'+test2).find('input');
        
        // var call = 'update_student';
        var values = new Array();
        for (let index = 0; index < td_value.length; index++) {
            
             values.push(td_value[index].value);
        
        }
        // console.log(values);
        $.post('Templates/template_parts/add.php',{
            call:call,
            value:values,
            olded_user:old_user
      },function(data,status){
            if(data == "successfull"){
            alert("submit successfull");
            window.location.reload();
            }else{
                alert(data); 
            }
      });   
        



    });

  

  

});

$(".Cancel").click(function(){

    window.location.reload();


});

$(".delete-project").click(function(){
    if(confirm('This Will also delete the students data with this project \n Are you sure')){
        var test2 =  $(this).attr('id');
        var test2 = test2.substring(0,5);
        call = 'delete_project';
       
        var reg = $('.'+test2).find('td');
        reg = reg[2].innerText;
        $.post('Templates/template_parts/add.php',{
            call:call,
            value:reg,
      },function(data,status){
            if(data == "successfull"){
            alert("Deletetion Successfull");
            window.location.reload();
            }else{
                alert(data); 
            }
      });  
        
    }

});


$(".delete-student").click(function(){
    if(confirm('This will completly delete All the Projects for this user \nAre you sure')){
        var test2 =  $(this).attr('id');
        var test2 = test2.substring(0,5);
        call = 'delete_student';
       
        var reg = $('.'+test2).find('td');
        reg = reg[1].innerText;
        $.post('Templates/template_parts/add.php',{
            call:call,
            value:reg,
      },function(data,status){
            if(data == "successfull"){
            alert("Deletetion Successfull");
            window.location.reload();
            }else{
                alert(data); 
            }
      });  
        
    }

});



$(".delete-user").click(function(){
    if(confirm('This will completly delete this user id \nAre you sure')){
        var test2 =  $(this).attr('id');
        var test2 = test2.substring(0,5);
        call = 'delete_user';
       
        var reg = $('.'+test2).find('td');
        reg = reg[1].innerText;
        $.post('Templates/template_parts/add.php',{
            call:call,
            value:reg,
      },function(data,status){
            if(data == "successfull"){
            alert("Deletetion Successfull");
            window.location.reload();
            }else{
                alert(data); 
            }
      });  
        
    }

});


$(".project-search").keyup(function(){


    var project_name_show = $(".project-search").val();
    
    var callp = $(".recent-title-h3").html();

  
    
    $.post('Templates/template_parts/search.php',
    {
      value:project_name_show,
      call:callp
    },function(data,status){
        
    switch (callp) {
            case 'User List':
                $(".user-list-data").html(data); 
                break;
            case 'Admin List':
                $(".admin-list-data").html(data); 
                break; 
            case 'Project List':
                $(".project-list-data").html(data); 
                break; 
            case 'Student List':
                $(".student-list-data").html(data);
                break; 
            
            default:
                break;
        }    
       
    }
    );
    });


    $(".testing_file").on({
        submit:function(j){
            upload_file(j);
        }
    });


    function upload_file(j){
    j.preventDefault();
    console.log('test');
    
    let myForm = document.getElementById('upload-file-form');
  
      
    let formData = new FormData(myForm);
    console.log(typeof(formData));
  
    var call = "upload_file";

    $.ajax({
        url:"Templates/template_parts/upload_assign.php",
        type:"POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success:function(data){
          if(data == 'sucessfull'){
        alert("submit successfull");
          window.location.reload();
          }else{
              alert(data);
          }
        },
        error: function(status,error){
            alert(status);
        }

    });

    



    }

    $(".forgot-pass-button").click(function(){
        $(".loginform").hide();
        $(".forgotpassform").show();
        $(".forgot-pass-button").hide();

       
    });


    $(".forgotpassform").on("submit",function(k){
        k.preventDefault();
        $(".email-send-button").html("Sending...");
        // var values = $(".forgotpassforn").serializeArray();
        var value_mail = $(".forgot_email").val();
        

        $.post('Templates/template_parts/sendmail.php',{
              test_email:value_mail
        },function(data,status){
            
            if(data == 'successfull'){    
                    alert("Password has been sent thorugh mail");
                    window.location.reload();
            }else{
                alert(data);
                $(".email-send-button").html("Submit");
            }
        });
        
    });



});