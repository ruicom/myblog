<?php
namespace App\Controllers;
use App\Models\Comment;
use App\Libs\FileUpload;

class DemoController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function commentAction()
    {
        /* 
        $comments = Comment::find(array(
            "order" => "create_time desc"
        ));
        */

        $comments = $this->getCommentList();

        $num = Comment::count();
        

        $this->view->setVar("datas",$comments);

        $this->view->setVar("num",$num);
        
        
    }
    

    protected function getCommentList($parent_id = 0,&$result = array()) 
    {
       $arr = Comment::find(array(
            "conditions" => "parent_id = :parent_id:",
            "bind" => array( 
                "parent_id" => $parent_id
            ),
            "order" => "create_time desc"
       ));
       $resultArr = $arr->toArray();
       if ($arr->count() == 0) {
            return array();
       }
       foreach($resultArr as $cm) {
           $thisArr = &$result[]; 
           $cm['child'] = $this->getCommentList($cm['id'],$thisArr);
           $thisArr = $cm;
       }
       return $result;
    }

    public function addCommentAction() 
    {
        $account = array();
        if (null != $this->session->get("auth")) {
           $account = $this->session->get("auth"); 
        }
        else 
        {
           $account['id'] = 0; 
           $account['username'] = '游客';
        }
        $comment = new Comment();
        $data=array();
        if((isset($_POST["comment"]))&&(!empty($_POST["comment"]))){
            //解析json数据
            $cm = json_decode($_POST["comment"],true);
            $cm['create_time']=date('Y-m-d H:i:s',time());

            $cm['account_username'] = $account['username']; 
            
            //增加到数据库里面
            $comment->save($cm,'create_time,account_username,content,parent_id'); 
 
            $cm['nickname'] = $account['username'];

            $cm["id"] = $comment->id;

            $data = $cm;

            $num =  $comment->count();//统计评论总数

            $data['num']= $num;

        }else{
            $data["error"] = "0";
        }
        $this->outputJson($data);
    } 


    public function testAction() {
            
    }

    public function uploadAction() 
    {
            
        echo $_FILES["file"]["type"];
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 200000))
        {
          echo "do it";
          if ($_FILES["file"]["error"] > 0)
            {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
          else
            {
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            if (file_exists("upload/" . $_FILES["file"]["name"]))
              {
              echo $_FILES["file"]["name"] . " already exists. ";
              }
            else
              {
              move_uploaded_file($_FILES["file"]["tmp_name"],
              "upload/" . $_FILES["file"]["name"]);
              echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                
              }
            }
          }
        else
          {
          echo "Invalid file";
          
          }
    }
}

