<?php
require_once("connectdb.php"); /*連接資料庫*/
$result = mysqli_query($link,'select * from products');
?>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>商品庫存</title>
	<link rel="stylesheet" href="beauty.css">
</head>

<body bgcolor="#F2E6E6">

	<center>
	<font size="10" color="#613030">商品庫存管理</font><P>
	<font size="2.5"color="#613030">搜尋商品：</font>
	<input type="search" class="light-table-filter" data-table="order-table" placeholder="請輸入關鍵字"><p>
	<button class="btn" id="SPbtn1" onclick="GoSI();">新增商品</button>
	<button class="btn" id="SPbtn1" onclick="GoShowSO();">查看出庫單</button>
	<button class="btn" id="SPbtn1" onclick="GoCost();">成本統計</button>
	
	<form name="GoEditorOrOut" id="GoEditorOrOut" class="inlineform" method="POST">
		<table class="order-table SPtable" border=1 width=70% align="center" >
			<thead>
				<tr align="center">
					<th align="center" width=5%><input onclick="unselAll();" type='button' class="btn" id="SPbtn2" value="取消勾選"><br>編號</th>
					<th align="center" width=20%><input name="getcheckedForEdi" type='button' onclick="Editor();" class="btn" id="SPbtn2" value="修改商品內容"><br>商品名稱</th>
					<th align="center" width=5%><input name="getcheckedForOut" type='button' onclick="Out();" class="btn" id="SPbtn2" value="出庫"><br>數量</th>
					<th align="center" width=8%><br>庫存位置</th>
					<th align="center" width=10%><br>規格</th>
					<th align="center" width=5%><br>圖片</th>
					<th align="center" width=10%><br>備註</th>
					<th align="center" width=5%><br>單價</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($row=mysqli_fetch_row($result))
				{
				?>	
				<tr align="center">
					<td align="center" width=5%><input name="EditorCheckboxes[]" type="checkbox" value=" <?php printf ("%d",$row[0]);?>"><?php printf ("%d",$row[0]);?></td>
					<td align="center" width=20%><?php printf ("%s",$row[1]);?></td>
					<td align="center" width=5%><?php printf ("%d",$row[2]);?></td>
					<td align="center" width=5%><?php printf ("%s",$row[3]);?></td>
					<td align="center" width=10%><?php printf ("%s",$row[4]);?></td>
					<td align="center" width=5%><div class="bigimg"><img src="<?php printf ("%s",$row[6]);?> "alt="無此庫存照片"height="80px"></td>
					<td align="center" width=10%><?php printf ("%s",$row[5]);?></td>
					<td align="center" width=5%><?php printf ("%d",$row[7]);?>元</td>			
				</tr>
			</tbody>

				<?php	
				}
				mysqli_free_result($result) //釋放內存
				?>
				
		</table>
	</form>

	<script type="text/javascript">

		/*跳轉頁面*/
		function GoCost()
		{
			location.href="TotalCost.php";
		}
		function GoShowSO()
		{
			location.href="ShowStockOut.php";
		}
		function GoSI()
		{
			location.href="StockIn.php";
		}
	

		/*抓取被勾選的商品編號*/
		function getchecked() {
			const obj = document.getElementsByName("EditorCheckboxes[]");
			checkarray = [];
			for (i in obj) {
				if(obj[i].checked)
				{		
					if(checkarray == ""){
					checkarray = obj[i].value;
					}
				else{
					checkarray += ","+obj[i].value;
					}  
				}
			}
				alert(checkarray);
				return true;
			document.getElementById('GoEditorOrOut').submit();
		}

		/*取消所有勾選*/
		function unselAll(){ 
			const checkItem = document.getElementsByName("EditorCheckboxes[]");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=false;
			}
		}

		/*不同按鈕POST到不同頁面*/
		function Editor(){ 
			document.GoEditorOrOut.action="EditorProducts.php";
			document.GoEditorOrOut.submit();
		}
		function Out(){
			document.GoEditorOrOut.action="StockOut.php";
			document.GoEditorOrOut.submit();
		}

		/*搜尋功能*/
		(function(document) {
			'use strict';

			// 建立 LightTableFilter
			var LightTableFilter = (function(Arr) {
				var _input;

				// 資料輸入事件處理函數
				function _onInputEvent(e) {
					_input = e.target;
					var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
					Arr.forEach.call(tables, function(table) {
						Arr.forEach.call(table.tBodies, function(tbody) {
							Arr.forEach.call(tbody.rows, _filter);
						});
					});
				}

				// 資料篩選函數，顯示包含關鍵字的列，其餘隱藏
				function _filter(row) {
					var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
					row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
				}

				return {
					// 初始化函數
					init: function() {
						var inputs = document.getElementsByClassName('light-table-filter');
						Arr.forEach.call(inputs, function(input) {
							input.oninput = _onInputEvent;
						});
					}
				};
			})(Array.prototype);

		// 網頁載入完成後，啟動 LightTableFilter
			document.addEventListener('readystatechange', function() {
				if (document.readyState === 'complete') {
				LightTableFilter.init();
				}
			});
		})(document);
	</script>

</body>
