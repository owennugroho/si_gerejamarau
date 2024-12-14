<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			font-family: "Courier New", Courier, monospace;
			font-size: 13px;
		}
		body,h1,h2,h3,h4,h5,h6 {
			margin: 0px;
			padding: 0px;
			
		}
		small {
			font-size: small;
			color: #888;
		}
		#report-header {
			position: relative;
			border-bottom: 10px double #0066cc;
			background: #fafafa;
			padding: 10px;
		}
		#report-header table{
			margin:0;
		}
		#report-header .sub-title {
			font-size: small;
			color: #888;
		}
		#report-header img {
			height: 50px;
			width: 50px;
		}
		#report-title {
			padding: 20px 0;
			border-bottom: 1px solid #ddd;
		}

		#report-body{
			padding: 0 20px;
			min-height: 500px;
			
		}
		#report-footer {
			padding: 10px;
			background: #fafafa;
			border-top: 2px solid #0066cc;
			margin: 0 auto;
		}
		#report-footer table{
			margin: 0;
			overflow: hidden;
		}
		table,
		.table {
			width: 100%;
			max-width: 100%;
			margin-bottom: 1rem;
			border-collapse: collapse;
		}
		.table th,
		.table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #eceeef;
			text-align: left;
		}
		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #eceeef;
			text-align: left;
		}
		.table tbody+tbody {
			border-top: 2px solid #eceeef;
		}
		.table .table {
			background-color: #fff;
		}
		.table-sm th,
		.table-sm td {
			padding: 0.3rem;
		}
		.table-bordered {
			border: 1px solid #eceeef;
		}
		.table-bordered th,
		.table-bordered td {
			border: 1px solid #eceeef;
		}
		.table-bordered thead th,
		.table-bordered thead td {
			border-bottom-width: 2px;
		}
		.table-striped tbody tr:nth-of-type(odd) {
			background-color: rgba(0, 0, 0, 0.05);
		}
	</style>
</head>
<body>
	<div id="report-header">
		<table class="table table-sm">
			<tr>
				<th align="left" valign="middle" width="60">
					<img width="50" height="50" src="<?php print_link('images/logo.png') ?>" />
				</th>
				<th align="left" valign="middle">
					<h3 class="company-name">{{ config('app.name') }}</h3>
					<small class="sub-title">Keuskupan Ketapang</small>
				</th>
			</tr>
		</table>
	</div>

	<div id="report-body">
		@yield('content')
	</div>

	<div id="report-footer">
		<table class="table table-sm">
			<tr>
				<td align="left" valign="middle" width="30">
					<img width="30" height="30" src="<?php print_link('images/logo.png') ?>" />
				</td>
				<td align="right" valign="middle">
					<?php echo  human_datetime(time()); ?>
				</td>
			</tr>
		</table>
	</div>
	<script>
		window.print();
	</script>
</body>

</html>