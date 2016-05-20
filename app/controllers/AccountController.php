<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Libs\Filter;
use App\Models\Account;
use App\Models\Site;
use App\Libs\Smtp;
use App\Models\File;

class AccountController extends ControllerBase
{
    private $loginAttr = array('username','password');
    
    
    /** 
    * @brief  转向注册界面
    * 
    * @return 
    */
    public function registerViewAction()
    {
    }

    

    /** 
    * @brief  进行注册的处理动作
    * 
    * @return 
    */
    public function registerAction()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $username = $_POST['username'];
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];

        $birthday = strtotime($birthday);

        $errors = array();
        //数据的验证操作
        
        //(1)非空验证
        if($this->filled_out($_POST) == false) {
            $errors[] = "you hava not filled the form out correctly please go
                back and try agagin";
        }
       
        //(2)邮箱格式验证
        if($this->valid_email($email)==false) {
            $errors[] = "邮箱格式不正确，请重新尝试";
        }

        //(3)两次输入的密码是否一致
        if ($password != $password2) {
            $errors[] = "两次输入的密码不一致，请重新输入";
        }    

        //(4)判断该用户名是否已经被注册了
        $user = Account::findFirst(array(
                "username = :username:",
                'bind' => array(
                    'username' => $username,
               )
            ));
        
        if($user != NULL) {
           $errors[]  = '该用户已经被注册,请重新选择其他用户名';
        }

        if (count($errors) > 0 ) {
            $this->view->setVar("errors",$errors);
            return $this->dispatcher->forward(
                array(
                    'controller' => 'account',
                    'action'     => 'registerView'
                )
            );
        }
        $filename = $_FILES['file']['name'] . uniqid('a');
        $path = "../upload/accountimg/" . $filename;
         
        //上传文件
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

              move_uploaded_file($_FILES["file"]["tmp_name"],
              "upload/accountimg/" . $filename);
              echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                
            }
         }
        else
        {
          echo "Invalid file";
          
        }

        $file = new File();
        $file->path = $path;
        $file->createtime = time();
        $file->type = 0;
        $file->size = $_FILES['file']['size'];
        $success = $file->save();
        if(!$success) {
             foreach ($file->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }


        //数据的过滤
        $accountData = Filter::filterInputData($_POST ,$this->loginAttr);

        //数据的补充
        $accountData['createtime'] = time();
        $accountData['updatetime'] = time();
        $accountData['role'] = '0';
        $accountData['state'] = 1;

        //进行数据的加密
        $accountData['password'] = sha1($password);
        $accountData['file_id'] = $file->id;

        //执行sql语句进行数据的查询
        $account = new Account();
        $success =
            $account->save($accountData,array('file_id','username','password','email','role','state','createtime','updatetime','sex','birthday'));

        if(!$success) {
            foreach($account->getMessages() as $message) {
                echo $message->getMessage(); 
            }
        }
                //个人站点的基本的信息
        $site = new Site();
        $site->title = "$username 的专栏";
        $site->about_me = "这个人比较懒，还没有任何自我介绍~~";
        $site->account_id = $account->id;
        $site->createtime = time();
        $site->updatetime = time();
        $success = $site->save();
        if($success == true) {
            echo "<br/>注册成功,<a href = 'loginView'>前往登陆页</a>
            <img src='$path' />";
            $this->view->disable();
        }
        else {
            foreach ($site->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
    }
    

    public function adminLoginViewAction() 
    {
        
    }

    public function loginviewAction() 
    {
    }

    /** 
    * @brief 进行登录的处理
    * 
    * @return 
    */
    public function loginAction() 
    {
        if ($this->request->isPost()) {

           $username = $_POST['username'];
           $password = sha1($_POST['password']);
           $role = $_POST['role'];
           $user = Account::findFirst(array(
                    "username = :username: and password = :password:
                        and role = :role: and state = '1'",
                    'bind' => array(
                        'username' => $username,
                        'password' => $password,
                        'role' => $role
                    )
            )); 
          
           if ($user == null) {
               $this->view->setVar("errors","用户名或者密码错误");
               return $this->dispatcher->forward(
                    array(
                        'controller' => 'account',
                        'action'     => 'loginView'
                    )
                ); 
           }
           else {
            //存入session
            $this->session->set('auth', $user);
            if($role == 1) {
                $this->response->redirect("manage/index")->sendheaders(); 
            }
            else { $this->response->redirect("blog/index")->sendheaders();
            }
           }
        } 
        else {
            if($role == 0) {
                 return $this->dispatcher->forward(
                    array(
                        'controller' => 'account',
                        'action'     => 'loginView'
                    )
                );   
            }
            else {
                return $this->dispatcher->forward(
                    array(
                        'controller' => 'account',
                        'action'     => 'adminloginView'
                    )
                );
            }
             
        }
    }

    
    /** 
    * @brief  登出
    * 
    * @return 
    */
    public function logoutaction() 
    {
       $this->session->destroy();
       $this->view->disable();
       $this->response->redirect("account/loginView")->sendheaders();
       
    }

    

    public function forgetPasswordViewAction()
    {
        
    }

    /** 
    * @brief 忘记密码 
    * 
    * @return 
    */
    public function forgetPasswordAction() 
    {
        $username = $_POST['username'] ;
        $email = $_POST['email'];
        $account = Account::findFirst(array(
           "username = :username: and email = :email:",
           "bind" => array(
            "username" => $username,
            "email"    => $email
           )
        ));
    $smtpserver = "smtp.qq.com";//SMTP服务器
    $smtpserverport =25;//SMTP服务器端口
    $smtpusermail = "1187349730@qq.com";//SMTP服务器的用户邮箱
    $smtpuser = "1187349730";//SMTP服务器的用户帐号
    $smtppass = "rui13642310964";//SMTP服务器的用户密码
    
    $smtpemailto = 'onroadrui@163.com';//发送给谁
    $mailtitle = "邮件主题";//邮件主题
    $mailcontent = "邮件内容";//邮件内容

    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
    //************************ 配置信息 ****************************
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = true;//是否显示发送的调试信息
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype); 
 
 }



    public function deleteAction()
    {
        $id = $_GET['id'];
        $phql = "update App\Models\Account set state = 0 where id = :id:";
        $result = $this->modelsManager->executeQuery($phql,
            array(
                "id" => $id
            )
        ); 
        $message = "<br/><br/><br/>删除成功!<br/><a
        href='../manage/getAccounts?page=1&num=10'>查看用户列表</a>";
        echo $message;
        $this->view->disable();
    }

    
    /** 
    * @brief 查询获取到所需要的所有数据
    * 
    * @return 
    */
    public function updateViewAction() 
    {
        $id = $_GET['id'];
        $account = account::findFirst(array(
                    "id = :id:",
                    'bind' => array(
                        'id' => $id
                    )
         )); 
        $this->view->setvar("account",$account); 
        
        
    }
    public function updateAction() 
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
        href='../manage/getAccounts'>查看用户列表</a>";
        echo $message;
        $this->view->disable();
    }

}
