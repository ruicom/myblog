<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sample blog</title>

    <!-- Bootstrap core CSS -->
 	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="../css/templatemo_style.css" rel="stylesheet" type="text/css">	

    <link href="../css/common.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <script>
        function checkAccount()
        {
            var username=document.getElementById("username").value;
            var password=document.getElementById("password").value;
           
            var usrLen = username.length;
            var passLen = password.length;

            var isFasle = false;
            var errMsg = '';
            if(usrLen < 6 || usrLen > 16) {
                isFalse = true;
                errMsg = errMsg + '用户名长度应该大于6个字符小于16个字符';
            }
                
            if(passLen < 6 || passLen > 16) {
                isFalse = true;
                errMsg = errMsg + '-密码长度应该大于6个字符小于16个字符-';
            }
            if(isFalse) {
                alert(errMsg);
                return false;
            }
        }
        
    </script>
    <?php 
        if(isset($errors)) {
            echo "<script>alert('" . $errors . "');</script>";
        }
    ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
	<div class="container">
		<div class="col-md-12">
			<h1 class="margin-bottom-15">登陆</h1>
			<form class="form-horizontal templatemo-container
            templatemo-login-form-1 margin-bottom-30"  
             role="form" action="login" method="post">				
		        <div class="form-group">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="username" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
		            	<input type="text" name="username" class="form-control" id="username" placeholder="Username">
                        <input type="hidden" name="role" value="0">
		            </div>		            	            
		          </div>              
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
		            	<input type="password" name="password" class="form-control" id="password" placeholder="Password">
		            </div>
		          </div>
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		          		<input type="submit" value="Log in"
                         class="btn btn-info">
		          		<a href="registerView" class="text-right
                        pull-right">sign up</a>
		          	</div>
		          </div>
		        </div>
		        <hr>
		       
		      </form>
		      <div class="text-center">
		      	<a href="create-account.html" class="templatemo-create-new">Create new account <i class="fa fa-arrow-circle-o-right"></i></a>	
		      </div>
		</div>
	</div>

   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>


  </body>
</html>

