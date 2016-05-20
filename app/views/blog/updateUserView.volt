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
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

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
    <div class="container">
      <form class="form-signin" action="updateUser" method="POST">
        <h2 class="form-signin-heading">修改用户信息</h2>
        <label for="inputusername" class="sr-only">username</label>
        <input type="text" id="username" name ="username" class="form-control"
        placeholder="Username" value ="<?php echo $account->username ?>"
        required readonly>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" value="<?php echo $account->password ?>" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputEmail" class="sr-only">Password</label>
        <input type="email" id="inputEmail" name="email" class="form-control"
        placeholder="email" value="<?php echo $account->email ?>" required>
        <input type="hidden" name="role" value='0'/>
        <input type="hidden" name="id" value="<?php echo $account->id  ?>" />
        <button class="btn btn-lg btn-primary btn-block" type="submit">修改</button>
      </form>
    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

