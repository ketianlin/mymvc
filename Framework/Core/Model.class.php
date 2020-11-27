<?php
namespace Core;

class Model
{
    protected $mypdo;
    private $table; //表名
    private $pk;    //主键
    public function __construct($table='') {
        $this->initMyPDO();
        $this->initTable($table);
        $this->getPrimaryKey();
    }

    //连接数据库
    private function initMyPDO()
    {
        $this->mypdo = MyPDO::getInstance($GLOBALS['config']['database']);
    }

    //获取表名
    private function initTable($table)
    {
        if ($table){
            //直接给基础模型传递表名
            $this->table = $table;
        }else{
            //实例化子类模型
            $this->table = substr(basename(get_class($this)), 0, -5);
        }
    }

    //获取主键
    private function getPrimaryKey()
    {
        $rs = $this->mypdo->fetchAll("desc `{$this->table}`");
        foreach ($rs as $rows){
            if ($rows['Key'] == 'PRI'){
                $this->pk = $rows['Field'];
                break;
            }
        }
    }

    //删除
    public function delete($id){
        $sql = "delete from `{$this->table}` where $this->pk='{$id}'";
        return $this->mypdo->exec($sql);
    }

    //万能的更新
    public function update($data){
        $keys = array_keys($data);	//获取所有键
        $index = array_search($this->pk, $keys);    //返回主键在数组中的下标
        unset($keys[$index]);
        $keys = array_map(function ($key) use ($data) {
            return "`{$key}`='{$data[$key]}'";
        }, $keys);
        $keys = implode(', ', $keys);
        $sql = "update `{$this->table}` set {$keys} where $this->pk='{$data[$this->pk]}'";
        return $this->mypdo->exec($sql);
    }

    //万能的插入
    public function insert($data){
        $keys = array_keys($data);  //获取所有的字段名
        $keys = array_map(function ($key){
            //在所有的字段名上添加反引号
            return "`{$key}`";
        }, $keys);
        $keys = implode(', ', $keys);    //字段名用逗号连接起来
        $values = array_values($data);        //获取所有的值
        $values = array_map(function ($value){
            //所有的值上添加单引号
            return "'{$value}'";
        }, $values);
        $values = implode(',',$values);	//值通过逗号连接起来
        $sql = "insert into `{$this->table}` ($keys) values ($values)";
        if ($this->mypdo->exec($sql)){
            return $this->mypdo->lastInsertId();
        }
        return false;
    }

    private function getPartCond($k, $v){
        if (is_array($v)){
            switch ($v[0]){
                case 'eq':
                    $op = '=';
                    break;
                case 'neq':
                    $op = '<>';
                    break;
                case 'gt':
                    $op = '>';
                    break;
                case 'lt':
                    $op = '<';
                    break;
                case 'gte':
                case 'egt':
                    $op = '>=';
                    break;
                case 'lte':
                case 'elt':
                    $op = '<=';
                    break;
            }
            $op = " and `{$k}` {$op} '{$v[1]}' ";
        }else{
            $op = " and `{$k}`='{$v}' ";
        }
        return $op;
    }

    //查询,返回二维数组
    public function select($cond = []){
        $sql = "select * from `{$this->table}` where 1 ";
        if ( ! empty($cond)){
            foreach ($cond as $k=>$v){
                $sql .= $this->getPartCond($k, $v);
            }
        }
        return $this->mypdo->fetchAll($sql);
    }

    //查询,返回二维数组
    public function find($id){
        $sql = "select * from `{$this->table}` where `{$this->pk}`='$id'";
        return $this->mypdo->fetchRow($sql);
    }
}