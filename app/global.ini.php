<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$dirRoot = dirname(BASEPATH) . '/';
require_once $dirRoot . 'application/config/database.php';
$dbHostname = $db['default']['hostname'];
$dbUsername = $db['default']['username'];
$dbPassword = $db['default']['password'];
$dbDatabase = $db['default']['database'];
$dbCharset = $db['default']['char_set'];

class Model
{
	public static $conn = null;
	function __construct($dbHostname,$dbUsername,$dbPassword,$dbDatabase,$dbCharset)
	{
		if(is_null(self::$conn))
		{
			$link = new mysqli($dbHostname,$dbUsername,$dbPassword,$dbDatabase);
			if(mysqli_connect_errno())
			{
				die('error: ' . mysqli_connect_error());
			}
			$link->query("set names " . $dbCharset);
			self::$conn = $link;
		}
		return self::$conn;
	}

	// 修改
	function update($sql)
	{
		self::$conn->query($sql);
		return self::$conn->affected_rows;
	}
	
	// 查找
	function query($sql)
	{
		$arr = array();
		$res = self::$conn->query($sql);
		return $row = $res->fetch_assoc();

	}
	// 析构函数
	function __destruct()
	{
		self::$conn->close();
	}
}
$model = new Model($dbHostname,$dbUsername,$dbPassword,$dbDatabase,$dbCharset);
$sql = "select * from fu_status where id = 1";
$res = $model->query($sql);
if(!$res['flag'])
{ ?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="orange" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<meta name="renderer" content="webkit">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>系统暂时关闭，没有开放</title>
</head>
<body>
系统暂时关闭!!!
</body>
</html>
<?php 
exit;
} ?>
