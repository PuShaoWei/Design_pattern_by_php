<?php

/**
 * Singleton  单例(单元素)模式实现
 * -------------------------------------
 * ** 来自说明 **
 * 
 * 通过提供对自身共享实例对访问，单元素(单例)设计模式用于限制特定对象只能被创建一次。
 * 此对象可能最多存储自身的5个实例，如果出现第6个请求，那么不得不等待。
 * 或者只是提供对先前创建的5个实例之一的引用在排队请求中，这种体系结构类型特别有用
 * 
 * ===================================== 
 * ** 应用场景 **
 * 
 * 最常用于数据库连接对象，数据库访问对象可以负责创建一个与数据库的实例化连接。
 * 接下来，只要调用这个对象的特定方法，该对象就会使用已成功创建的连接。
 * 从而减少服务器开销 
 * -------------------------------------
 * 
 * @version ${Id}$
 * @author Shaowei Pu <pushaowei@sporte.cn>
 */

class Singleton  
{
	/**
	 * [$_instance 实例容器]
	 * @var null
	 */
	private static $_instance = NULL ;
	/**
	 * [$_pdo pdo容器]
	 * @var null
	 */
	private  $_pdo = NULL ;

	/**
	 * [__clone 阉割掉克隆]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2017-02-08T11:20:19+0800
	 * @return                              [type] [description]
	 */
	private function __clone(){}

	/**
	 * [__construct 不能new啦]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2017-02-08T11:18:09+0800
	 */
    private function __construct(){
        try{
	        $this->pdo =new \PDO("mysql:dbname=数据库名字;host=127.0.0.1,root,123456");
	        $this->pdo->exec('SET NAMES utf8');//设置通信编码
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	    }catch(PDOException $e){
	        die('error:'.$e->getMessage());
	    }   
  	}
  	/**
  	 * [getinstance 单例开始]
  	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
  	 * @CreateTime	2017-02-08T11:21:31+0800
  	 * @return                              [type] [description]
  	 */
  	public static function getInstance(){
  		// 检测其并不是本类实例
  		if( !self::$_instance instanceof self ){
  			self::$_instance = new self; 
  		}
  		return self::$_instance;
  	}
  	/**
  	 * [select 简单查询操作]
  	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
  	 * @CreateTime	2017-02-08T12:11:06+0800
  	 * @param                               [type] $dbname [description]
  	 * @param                               [type] $filed  [description]
  	 * @param                               [type] $where  [description]
  	 * @return                              [type]         [description]
  	 */
	public function select($dbname,$filed,$where)
	{
		$stmt = self::$_pdo ->prepare(" SELECT {$filed} FROM {$dbname} {$where}");
		$stmt->execute();
	  	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
Singleton::getInstance();