<?php
// 定义抽象的基础模型类
abstract class BaseModel {
	// 包含数据库工具类
	protected $db = null;
	public function __construct() {
		require_once 'Db.class.php';
		// 创建数据库类的对象
		$arr = array (
				'db_host' => 'localhost',
				'db_user' => 'root',
				'db_pass' => 'admin123',
				'db_name' => 'luo',
				// 'db_user' => 'luo_junengw_com',
				// 'db_pass' => '78MreCc7X34P37GS',
				// 'db_name' => 'luo_junengw_com',
				'charset' => 'utf-8' 
		);
		$this->db = Db::getInstance ( $arr );
	}
}