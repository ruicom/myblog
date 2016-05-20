<?php
namespace App\Controllers;
use App\Models\Site;
use App\Models\Account;
use App\Models\Blogpost;
use App\Models\Comment;
use App\Models\Category;

class BlogController extends ControllerBase
{

    public function indexAction()
    {
        $page = 1;
        $num =  5;
    
        if (isset($_GET['page']) ) {
           $page =intval($_GET['page']);
        }
        if(isset($_GET['num'])) {
           $num = intval($_GET['num']);
        }
        $begin = ($page - 1) * 5;
        
        $account_id = $this->session->get("auth")->id;
     
        $site = Site::findFirst(     
            array(
                "conditions" => "account_id = ?1",
                "bind"       => array(1 => $account_id)
            )
        );
       $blogs = Blogpost::find(
            array(
                "conditions" => "account_id = ?1 and state = 1 limit $num
                offset $begin",
                "bind"       => array(1 => $account_id)
            )
        );
        $totalnum = Blogpost::find(
            array(
                "conditions" => "account_id = ?1 and state = 1 ",
                "bind"       => array(1 => $account_id)
            )
        )->count();
        if ($totalnum % $num == 0) {
           $totalpage= (int)$totalnum / $num; 
        }
        else {
            $totalpage = (int)($totalnum+$num) / $num;
        }
        

        //获取分类的书
       $categorys = Category::find(array(
            "conditions" => "state = 1 and account_id = :id:",
            "bind"       => array("id" => $account_id)
       ));       

        $this->view->setVar('categorys',$categorys->toArray());
        $this->view->setVar('page',$page);
        $this->view->setVar('totalpage',$totalpage);
        $this->view->setVar('blogs',$blogs->toArray());
        $this->view->setVar('site',$site);
    }
    
    public function searchAction() 
    {
        $page = 1;
        $num =  5;
    
        if (isset($_GET['page']) ) {
           $page =intval($_GET['page']);
        }
        if(isset($_GET['num'])) {
           $num = intval($_GET['num']);
        }
        $begin = ($page - 1) * 5;
        
        $account_id = $this->session->get("auth")->id;
     
        $site = Site::findFirst(     
            array(
                "conditions" => "account_id = ?1",
                "bind"       => array(1 => $account_id)
            )
        );

       $keyword='';
       if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
       }
        $phql = "select * from App\Models\Blogpost where state = 1 and
            account_id = :account_id: and title like '%$keyword%' limit $num offset
            $begin";
        $blogs = $this->modelsManager->executeQuery($phql,
            array(
                "account_id" => $account_id,
            )
        );      
         $phql = "select * from App\Models\Blogpost where state = 1 and
            account_id = :account_id: and title like '%$keyword%'";
         $totalnum = $this->modelsManager->executeQuery($phql,
            array(
                "account_id" => $account_id,
            )
        )->count();
       /*
       $blogs = Blogpost::find(
            array(
                "conditions" => "account_id = ?1 and state = 1 and title like
                '%'$keyword'%' limit $num offset $begin",
                "bind"       => array(1 => $account_id)
            )
        );
        $totalnum = Blogpost::find(
            array(
                "conditions" => "account_id = ?1 and state = 1 and title like
                %test% ",
                "bind"       => array(1 => $account_id)
            )
        )->count();
        */
       
        $totalpage = (int)(($totalnum+$num) / $num);
        $this->view->setVar('page',$page);
        $this->view->setVar('totalpage',$totalpage);
        $this->view->setVar('blogs',$blogs->toArray());
        $this->view->setVar('site',$site);
        $this->view->setVar('keyword',$keyword);
       }
    
    /** 
    * @brief  跳转到编辑器的页面
    * 
    * @return 
    */
    public function editAction() 
    {
        $account_id = $this->session->get('auth')->id;
        echo $account_id;
       //取出所有的A类别 
       $categorys = Category::find(array(
            "conditions" => "state = 1 and account_id = :id:",
            "bind"       => array("id" => $account_id)
       ));
       $this->view->setVar("categorys",$categorys->toArray());
    }

    
    /** 
    * @brief 发布博客的处理
    * 
    * @return 
    */
    public function postAction() 
    {
        $account_id = $this->session->get("auth")->id;
        //获取到需要的数据 
        $attr = $_POST;
        
        
        //补充需要的数据
        $attr['createtime'] = time();
        $attr['updatetime'] = time();
        $attr['account_id'] = $account_id;
        $attr['state'] = 1;
        
        $blog = new Blogpost();
        $success =
        $blog->save($attr,array('category_id','state','title','comtent','account_id','createtime','updatetime','is_open'));
    
        $phql = "update App\Models\Category set num=num+1 where id = :id:";
        $success = $success && ($this->modelsManager->executeQuery($phql,array("id" =>
        $attr['category_id'])));
             
        if($success == true) {
            echo "<br/>博客发表成功<br/><a href='index'>前往主页</a>";
        }
        else {
            foreach($blog->getMessages() as $message) {
                echo $message->getMessage();
            }
        }

    }
        
    
    public function aboutMeAction()
    {
        $account_id = $this->session->get("auth")->id;
        $site = Site::findFirst(     
            array(
                "conditions" => "account_id = ?1",
                "bind"       => array(1 => $account_id)
            )
        );
        $aboutMe = $site->about_me;
        $this->view->setVar("aboutMe",$aboutMe);

    }

    protected function getCommentList($blog_id,$parent_id = 0,&$result = array()) 
    {
       $arr = Comment::find(array(
            "conditions" => "parent_id = :parent_id: and blog_id = :blog_id:",
            "bind" => array( 
                "parent_id" => $parent_id,
                "blog_id" => $blog_id,
            ),
            "order" => "create_time desc"
       ));
       $resultArr = $arr->toArray();
       if ($arr->count() == 0) {
            return array();
       }
       foreach($resultArr as $cm) {
           $thisArr = &$result[]; 
           $cm['child'] = $this->getCommentList($blog_id,$cm['id'],$thisArr);
           $thisArr = $cm;
       }
       return $result;
    }

    protected function object2array($object) {
      if (is_object($object)) {
        foreach ($object as $key => $value) {
          $array[$key] = $value;
        }
      }
      else {
        $array = $object;
      }
      return $array;
    }    
    public function addCommentAction() 
    {
        $user = array();
        if (null != $this->session->get("auth")) {
           $user = $this->session->get("auth"); 
           $user = $this->object2array($user);
        }
        else 
        {
           $user['id'] = 0; 
           $user['username'] = '游客';
        }
        $comment = new Comment();
        $data=array();
        if((isset($_POST["comment"]))&&(!empty($_POST["comment"]))){
            //解析json数据
            $cm = json_decode($_POST["comment"],true);
            $cm['create_time']=date('Y-m-d H:i:s',time());

            $cm['account_username'] = $user['username']; 
             
            //增加到数据库里面
            $comment->save($cm,'create_time,account_username,content,parent_id,blog_id'); 
 
            $cm['nickname'] = $user['username'];

            $cm["id"] = $comment->id;

                $data = $cm;

            $num = Comment::count(
                array(
                    "conditions" => "blog_id = :blog_id:",
                    "bind" => array(
                        "blog_id" => $cm['blog_id']
                    )
            ));


            $data['num']= $num;

        }else{
            $data["error"] = "0";
        }

        $this->outputJson($data);
    } 

    public function deleteCommentAction()
    {
        
        if((isset($_POST["comment"]))&&(!empty($_POST["comment"]))){ 
            $cm = json_decode($_POST["comment"],true);
            $comment_id = $cm['comment_id'];
            $phql = "DELETE FROM App\Models\Comment WHERE id = :id: or
            parent_id = :id:";
            $status = $this->modelsManager->executeQuery($phql, array(
                'id' => $comment_id
            ));
            /*
            $comment = Comment::findFirst(array(
                "conditions" => "id = :comment_id:",
                "bind"       => array("comment_id" => $comment_id)
             ));
            $comment->delete(); 
            */
        }
        $data = array();
        $num = Comment::count(
            array(
                "conditions" => "blog_id = :blog_id:",
                "bind" => array(
                    "blog_id" => $cm['blog_id']
                )
        ));
        $data['num'] = $num;
        $this->outputJson($data);

     }
    public function descriptionAction() 
    {
        $id = $_GET['id'];
        //获取到对应的文章详情页
        $blog = Blogpost::findFirst(
            array(
                "conditions" => "id = ?1",
                "bind"       => array(1 => $id)
            )
        );
        $comments = $this->getCommentList($id);

        $num = Comment::count(
            array(
                "conditions" => "blog_id = :blog_id:",
                "bind" => array(
                    "blog_id" => $id
                )
            ));
        $this->view->setVar("blog",$blog);

        $this->view->setVar("datas",$comments);

        $this->view->setVar("num",$num);
 
            
    } 
    public function editDemoAction()
    { 
    }
        
    public function postdemoAction()
    {
        $content = $_POST['content'];
        echo $content;
        die();
    }

    public function deleteBlogAction() 
    {
        $id = $_GET['id'];
        $phql = "update App\Models\Blogpost set state = 0 where id = :id:";
        $result = $this->modelsManager->executeQuery($phql,
            array(
                "id" => $id
            )
        ); 
        if($result) {
           $message = "<br/><br/><br/>删除成功！<br/><a
           href='index'>前往主页</a>";
           echo $message;
           $this->view->disable();
        }
    }

    public function updateBlogViewAction()
    {
        $id = $_GET['id'];
        //获取到对应的文章详情页
        $blog = Blogpost::findFirst(
            array(
                "conditions" => "id = ?1",
                "bind"       => array(1 => $id)
            )
        );
        $this->view->setVar("blog",$blog);

    }

    public function updateBlogAction() 
    {
        $id = $_POST['id'];
        $content= $_POST['comtent'];
        $title = $_POST['title'];
        
        $phql = "update App\Models\Blogpost set title = :title:,comtent =
        :content:  where id = :id:";
        $result = $this->modelsManager->executeQuery($phql,
            array(
                "id"      => $id,
                "title"   => $title,
                "content" => $content
            )
        ); 
        if($result) {
           $message = "<br/><br/><br/>修改成功！<br/><a
           href='description?id=$id'>前往文章详情页</a>";
           echo $message;
           $this->view->disable();
        }
    }
        
   public function settingAction() 
   {
    
   }

    
   public function siteSettingAction()
   {
        $account_id = $this->session->get("auth")->id;
        $site = Site::findFirst(     
            array(
                "conditions" => "account_id = ?1",
                "bind"       => array(1 => $account_id)
            )
        );
        $this->view->setVar("site",$site);
              
   }

   public function siteSettingUpdateAction()
   {
        $account_id = $this->session->get("auth")->id;
        $title = $_POST['title'];
        $title_des = $_POST['title_des'];
        $about_me = $_POST['about_me'];

        $phql = "update App\Models\Site set title = :title:,title_des =
            :title_des:,about_me=:about_me:  where account_id = :account_id:";
        $result = $this->modelsManager->executeQuery($phql,
            array(
                "account_id"      => $account_id,
                "title"   => $title,
                "title_des" => $title_des,
                "about_me" => $about_me
            )
        ); 
        if($result) {
           $message = "<br/><br/><br/>设置成功！<br/><a
           href='index'>前往主页</a>";
           echo $message;
           $this->view->disable();
        }

   }
    /** 
    * @brief 查询获取到所需要的所有数据
    * 
    * @return 
    */
    public function updateUserViewAction() 
    {
        $id = $_GET['id'];
        $account = account::findFirst(array(
                    "id = :id:",
                    'bind' => array(
                        'id' => $id
                    )
         )); 
        $this->view->setVar("account",$account); 
        
        
    }
    public function updateUserAction() 
    {
        $phql = "UPDATE App\Models\Account SET username = :username:, password
            = :password:, email = :email: WHERE id = :id:";
        $status = $this->modelsManager->executeQuery($phql, array(
            'id' => $_POST['id'],
            'username' => $_POST['username'],
            'password' => sha1($_POST['password']),
            'email' => $_POST['email']
        ));  
        $message = "<br/><br/><br/>修改成功<br/><a
        href='index?page=1'>前往主页</a>";
        echo $message;
        $this->view->disable();
        
    }


}

