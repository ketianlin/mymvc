<?php
namespace Controller\Admin;

use Core\Model;
use Model\ProductsModel;

class ProductsController
{
    use \Traits\Jump;
    //获取商品列表
    public function listAction(){
        //实例化模型
        $model = new ProductsModel();
//        $rs = $model->update(['proname'=>'fuck456', 'proprice'=>456, 'proID'=>86]);
        $list = $model->select(['proprice'=>['lt', 10]]);
        //加载视图
        require __VIEW__.'products_list.html';
    }

    //添加商品
    public function addAction(){
        if (isset($_POST) && ! empty($_POST)){
            $model = new Model('products');
            $rs = $model->insert($_POST);
            if ($rs){
                $this->success('/', '插入成功');
            }else{
                $this->error('/', '插入失败');
            }
            exit;
        }
        require __VIEW__.'products_add.html';
    }

    //修改商品
    public function editAction(){
        $proid = $_GET['proid'];  //需要修改的商品id
        $model = new \Core\Model('products');
        $requestUri = $_SERVER['REQUEST_URI'];
        if (isset($_POST) && ! empty($_POST)){
            $requestUri = $_POST['requestUri'];
            unset($_POST['requestUri']);
            $_POST['proID'] = $proid;
            $rs = $model->update($_POST);
            if ($rs){
                $this->success('/', '修改成功');
            }else{
                $this->error($requestUri, '修改失败');
            }
            exit;
        }
        //显示商品
        $info = $model->find($proid);
        require __VIEW__.'products_edit.html';
    }

    //删除商品
    public function delAction() {
        $id=(int)$_GET['proid'];	//如果参数明确是整数，要强制转成整形
        $model=new \Model\ProductsModel();
        if($model->delete($id)){
            $this->success('/', '删除成功');
        }else{
            $this->error('/', '删除失败');
        }
    }
}