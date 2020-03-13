<?php
// 引入model文件
require_once '../libs/FactoryModel.class.php';

/*
 * // 测试工程模型类是不是单例
 * $obj1 = FactoryModel::getInstance ( "StudentModel" );
 * $obj2 = FactoryModel::getInstance ( "StudentModel" );
 * $obj3 = FactoryModel::getInstance ( "NewModel" );
 * $obj4 = FactoryModel::getInstance ( "NewModel" );
 * var_dump ( $obj1, $obj2, $obj3, $obj4 );
 */

// 定义最终的学生控制器类
final class IndexController {
	// 主页查询
	public function index() {
		// 获取日期信息
		$modelObj = FactoryModel::getInstance ( "IndexModel" );
		$dateArrs = $modelObj->fetchAllDate ();
		// 获取当前日期约车课程
		$nowDate = $dateArrs [0] ['date_date'];
		$studentSums = array ();
		// 查询今日可约人数
		$kStudent = $modelObj->fetchKStudent ( $nowDate );
		// 查询今日已约人数
		$yStudent = $modelObj->fetchYStudent ( $nowDate );
		// 获取当前日期约车学员姓名
		for($i = 1; $i <= 5; $i ++) {
			@$studentSums [$i] = $modelObj->fetchStudentSum ( $nowDate, $i );
		}
		// 展示数据
		include_once '../view/IndexView.html';
	}
	// 删除
	public function delete() {
		$id = $_GET ['id'];
		// 创建学生模型类对象
		$modelObj = FactoryModel::getInstance ( "StudentModel" );
		// 调用删除方法删除
		if ($modelObj->delete ( $id )) {
			echo "<h2>ID：{$id } 删除成功！</h2>";
			header ( "refresh:1;url=?" );
			die ();
		}
	}
	
	// 显示增加表单
	public function add() {
		include '../StudentAddView.html';
	}
	// 增加数据
	public function insert() {
		// 获取表单提交值
		$data = array ();
		$fields = array (
				'name',
				'pwd' 
		);
		foreach ( $fields as $v ) {
			$data [$v] = isset ( $_POST [$v] ) ? trim ( htmlspecialchars ( $_POST [$v] ) ) : '';
		}
		// 创建模型类对象
		$modelObj = FactoryModel::getInstance ( "StudentModel" );
		if ($modelObj->insert ( $data )) {
			echo "<h2>学生信息添加成功！</h2>";
			header ( "refresh:2;url=?" );
			die ();
		}
	}
}

header ( "content-type:text/html;charset=utf-8" );

// 获取用户动作参数
$ac = isset ( $_GET ['ac'] ) ? $_GET ['ac'] : 'index';

// 创建控制器类的对象
$controllerObj = new IndexController ();
// 根据用户不同的参数调用不同的方法
$controllerObj->$ac ();