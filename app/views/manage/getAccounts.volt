<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    $<link rel="icon" href="../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

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
<h2 class="sub-header">用户管理</h2>
<form action = "searchAccount" method="GET" >
    <input type="text" name="keyword">
    <input type="submit" value="搜索">
</form>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>编号</th>
              <th>username</th>
              <th>email</th>
              <th>role</th>
              <th>state</th>
              <th>createtime</th>
              <th>operation</th>
            </tr>
        </thead>
        <tbody id = "tbody1">
            <?php 
                $key = 1;
                foreach($accounts as $account) {
                    echo "<tr>";
                    $id = $account['id'];
                    $username = $account['username'];
                    $password = $account['password'];
                    $email = $account['email'];
                    $role = $account['role'];
                    if($account['state'] == 1) {
                        $state = '有效';
                    }
                    else {
                        $state = '无效';
                    }                    
                    $createtime = date('Y-m-d H:i:s',$account['createtime']);
                    echo "<td>$key</td>";
                    echo "<td>$username</td>";
                    echo "<td>$email</td>";
                    if($role == 0) {
                        echo "<td>普通用户</td>";
                    }
                    else {
                        echo "<td>管理员</td>";
                    }
                    echo "<td>$state</td>";
                    echo "<td>$createtime</td>";
                    echo "<td>
                        <input type='button' onclick='deleteUser($id)' value ='删除'>
                        <input type='button' onclick='updateUserView($id)' value ='修改'>";
                    if($role == 0) {
                        echo "<input type='button' onclick='upToAdmin($id)' value
                        ='升级'>";
                    }
                    else {
                        echo "<input type='button' onclick='downToUser($id)'
                        value ='降级'>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    $key = $key + 1;
                }
            ?>
        </tbody>
    </table>

    <nav>
        <ul class="pager">
        <?php if($page-1 > 0) {
        ?> 
          <li><a href="getAccounts?page=<?php echo $page-1 ?>">Previous</a></li>
        <?php } ?>
       <?php if($page+1 <= $totalpage) {
       ?> 
          <li><a href="getAccounts?page=<?php echo $page+1 ?>">Next</a></li>
        <?php } ?>
        </ul>
    </nav>


</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    function deleteUser(id) {
        if(window.confirm("确定要删除么?")) {
            window.location = "../account/delete?id="+id;
        }
    }

    function updateUserView(id) {
        window.location = "../account/updateView?id="+id;
    }

    function upToAdmin(id) {
        window.location = "upToAdmin?id="+id; 
    }

    function downToUser(id) {
        window.location = "downToUser?id="+id; 
    }


</script>

</body>
</html>
