<?php
require_once("connectdb.php");
$result = mysqli_query($link,'select * from products');
date_default_timezone_set("Asia/Taipei");
?>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>商品出庫</title>
	<link rel="stylesheet" href="beauty.css">
</head>
<body bgcolor="#A9C6D9">
	<center>
	<font size="10" color="#1F4D5E">商品出庫</font><P>

	<form id="StockOut" name="StockOut" method="POST" action="delete.php" class="inlineform">
		<font size="2.5" color="#1F4D5E">日期：</font>
		<input type="text" name="date" id="date"  placeholder="YYYY/MM/DD">
		<font size="2.5" color="#1F4D5E">出庫單標題：</font>
		<input type="text" name="title" id="title" placeholder="客戶單位-案名">
		<table class="order-table SOtable"  border=3 width=70% align="center">
			<?php 
			if(isset($_POST['EditorCheckboxes']))
			{
			?>
				<thead>
					<tr align="center">
						<th align="center" width=10%>編號</th>
						<th align="center" width=30%>商品名稱</th>
						<th align="center" width=10%>出庫數量</th>
						<th align="center" width=10%>庫存位置</th>
						<th align="center" width=10%>規格</th>
						<th align="center" width=10%>備註</th>
						<th align="center" width=10%>單價</th>
					</tr>
				</thead>
				<?php 
				$postcheck=$_POST['EditorCheckboxes'];
				foreach ($postcheck as $key =>$value)
				{	
					$checkvalue=mysqli_query($link,"SELECT * FROM `products` WHERE `ProductNumber`='".$value."'");
					while($checkvaluedata=mysqli_fetch_row($checkvalue))
					{?>
						<tbody>
							<tr align="center">
								<td align="center"><?php echo $checkvaluedata[0];?> </td>
								<td><?php echo $checkvaluedata[1];?></td>
								<td><input type="text" name="OutQuantity<?php echo $key;?>" value="" oninput="if(value><?php echo $checkvaluedata[2];?>)value=<?php echo $checkvaluedata[2];?>;if(value<0)value=0;value=value.replace(/[^\d]/g,'')" placeholder="庫存裡有<?php echo $checkvaluedata[2];?>pcs"></td>
								<td><?php echo $checkvaluedata[3];?></td>
								<td><?php echo $checkvaluedata[4];?></td>
								<td><?php echo $checkvaluedata[5];?></td>
								<td><?php echo $checkvaluedata[7]."元";?></td>
							</tr>
						</tbody>
						<input type="hidden" name="QuantityValue<?php echo $key;?>" value="<?php echo $checkvaluedata[2];?>">
						<input type="hidden" name="Checked[]" value="<?php echo $checkvaluedata[0];?>">
					<?php
					}
				}
			}
			else
			{	
				die("沒有勾選商品");
			}
			?>
		</table>
		<input type="submit" name="submitOut" class="btn" id="SObtn" value="出庫"/>
	</form>

	<form  id="GoShowProducts" action="ShowProducts.php" class="inlineform"> 
		<input type='submit' class="btn" id="SObtn" value="返回">
	</form>
	
</body>
