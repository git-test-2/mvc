<?php
namespace App\Controllers;

use App\Models\Message;

class AdminBlogConroller extends BaseController
{
    public function index()
    {
        $massageModel = new Message();
        $imageModel = new \App\Models\Image();


        $allMessages = $massageModel->getAll();

        $userId = $this->auth->user()['id'];
        if($_GET){
            $massageModel->delete(key($_GET));

            echo key($_GET);
        }


        if($_POST){

            if (!empty($_FILES['userfile']['tmp_name'])) {
                $imageModel->add($_FILES['userfile']['tmp_name'],$massageModel->getLastInsertId());
            }

            $massageModel->add($userId,$_POST['text']);
            $this->redirect('blog');
        }
        $this->render('front/adminBlog',['messages'=>$allMessages]);

    }





}