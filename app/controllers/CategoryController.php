<?php
namespace App\Controllers;
use App\Models\Category;

class CategoryController extends ControllerBase
{

    public function indexAction()
    {

    }


    public function addCategoryAction()
    {
        $account_id = $this->session->get('auth')->id;
        $arr = $_POST;
        $arr['state'] = 1;
        $arr['createtime'] = time();
        $arr['num'] = 0;
        $arr['updatetime'] = time();
        $arr['account_id'] = $account_id;
        $category = new Category();
        $success =
        $category->save($arr,array('name','state','createtime','updatetime','num','account_id'));
        if($success) {
            $message = "<br/><br/><br/>增加成功！<br/><a href='getAllCategory'>前往类别</a>";
            echo $message;
            $this->view->disable();
        }
        else {
            foreach($category->getMessages() as $mes) 
            {
                echo $mes->getMessage();
            }
        }
        

    }


    public function deleteCategoryAction()
    {
        $id = $_POST['id'];

        //j检查和是否有相关文章.
        $phql = "select count(1)as num from App\Models\Blogpost where
        catetory_id = :id:";
    
        $result =  $this->modelsManager->executeQuery($phql,array("id" => $id));
        
        if ($result->num >= 1) {
            echo "该分类存在文章，不能删除";
        }
        else {
            //进行删除
            $phql = "update App\Models\Category set state = 0 where id = :id:";

            $result =  $this->modelsManager->executeQuery($phql,array("id" =>
            $id));
            echo "删除成功";
        }

    }

    
    public function getAllCategoryAction() 
    {
        $phql = "select * from App\Models\Category where state = 1";
        $categorys = $this->modelsManager->executeQuery($phql);

        $this->view->setVar("categorys",$categorys);
        var_dump($categorys->toArray());
        die();

     }
    public function categorySettingAction()
    {
        
    }


    public function addCategoryViewAction()
    {
        
    }

    
    public function getCategoryBlogsAction()
    {
       
       $account_id = $this->session->get('auth')->id;
       $category_id = $_GET['id'];
       $category_name = $_GET['name'];

       echo $account_id;
       echo "<br/>";
       echo $category_id;
        //查询所有的结果
        
        $phql = "select * from App\Models\Blogpost where category_id =
            :category_id: and account_id = :account_id:";

        $blogs = $this->modelsManager->executeQuery($phql,array(
            "category_id" => $category_id,
            "account_id"  => $account_id
            )
        );
        var_dump($blogs->toArray()); 
        $this->view->setVar("blogs",$blogs->toArray()); 
        $this->view->setVar("cate_name",$category_name); 

    }
}


