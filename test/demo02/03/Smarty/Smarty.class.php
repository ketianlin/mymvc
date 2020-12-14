<?php
class Smarty{
    public $template_dir='./templates/';	//默认模板目录
    public $templatec_dir='./templates_c/';	//默认混编目录
    private $tpl_var = [];

    //赋值
    public function assign($k,$v){
        $this->tpl_var[$k] = $v;
    }
    public function display($tpl){
        require $this->compile($tpl);
    }
    /*
     *作用：编译模板
     *@param $tpl string 模板的路径
     */
    private function compile($tpl){
        $tpl_file = $this->template_dir.$tpl;           //拼接模板地址
        if (!is_dir($this->templatec_dir)){
            mkdir($this->templatec_dir, 0777, true);
        }
        $com_file = $this->templatec_dir.$tpl.'.php';	//混编文件地址
        //文件存在，并且模板文件修改时间<混编文件修改时间
        if (file_exists($com_file) && filemtime($tpl_file)<filemtime($com_file)){
            return $com_file;
        }
        $str=file_get_contents($tpl_file);
        $str=str_replace('{$','<?php echo $this->tpl_var[\'',$str);	//替换左大括号
        $str=str_replace('}','\'];?>',$str);			//替换右大括号
        file_put_contents($com_file, $str);	//写入混编文件
        return $com_file;	//包含混编文件
    }
}