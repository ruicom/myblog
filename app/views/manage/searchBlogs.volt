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
<h2 class="sub-header">博客结果</h2>
<form action = "searchBlogs" method="GET" >
    <input type="text" name="keyword">
    <input type="submit" value="搜索">
</form>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>编号</th>
              <th> id </th>
              <th>title</th>
              <th>author</th>
              <th>是否开放</th>
              <th>createtime</th>
            </tr>
        </thead>
        <tbody id = "tbody1">
            <?php 
                $key = 1;
                foreach($blogs as $blog) {
                    $id = $blog->id;
                    $title = $blog->title;  
                    $author = $blog->username;
                    $is_open = $blog->is_open; 
                    $createtime = date('Y-m-d H:i:s',$blog->createtime);
                    echo "<td>$key</td>";
                    echo "<td>$id</td>";
                    echo "<td>$title</td>";
                    echo "<td>$author</td>";
                    if ($is_open == 0) {
                        echo "<td>私密</td>";
                    }
                    else {
                        echo "<td>公开</td>"; 
                    }
                    echo "<td>$createtime</td>";
                    echo "<td>";
                    if($is_open == 0) {
                        echo "<input type='button' onclick='upToOpen($id)' value
                        ='公开'>";
                    }
                    else {
                        echo "<input type='button' onclick='downToPrivate($id)'
                        value ='私密'>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    $key = $key + 1;
                }
            ?>
        </tbody>
    </table>


</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    function upToOpen(id) {
        window.location = "upToAdmin?id="+id; 
    }

    function downToPrivate(id) {
        window.location = "downToUser?id="+id; 
    }


</script>

</body>
</html>
