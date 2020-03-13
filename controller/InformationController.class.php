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
final class InformationController {
	// 主页查询
	public function index() {
		// 获取日期信息
		$modelObj = FactoryModel::getInstance ( "InformationModel" );
		$dateArrs = $modelObj->fetchAllDate ();
		// 获取当前日期约车课程
		$nowDate = isset ( $_GET ['date_date'] ) ? trim ( htmlspecialchars ( $_GET ['date_date'] ) ) : $dateArrs [0] ['date_date'];
		$studentNames = array ();
		// 获取当前日期约车学员姓名
		for($i = 1; $i <= 5; $i ++) {
			@$studentNames [$i] = $modelObj->fetchStudent ( $nowDate, $i );
		}
		if ($_GET ['copy'] == "copy") {
			// 展示数据
			$hoDay = date ( "m月d号", strtotime ( "+1 day" ) );
			include_once '../view/CopyView.html';
		} else {
			// 展示数据
			include_once '../view/InformationView.html';
		}
	}
	// 删除
	public function delete() {
		// 获取表单提交值
		$data = array ();
		$fields = array (
				'student_name',
				'student_pwd',
				'date_date',
				'course_name' 
		);
		foreach ( $fields as $v ) {
			$data [$v] = isset ( $_GET [$v] ) ? trim ( htmlspecialchars ( $_GET [$v] ) ) : '';
		}
		// 创建学生模型类对象
		$modelObj = FactoryModel::getInstance ( "InformationModel" );
		$studentOne = $modelObj->fetchStudentOne ( $data ['student_name'], $data ['student_pwd'], $data ['date_date'], $data ['course_name'] );
		if ($studentOne) {
			if ($modelObj->delete ( $data )) {
				echo "<h2>学员：{$data['student_name'] } 取消约课成功！</h2>";
				header ( "refresh:2;url=?" );
				die ();
			}
		} else {
			echo "<h1>姓名或密码输入错误！</h1>";
			header ( "refresh:2;url=?" );
			die ();
		}
	}
}

header ( "content-type:text/html;charset=utf-8" );

// 获取用户动作参数
$ac = isset ( $_GET ['ac'] ) ? $_GET ['ac'] : 'index';

// 创建控制器类的对象
$controllerObj = new InformationController ();
// 根据用户不同的参数调用不同的方法
$controllerObj->$ac ();