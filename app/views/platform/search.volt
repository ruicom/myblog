<!DOCTYPE HTML>
<html>
<head><meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Discussions - Phalcon Framework</title>

        <meta content="php, phalcon, phalcon php, php framework, faster php framework, forum, phosphorum" name="keyword">
        <meta content="Phosphorum - Official Phalcon Forum. Get support using Phalcon, the next-generation PHP Framework." name="description">
        <meta name="generator" content="Phalcon Framework 2.0.11"><link rel="canonical" href="https://forum.phalconphp.com/"><link rel="author" href="https://github.com/Johngtrs">
        <link rel="publisher" href="https://forum.phalconphp.com/"><meta property="og:url" content="https://forum.phalconphp.com/">
        <meta property="og:site_name" content="Phosphorum">
        <link href="../css/blog.css" rel="stylesheet">
        <style type="text/css">
            @font-face {
                font-family: 'icomoon';
                    src:url('/fonts/icomoon.wofficomoon.eot');
                    src:url('/fonts/icomoon.eot?#iefix') format('embedded-opentype'),
                    url('/fonts/icomoon.woff') format('woff'),
                    url('/fonts/icomoon.ttf') format('truetype'),
                    url('/fonts/icomoon.svg#icomoon') format('svg');
                font-weight: normal;
                font-style: normal;
            }
            .searchform {
                    margin: -22px 0px 28px 306px;
            }
           </style><link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
<body>
<div class="col-md-12">
<br>
<div align="center">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#forum-navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index" class="navbar-brand" title="Go to main page">Sample Blog Platform</a>        </div>

        <div class="collapse navbar-collapse" id="forum-navbar-collapse">
            <?php 
                $account = $this->session->get("auth");
                if (null == $account) {
            ?>        
            <div id = "login">
            <a href = "../account/loginView">登陆</a>
            <a href = "../account/registerView">注册</a>
            <?php } else { ?> 
                <a href ="#">欢迎-  <?php echo $account->username; ?>
            <?php } ?>
            
            </div>
            
        </div>
</nav>
<form class="searchform">
    <input type="text" name="keyword">
    <input type="submit" value="提交">
</form>
<table class="table table-striped list-discussions" width="80%">
    <tbody><tr>
        <th> &nbsp; </th><th width="38%">Topic</th>
        <th class="hidden-xs">author</th>
        <th class="hidden-xs">Created</th>
         </tr>
         <?php foreach($blogs as $blog) { ?> 
        <tr class="post-positive">
                        <td><img src="https://phosphorum-1618.kxcdn.com//icon/new_none.png" class="img-rounded" width="24" height="24"></td>
        <td class="hidden-xs"><a href="../blog/description?id=<?php
                echo $blog['id'] ?>" title="phalcon">
                    {{blog.title }}
                <td class="hidden-xs">
                    <span class="category">{{blog.username }}</span>
                </td>
                
                  <td class="hidden-xs">
                    <span class="date">{{ date('Y-m-d H:i:s',blog.createtime) }}</span>
                </td>
                </tr>
                <?php } ?>
            </tbody></table>
    </div>
</div>
<footer class="blog-footer" id="footer">
          <p>Sample Blog built for <a href="http://getbootstrap.com">Bootstrap</a> by <a
      href="https://twitter.com/mdo">rui</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
 </footer>

</body>
</html>
