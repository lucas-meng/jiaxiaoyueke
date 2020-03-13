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
final class GoClassController {
	// 主页查询
	public function index() {
		// 获取日期信息
		$modelObj = FactoryModel::getInstance ( "GoClassModel" );
		$dateArrs = $modelObj->fetchAllDate ();
		// 获取当前日期约车课程与可预约人数信息
		$nowDate = isset ( $_GET ['date_date'] ) ? trim ( htmlspecialchars ( $_GET ['date_date'] ) ) : $dateArrs [0] ['date_date'];
		$people = array ();
		for($i = 1; $i <= 5; $i ++) {
			$people [$i] = $modelObj->fetchSumPeople ( $nowDate, $i );
		}
		// 获取当前日期约车课程与已预约人数信息
		$peopleGo = array ();
		for($i = 1; $i <= 5; $i ++) {
			$peopleGo [$i] = $modelObj->fetchSumPeopleGo ( $nowDate, $i );
		}
		// 展示数据
		include_once '../view/GoClassView.html';
	}
	// 增加数据
	public function insert() {
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
		// 创建模型类对象
		$modelObj = FactoryModel::getInstance ( "GoClassModel" );
		$kPeople = $modelObj->fetchSumPeople ( $data ['date_date'], $data ['course_name'] );
		$yPeople = $modelObj->fetchSumPeopleGo ( $data ['date_date'], $data ['course_name'] );
		$mPeople = $modelObj->fetchSumPeopleMe ( $data ['date_date'], $data ['student_name'] );
		if (( int ) $kPeople ['people'] > ( int ) $yPeople ['peoplego']) {
			if (( int ) $mPeople ['peopleme'] == 0) {
				if ($modelObj->insert ( $data )) {
					echo "<h2>约课成功！</h2>";
					header ( "refresh:2;url=InformationController.class.php" );
					die ();
				}
			} else {
				echo "<h2>约课失败，您已经约了一节课了哦！</h2>";
				header ( "refresh:2;url=?" );
				die ();
			}
		} else {
			echo "<h2>约课失败，已约满！请刷新界面！</h2>";
			header ( "refresh:2;url=?" );
			die ();
		}
	}
}

header ( "content-type:text/html;charset=utf-8" );

// 获取用户动作参数
$ac = isset ( $_GET ['ac'] ) ? $_GET ['ac'] : 'index';

// 创建控制器类的对象
$controllerObj = new GoClassController ();
// 根据用户不同的参数调用不同的方法
$controllerObj->$ac ();