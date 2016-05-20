<?php

require_once 'Filter.php';
use App\libs\Filter;

class FilterTest extends PHPUnit_Framework_TestCase
{
    
   public function testFilterInputData()
   {
        $sources1 = array(
            'username' => 'chen\rui',
            'password' => '3333\44',
        );
        $expected1 = array(
            'username' => 'chenrui',
            'password' => '333344',
        );

       $ret1 =  Filter::filterInputData($sources1 ,array('username','password'));
        
       $this->assertEquals($expected1,$ret1);
         

   }



}
