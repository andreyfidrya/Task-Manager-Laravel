@props([
    'title',
    'header',
	'username'		
])



<!doctype html>
<html class="fixed header-dark">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>{{$title}}</title>

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }} " />
		<link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }} " />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.css') }} " />
		<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.css') }} " />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ asset('vendor/morris/morris.css') }} " />
		<link rel="stylesheet" href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.min.css') }} "/>
		<link rel="stylesheet" href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('vendor/owl.carousel/assets/owl.theme.default.min.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('css/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
		
		<!-- CKEditor -->
		<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<style>
			
			.ui-front { z-index: 9999; }			
			
		</style>

	</head>

	<body>
	
		<section class="body">

			<!-- start: header -->
			<header class="header">
		    
				<div class="logo-container">
					<a href="/" class="logo">
						<img src="{{ asset('img/logo.png') }}" width="75" height="35" alt="Porto Admin" />
					</a>
				</div>	
		 

				<!-- start: search & user box -->
				<div class="header-right">

					<form action="{{ route('search') }}" method="GET" class="search nav-form">
						<div class="input-group">
							<input type="text" class="form-control" name="search" id="search" placeholder="Search...">
							<button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
						</div>
					</form>

					<script type="text/javascript">
					var path = "{{ route('autocomplete') }}";
				
					$( "#search" ).autocomplete({
						source: function( request, response ) {
						$.ajax({
							url: path,
							type: 'GET',
							dataType: "json",
							data: {
							search: request.term
							},
							success: function( data ) {
							response( data );
							}
						});
						},
						select: function (event, ui) {
						$('#search').val(ui.item.label);
						console.log(ui.item); 
						return false;
						}
					});
  
					</script>

					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-bs-toggle="dropdown">
							<!--
							<figure class="profile-picture">
								<img src="img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
							</figure>
							-->
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">{{$username}}</span>
								<span class="role">Administrator</span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('users.profile') }}"><i class="bx bx-user-circle"></i> My Profile</a>
								</li>
								<li>
								<x-form method="delete" action="{{ route('login.destroy') }}">
								<button class="btn btn-danger">Logout</button>
								</x-form>								
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
	

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

				 <div class="sidebar-header">
				        <div class="sidebar-title">
				            Navigation
				        </div>
				        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div> 

				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">

				                <ul class="nav nav-main">
				                    
									<li class="nav-parent">
				                        <a class="nav-link" href="">
				                            <i class="bx bx-cube" aria-hidden="true"></i>
				                            <span>Task Manager</span>
				                        </a>
				                        <ul class="nav nav-children">
											<li>
											<x-navs.link route="tasks.index">Tasks</x-navs.link>
				                            </li>
									<li class="nav-parent">
				                        <a class="nav-link" href="#">
				                            <span>Clients</span>
				                        </a>
				                        <ul class="nav nav-children">											                          
											<li>
											<x-navs.link route="clients.index">Active Clients</x-navs.link>
				                            </li>				                            
											<li>
				                            <x-navs.link route="inactiveclients">Inactive Clients</x-navs.link>
											</li>														                            											
				                        </ul>
				                    </li>
				                    <li class="nav-parent">
				                        <a class="nav-link" href="#">
				                            Earnings <span class="mega-sub-nav-toggle toggled float-end" data-toggle="collapse" data-target=".mega-sub-nav-sub-menu-1"></span>
				                        </a>
				                        <ul class="nav nav-children">
											<li>
				                            <x-navs.link route="annualearnings.index">Annual earnings by months</x-navs.link>    
											</li>
											<li>
				                            <x-navs.link route="performedtasks">Total earnings per month</x-navs.link>    
											</li>
											<li>
				                            <x-navs.link route="earningsbyclients">Earnings by clients per month</x-navs.link>    
											</li>
				                            <li>
				                            <x-navs.link route="earningsbyusers">Earnings by users per month</x-navs.link>    
				                            </li>																										                                    
				                        </ul>
				                    </li>
									<li class="nav-parent">
				                        <a class="nav-link" href="#">
				                            <span>Spendings</span>
				                        </a>
				                        <ul class="nav nav-children">											                          
											<li>
				                            <x-navs.link route="spendings.index">Spendings per month</x-navs.link>    
											</li>								     											
				                        </ul>
				                    </li>
									<li class="nav-parent">
				                        <a class="nav-link" href="#">
				                            <span>Workload</span>
				                        </a>
				                        <ul class="nav nav-children">											                          
											<li>
											<x-navs.link route="totalworkload">Total workload per week</x-navs.link>
				                            </li>				                            
											<li>
				                            <x-navs.link route="workloadperuser">Workload per user per week</x-navs.link>
											</li>														                            											
				                        </ul>
				                    </li>											
				                </ul>
				                    </li>
									<li class="nav-parent">
				                        <a class="nav-link" href="#">
				                            <i class="bx bx-cube" aria-hidden="true"></i>
				                            <span>Email Creation Tool</span>
				                        </a>
				                        <ul class="nav nav-children">											                          
												<li>
												<x-navs.link route="emails.index">Email Template</x-navs.link>
				                            	</li>				                            
												<li>
				                                <x-navs.link route="topics.index">Topics</x-navs.link>
												</li>
												<li>
												<x-navs.link route="samples.index">Samples</x-navs.link>												
				                            	</li> 		                            											
				                        </ul>
				                    </li>
									<li class="nav-children">
									<x-navs.link route="payments.index">
									<i class="bx bx-cube" aria-hidden="true"></i>
				                            <span>Regular Payments</span>
									</x-navs.link>				                        
				                    </li>  
									<li class="nav-parent">
				                        <a class="nav-link" href="#">
				                            <i class="bx bx-layout" aria-hidden="true"></i>
				                            <span>Users</span>
				                        </a>
				                        <ul class="nav nav-children">
				                            <li>
												<x-navs.link route="users.index">All users</x-navs.link>
											</li>
				                            <li class="nav-parent">
				                                <a>
				                                    Users by roles
				                                </a>
				                                <ul class="nav nav-children">
				                                    <li>
				                                        <a class="nav-link" href="layouts-boxed.html">
				                                            Administrators
				                                        </a>
				                                    </li>
				                                    <li>
				                                        <a class="nav-link" href="layouts-boxed-fixed-header.html">
				                                            Moderators
				                                        </a>
				                                    </li>
													<li>
				                                        <a class="nav-link" href="layouts-boxed-fixed-header.html">
				                                            Guests
				                                        </a>
				                                    </li>
				                                </ul>
				                            </li>
				                            <li class="nav-parent">
				                                <a>
				                                    Users by status
				                                </a>
				                                <ul class="nav nav-children">
				                                    <li>
				                                        <a class="nav-link" href="layouts-header-menu.html">
				                                            Registered users
				                                        </a>
				                                    </li>
				                                    <li>
				                                        <a class="nav-link" href="layouts-header-menu-stripe.html">
				                                            Approved users
				                                        </a>
				                                    </li>
				                                    <li>
				                                        <a class="nav-link" href="layouts-header-menu-top-line.html">
				                                            Blocked users
				                                        </a>
				                                    </li>
				                                </ul>
				                            </li>
				                        </ul>
				                    </li>  			                
				                </ul>
				            </nav>

				            <hr class="separator" />
				            
				        </div>

				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>
						
				    </div>
					

				</aside>
				
					
				<!-- end: sidebar -->
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>{{ $header }}</h2>						
					</header> 

					<!-- start: page -->
					<div class="row">
						<div class="col col-12 col-md-10">						
						@if($errors->any())
            			<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
						</ul>
            			</div>
        				@endif

						<main>
                    		{{ $slot }}
                		</main>							
						
						</div>
					</div>
					<!-- end: page -->
				</section>
			</div>

		</section>

		

		<!-- Vendor -->
		<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('vendor/common/common.js') }}"></script>
		<script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		<!-- Specific Page Vendor -->
		<script src="{{ asset('vendor/jquery-ui/jquery-ui.js') }}"></script>
		<script src="{{ asset('vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ asset('vendor/jquery-appear/jquery.appear.js') }}"></script>
		<script src="{{ asset('vendor/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
		<script src="{{ asset('vendor/jquery.easy-pie-chart/jquery.easypiechart.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('vendor/flot.tooltip/jquery.flot.tooltip.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ asset('vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
		<script src="{{ asset('vendor/raphael/raphael.js') }}"></script>
		<script src="{{ asset('vendor/morris/morris.js') }}"></script>
		<script src="{{ asset('vendor/gauge/gauge.js') }}"></script>
		<script src="{{ asset('vendor/snap.svg/snap.svg.js') }}"></script>
		<script src="{{ asset('vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('js/theme.js') }}"></script>

		<!-- Text Editor -->
		<script src="{{ asset('js/texteditor.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('js/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('js/examples/examples.dashboard.js') }}"></script>
		<script src="{{ asset('js/examples/examples.charts.js') }}"></script>
		
		<script>
		ClassicEditor
			.create( document.querySelector( '#editor' ) )
			.catch( error => {
				console.error( error );
			} );
		</script>
		
		<script>
		ClassicEditor
			.create( document.querySelector( '#editor2' ) )
			.catch( error => {
				console.error( error );
			} );
		</script>



	</body>
</html>