<?php
// 包含基础模型类
require_once '../libs/BaseModel.class.php';
// 定义最终的学生类，并继承基础模型类
final class IndexModel extends BaseModel {
	// 查询到所有的日期
	public function fetchAllDate() {
		// 构建查询的SQL语句
		$sql = "SELECT date_date FROM DATE GROUP BY date_date DESC";
		// 执行sql语句并返回结果（二维数组）
		return $this->db->fetchAll ( $sql );
	}
	// 查询到当前日期的单节课的约车人数
	public function fetchStudentSum($nowDate, $course_name) {
		// 构建查询的SQL语句
		$sql = "SELECT COUNT(student_name) COUNT FROM student WHERE date_date = '{$nowDate}' AND course_name = '{$course_name}'";
		// 执行sql语句并返回结果（一维数组）
		return $this->db->fetchOne ( $sql );
	}
	// 查询今日可约人数
	public function fetchKStudent($nowDate) {
		// 构建查询的SQL语句
		$sql = "SELECT SUM(people) sumPeople FROM DATE WHERE date_date = '{$nowDate}'";
		// 执行sql语句并返回结果（一维数组）
		return $this->db->fetchOne ( $sql );
	}
	// 查询今日已约人数
	public function fetchYStudent($nowDate) {
		// 构建查询的SQL语句
		$sql = "SELECT COUNT(student_name) countPeople FROM student WHERE date_date = '{$nowDate}'";
		// 执行sql语句并返回结果（一维数组）
		return $this->db->fetchOne ( $sql );
	}
}