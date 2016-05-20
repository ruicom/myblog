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

    <title>Sample Blog Manager</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/manage.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sample blog</a>
        </div>
        <!--
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Settings</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
        -->
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href ="getAccounts?page=1&num=10" target="Accounts" id="userManage">用户管理 <span class="sr-only">(current)</span></a></li>
            <li><a href="getBlogs" target="Accounts" id="blogManage">博客管理</a></li>
           <!-- <li><a href="#">评论管理</a></li> -->
          </ul>
       </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
              <iframe  name="Accounts"  frameborder ="0" width="1024"
              height="1024" >
              </iframe>
              <iframe  name="Blogs"  frameborder ="0" width="1024"
              height="1024" >
              </iframe>
        </div>
      </div>
    </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
            $(function () {
                //获取所有的用户信息
                $("#userManage").click(function () {
                    var $this = $(this);
                    $.getJSON("getAccounts",function(data){
                        $("#tbody1").empty();
                        $("#tbody1 tr").attr("align","center");
                        $.each(data, function(i,account){      
                            $("#tbody1").append("<tr>");
                            $("#tbody1").append("<td>" + i + "</td>");
                            $("#tbody1").append("<td>" + account["username"] + "</td>");
                            $("#tbody1").append("<td>" + account["password"] + "</td>");
                            $("#tbody1").append("<td>" + account["email"] + "</td>");
                            if(account["state"] == 1) {
                                $("#tbody1").append("<td>有效</td>");
                            }
                            else {
                                $("#tbody1").append("<td>无效</td>");
                            }
                            $("#tbody1").append("<td>" +"<a href='#' class='deleteUser'>删除</a>" + "</td>");
                            $("#tbody1").append("</tr>");
                            
                        });  
                    });
                });


                //删除某个用户的信息（使其失效）
                $(".deleteUser").click(function() {
                    alert("delete");
                });
                
            });
        </script>
  </body>
</html>

