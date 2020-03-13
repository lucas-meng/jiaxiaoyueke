<?php
// 定义最终的单例的数据库工具类
final class Db {
	// 私有的静态的保存对象的属性
	private static $obj = null;
	// 私有的数据库配置信息
	private $db_host;
	// private $db_port;
	private $db_user;
	private $db_pass;
	private $db_name;
	private $charset;
	// 私有的构造方法：防止类外new对象
	private function __construct(array $config) {
		$this->db_host = $config ['db_host'];
		// $this->db_port = $config ['db_port'];
		$this->db_user = $config ['db_user'];
		$this->db_pass = $config ['db_pass'];
		$this->db_name = $config ['db_name'];
		$this->charset = $config ['charset'];
		// 连接MySQL服务器
		$this->connectDb ();
		// 选择数据库
		$this->selectDb ();
		// 设置字符编码
		$this->setCharset ();
	}
	// 私有的克隆方法，阻止类clone对象
	private function __clone() {
	}
	// 公共的静态的创建对象的方法
	public static function getInstance($config) {
		// 判断当前对象是否存在
		if (! self::$obj instanceof self) {
			// 如果不存在则创建它
			self::$obj = new self ( $config );
		}
		// 如果对象存在，直接返回
		return self::$obj;
	}
	// 私有的连接mysql服务器
	private function connectDb() {
		if (! @mysql_connect ( $this->db_host, $this->db_user, $this->db_pass ))
			die ( "PHP连接MySQL服务器失败" );
	}
	// 私有的选择数据库
	private function selectDb() {
		if (! mysql_select_db ( $this->db_name ))
			die ( "选择数据库{$this->db_name}失败！" );
	}
	// 私有的设置字符集
	private function setCharset() {
		$this->exec ( "set names {$this->charset}" );
	}
	// 公共的执行sql语句增删改
	public function exec($sql) {
		// 转小写
		$sql = strtolower ( $sql );
		// 判断sql语句是不是select语句
		if (substr ( $sql, 0, 6 ) == 'select') {
			die ( "该方法不能执行select语句" );
		}
		// 返回布尔值
		return mysql_query ( $sql );
	}
	// 公共的执行sql语句查
	public function query($sql) {
		// 转小写
		$sql = strtolower ( $sql );
		// 判断sql语句是不是select语句
		if (substr ( $sql, 0, 6 ) != 'select') {
			die ( "该方法不能执行非select语句" );
		}
		// 返回结果集
		return mysql_query ( $sql );
	}
	// 公共的获取单行纪录的方法（一维数组）
	public function fetchOne($sql, $type = 3) {
		$result = $this->query ( $sql );
		$types = array (
				1 => MYSQL_NUM,
				2 => MYSQL_BOTH,
				3 => MYSQL_ASSOC 
		);
		// 返回一条纪录
		return mysql_fetch_array ( $result, $types [$type] );
	}
	// 公共的获取多行纪录的方法（多维数组）
	public function fetchAll($sql, $type = 3) {
		$result = $this->query ( $sql );
		$types = array (
				1 => MYSQL_NUM,
				2 => MYSQL_BOTH,
				3 => MYSQL_ASSOC 
		);
		// 返回一条纪录
		while ( $row = mysql_fetch_array ( $result, $types [$type] ) ) {
			$arrs [] = $row;
		}
		return $arrs;
	}
	// 公共的获取纪录数的方法
	public function rowCount($sql) {
		// 执行sql语句，返回结果集
		$result = $this->exec ( $sql );
		// 返回纪录数
		return mysql_affected_rows ( $result );
	}
}