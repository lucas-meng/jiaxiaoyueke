<?php
// 包含基础模型类
require_once '../libs/BaseModel.class.php';
// 定义最终的学生类，并继承基础模型类
final class AdminModel extends BaseModel {
	// 查询到所有的日期
	public function fetchAllDateCount($date_date) {
		// 构建查询的SQL语句
		$sql = "SELECT COUNT(date_date) count FROM DATE WHERE date_date = '{$date_date}'";
		// 执行sql语句并返回结果（二维数组）
		return $this->db->fetchOne ( $sql );
	}
	// 增加
	public function insert($date_date, $course_name, $people) {
		// 构建SQL语句
		$sql = "insert date values(null,'{$date_date}','{$course_name}','{$people}')";
		return $this->db->exec ( $sql );
	}
	// 删除
	public function deleteDate($date_date) {
		// 构建SQL语句
		$sql = "DELETE FROM DATE WHERE date_date = '{$date_date}'";
		return $this->db->exec ( $sql );
	}
	// 删除
	public function deleteStudent($date_date) {
		// 构建SQL语句
		$sql = "DELETE FROM student WHERE date_date = '{$date_date}'";
		return $this->db->exec ( $sql );
	}
	// 修改
	public function update($data) {
		// 构建SQL语句
		$sql = "UPDATE DATE SET people = {$data['people']} WHERE date_date = '{$data['up_date_date']}' AND course_name = '{$data['course_name']}'";
		return $this->db->exec ( $sql );
	}
	// 增加自己
	public function insertToMe($date_date, $course_name) {
		// 构建SQL语句
		$sql = "insert student values(null,'孟鹏宇','123',null,'{$date_date}',$course_name)";
		return $this->db->exec ( $sql );
	}
}