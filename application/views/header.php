<?php
$ci = get_instance();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= (isset($title)) ? $title : 'سایبورگ تک' ?></title>
	<meta charset="utf-8">
	<meta content="ie=edge" http-equiv="x-ua-compatible">
	<meta content="template language" name="keywords">
	<meta content="Tamerlan Soziev" name="author">
	<meta content="Admin dashboard html template" name="description">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="<?= base_url() . 'assets/' ?>favicon.png" rel="shortcut icon">
	<link href="<?= base_url() . 'assets/' ?>apple-touch-icon.png" rel="apple-touch-icon">
	<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">-->
	<link href="<?= base_url() . 'assets/' ?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
	<!-- Pnotify CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/pnotify.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/pnotify.buttons.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/pnotify.nonblock.css">
	<link rel="stylesheet" href="<?= base_url()  ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()  ?>assets/bower_components/bootstrap/dist/css/bootstrap.mins.css">

	<link href="<?= base_url() . 'assets/' ?>css/main.css?version=4.4.0" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/rtl.css?version=4.4.0" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/custom.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/'  ?>icon_fonts_assets/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- <link rel="stylesheet" href="<?= base_url() . 'assets/' ?>bower_components/datePickerJalali/dist/kamadatepicker.min.css"> -->

	<link rel="stylesheet" href="https://canin-cdn.cyborgtech.co/assets/plugins/jalalidatepicker/jalalidatepicker.min.css">

	<script src="<?= base_url() ?>assets/js/xhrFunctions.js"></script>
	<?php if (isset($_COOKIE['menu'])) : if ($_COOKIE['menu'] == 'right') : ?>
			<style>
				.ui-pnotify.ui-pnotify-fade-normal.ui-pnotify.ui-pnotify-move {
					left: 36px !important;
					right: auto !important;
				}
			</style>
	<?php endif;
	endif; ?>

	<?php if (isset($_COOKIE['color'])) : if ($_COOKIE['color'] == 'dark') : ?>

			<style>
				.select2-results__option {
					color: #047bf8;
				}

				.label-date {
					color: #fff;
					background-color: #2a334c;
				}
			</style>
	<?php endif;
	endif; ?>
	<style type="text/css">
		/* Chart.js */
		@-webkit-keyframes chartjs-render-animation {
			from {
				opacity: 0.99
			}

			to {
				opacity: 1
			}
		}

		@keyframes chartjs-render-animation {
			from {
				opacity: 0.99
			}

			to {
				opacity: 1
			}
		}

		.chartjs-render-monitor {
			-webkit-animation: chartjs-render-animation 0.001s;
			animation: chartjs-render-animation 0.001s;
		}
	</style>
	<style>
		.cke {
			visibility: hidden;
		}
	</style>
</head>

<body class="body color-scheme-<?php if (isset($_COOKIE['color'])) : ?><?= ($_COOKIE['color'] !== 'dark') ? 'light' : 'dark'; ?> <?= ($_COOKIE['full_screen'] !== 'border_less') ? 'full-screen' : '' ?> <?= ($_COOKIE['menu'] !== 'right') ? 'menu-position-top' : 'menu-position-side menu-side-left' ?> <?php endif; ?>">
	<div class="all-wrapper solid-bg-all">
		<div class="search-with-suggestions-w">
			<div class="search-with-suggestions-modal">
				<div class="element-search">
					<input class="search-suggest-input" placeholder="اینجا جستجو کنید..." type="text">
					<div class="close-search-suggestions">
						<i class="os-icon os-icon-x"></i>
					</div>

				</div>
				<div class="search-suggestions-group">
					<div class="ssg-header">
						<div class="ssg-icon">
							<div class="os-icon os-icon-box"></div>
						</div>
						<div class="ssg-name">
							Projects
						</div>
						<div class="ssg-info">
							24 Total
						</div>
					</div>
					<div class="ssg-content">
						<div class="ssg-items ssg-items-boxed">
							<a class="ssg-item" href="users_profile_big.html">
								<div class="item-media" style="background-image: url(<?= base_url() . 'assets/' ?>img/company6.png)"></div>
								<div class="item-name">
									Integ<span>ration</span> with API
								</div>
							</a><a class="ssg-item" href="users_profile_big.html">
								<div class="item-media" style="background-image: url(<?= base_url() . 'assets/' ?>img/company7.png)"></div>
								<div class="item-name">
									Deve<span>lopm</span>ent Project
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="search-suggestions-group">
					<div class="ssg-header">
						<div class="ssg-icon">
							<div class="os-icon os-icon-users"></div>
						</div>
						<div class="ssg-name">
							Customers
						</div>
						<div class="ssg-info">
							12 Total
						</div>
					</div>
					<div class="ssg-content">
						<div class="ssg-items ssg-items-list">
							<a class="ssg-item" href="users_profile_big.html">
								<div class="item-media" style="background-image: url(<?= base_url() . 'assets/' ?>img/avatar1.jpg)"></div>
								<div class="item-name">
									John Ma<span>yer</span>s
								</div>
							</a><a class="ssg-item" href="users_profile_big.html">
								<div class="item-media" style="background-image: url(<?= base_url() . 'assets/' ?>img/avatar2.jpg)"></div>
								<div class="item-name">
									Th<span>omas</span> Mullier
								</div>
							</a><a class="ssg-item" href="users_profile_big.html">
								<div class="item-media" style="background-image: url(<?= base_url() . 'assets/' ?>img/avatar3.jpg)"></div>
								<div class="item-name">
									Kim C<span>olli</span>ns
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="search-suggestions-group">
					<div class="ssg-header">
						<div class="ssg-icon">
							<div class="os-icon os-icon-folder"></div>
						</div>
						<div class="ssg-name">
							Files
						</div>
						<div class="ssg-info">
							17 Total
						</div>
					</div>
					<div class="ssg-content">
						<div class="ssg-items ssg-items-blocks">
							<a class="ssg-item" href="#">
								<div class="item-icon">
									<i class="os-icon os-icon-file-text"></i>
								</div>
								<div class="item-name">
									Work<span>Not</span>e.txt
								</div>
							</a><a class="ssg-item" href="#">
								<div class="item-icon">
									<i class="os-icon os-icon-film"></i>
								</div>
								<div class="item-name">
									V<span>ideo</span>.avi
								</div>
							</a><a class="ssg-item" href="#">
								<div class="item-icon">
									<i class="os-icon os-icon-database"></i>
								</div>
								<div class="item-name">
									User<span>Tabl</span>e.sql
								</div>
							</a><a class="ssg-item" href="#">
								<div class="item-icon">
									<i class="os-icon os-icon-image"></i>
								</div>
								<div class="item-name">
									wed<span>din</span>g.jpg
								</div>
							</a>
						</div>
						<div class="ssg-nothing-found">
							<div class="icon-w">
								<i class="os-icon os-icon-eye-off"></i>
							</div>
							<span>No files were found. Try changing your query...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="layout-w">
			<!--------------------
        START - Mobile Menu
        -------------------->
			<div class="menu-mobile menu-activated-on-click color-scheme-dark">
				<div class="mm-logo-buttons-w">
					<a class="mm-logo" href="index.html"><img src="<?= base_url() . 'assets/' ?>img/logo.png"><span>سایبورگ تک</span></a>
					<div class="mm-buttons">
						<div class="content-panel-open">
							<div class="os-icon os-icon-grid-circles"></div>
						</div>
						<div class="mobile-menu-trigger">
							<div class="os-icon os-icon-hamburger-menu-1"></div>
						</div>
					</div>
				</div>
				<div class="menu-and-user">
					<div class="logged-user-w">
						<div class="avatar-w">
							<img alt="" src="<?= base_url() . 'assets/user_images/' . (empty($this->session->userdata($ci->mylibrary->hash_session('u_photo'))) ? 'default.png' : $this->session->userdata($ci->mylibrary->hash_session('u_photo'))); ?>">
						</div>
						<div class="logged-user-info-w">
							<div class="logged-user-name">
								<?= ucwords($this->session->userdata($ci->mylibrary->hash_session('u_fullname'))) ?>
							</div>
							<div class="logged-user-role">
								<?= ($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'کاربر' : 'مدیر'; ?>
							</div>
						</div>
					</div>
					<!--------------------
            START - Mobile Menu List
            -------------------->
					<?php if ($this->session->userdata($ci->mylibrary->hash_session('u_role')) == 'admin') : ?>
						<ul class="main-menu">
							<li class="sub-header">
								<span>بخش اصلی</span>
							</li>
							<li class="<?= ($page == 'dashboard') ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-layout"></div>
									</div>
									<span>خانه</span>
								</a>
							</li>

							<li class="<?= ($page == 'customers')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/customers/') ?>">
									<div class="icon-w">
										<div class="fa fa-user"></div>
									</div>
									<span>حساب های مالی</span>
								</a>
							</li>


							<li class="<?= ($page == 'receipt')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/receipt') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-wallet-loaded"></div>
									</div>
									<span>رسیدات</span>
								</a>
							</li>

							<li class="<?= ($page == 'loan')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/loan') ?>">
									<div class="icon-w">
										<div class="fa fa-money"></div>
									</div>
									<span>قرضه های کوچک</span>
								</a>
							</li>

							<li class="<?= ($page == 'reports')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/reports') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-newspaper"></div>
									</div>
									<span>گزارشات</span>
								</a>
							</li>

							<li class="<?= ($page == 'reports_all')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/reports_all') ?>">
									<div class="icon-w">
										<div class="fa fa-pie-chart"></div>
									</div>
									<span>گزارش کلی</span>
								</a>
							</li>

							<li class="<?= ($page == 'report_user')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/report_user') ?>">
									<div class="icon-w">
										<div class="fa fa-address-card"></div>
									</div>
									<span>گزارش حساب های مالی</span>
								</a>
							</li>

							<li class="<?= ($page == 'users')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/users') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-users"></div>
									</div>
									<span>کاربران</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() . ('admin/logout') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-signs-11"></div>
									</div>
									<span>خروج</span>
								</a>
							</li>
						</ul>
					<?php else : ?>
						<ul class="main-menu">
							<li class="sub-header">
								<span>بخش اصلی</span>
							</li>
							<li class="<?= ($page == 'dashboard') ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('users') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-layout"></div>
									</div>
									<span>خانه</span>
								</a>
							</li>

							<li class="<?= ($page == 'DIAGNOSE') || ($page == 'Add Diagnose') || ($page == 'single patient') || ($page == 'OPD') || ($page == 'Add opd') || ($page == 'IPD') || ($page == 'Add ipd') ? 'selected' : '' ?> has-sub-menu">
								<a href="javascript:void(0)">
									<div class="icon-w">
										<div class="fa fa-stethoscope"></div>
									</div>
									<span>درج اطلاعات</span>
								</a>
								<div class="sub-menu-w">

									<div class="sub-menu-i">
										<ul class="sub-menu">
											<li>
												<a href="<?= base_url() . ('users/opd') ?>">OPD</a>
											</li>
											<li>
												<a href="<?= base_url() . ('users/ipd') ?>">IPD</a>
											</li>
											<li>
												<a href="<?= base_url() . ('users/diagnose') ?>">تشخیصیه</a>
											</li>


										</ul>
									</div>
								</div>
							</li>

							<li>
								<a href="<?= base_url() . ('admin/logout') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-signs-11"></div>
									</div>
									<span>خروج</span>
								</a>
							</li>
						</ul>
					<?php endif; ?>
					<!--------------------
            END - Mobile Menu List
            -------------------->
					<div class="mobile-menu-magic">
						<h4>
							سیستم مدیریت صرافی
						</h4>
						<p>
							سایبورگ تک
						</p>
						<div class="btn-w">
							<a class="btn btn-white btn-rounded" href="https://Cyborgtech.com/fa" target="_blank">وب سایت</a>
						</div>
					</div>
				</div>
			</div>
			<!--------------------
        END - Mobile Menu
        -------------------->
			<!--------------------
        START - Main Menu
        -------------------->
			<?php if (isset($_COOKIE['menu'])) : if ($_COOKIE['menu'] !== 'right') : ?><div class="menu-w selected-menu-color-<?= ($_COOKIE['color'] !== 'dark') ? 'light' : 'dark'; ?> menu-activated-on-hover menu-with-image menu-has-selected-link color-scheme-dark color-style-bright sub-menu-color-bright menu-position-top menu-layout-compact sub-menu-style-over"><?php else : ?>
						<div class="menu-w selected-menu-color-<?= ($_COOKIE['color'] !== 'dark') ? 'light' : 'dark'; ?> menu-activated-on-hover menu-with-image menu-has-selected-link color-scheme-<?= ($_COOKIE['color'] !== 'dark') ? 'light' : 'dark'; ?> color-style-transparent sub-menu-color-<?= ($_COOKIE['color'] !== 'dark') ? 'light' : 'dark'; ?> menu-position-side menu-side-left menu-layout-full sub-menu-style-over"> <?php endif;
																																																																																																																																																																																																													endif; ?>
					<div class="logo-w">
						<a class="logo" href="https://Cyborgtech.com/fa" target="_blank">
							<div class="logo-element"></div>
							<div class="logo-label">
								سایبورگ تک
							</div>
						</a>
					</div>
					<div class="logged-user-w avatar-inline">
						<div class="logged-user-i">
							<div class="avatar-w">
								<img alt="" src="<?= base_url() . 'assets/user_images/' .  (empty($this->session->userdata($ci->mylibrary->hash_session('u_photo'))) ? 'default.png' : $this->session->userdata($ci->mylibrary->hash_session('u_photo')));  ?>">
							</div>
							<div class="logged-user-info-w">
								<div class="logged-user-name">
									<?= ucwords($this->session->userdata($ci->mylibrary->hash_session('u_fullname'))) ?>
								</div>
								<div class="logged-user-role">
									<?= ($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'کاربر' : 'مدیر'; ?>
								</div>
							</div>
							<div class="logged-user-toggler-arrow">
								<div class="os-icon os-icon-chevron-down"></div>
							</div>
							<div class="logged-user-menu color-style-bright">
								<div class="logged-user-avatar-info">
									<div class="avatar-w">
										<img alt="" src="<?= base_url() . 'assets/user_images/' . (empty($this->session->userdata($ci->mylibrary->hash_session('u_photo'))) ? 'default.png' : $this->session->userdata($ci->mylibrary->hash_session('u_photo'))); ?>">
									</div>
									<div class="logged-user-info-w">
										<div class="logged-user-name">
											<?= ucwords($this->session->userdata($ci->mylibrary->hash_session('u_fullname'))) ?>
										</div>
										<div class="logged-user-role">
											<?= ($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'کاربر' : 'مدیر'; ?>
										</div>
									</div>
								</div>
								<div class="bg-icon">
									<i class="os-icon os-icon-wallet-loaded"></i>
								</div>
								<ul>
									<li>
										<a href="<?= base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/profile') ?>"><i class="os-icon os-icon-user-male-circle2"></i><span>پروفایل</span></a>
									</li>
									<li>
										<a href="<?= base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/lock') ?>"><i class="fa fa-lock"></i><span>قفل</span></a>
									</li>
									<li>
										<a href="<?= base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/logout') ?>"><i class="os-icon os-icon-signs-11"></i><span>خروج</span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="menu-actions">
						<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
							<i class="fa fa-bars"></i>
							<div class="os-dropdown">
								<div class="icon-w">
									<i class="fa fa-bars"></i>
								</div>
								<ul>
									<li>
										<a href="<?= ($_COOKIE['menu'] == 'top') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/top') ?>"><span>بالا</span></a>
									</li>
									<li>
										<a href="<?= ($_COOKIE['menu'] == 'right') ? 'javascript:void(0)' : base_url() .  (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/right') ?>"><span>راست</span></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
							<i class="fa fa-paint-brush"></i>
							<div class="os-dropdown">
								<div class="icon-w">
									<i class="fa fa-paint-brush"></i>
								</div>
								<ul>
									<li>
										<a href="<?= ($_COOKIE['color'] == 'light') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/light') ?>"><span>روشن</span></a>
									</li>
									<li>
										<a href="<?= ($_COOKIE['color'] == 'dark') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/dark') ?>"><span>تاریک</span></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
							<i class="fa fa-desktop"></i>
							<div class="os-dropdown">
								<div class="icon-w">
									<i class="fa fa-desktop"></i>
								</div>
								<ul>
									<li>
										<a href="<?= ($_COOKIE['full_screen'] !== 'border_less') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/full_screen') ?>"><span>صفحه کامل</span></a>
									</li>
									<li>
										<a href="<?= ($_COOKIE['full_screen'] == 'border_less') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/border_less') ?>"><span>بدون چوکات</span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="time-clock">
						<span id="clock"></span><i id="shamsi"></i>
					</div>
					<h1 class="menu-page-header">
						<?= ucwords($title) ?>
					</h1>
					<?php if ($this->session->userdata($ci->mylibrary->hash_session('u_role')) == 'admin') : ?>
						<ul class="main-menu">
							<li class="sub-header">
								<span>بخش اصلی</span>
							</li>
							<li class="<?= ($page == 'dashboard') ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-layout"></div>
									</div>
									<span>خانه</span>
								</a>
							</li>

							<li class="<?= ($page == 'customers')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/customers/') ?>">
									<div class="icon-w">
										<div class="fa fa-user"></div>
									</div>
									<span>حساب های مالی</span>
								</a>
							</li>


							<li class="<?= ($page == 'receipt')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/receipt') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-wallet-loaded"></div>
									</div>
									<span>رسیدات</span>
								</a>
							</li>

							<li class="<?= ($page == 'loan')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/loan') ?>">
									<div class="icon-w">
										<div class="fa fa-money"></div>
									</div>
									<span>قرضه های کوچک</span>
								</a>
							</li>

							<li class="<?= ($page == 'reports')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/reports') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-newspaper"></div>
									</div>
									<span>گزارشات</span>
								</a>
							</li>

							<li class="<?= ($page == 'reports_all')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/reports_all') ?>">
									<div class="icon-w">
										<div class="fa fa-pie-chart"></div>
									</div>
									<span>گزارش کلی</span>
								</a>
							</li>

							<li class="<?= ($page == 'report_user')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/report_user') ?>">
									<div class="icon-w">
										<div class="fa fa-address-card"></div>
									</div>
									<span>گزارش حساب های مالی</span>
								</a>
							</li>

							<li class="<?= ($page == 'users')  ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('admin/users') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-users"></div>
									</div>
									<span>کاربران</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() . ('admin/logout') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-signs-11"></div>
									</div>
									<span>خروج</span>
								</a>
							</li>
						</ul>
					<?php else : ?>
						<ul class="main-menu">
							<li class="sub-header">
								<span>بخش اصلی</span>
							</li>
							<li class="<?= ($page == 'dashboard') ? 'selected' : '' ?>">
								<a href="<?= base_url() . ('users') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-layout"></div>
									</div>
									<span>خانه</span>
								</a>
							</li>

							<li class="<?= ($page == 'DIAGNOSE') || ($page == 'Add Diagnose') || ($page == 'single patient') || ($page == 'OPD') || ($page == 'Add opd') || ($page == 'IPD') || ($page == 'Add ipd') ? 'selected' : '' ?> has-sub-menu">
								<a href="javascript:void(0)">
									<div class="icon-w">
										<div class="fa fa-stethoscope"></div>
									</div>
									<span>درج اطلاعات</span>
								</a>
								<div class="sub-menu-w">
									<div class="sub-menu-header">
										درج اطلاعات
									</div>
									<div class="sub-menu-icon">
										<i class="fa fa-stethoscope"></i>
									</div>
									<div class="sub-menu-i">
										<ul class="sub-menu">
											<li>
												<a href="<?= base_url() . ('users/opd') ?>">OPD</a>
											</li>
											<li>
												<a href="<?= base_url() . ('users/ipd') ?>">IPD</a>
											</li>
											<li>
												<a href="<?= base_url() . ('users/diagnose') ?>">تشخیصیه</a>
											</li>


										</ul>
									</div>
								</div>
							</li>

							<li>
								<a href="<?= base_url() . ('admin/logout') ?>">
									<div class="icon-w">
										<div class="os-icon os-icon-signs-11"></div>
									</div>
									<span>خروج</span>
								</a>
							</li>
						</ul>
					<?php endif; ?>
					<div class="side-menu-magic">
						<h4>
							سیستم مدیریت صرافی
						</h4>
						<p>
							سایبورگ تک
						</p>
						<div class="btn-w">
							<a class="btn btn-white btn-rounded" href="https://Cyborgtech.com/fa" target="_blank">وب سایت</a>
						</div>
					</div>
						</div>
						<!--------------------
        END - Main Menu
        -------------------->
						<div class="content-w">
							<!--------------------
          START - Top Bar
          -------------------->
							<div class="right-mini <?php if (isset($_COOKIE['menu'])) : ?><?= ($_COOKIE['menu'] !== 'right') ? 'top-bar d-none color-scheme-transparent' : 'top-bar color-scheme-transparent' ?> <?php endif; ?>">
								<!--------------------
            START - Top Menu Controls
            -------------------->
								<div class="top-menu-controls">
									<!--------------------
              START - Settings Link in secondary top menu
              -------------------->
									<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
										<i class="fa fa-bars"></i>
										<div class="os-dropdown">
											<div class="icon-w">
												<i class="fa fa-bars"></i>
											</div>
											<ul>
												<li>
													<a href="<?= ($_COOKIE['menu'] == 'top') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/top') ?>"><span>بالا</span></a>
												</li>
												<li>
													<a href="<?= ($_COOKIE['menu'] == 'right') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/right') ?>"><span>راست</span></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
										<i class="fa fa-paint-brush"></i>
										<div class="os-dropdown">
											<div class="icon-w">
												<i class="fa fa-paint-brush"></i>
											</div>
											<ul>
												<li>
													<a href="<?= ($_COOKIE['color'] == 'light') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/light') ?>"><span>روشن</span></a>
												</li>
												<li>
													<a href="<?= ($_COOKIE['color'] == 'dark') ? 'javascript:void(0)' : base_url() .  (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/dark') ?>"><span>تاریک</span></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
										<i class="fa fa-desktop"></i>
										<div class="os-dropdown">
											<div class="icon-w">
												<i class="fa fa-desktop"></i>
											</div>
											<ul>
												<li>
													<a href="<?= ($_COOKIE['full_screen'] !== 'border_less') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/full_screen') ?>"><span>صفحه کامل</span></a>
												</li>
												<li>
													<a href="<?= ($_COOKIE['full_screen'] == 'border_less') ? 'javascript:void(0)' : base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/theme/border_less') ?>"><span>بدون چوکات</span></a>
												</li>
											</ul>
										</div>
									</div>
									<!--------------------
              END - Settings Link in secondary top menu
              -------------------->
									<!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
									<div class="logged-user-w">
										<div class="logged-user-i">
											<div class="avatar-w">
												<img alt="" src="<?= base_url() . 'assets/user_images/' . (empty($this->session->userdata($ci->mylibrary->hash_session('u_photo'))) ? 'default.png' : $this->session->userdata($ci->mylibrary->hash_session('u_photo'))); ?>">
											</div>
											<div class="logged-user-menu color-style-bright">
												<div class="logged-user-avatar-info">
													<div class="avatar-w">
														<img alt="" src="<?= base_url() . 'assets/user_images/' . (empty($this->session->userdata($ci->mylibrary->hash_session('u_photo'))) ? 'default.png' : $this->session->userdata($ci->mylibrary->hash_session('u_photo'))); ?>">
													</div>
													<div class="logged-user-info-w">
														<div class="logged-user-name">
															<?= ucwords($this->session->userdata($ci->mylibrary->hash_session('u_fullname'))) ?>
														</div>
														<div class="logged-user-role">
															<?= ($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'کاربر' : 'مدیر'; ?>
														</div>
													</div>
												</div>

												<div class="bg-icon">
													<i class="os-icon os-icon-wallet-loaded"></i>
												</div>
												<ul>
													<li>
														<a href="<?= base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/profile') ?>"><i class="os-icon os-icon-user-male-circle2"></i><span>پروفایل</span></a>
													</li>
													<li>
														<a href="<?= base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/lock') ?>"><i class="fa fa-lock"></i><span>قفل</span></a>
													</li>
													<li>
														<a href="<?= base_url() . (($this->session->userdata($ci->mylibrary->hash_session('u_role')) !== 'admin') ? 'users' : 'admin') . ('/logout') ?>"><i class="os-icon os-icon-signs-11"></i><span>خروج</span></a>
													</li>
												</ul>
											</div>
										</div>
									</div>

									<!--------------------
              END - User avatar and menu in secondary top menu
              -------------------->
								</div>
								<!--------------------
            END - Top Menu Controls
            -------------------->
							</div>
							<!--------------------
          END - Top Bar
          -------------------->
							<!--------------------
          START - Breadcrumbs
		  -------------------->
							<?php if ($page !== 'dashboard' && $page !== 'backres') : ?>
								<ul class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="<?= base_url() . ('admin') ?>">خانه</a>
									</li>
									<?php if ($page !== 'dashboard') : ?>
										<li class="breadcrumb-item">
											<span><?= $title ?></span>
										</li>
									<?php endif; ?>
								</ul>
								<!--------------------
          END - Breadcrumbs
		  -------------------->

								<div class="content-i">
									<div class="content-box">

										<!-- Start Content With End -->
										<div class="element-wrapper">
											<h6 class="element-header">
												<?= ucwords($title) ?>
											</h6>
										<?php endif; ?>