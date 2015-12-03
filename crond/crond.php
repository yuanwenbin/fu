<?php
class Model
{
	private $hostname = '';

	private $username = '';
	private $password = '';
	
	private $database = '';
	private $dbcharset = 'utf8';
	public static $conn = null;
	function __construct()
	{
		if(is_null(self::$conn))
		{
			$link = new mysqli($this->hostname,$this->username,$this->password,$this->database);
			if(mysqli_connect_errno())
			{
				die('error: ' . mysqli_connect_error());
			}
			$link->query("set names " . $this->dbcharset);
			self::$conn = $link;
		}
		return self::$conn;
	}

	function clearData()
	{
    	$affectTime = time() - 7200;
    	$sql = "select order_location_id from fu_order_info where order_payment = 0 and order_datetime < " . $affectTime;
    	$res = $this->query($sql);
    	$ids = '';
    	if($res)
    	{
    		$ids = "(";
    		foreach($res as $v)
    		{
    			$ids .= $v['order_location_id'] . ",";
    		}   
    		$ids = substr($ids,0,-1) . ")";
    		$userSQL = "delete from fu_user where user_location_id in " . $ids;
    	}
    	$upSQL = "update fu_location_list set location_number = 2,location_date=0 where location_date < " . $affectTime . " and location_ispayment = 0";
    	$delSql = "delete from fu_order_info where order_payment = 0 and order_datetime <  " . $affectTime;
    	$this->update($upSQL);
    	$this->update($delSql);
    	if($ids)
    	{
    		$this->update($userSQL);
    	}

	}


	// 修改
	function update($sql)
	{
		self::$conn->query($sql);
		//return self::$conn->affected_rows;
	}
	
	// 查找
	function query($sql)
	{
		$arr = array();
		$res = self::$conn->query($sql);
		if(!$res)
		{
			return 0;
		}
		
		while($row = $res->fetch_assoc())
		{
			$arr[] = $row;
		}
		return $arr;
	}
	// 析构函数
	function __destruct()
	{
		self::$conn->close();
	}
}

$model = new Model();
$model->clearData();