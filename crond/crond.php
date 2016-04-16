<?php
define('BASEPATH', true);
class Model
{
	public static $conn = null;
	function __construct($hostname,$username,$password,$database,$dbcharset)
	{
		if(is_null(self::$conn))
		{
			$link = new mysqli($hostname,$username,$password,$database);
			if(mysqli_connect_errno())
			{
				die('error: ' . mysqli_connect_error());
			}
			$link->query("set names " . $dbcharset);
			self::$conn = $link;
		}
		return self::$conn;
	}
	
	function clearData()
	{
    	$affectTime = time() - 7200;
			
    	$sql = "select order_location_id,order_datetime from fu_order_info where order_payment = 0 and (order_datetime+add_datetime)  < " . $affectTime;
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
    		//$userSQL = "delete from fu_user where user_location_id in " . $ids;
			if($ids && $ids != ')')
			{
				$userSQL = "update fu_user set user_location_id = 0,user_type = '-1',user_selected=0,user_selected_date=0
									  where	user_location_id in " . $ids;
				$this->update($userSQL);
				$upSQL = "update fu_location_list set location_number = 2,location_date=0 where  localtion_id in  " . $ids;
				$delSql = "delete from fu_order_info where order_payment = 0 and order_location_id in  " . $ids;
				$this->update($upSQL);
				$this->update($delSql);
			}
    	}
		/*	
    	$upSQL = "update fu_location_list set location_number = 2,location_date=0 where location_date < " . $affectTime . " and location_ispayment = 0";
    	$delSql = "delete from fu_order_info where order_payment = 0 and order_datetime <  " . $affectTime;
    	$this->update($upSQL);
    	$this->update($delSql);
		*/
			
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
$dirRoot = dirname(dirname(($_SERVER['SCRIPT_FILENAME'])));
require_once($dirRoot.'/application/config/database.php');
$model = new Model($db['default']['hostname'],$db['default']['username'],$db['default']['password'],$db['default']['database'],$db['default']['char_set']);
$model->clearData();
 ?>