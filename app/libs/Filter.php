<?php
namespace App\libs;

class Filter 
{
    
    /** 
    * @brief 
    * 
    * @param $datas 需要过滤的输入数据，一般是$_POST或者是$_GET里面的数据
    * @param $attrs
    * 需要过滤的属性名称。eg:method是post,array('username'),那么将会过滤$_POST里面的username属性
    * 
    * @return 
    */
    public static function filterInputData($datas,$attrs) 
    {
        foreach($attrs as $attr) {
            if(!empty($datas[$attr])) {
                $datas[$attr] = htmlspecialchars($datas[$attr]);
                $datas[$attr] = stripslashes($datas[$attr]);
                
            }
        }
        return $datas;
    }
}

?>
