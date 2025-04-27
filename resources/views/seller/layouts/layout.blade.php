<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>@yield('Seller_page_title')</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">


	<link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	@livewireStyles
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('vendor.dashboard') }}">
					<span class="align-middle">TrendNest Seller</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Overview
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.dashboard')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.dashboard')}}">
							<i class="align-middle" data-feather="home"></i> 
							<span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.analytics')?'active': ''}}">
						<a class="sidebar-link" href="#">
							<i class="align-middle" data-feather="bar-chart-2"></i> 
							<span class="align-middle">Analytics</span>
						</a>
					</li>

					<li class="sidebar-header">
						Store Management
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.store.create')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.store.create')}}">
							<i class="align-middle" data-feather="plus-square"></i> 
							<span class="align-middle">Create Store</span>
						</a>
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.store.manage')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.store.manage')}}">
							<i class="align-middle" data-feather="shopping-bag"></i> 
							<span class="align-middle">Manage Stores</span>
						</a>
					</li>

					<li class="sidebar-header">
						Products
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.product.create')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.product.create')}}">
							<i class="align-middle" data-feather="plus"></i> 
							<span class="align-middle">Add Product</span>
						</a>
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.product.manage')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.product.manage')}}">
							<i class="align-middle" data-feather="package"></i> 
							<span class="align-middle">Manage Products</span>
						</a>
					</li>

					<li class="sidebar-header">
						Orders & Customers
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.order.history')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.order.history')}}">
							<i class="align-middle" data-feather="shopping-cart"></i> 
							<span class="align-middle">Orders</span>
						</a>
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.customers')?'active': ''}}">
						<a class="sidebar-link" href="#">
							<i class="align-middle" data-feather="users"></i> 
							<span class="align-middle">Customers</span>
						</a>
					</li>

					<li class="sidebar-header">
						Settings
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.profile')?'active': ''}}">
						<a class="sidebar-link" href="{{route('vendor.profile')}}">
							<i class="align-middle" data-feather="user"></i> 
							<span class="align-middle">Profile</span>
						</a>
					</li>

					<li class="sidebar-item{{request()->routeIs('vendor.settings')?'active': ''}}">
						<a class="sidebar-link" href="#">
							<i class="align-middle" data-feather="settings"></i> 
							<span class="align-middle">Store Settings</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="{{ Auth::user()->profile_picture_url }}" class="avatar img-fluid rounded me-1" alt="{{ Auth::user()->name }}" /> 
								<span class="text-dark">{{ Auth::user()->name }}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<h6 class="dropdown-header">Seller Account</h6>
								<a class="dropdown-item" href="{{ route('vendor.profile') }}">
									<i class="align-middle me-1" data-feather="user"></i> My Profile
								</a>
								<a class="dropdown-item" href="{{ route('vendor.store.manage') }}">
									<i class="align-middle me-1" data-feather="shopping-bag"></i> My Stores
								</a>
								<a class="dropdown-item" href="{{ route('vendor.product.manage') }}">
									<i class="align-middle me-1" data-feather="package"></i> My Products
								</a>
								
								<div class="dropdown-divider"></div>
								<h6 class="dropdown-header">Settings & Support</h6>
								<a class="dropdown-item" href="#">
									<i class="align-middle me-1" data-feather="settings"></i> Account Settings
								</a>
								<a class="dropdown-item" href="#">
									<i class="align-middle me-1" data-feather="bell"></i> Notifications
								</a>
								<a class="dropdown-item" href="#">
									<i class="align-middle me-1" data-feather="help-circle"></i> Help Center
								</a>
								
								<div class="dropdown-divider"></div>
								<form action="{{route('logout')}}" method="POST" class="px-2">
									@csrf
									<button type="submit" class="btn btn-danger btn-sm w-100">
										<i class="align-middle me-1" data-feather="log-out"></i> Sign Out
									</button>
								</form>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		
			<main class="content">
				<div class="container-fluid p-0">

					@yield('seller_layout')

				</div>
			</main>

			<footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <strong>TrendNest</strong> - Seller Dashboard &copy; {{ date('Y') }}
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Seller Guide</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy Policy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
		</div>
	</div>

	<script src="{{ asset('admin_asset/js/app.js') }}"></script>
	@livewireScripts
</body>

</html>