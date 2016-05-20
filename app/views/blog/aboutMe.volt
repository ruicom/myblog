<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sample Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog.css" rel="stylesheet">
    
    <!-- Just for debugging purposes. Don't actually copy sthese 2 lies! -->
     <style type="text/css">  
        .aboutMe {
          padding: 40px 15px;
          text-align: center;
        }

    </style>  
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index">主页</a>
          <a class="blog-nav-item" href="aboutMe">关于我</a>
          <a class="blog-nav-item" href="edit">写博客</a>
          <a class="blog-nav-item" href="setting">个人设置</a>
          <a class="blog-nav-item" href="../account/logout">登出</a>
          <a class="blog-nav-item" href="#">
            <?php 
               echo 'hello-' . $this->session->get('auth')->username; 
            ?>
          </a>
        </nav>
      </div>
    </div>
    
        <p class="aboutMe">
            {{ aboutMe }}
        </p>
</body>
</html>















