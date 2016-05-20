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
    <link rel="stylesheet" type="text/css" href="../css/comment.css">
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js" ></script>
    <script type="text/javascript" src="../js/comment.js" ></script>

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
        <?php 
            $account = $this->session->get('auth');
            $account_id = $blog->account_id;
            if ((null != $account) && ($account_id == $account->id)) {
        ?> 
          <a class="blog-nav-item active" href="index">主页</a>
          <a class="blog-nav-item" href="aboutMe">关于我</a>
          <a class="blog-nav-item" href="edit">写博客</a>
          <a class="blog-nav-item" href="../platform/index">返回平台首页</a>
          <a class="blog-nav-item" href="../account/logout">登出</a>
          <a class="blog-nav-item" href="#">
            <?php 
               echo 'hello-' . $this->session->get('auth')->username; 
            ?>
          </a>
        <?php } else {
        ?>
         <span class="blog-nav-item">Sample blog</span>
         <a class="blog-nav-item" href="../platform/index">返回平台主页</a>
         <?php } ?>

        </nav>
      </div>
    </div>
    <div class="container">
      <div class="blog-header">
        <h2> {{ blog.title }}
        </h2>
         <p class="blog-post-meta">{{ date('Y-m-d H:i:s',blog.createtime) }}</p> 
      </div> 
      <div class="row">
        <div class="col-sm-8 blog-main">
            <p class="blog-post-comtent">
                <?php
                    echo $blog->comtent;
                ?>
                </p>
         <?php  
            $account = $this->session->get('auth');
            if ((null != $account) && ($account->id ==
            $blog->account_id)) {
         ?>
            <input type="button" value="删除" class="btn btn-default"
            onclick="deleteBlog(<?php echo $blog->id ?>)">
            <input type="button" value="修改" class="btn btn-default"
            onclick="updateBlog(<?php echo $blog->id ?>)">
         <?php } ?>
            <br>
            <br>
        <div class="comment-filed">
         <input type="hidden" id="blog_id" value="<?php echo $blog->id ?>">
          <!--发表评论区begin-->
          <div>
            <div class="comment-num">
                <span>{{ num }}条评论</span>
            </div>
            <div>
                <div>
                <textarea class="txt-commit" replyid="0"></textarea>
                </div>
                <div class="div-txt-submit">
                    <a class="comment-submit" parent_id="0" style="" href="javascript:void(0);"><span style=''>发表评论</span></a>
                </div>      
            </div>
          </div>
          <!--发表评论区end-->

          <!--评论列表显示区begin-->
            <!-- {$commentlist} -->
            <div class="comment-filed-list" >
                <div><span>全部评论</span></div>
                <div class="comment-list" >
                    <!--一级评论列表begin-->
                    <ul class="comment-ul">     
                        <?php
                            function echolist($datas,$account) 
                            {
                                foreach($datas as $data) {
                                    echo "<li comment_id='" . $data['id'] . "'>";
                                    echo "<div>";
                                    echo "<div>";
                                    echo "<img class='head-pic'  src='" .
                                    "http://" . "' alt=''>";
                                    echo "</div>";
                                    echo "<div class='cm'>";
                                    echo "<div class='cm-header'>";
                                    echo "<span>" . $data['account_username'] . "</span>";
                                    echo "<span>" . $data['create_time'] . "</span>";
                                    echo "</div>";
                                    echo "<div class='cm-content'>";
                                    echo "<p>";
                                    echo $data['content']. "</p>";
                                    echo "</div>";
                                    echo "<div class='cm-footer'>";
                                    if ((null != $account) &&
                                    ($account->username ==
                                        $data['account_username'])) {
                                        echo "<a class='comment-delete' comment_id='" .
                                        $data['id'] . "'
                                        href='javascript:void(0);'>删除</a> ";
                                    }
                                    echo "<a class='comment-reply' comment_id='" .
                                    $data['id'] . "'
                                    href='javascript:void(0);'>回复</a> </div></div>";
                                    echo "</div>";
                                    if(isset($data['child'])) {
                                        echo "<ul class='children'>";
                                        echolist($data['child'],$account);
                                        echo "</ul>";
                                        echo "</li>";
                                    }
                                }
                            }
                            echolist($datas,$account);
                         ?>
                    </ul>
                    <!--一级评论列表end-->
               
            </div>
          <!--评论列表显示区end-->

        </div>
          </div><!-- /.blog-post -->
         

      </div><!-- /.container -->
      </div><!-- /.row -->

 
    </div>       
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 <footer class="blog-footer" id="footer">
          <p>Sample Blog built for <a href="http://getbootstrap.com">Bootstrap</a> by <a
      href="https://twitter.com/mdo">rui</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


 </body>
 <script>
    function deleteBlog(id) 
    {
        if(window.confirm("确定删除?")) {
            window.location = "deleteBlog?id="+id;
        }
    }
    function updateBlog(id) 
    {
        window.location = "updateBlogView?id="+id; 
    }


 </script>
</html>

