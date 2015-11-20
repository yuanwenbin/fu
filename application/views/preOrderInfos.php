<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>成功</title>

</head>
<body>

<div>
<?php echo $tips; ?><br />
<a href="/Index/index">点击返回登陆</a><br />

<p>福位号码:<?php echo $order['order_location_id']; ?></p>
<p>福位状态:成功购买</p>
<p>福位档次:<?php echo $user_type; ?></p>
<hr />
<?php
echo "<pre>";
print_r($fu_location_list);
echo "</pre>";

echo "<pre>";
print_r($order);
echo "</pre>";
?>
</div>
</body>
</html>