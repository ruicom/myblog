<?php
namespace App\Controllers;
use App\Models\Test;
class IndexController extends ControllerBase
{
    public function indexAction()
    {
            $this->response->redirect("account/loginView")->sendheaders(); 
            
         
    }

    public function testAction() {
        echo "this is the first step of blog";
        $records = Test::find();
        foreach($records as $record) {
            echo $record->id;
            echo "-";
            echo $record->name;
        }
    }
}

