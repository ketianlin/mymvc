<?php
class Smarty
{
    private $tpl_var = [];

    //赋值
    public function assign($k,$v){
        $this->tpl_var[$k] = $v;
    }
    /*
     *作用：编译模板
     *@param $tpl string 模板的路径
     */
    public function compile($tpl){
        $com_file=$tpl.'.php';		//混编文件地址
        //文件存在，并且模板文件修改时间<混编文件修改时间
        if (file_exists($com_file) && filemtime($tpl)<filemtime($com_file)){
            require $com_file;
            return;
        }
        echo 'xxx';
        $str=file_get_contents($tpl);
        $str=str_replace('{$','<?php echo $this->tpl_var[\'',$str);	//替换左大括号
        $str=str_replace('}','\'];?>',$str);			//替换右大括号
        file_put_contents($com_file, $str);	//写入混编文件
        require $com_file;	//包含混编文件
    }
}