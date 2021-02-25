<?php
require_once("connectdb.php"); /*連接資料庫*/
$result = mysqli_query($link,'SELECT `date`,`title`,SUM(`unitprice`*`OutQuantity`) FROM `stockout` GROUP BY `date`,`title`');
?>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>華育機電の各案成本統計</title>
	<link rel="stylesheet" href="beauty.css">
</head>

<body bgcolor="#A9C6D9">
    
    <center>
	<font size="10" color="#613030">各案成本統計</font><P>
	<font size="2.5"color="#613030">搜尋案名：</font>
	<input type="search" class="light-table-filter" data-table="order-table" placeholder="請輸入關鍵字"><p>
    <button name="Submit" class="btn" id="SObtn" onclick="Goback();"> 回首頁</button>

    <form name="TotalCost" id="TotalCost" class="inlineform">
		<table class="order-table SOtable" border=1 width=50% align="center" >
			<thead>
				<tr>
					<th>日期</th>
                    <th>案名</th>
                    <th>總成本</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($row=mysqli_fetch_row($result))
				{
				?>	
				<tr align="center">
                    <td><?php printf ("%s",$row[0]);?></td>
                    <td><?php printf ("%s",$row[1]);?></td>
					<td><?php printf ("%d",$row[2]);?>元</td>			
				</tr>
			</tbody>
		    	<?php	
			    }
				mysqli_free_result($result) //釋放內存
				?>	
		</table>
	</form>
</body>

<script>  
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

    /*跳轉頁面*/
	function Goback(){
		location.href="ShowProducts.php";
	}
</script>
