<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>php无限级分类实战————评论及回复功能</title>
    <link rel="stylesheet" type="text/css" href="../css/comment.css">
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js" ></script>
    <script type="text/javascript" src="../js/comment.js" ></script>
</head>
<body>

<div class="comment-filed">
  <!--发表评论区begin-->
  <div>
    <div class="comment-num">
        <span><?php echo $num; ?>条评论</span>
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
                    function echolist($datas) 
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
                            echo "<a class='comment-reply' comment_id='" .
                            $data['id'] . "'
                            href='javascript:void(0);'>回复</a> </div></div>";
                            echo "</div>";
                            if(isset($data['child'])) {
                                echo "<ul class='children'>";
                                echolist($data['child']);
                                echo "</ul>";
                                echo "</li>";
                            }
                        }
                    }
                    echolist($datas);
                 ?>
            </ul>
            <!--一级评论列表end-->
        </div>      
       
    </div>
  <!--评论列表显示区end-->
</div>  
    </body>
</html>
