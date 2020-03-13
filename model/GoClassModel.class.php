<?php
// 包含基础模型类
require_once '../libs/BaseModel.class.php';
// 定义最终的学生类，并继承基础模型类
final class GoClassModel extends BaseModel {
	// 查询到所有的日期
	public function fetchAllDate() {
		// 构建查询的SQL语句
		$sql = "SELECT date_date FROM DATE GROUP BY date_date DESC";
		// 执行sql语句并返回结果（二维数组）
		return $this->db->fetchAll ( $sql );
	}
	// 查询到当前日期的约车课程信息
	public function fetchSumPeople($nowDate, $course_name) {
		// 构建查询的SQL语句
		$sql = "SELECT people FROM DATE WHERE date_date = '{$nowDate}' AND course_name = '{$course_name}'";
		// 执行sql语句并返回结果（一维数组）
		return $this->db->fetchOne ( $sql );
	}
	// 查询到当前日期的已约车信息
	public function fetchSumPeopleGo($date_date, $course_name) {
		// 构建查询的SQL语句
		$sql = "SELECT COUNT(*) peoplego FROM student WHERE date_date = '{$date_date}' AND course_name = '{$course_name}'";
		// 执行sql语句并返回结果（二维数组）
		return $this->db->fetchOne ( $sql );
	}
	// 查询到当前学员今天的已约车信息
	public function fetchSumPeopleMe($date_date, $student_name) {
		// 构建查询的SQL语句
		$sql = "SELECT COUNT(*) peopleme FROM student WHERE date_date = '{$date_date}' and student_name = '{$student_name}'";
		// 执行sql语句并返回结果（二维数组）
		return $this->db->fetchOne ( $sql );
	}
	// 增加
	public function insert($data) {
		// 构建SQL语句
		$sql = "insert student values(null,'{$data['student_name']}','{$data['student_pwd']}',null,'{$data['date_date']}','{$data['course_name']}')";
		return $this->db->exec ( $sql );
	}
}