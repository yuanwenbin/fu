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
<?php
echo "<pre>";
print_r($result);
echo "</pre>";
?>
<a href="<?php echo URL_APP_C;?>/Choice/byRandSubmit">提交</a>
</div>
</body>
</html>