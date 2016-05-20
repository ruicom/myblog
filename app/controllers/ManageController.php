<?php
namespace App\Controllers;
use App\Models\Account;
use App\Models\Blogpost;

class ManageController extends ControllerBase
{

    public function indexAction()
    {

    }

    
    /** 
    * @brief 获取到用户的信息
    * 
    * @return 
    */
    public function getAccountsAction() 
    {
        $page = 1;
        $num =  8;
    
        if (isset($_GET['page']) ) {
           $page =intval($_GET['page']);
        }
        if(isset($_GET['num'])) {
           $num = intval($_GET['num']);
        }
        $begin = ($page - 1) * $num;
        $query = $this->modelsManager->createQuery("SELECT * FROM
            App\Models\Account where state = 1 order by state desc limit $num
            offset $begin");
        $accounts  = $query->execute(
        ); 
        $totalnum = Account::count(
            array(
                "conditions" => "state = 1",
            )
        );

        if ($totalnum % $num == 0) {
           $totalpage= (int)$totalnum / $num; 
        }
        else {
            $totalpage = (int)($totalnum+$num) / $num;
        }
        
        $this->view->setVar("accounts",$accounts->toArray());
        $this->view->setVar("page",$page);
        $this->view->setVar("totalpage",$totalpage);
  }


  public function searchAccountAction() 
  {
      $keyword = $_GET['keyword'];
        
      $phql = "select * from App\Models\Account where state = 1 and  username
               like '%$keyword%'";

       
      $accounts = $this->modelsManager->createQuery($phql)->execute();
      

      $this->view->setVar("accounts",$accounts->toArray());


  }


  public function searchBlogsAction()
  {
        $keyword = $_GET['keyword'];
        $phql = "select b.id,b.title,a.username,b.createtime,is_open from App\Models\Blogpost as b left join
        App\Models\Account as a on b.account_id = a.id where b.state = 1
        and title like '%$keyword%' order by b.createtime desc";
        $blogs = $this->modelsManager->executeQuery($phql);
        $this->view->setVar("blogs",$blogs);
     
  }


  public function upToAdminAction()
  {
     $id = $_GET['id'];
     $phql = "update App\Models\Account set role = 1 where id = :id:";
     
     $success = $this->modelsManager->createQuery($phql)->execute(array("id"=>$id));
        
     $message = "<br/><br/><br/>修改成功<br/><a
     href='../manage/getAccounts'>查看用户列表</a>";
     echo $message;
     $this->view->disable();

  }

  public function downToUserAction() 
  {
     $id = $_GET['id'];
     $phql = "update App\Models\Account set role = 0 where id = :id:";
     
     $success =
     $this->modelsManager->createQuery($phql)->execute(array("id"=>$id));
        
     $message = "<br/><br/><br/>修改成功<br/><a
     href='../manage/getAccounts'>查看用户列表</a>";
     echo $message;
     $this->view->disable();
 
  }
  

 public function getBlogsAction() 
 {
       $page = 1;
        $num = 15;
        if (isset($_GET['page']) ) {
           $page =intval($_GET['page']);
        }
        if(isset($_GET['num'])) {
           $num = intval($_GET['num']);
        }
        $begin = ($page - 1) * $num;
    
        $phql = "select b.id,b.title,a.username,b.createtime,is_open from App\Models\Blogpost as b left join
        App\Models\Account as a on b.account_id = a.id where b.state = 1
        order by b.createtime desc limit $num offset $begin ";
        $blogs = $this->modelsManager->executeQuery($phql);
        
        $totalnum = Blogpost::count(
                array(
                    "conditions" => "is_open=1 and state=1",
                )
        );
        if ($totalnum % $num == 0) {
           $totalpage= (int)$totalnum / $num; 
        }
        else {
            $totalpage = (int)($totalnum+$num) / $num;
        }
        echo $totalpage;
        echo "<br/>" . $page;
        $this->view->setVar('page',$page);
        $this->view->setVar('totalpage',$totalpage);
        $this->view->setVar("blogs",$blogs);
 
 }


 public function upToOpenAction()
 {
     $id = $_GET['id'];
     $phql = "update App\Models\Blogpost set is_open = 1 where id = :id:";
     
     $success = $this->modelsManager->createQuery($phql)->execute(array("id"=>$id));
        
     $message = "<br/><br/><br/>修改成功<br/><a
     href='../manage/getBlogs'>查看博客列表</a>";
     echo $message;
     $this->view->disable();
   
 }


 public function downToPrivateAction() 
 {
     $id = $_GET['id'];
     $phql = "update App\Models\Blogpost set is_open = 0 where id = :id:";
     
     $success = $this->modelsManager->createQuery($phql)->execute(array("id"=>$id));
        
     $message = "<br/><br/><br/>修改成功<br/><a
     href='../manage/getBlogs'>查看博客列表</a>";
     echo $message;
     $this->view->disable();

 }


}



