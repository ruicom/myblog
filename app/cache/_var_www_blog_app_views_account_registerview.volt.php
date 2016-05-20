<!DOCTYPE html>
<head>
	<title>Sample Blog</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="../css/templatemo_style.css" rel="stylesheet" type="text/css">	
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
</head>
<body class="templatemo-bg-gray">
	<h1 class="margin-bottom-15">注册用户</h1>
	<div class="container">
		<div class="col-md-12">			
			<form class="form-horizontal templatemo-create-account
            templatemo-container" role="form" action="register" method="POST"
            enctype="multipart/form-data">
				<div class="form-inner">
                <!--
					<div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">First Name</label>
			            <input type="text" class="form-control" id="first_name" placeholder="">		            		            		            
			          </div>  
			          <div class="col-md-6">		          	
			            <label for="last_name" class="control-label">Last Name</label>
			            <input type="text" class="form-control" id="last_name" placeholder="">		            		            		            
			          </div>             
			        </div>
                    -->
			        <div class="form-group">
			          <div class="col-md-12">		          	
			            <label for="email" class="control-label">Email</label>
			            <input type="email" name="email" class="form-control" id="email" placeholder="">		            		            		            
			          </div>              
			        </div>			
			        <div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="username" class="control-label">Username</label>
			            <input type="text" name="username" class="form-control" id="username" placeholder="">		            		            		            
			          </div>
			          <div class="col-md-6 templatemo-radio-group">
			          	<label class="radio-inline">
		          			<input type="radio" name="sex" id="optionsRadios1"
                            value="1"> Male
		          		</label>
		          		<label class="radio-inline">
		          			<input type="radio" name="sex" id="optionsRadios2"
                            value="0"> Female
		          		</label>
			          </div>             
			        </div>
			        <div class="form-group">
			          <div class="col-md-6">
			            <label for="password" class="control-label">Password</label>
			            <input type="password" name="password" class="form-control" id="password" placeholder="">
			          </div>
			          <div class="col-md-6">
			            <label for="password" class="control-label">Confirm Password</label>
			            <input type="password" class="form-control"
                        name="password2" id="password_confirm" placeholder="">
			          </div>
			        </div>
			        
                    <div class="form-group">
			          <div class="col-md-6">
			            <label for="birthday" class="control-label">出生日期</label>
                       <div class="input-append date form_datetime">
                            <input  class="form-control" name="birthday" type="text" value="" readonly>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div> 
			          </div>
			          
			        </div>
                    <div class="form-group">
			          <div class="col-md-6">
			            <label for="file" class="control-label">个人头像</label>
			            <input type="file" name="file" placeholder="">
			          </div>
			        </div>

                    <div class="form-group">
			          <div class="col-md-12">
			            <input type="submit" value="Create account" class="btn btn-info">
			            <a href="login-1.html" class="pull-right">Login</a>
			          </div>
			        </div>	
				</div>				    	
		      </form>		      
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="templatemo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Terms of Service</h4>
	      </div>
	      <div class="modal-body">
	      	<p>This form is provided by <a rel="nofollow" href="http://www.cssmoban.com/page/1">Free HTML5 Templates</a> that can be used for your websites. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
	        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
	        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.fr.js"></script>
    <script type="text/javascript">
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-dd",
            minView:"month",

        });
    </script>
</body>
</html>
