<?php
namespace App\Controllers;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    
    /** 
    * @brief 检查表单表单项是否为非空
    * 
    * @param $form_vars
    * 
    * @return 
    */
    public function filled_out($form_vars) 
    {
       foreach($form_vars as $key => $value) {
        if((!isset($key)) || ($value == '')) {
            return false;
        }
       }
       return true;
    }

    public function valid_email($email) 
    {
        $reg = '/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/';
        if (preg_match($reg,$email) == true) {
            return true;
        }
        else {
            return false;
        }
    }

    //为什么胡不可以呢？
    public function getAccountId() 
    {
        $this->session->get('auth')->id; 
    }


    protected function getAccount() 
    {
        $this->session->get('auth');
    }

       /**
     * 使用json打包模版数据
     *
     * @param string $data       输入数组
     * @param bool   $sendHeader 默认true
     * @param int    $options    二进制掩码A
     *
     * @return String
     */
    public function jsonPack($data, $sendHeader = true, $options = null)
    {
        if ($sendHeader) {
            $this->response->setHeader('Content-Type', 'application/json');
            $this->response->setHeader('charset', 'utf-8');
        }
        if (isset($options)) {
            return json_encode($data, $options);
        } else {
            return json_encode($data);
        }
    }

    /**
     * 输出json
     *
     * @param array   $data       输入的数据
     * @param boolean $jsonencode 是否json编码
     * @param array   $options    可选项
     *
     * @access public
     * @return mixed
     */
    public function outputJson($data = array(), $jsonencode = true, $options = null)
    {
        $this->view->disable();
        $this->response->setHeader('Content-Type', 'application/json');
        $this->response->setHeader('charset', 'utf-8');
        if ($jsonencode) {
            if ($options) {
                $content = json_encode($data, $options);
            } else {
                $content = json_encode($data);
            }
        } else {
            $content = $data;
        }
        $this->response->setContent($content);
        $this->response->send();

    }

    /**
     * 输出错误
     *
     * @param int    $code    错误码
     * @param int    $type    错误类型
     * @param string $message 错误消息
     *
     * @access public
     * @return mixed
     */
    public function outputErrMsg($code, $type = null, $message = null)
    {
        if (!empty($type) || !empty($message)) {
            $this->outputJson(array('error' => array('code' => $code, 'type' => $type, 'message' => $message)));
            die;
        }
        switch ($code) {
        case 405:
            $this->outputJson(array('error' => array('code' => 405, 'type' => '', 'message' => 'Method now Allowed')));
            die;
            break;
        default:
            $this->outputJson(array('error' => array('code' => $code, 'type' => $type, 'message' => $message)));
            die;
        }
    } 

   

}
/*
$email ='1187349730@qq.com';
$controllerBase = new ControllerBase();
$result = $controllerBase->valid_email('1187349730@qq.com');
if ($result == true) {
    echo "true";
}
else {
    echo "false"; 
}

*/
