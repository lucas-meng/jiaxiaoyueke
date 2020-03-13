<?php
define ( 'MYDATE', "" );
define ( 'MYCOURSE', "" );
// 引入model文件
require_once '../libs/FactoryModel.class.php';

// 定义最终的学生控制器类
final class AdminController {
	// 主页查询
	public function index() {
		// 展示数据
		include_once '../view/AdminView.html';
	}
	// 增加数据
	public function insert() {
		// 获取表单提交值
		$data = array ();
		$fields = array (
				'date_date',
				'onePeople',
				'twoPeople',
				'threePeople',
				'fourPeople',
				'fivePeople' 
		);
		foreach ( $fields as $v ) {
			$data [$v] = isset ( $_POST [$v] ) ? trim ( htmlspecialchars ( $_POST [$v] ) ) : '';
		}
		
		// 创建模型类对象
		$modelObj = FactoryModel::getInstance ( "AdminModel" );
		$false = $modelObj->fetchAllDateCount ( $data ['date_date'] );
		if (! empty ( $data ['date_date'] )) {
			if (( int ) $false ['count'] == 0) {
				$modelObj->insert ( $data ['date_date'], '1', $data ['onePeople'] );
				$modelObj->insert ( $data ['date_date'], '2', $data ['twoPeople'] );
				$modelObj->insert ( $data ['date_date'], '3', $data ['threePeople'] );
				$modelObj->insert ( $data ['date_date'], '4', $data ['fourPeople'] );
				$modelObj->insert ( $data ['date_date'], '5', $data ['fivePeople'] );
				$msg = "alert('生成课表成功！')";
				if (! empty ( constant ( "MYDATE" ) ) && ! empty ( constant ( "MYCOURSE" ) )) {
					$modelObj->insertToMe ( constant ( "MYDATE" ), constant ( "MYCOURSE" ) );
				}
			} else {
				$msg = "alert('生成课表失败，日期选择不正确！')";
			}
		} else {
			$msg = "alert('生成课表失败，没有选择日期！')";
		}
		include_once '../view/AdminView.html';
	}
	// 删除日期
	public function delete() {
		$date_date = trim ( htmlspecialchars ( $_GET ['date_date'] ) );
		// 创建模型类对象
		$modelObj = FactoryModel::getInstance ( "AdminModel" );
		if ($modelObj->deleteDate ( $date_date )) {
			if ($modelObj->deleteStudent ( $date_date )) {
				$msg = "alert('删除成功！')";
			} else {
				$msg = "alert('学生约课信息删除失败！')";
			}
		} else {
			$msg = "alert('课表信息删除失败！')";
		}
		include_once '../view/AdminView.html';
	}
	// 修改日期
	public function update() {
		// 获取表单提交值
		$data = array ();
		$fields = array (
				'up_date_date',
				'course_name',
				'people' 
		);
		foreach ( $fields as $v ) {
			$data [$v] = isset ( $_GET [$v] ) ? trim ( htmlspecialchars ( $_GET [$v] ) ) : '';
		}
		// 创建模型类对象
		$modelObj = FactoryModel::getInstance ( "AdminModel" );
		if ($modelObj->update ( $data )) {
			$msg = "alert('课表信息修改成功！')";
		} else {
			$msg = "alert('课表信息修改失败！')";
		}
		
		include_once '../view/AdminView.html';
	}
}

header ( "content-type:text/html;charset=utf-8" );

// 获取用户动作参数
$ac = isset ( $_GET ['ac'] ) ? $_GET ['ac'] : 'index';

// 创建控制器类的对象
$controllerObj = new AdminController ();
// 根据用户不同的参数调用不同的方法
$controllerObj->$ac ();