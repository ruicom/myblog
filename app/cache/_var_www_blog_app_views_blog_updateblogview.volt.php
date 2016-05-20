<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog.css" rel="stylesheet">

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
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index">主页</a>
          <a class="blog-nav-item" href="aboutMe">关于我</a>
          <a class="blog-nav-item" href="edit">写博客</a>
          <a class="blog-nav-item" href="../account/logout">登出</a>
          <a class="blog-nav-item" href="#">
            <?php 
               echo 'hello-' . $this->session->get('auth')->username; 
            ?>
          </a>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="blog-header">
        <p class="lead blog-description">博客修改</p>
          </div>
      <div class="row">
        <div class="col-sm-8 blog-main">
        <form action="updateBlog" method="POST">
            <span>标题:</span><input type="text" class="form-control"
                   placeholder="title" name="title" value="<?php echo
                   $blog->title ?>"> 
            <!-- 加载编辑器的容器 -->
            博客内容
            <script id="container" name="comtent" type="text/plain"><?php echo
            $blog->comtent ?></script>
            <br/>
            <input type="hidden" value="<?php echo $blog->id ?>" name="id"> 
            <input type="submit" value="提交" class="btn btn-default">
            <input type="reset" value="重置" class="btn btn-default">
        </form>
        <!-- 配置文件 -->
        <script type="text/javascript" src="../uedit/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="../uedit/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
        </script>

        <!--
            <form role="form" action="post" method="POST">
              <div class="form-group">
               <span>标题:</span><input type="text" class="form-control"
                   placeholder="title" name="title"> 
                博客内容:<textarea class="form-control" rows="18"
                   name="comtent" ></textarea>
              </div>
              
            </form>
    -->
        </div>
      </div><!-- /.blog-main -->
    </div>


 


</body>
</html>















