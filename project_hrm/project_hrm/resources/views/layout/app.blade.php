<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<title> Đồ án  </title>
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<div class="top-menu row mx-0">
		<div class="logo-details col-lg-4 col-md-4 col-2 d-flex align-items-center px-0">
			<i class='bx bx-grid-alt show-sidebar'></i>
			<span class="logo_name">Quản lý nhân sự</span>
		</div>
		<div class="col-5 d-flex align-items-center position-relative px-0">
			<input class="form-control" type="text" placeholder="Tìm kiếm">
			<button class="btn-search py-0">
				<i class='bx bx-search'></i>
			</button>
		</div>
		<div class="col-lg-3 col-md-3 col-5 d-flex justify-content-end align-items-center info">
			<i class='bx bx-bell'></i>
			<i class='bx bx-help-circle px-3' ></i>
			<div class="avatar pe-3">
				<img src="{{ asset('img/avt.png') }}" alt="">
			</div>
		</div>
	</div>
	<div class="sidebar close">
		<ul class="nav-links">
			<li>
				<a href="#">
					<i class='bx bx-home-alt' ></i>
					<span class="link_name">Tổng quan</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="#">Tổng quan</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class='bx bxs-user-account' ></i>
						<span class="link_name">Hệ thống</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="#">Hệ thống</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class='bx bx-user-plus'></i>
						<span class="link_name">Tuyển dụng</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu blank ">
					<li><a class="link_name" href="#">Tuyển dụng</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class='bx bxs-user-detail'></i>
						<span class="link_name">Hồ sơ</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="#">Hồ sơ</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="/">
						<i class='bx bx-file'></i>
						<span class="link_name">Hợp đồng</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="/">Hợp đồng</a></li>
					<li><a href="/contracts">Tất cả hợp đồng</a></li>
					<li><a href="/contracts/create">Thêm hợp đồng</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class='bx bx-calendar'></i>
						<span class="link_name">Chấm công</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="#">Chấm công</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class='bx bx-calculator' ></i>
						<span class="link_name">Lương</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="#">Lương</a></li>
				</ul>
			</li>
		</ul>
	</div>
	@yield('content')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>