<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<!-- BEGIN META -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no minimal-ui" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link href="<?= base_url('favicon.ico'); ?>" rel="apple-touch-icon" />
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="default" />
	<link rel="icon" href="<?= base_url('favicon.ico'); ?>" type="image/x-icon" />

	<meta property="og:locale" content="zh_TW" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="發票對獎系統" />
	<meta property="og:description" content="發票對獎系統" />
	<meta property="og:image" content="<?= base_url('favicon.ico'); ?>" />
	<meta property="og:image:width" content="300" />
	<meta property="og:image:height" content="300" />

	<meta property="line:title" content="發票對獎系統" />
	<meta property="line:message" content="發票對獎系統" />
	<meta property="line:image" content="<?= base_url('favicon.ico'); ?>" />
	<meta property="line:image:width" content="300" />
	<meta property="line:image:height" content="300" />
	<!-- END META -->
	<!-- BEGIN STYLESHEET-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<!--[if lt IE 9]>
	<script src="Public/js/html5shiv.js"></script>
	<script src="Public/js/respond.min.js"></script>
<![endif]-->
	<!-- END STYLESHEET-->
	<title> 發票對獎系統 </title>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h1><?= $invoice_data["title"]; ?></h1>
			</div>
		</div>
		<!-- 對獎號碼 -->
		<div class="row">
			<?php foreach ($invoice_data["item"] as $val) { ?>
				<div class="col-4 mb-3">
					<div class="card">
						<div class="card-header">
							<h3 class="text-center"><?= $val["title"]; ?>開獎號碼</h3>
						</div>
						<div class="card-body">
							<p class="card-text">
								開獎日期: <?= $val["pubDate"]; ?><br>
								<?= $val["description"]; ?><br>
							</p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<!-- 自動對獎 -->
		<div class="row">
			<div class="col text-center">
				<h2>自動對獎</h2>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<form class="text-center" action="<?= site_url('Api/check_invoice'); ?>" id="form" method="post">
					<div class="input-group  mb-3">
						<input type="text" class="form-control" name="invoice_number" id="invoice_number" placeholder="請輸入發票號碼">
						<select class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="invoice_date">選擇期數
							<ul class="dropdown-menu">
								<?php foreach ($invoice_data["item"] as $key => $val) { ?>
									<li>
										<option class="dropdown-item" value="<?= $key; ?>"><?= $val["title"]; ?></option>
									</li>
								<?php } ?>
							</ul>
						</select>
						<button class="btn btn-outline-secondary" type="submit">查詢</button>
					</div>
				</form>
			</div>
		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(function() {
			$("#form").on("submit", function(e) {
				var form = $(this);
				var url = form.attr('action');

				$.ajax({
					type: "POST",
					url: url,
					data: form.serialize(),
					success: function(data) {
						alert(data);
					}
				});

				e.preventDefault();
			});
		});
	</script>

</body>

</html>