<?php
namespace App\Controllers;
use App\Models\Blogpost;

class PlatformController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
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
    
        $phql = "select b.id,b.title,a.username,b.createtime from App\Models\Blogpost as b left join
        App\Models\Account as a on b.account_id = a.id where b.state = 1
        and b.is_open = 1 order by b.createtime desc limit $num offset $begin ";
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


    public function searchAction() 
    {
        $keyword = $_GET['keyword'];
        $phql = "select b.id,b.title,a.username,b.createtime from App\Models\Blogpost as b left join
        App\Models\Account as a on b.account_id = a.id where b.state = 1
        and b.is_open = 1 and title like '%$keyword%' order by b.createtime desc";
        $blogs = $this->modelsManager->executeQuery($phql);
        $this->view->setVar("blogs",$blogs);
        
    }





}

