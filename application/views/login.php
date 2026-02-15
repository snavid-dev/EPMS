<!DOCTYPE html>
<html>

<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta content="ie=edge" http-equiv="x-ua-compatible">
	<meta content="template language" name="keywords">
	<meta content="Tamerlan Soziev" name="author">
	<meta content="Admin dashboard html template" name="description">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="<?= base_url() . 'assets/' ?>favicon.png" rel="shortcut icon">
	<link href="<?= base_url() . 'assets/' ?>apple-touch-icon.png" rel="apple-touch-icon">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
	<link href="<?= base_url() . 'assets/' ?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
	<script src="<?= base_url() . 'assets/' ?>bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/js/xhrFunctions.js"></script>



	<!-- Pnotify CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/pnotify.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/pnotify.buttons.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/pnotify.nonblock.css">

	<link href="<?= base_url() . 'assets/' ?>css/main.css?version=4.4.0" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/rtl.css?version=4.4.0" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/custom.css?version=4.4.0" rel="stylesheet">
	<style>
		body:before {
			background-image: url("<?= base_url() ?>/assets/back light.jpg") !important;
			background-size: cover !important;
		}

		.logo-w img {
			width: 100% !important;
		}
	</style>

</head>

<body class="auth-wrapper">
	<div class="all-wrapper menu-side">
		<div class="auth-box-w">
			<div class="logo-w">
				<a href="<?= base_url() ?>"><img alt="" src="https://cyborgtech.co/wp-content/themes/CyborgTech/assets/img/logo-dark.png"></a>
			</div>
			<h4 class="auth-header">
				فرم ورود
			</h4>
			<form id="navid" action="<?= base_url() ?>Login/" method="POST">
				<div class="form-group">
					<label for="">نام کاربری</label><input class="form-control" name="username" value="" placeholder="نام کاربری" type="text" autocomplete="off">
					<div class="pre-icon os-icon os-icon-user-male-circle"></div>
				</div>
				<div class="form-group">
					<label for="">رمز عبور</label><input class="form-control" name="password" placeholder="رمز عبور" type="password" autocomplete="off">
					<div class="pre-icon os-icon os-icon-fingerprint"></div>
				</div>
				<div class="buttons-w">
					<button type="submit" class="btn btn-primary">ورود</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Pnotify -->
	<script src="<?= base_url() ?>assets/js/pnotify.js"></script>
	<script src="<?= base_url() ?>assets/js/pnotify.buttons.js"></script>
	<script src="<?= base_url() ?>assets/js/pnotify.nonblock.js"></script>

	<script src="<?= base_url() . 'assets/' ?>js/custom.js?version=4.4.0"></script>

	<script>
		<?php if (isset($_SESSION['er_msg'])) : ?>
			init_PNotify("خطا!", "<?= $_SESSION['er_msg'] ?>", "error");
		<?php endif; ?>
	</script>
</body>

</html>