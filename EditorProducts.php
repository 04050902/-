<?php
require_once("connectdb.php");
?>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>修改商品庫存</title>
	<link rel="stylesheet" href="beauty.css">
</head>

<body bgcolor="#D9CDB8">
	<center>
	<font size="10" color="#022E40">修改商品庫存</font><P>
	<form id="UpdateProduct" name="UpdateProduct" method="POST" action="update.php" class="inlineform">
		<table class="order-table Editable"  border=3 width=70% align="center">
			<?php 
			if(isset($_POST['EditorCheckboxes']))
			{
			?>
				<thead>
					<tr align="center">
						<th align="center" width=10%>編號</th>
						<th align="center" width=30%>商品名稱</th>
						<th align="center" width=10%>數量</th>
						<th align="center" width=20%>庫存位置</th>
						<th align="center" width=50%>規格</th>
						<th align="center" width=50%>備註</th>
						<th align="center" width=50%>單價</th>
					</tr>
				</thead>
			<?php 
				$postcheck=$_POST['EditorCheckboxes'];
				foreach ($postcheck as $key =>$value)
				{	
					$checkvalue=mysqli_query($link,"SELECT * FROM `products` WHERE `ProductNumber`='".$value."'");
					while($checkvaluedata=mysqli_fetch_row($checkvalue))
					{
					?>
						<tbody>
							<tr align="center">
								<td align="center"><input type="hidden" name="Checked[]" value="<?php echo $checkvaluedata[0];?>"><?php echo $checkvaluedata[0];?> </td>
								<td><input type="text" name="EdiName<?php echo $key;?>" value="<?php echo $checkvaluedata[1];?>"></td>
								<td><input type="text" name="EdiQuantity<?php echo $key;?>" value="<?php echo $checkvaluedata[2];?>"></td>
								<td><input type="text" name="EdiLocation<?php echo $key;?>" value="<?php echo $checkvaluedata[3];?>"></td>
								<td><input type="text" name="EdiSPEC<?php echo $key;?>" value="<?php echo $checkvaluedata[4];?>"></td>
								<td><input type="text" name="EdiRemarks<?php echo $key;?>" value="<?php echo $checkvaluedata[5];?>"></td>
								<td><input type="text" name="EdiPrice<?php echo $key;?>" value="<?php echo $checkvaluedata[7];?>"></td>
							</tr>
						</tbody>
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
		<input type="submit" name="submitUpdate" class="btn" id="Edibtn" value="確定修改"/>
	</form>

	<form  id="GoShowProducts" action="ShowProducts.php" class="inlineform"> 
		<input type='submit' class="btn" id="Edibtn" value="返回">
	</form>

</body>
