<?php
require_once("connectdb.php");
$result = mysqli_query($link,'select * from warehouse');
date_default_timezone_set("Asia/Taipei");
$today=date("Y/m/d");
?>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>新增商品庫存</title>
	<link rel="stylesheet" href="beauty.css">
</head>

<body bgcolor="#F2E1C2">
	<center>
	<font size="10" color="#B8261C">新增商品庫存</font><P>

	<form id="StockIn" name="StockIn" class="inlineform" method="POST" action="AddStockIn.php">
		<table class="order-table SItable"  border=3 align="center">
			<thead>
				<tr align="center">
					<th>日期</th>
					<th>入庫單標題</th>
					<th>商品名稱</th>
					<th>數量</th>
					<th>庫位</th>
					<th>規格</th>
					<th>備註</th>
					<th>單價</th>
				</tr>	
			</thead>
			<tbody>
				<tr align="center">
					<td><input type=text name="date" id="date"  placeholder="YYYY/MM/DD"></td>
					<td><input type=text name="Title" id="Title" placeholder="客戶單位-案名"></td>
					<td><input type="text" name="Name" id="Name"></td>
					<td><input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" name="Quantity" id="Quantity"></td>
					<td>
					<select name="Location" id="Location">
						<?php
						for($i=1;$i<=mysqli_num_rows($result);$i++)
						{
							$rs=mysqli_fetch_row($result);
							echo '<option value="'.$rs[0].'">'.$rs[0].'</option>' ;
						}
						?>
					</select>
					</td>
					<td><input type="text" name="Specifications" id="Specifications"></td>
					<td><input type="text" name="Remarks" id="Remarks"></td>
					<td><input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" name="Unitprice" id="Unitprice"></td>
			</tbody>
		</table>
		<br>
		<input type="submit" name="button" class="btn" id="SIbtn" value="新增" />
	</form>

	<button name="Submit" class="btn" id="SIbtn" onclick="Goback();"> 回首頁</button>
	<p><font size="3" color="#B8261C">記得去D:\AppServ\www\images裡面新增檔名< img"商品編號".jpg >的照片</font>
	
</body>

<script>
	function Goback()
	{
		location.href="ShowProducts.php";
	}
</script>
