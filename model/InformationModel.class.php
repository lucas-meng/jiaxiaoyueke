<?php
// 包含基础模型类
require_once '../libs/BaseModel.class.php';
// 定义最终的学生类，并继承基础模型类
final class InformationModel extends BaseModel {
	// 查询到所有的日期
	public function fetchAllDate() {
		// 构建查询的SQL语句
		$sql = "SELECT date_date FROM DATE GROUP BY date_date DESC";
		// 执行sql语句并返回结果（二维数组）
		return $this->db->fetchAll ( $sql );
	}
	// 查询到当前日期的约车学院姓名
	public function fetchStudent($nowDate, $course_name) {
		// 构建查询的SQL语句
		$sql = "SELECT student_name FROM student WHERE date_date = '{$nowDate}' AND course_name = '{$course_name}'";
		// 执行sql语句并返回结果（一维数组）
		return $this->db->fetchAll ( $sql );
	}
	
	// 删除
	public function delete($data) {
		// 构建SQL语句
		$sql = "delete from student where student_name = '{$data['student_name']}' and student_pwd = '{$data['student_pwd']}' and date_date = '{$data['date_date']}' and course_name = '{$data['course_name']}'";
		return $this->db->exec ( $sql );
	}
	// 查询到当前日期的约车学员姓名
	public function fetchStudentOne($student_name, $student_pwd, $date_date, $course_name) {
		// 构建查询的SQL语句
		$sql = "SELECT student_name,student_pwd FROM student WHERE student_name = '{$student_name}' AND student_pwd = '{$student_pwd}' AND date_date = '{$date_date}' AND course_name = '{$course_name}'";
		// 执行sql语句并返回结果（一维数组）
		return $this->db->fetchOne ( $sql );
	}
}