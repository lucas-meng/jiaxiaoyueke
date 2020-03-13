<?php
// 包含所有的模型类文件
require_once '../model/GoClassModel.class.php';
require_once '../model/InformationModel.class.php';
require_once '../model/IndexModel.class.php';
require_once '../model/AdminModel.class.php';

// 定义最终的工厂类
final class FactoryModel {
	// 私有的，静态的，保存不同对象的数组属性
	private static $arrModelObj = array ();
	// 公共的，静态的，创建不同模型类对象的方法
	public static function getInstance($modelClassName) {
		// 判断当前模型类对象是否存在
		if (! isset ( self::$arrModelObj [$modelClassName] )) {
			// 如果当前模型类对象不存在，则创建并保存
			self::$arrModelObj [$modelClassName] = new $modelClassName ();
		}
		// 返回当前模型类对象
		return self::$arrModelObj [$modelClassName];
	}
}