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

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/common.css" rel="stylesheet">
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
          <a class="blog-nav-item" href="setting">个人设置</a>
          <a class="blog-nav-item" href="../account/logout">登出</a>
          <a class="blog-nav-item" href="#">
            <?php 
               echo 'hello-' . $this->session->get('auth')->username; 
            ?>
          </a>
          <span>
                    <span/>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="blog-header">
        <h1 class="blog-title">搜索结果</h1>
        <p class="lead blog-description"></p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">
          <div class="blog-post">
           <?php foreach ($blogs as $blog) { ?> 
            <h3>
                <?php echo $blog['title']; ?>
            </h3>
           <p class="blog-post-meta"><?php echo date('Y-m-d H:i:s', $blog['createtime']); ?></p> 
            <p class="blog-post-comtent">
                
            </p>
            <a href = "description?id=<?php echo $blog['id']; ?>">查看详情</a>
            <br/>
            <br/>
           <?php } ?>
          </div><!-- /.blog-post -->

          <nav>
            <ul class="pager">
            <?php if($page-1 > 0) {
            ?> 
              <li><a href="search?page=<?php echo $page-1 ?>&keyword=<?php echo
              $keyword ?>">Previous</a></li>
            <?php } ?>
           <?php if($page+1 <= $totalpage) {
           ?> 
              <li><a href="search?page=<?php echo $page+1 ?>&keyword=<?php echo
              $keyword ?>">Next</a></li>
            <?php } ?>
            </ul>
          </nav>

        </div><!-- /.blog-main -->
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <form action="search" method="GET" >
              <input type="text" name="keyword" >
              <input type="submit" value="搜索" />
          </form>
          <br/>
          <br/>
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p><?php echo $site->title_des ?></p>
          </div>
          
          <div class="sidebar-module">
            <h4>友情链接</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

