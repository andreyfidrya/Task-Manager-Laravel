<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@error('title')
	<div class="alert alert-danger">{{ $message }}</div>
@enderror

@if(isset($earningsofclients))
      @php      
      $earningsperclients = collect($earningsofclients)->sortBy('sum')->reverse()->toArray();
      @endphp	  

<div class="row">
						<div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">

							<section class="card">
								<div class="card-body">
									<div class="thumb-info mb-3">
										<img src="{{ $user->profile_image ? asset('images/profiles/' . $user->profile_image) : asset('img/!logged-user.jpg') }}" class="rounded img-fluid" alt="{{ $user->name }}">
										<div class="thumb-info-title">
											<span class="thumb-info-inner">{{$user->name}}</span>
											<span class="thumb-info-type">CEO</span>
										</div>
									</div>

									<div class="widget-toggle-expand mb-3">
										<div class="widget-header">
											<h5 class="mb-2 font-weight-semibold text-dark">Profile Completion</h5>
											<div class="widget-toggle">+</div>
										</div>
										<div class="widget-content-collapsed">
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$profilecompletion}}%;">
													
												</div>
											</div>
										</div>
										<div class="widget-content-expanded">
											<ul class="simple-todo-list mt-3">
												<li @if($user->profile_image) class="completed" @endif>Update Profile Picture</li>
												<li @if($user->about && $user->phone && $user->address && $user->address2 && $user->city && $user->state && $user->zip) class="completed" @endif">Change Personal Information</li>
												<li @if($user->facebook || $user->twitter || $user->linkedin) class="completed" @endif">Update Social Media</li>
												<li @if($numberofactiveclients > 0) class="completed" @endif>Get Active Clients </li>
											</ul>
										</div>
									</div>

									<hr class="dotted short">

									<h5 class="mb-2 mt-3">About</h5>
									<p class="text-2" id="aboutText">
										{{ \Illuminate\Support\Str::limit($user->about, 105) }}
									</p>

									@if(strlen($user->about) > 105)
										<div class="clearfix">
											<a class="text-uppercase text-muted float-end" href="#" id="toggleAbout">(View All)</a>
										</div>
									@endif

									<hr class="dotted short">

									<div class="social-icons-list">
										@if($user->facebook)<a rel="tooltip" data-bs-placement="bottom" target="_blank" href="{{$user->facebook}}" data-original-title="Facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>@endif
										@if($user->twitter)<a rel="tooltip" data-bs-placement="bottom" href="{{$user->twitter}}" data-original-title="Twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>@endif
										@if($user->linkedin)<a rel="tooltip" data-bs-placement="bottom" href="{{$user->linkedin}}" data-original-title="Linkedin"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>@endif
									</div>

								</div>
							</section>

							<section class="card">
								<header class="card-header">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>

									<h2 class="card-title">
										<span class="badge badge-primary label-sm font-weight-normal va-middle me-3">{{$numberofactiveclients}}</span>
										<span class="va-middle">Active Clients</span>
									</h2>
								</header>
								<div class="card-body">
									<div class="content">
										<ul class="simple-user-list" id="clientList">
											@foreach($clientsWithAnyTasks as $client)
											<li>
												<figure class="image rounded">
													<img src="{{asset('images')}}/{{$client->image}}" width="35" height="35" class="rounded-circle">
												</figure>
												<span class="title">{{$client->name}}</span>
												<span class="message truncate">{{ $client->price }}</span>
											</li>
											@endforeach
										</ul>
										<hr class="dotted short">
										<div class="text-end">
											<a class="text-uppercase text-muted" href="#" id="toggleClientListBtn" style="display: none;">(View All)</a>
										</div>
									</div>
								</div>								
							</section>

							<section class="card">
								<header class="card-header">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>

									<h2 class="card-title">Milestones In Progress</h2>
								</header>
								<div class="card-body">
									<ul class="simple-post-list">
										@foreach($tasksinprogressforuser as $task)
										<li>
											<div class="post-image">
												<div class="img-thumbnail">
													<a href="{{ route('clients.show', [ $task->client->slug ]) }}">
														<img src="{{asset('images')}}/{{$task->client->image}}" alt="">
													</a>
												</div>
											</div>
											<div class="post-info">
												<a href="{{ route('tasks.show', [ $task->id ]) }}">{{$task->task}}</a>
												<div class="post-meta">
													{{date('M d, Y', strtotime($task->created_at))}}
												</div>
											</div>
										</li>
										@endforeach										
									</ul>
								</div>
							</section>

						</div>
						<div class="col-lg-8 col-xl-6">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="nav-item">
										<button class="nav-link active" data-bs-target="#overview" data-bs-toggle="tab">Overview</button>
									</li>
									<li class="nav-item">
										<button class="nav-link" data-bs-target="#edit" data-bs-toggle="tab">Edit</button>
									</li>
								</ul>
								<script>
									document.addEventListener('DOMContentLoaded', function () {
										const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');										
										tabButtons.forEach(button => {
											button.addEventListener('click', function () {
												const targetId = button.getAttribute('data-bs-target');
												const tab = new bootstrap.Tab(button);
												tab.show();
											});
										});
									});
								</script>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">

										<div class="p-3">

											<h4 class="mb-3 font-weight-semibold text-dark">Update Status</h4>

											<section class="simple-compose-box mb-3">
												<form method="post" action="{{url('/updatestatus')}}" id="updatestatus">
													@csrf
													<textarea name="message" data-plugin-textarea-autosize placeholder="What's on your mind?" rows="1"></textarea>												
													<div class="compose-box-footer">
														<ul class="compose-toolbar">
															<li>
																<a href="#"><i class="fas fa-camera"></i></a>
															</li>
															<li>
																<a href="#"><i class="fas fa-map-marker-alt"></i></a>
															</li>
														</ul>
														<ul class="compose-btn">
															<li>
																<button type="submit" class="btn btn-primary btn-xs">Post</button>
															</li>
														</ul>
													</div>
												</form>
											</section>
												<script type="text/javascript">

													$(document).ready(function()
														{
															
														$('#updatestatus').on('submit', function(event)        
															{

																event.preventDefault();

																jQuery.ajax({

																	url:"{{url('/updatestatus')}}",																	                    
																	data:jQuery('#updatestatus').serialize(),
																	type:'post',
																	
																	success:function(result)
																	{
																		const now = new Date();
																		const postedAt = now.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

																		// Insert new message into timeline
																		const newStatus = `
																			<li>
																				<div class="tm-box">
																					<p class="text-muted mb-0">Just now</p>
																					<p>${jQuery('#updatestatus textarea[name="message"]').val()}</p>
																				</div>
																			</li>
																		`;

																		// Prepend new item to timeline
																		$('#timeline-items').prepend(newStatus);
																		jQuery('#updatestatus')[0].reset();
																	}
																
																})

															});

														});
												</script>

											<h4 class="mb-3 pt-4 font-weight-semibold text-dark">Timeline</h4>

											<div class="timeline timeline-simple mt-3 mb-3">
												<div class="tm-body">
													<div class="tm-title">
														<h5 class="m-0 pt-2 pb-2 text-dark font-weight-semibold text-uppercase">{{ \Carbon\Carbon::now()->format('F Y') }}</h5>
													</div>
													@foreach($chats as $chat)
													<ol class="tm-items" id="timeline-items">
														<li>
															<div class="tm-box">
																<p class="text-muted mb-0">{{ $chat->created_at->diffForHumans() }}</p>
																<p>
																	{{$chat->message}} 
																</p>
															</div>
														</li>														
													</ol>
													@endforeach
												</div>
											</div>
										</div>

									</div>
									<div id="edit" class="tab-pane">
									
										<form class="p-3" method="post" action="{{url('/updatepersonalinfo')}}" id="updatepersonalinfo">
											@csrf											
											<div class="personalinfo-content"></div>										
											<h4 class="mb-3 font-weight-semibold text-dark">Change Personal Information</h4>											
											
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputPhone">About</label>
													<textarea type="text" name="about" class="form-control" id="inputAbout">{{ $user->about }}</textarea>
												</div>
											</div>
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputPhone">Phone</label>
													<input type="text" name="phone" class="form-control" id="inputPhone" value="{{ $user->phone }}">
												</div>
											</div>											
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputAddress">Address</label>
													<input type="text" name="address" class="form-control" id="inputAddress" value="{{ $user->address }}">
												</div>
											</div>
											<div class="row mb-4">
												<div class="form-group col">
													<label for="inputAddress2">Address 2</label>
													<input type="text" name="address2" class="form-control" id="inputAddress2" value="{{ $user->address2 }}">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-4">
													<label for="inputCity">City</label>
													<input type="text" name="city" class="form-control" id="inputCity" value="{{ $user->city }}">
												</div>
												<div class="form-group col-md-5 border-top-0 pt-0">
													<label for="inputState">State</label>
													<select name="state" id="inputState" class="form-control">
														<option disabled {{ $user->state == null ? 'selected' : '' }}>Choose...</option>
														<option {{ $user->state == 'Cherkasy Oblast' ? 'selected' : '' }}>Cherkasy Oblast</option>
														<option {{ $user->state == 'Chernihiv Oblast' ? 'selected' : '' }}>Chernihiv Oblast</option>
														<option {{ $user->state == 'Chernivtsi Oblast' ? 'selected' : '' }}>Chernivtsi Oblast</option>
														<option {{ $user->state == 'Dnipropetrovsk Oblast' ? 'selected' : '' }}>Dnipropetrovsk Oblast</option>
														<option {{ $user->state == 'Donetsk Oblast' ? 'selected' : '' }}>Donetsk Oblast</option>
														<option {{ $user->state == 'Ivano-Frankivsk Oblast' ? 'selected' : '' }}>Ivano-Frankivsk Oblast</option>
														<option {{ $user->state == 'Kharkiv Oblast' ? 'selected' : '' }}>Kharkiv Oblast</option>
														<option {{ $user->state == 'Kherson Oblast' ? 'selected' : '' }}>Kherson Oblast</option>
														<option {{ $user->state == 'Khmelnytskyi Oblast' ? 'selected' : '' }}>Khmelnytskyi Oblast</option>
														<option {{ $user->state == 'Kirovohrad Oblast' ? 'selected' : '' }}>Kirovohrad Oblast</option>
														<option {{ $user->state == 'Kyiv Oblast' ? 'selected' : '' }}>Kyiv Oblast</option>
														<option {{ $user->state == 'Luhansk Oblast' ? 'selected' : '' }}>Luhansk Oblast</option>
														<option {{ $user->state == 'Lviv Oblast' ? 'selected' : '' }}>Lviv Oblast</option>
														<option {{ $user->state == 'Mykolaiv Oblast' ? 'selected' : '' }}>Mykolaiv Oblast</option>
														<option {{ $user->state == 'Odesa Oblast' ? 'selected' : '' }}>Odesa Oblast</option>
														<option {{ $user->state == 'Poltava Oblast' ? 'selected' : '' }}>Poltava Oblast</option>
														<option {{ $user->state == 'Rivne Oblast' ? 'selected' : '' }}>Rivne Oblast</option>
														<option {{ $user->state == 'Sumy Oblast' ? 'selected' : '' }}>Sumy Oblast</option>
														<option {{ $user->state == 'Ternopil Oblast' ? 'selected' : '' }}>Ternopil Oblast</option>
														<option {{ $user->state == 'Vinnytsia Oblast' ? 'selected' : '' }}>Vinnytsia Oblast</option>
														<option {{ $user->state == 'Volyn Oblast' ? 'selected' : '' }}>Volyn Oblast</option>
														<option {{ $user->state == 'Zakarpattia Oblast' ? 'selected' : '' }}>Zakarpattia Oblast</option>
														<option {{ $user->state == 'Zaporizhzhia Oblast' ? 'selected' : '' }}>Zaporizhzhia Oblast</option>
														<option {{ $user->state == 'Zhytomyr Oblast' ? 'selected' : '' }}>Zhytomyr Oblast</option>
													</select>
												</div>
												<div class="form-group col-md-3 border-top-0 pt-0">
													<label for="inputZip">Zip</label>
													<input type="text" name="zip" class="form-control" id="inputZip" value="{{ $user->zip }}">
												</div>
											</div>

											<div class="row">
												<div class="col-md-12 text-end mt-3">
													<button type="submit" class="btn btn-primary modal-confirm">Save</button>
												</div>
											</div>
										</form>

										<script type="text/javascript">

											$(document).ready(function()
												{
													
												$('#updatepersonalinfo').on('submit', function(event)        
													{

														event.preventDefault();

														jQuery.ajax({

															url:"{{url('/updatepersonalinfo')}}",
															context: $(".personalinfo-content"),                    
															data:jQuery('#updatepersonalinfo').serialize(),
															type:'post',
															
															success:function(result)
															{
															$(".personalinfo-content").text("Personal information has been updated!");
															}

														})

													});

												});
										</script>

										<form class="p-3" method="post" action="{{ url('/updateprofileimage') }}" enctype="multipart/form-data">
											@csrf
											<h4 class="mb-3 font-weight-semibold text-dark">Profile Image</h4>
											<div class="mb-3">
												<label for="profile_image" class="form-label">Upload New Profile Image</label>
												<input class="form-control" type="file" id="profile_image" name="profile_image" onchange="previewFile(this)">
												<img style="max-width:150px;margin-top:20px;" id="img-profile"/>
											</div>
											<div class="text-end">
												<button type="submit" class="btn btn-primary">Upload</button>
											</div>
										</form>

										<script language=javascript>
											function previewFile(input){
												var preview = document.querySelector('#img-profile');
												var file = input.files[0];
												var reader = new FileReader();
												reader.onloadend = function () {
													preview.src = reader.result;
												}
												if (file) {
													reader.readAsDataURL(file);
												} else {
													preview.src = "";
												}
											}
										</script>
										
										<form class="p-3" method="post" action="{{url('/updatesocialmedia')}}" id="updatesocialmedia">
											@csrf											
											<hr class="dotted tall">
											<h4 class="mb-3 font-weight-semibold text-dark">Update Social Media</h4>
											<div class="socialmedia-content"></div>
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputPhone">Facebook</label>
													<input type="url" name="facebook" class="form-control" value="{{ $user->facebook }}">
												</div>
											</div>
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputPhone">Twitter</label>
													<input type="url" name="twitter" class="form-control" value="{{ $user->twitter }}">
												</div>
											</div>
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputPhone">LinkedIn</label>
													<input type="url" name="linkedin" class="form-control" value="{{ $user->linkedin }}">
												</div>
											</div>
											
											<div class="row">
												<div class="col-md-12 text-end mt-3">
													<button type="submit" class="btn btn-primary modal-confirm">Save</button>
												</div>
											</div>
										</form>

										<form class="p-3" action="{{route('user.account.security.update')}}" method="post">
											@csrf
											@method('PUT')

											<hr class="dotted tall">
											<h4 class="mb-3 font-weight-semibold text-dark">Change Password</h4>
											
											<div class="row mb-4">
												<div class="form-group col">
													<label for="oldPassword">Old Password</label>
													<input type="password" name="old_password" class="form-control" id="oldPassword" placeholder="Password">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label for="newPassword4">New Password</label>
													<input type="password" name="new_password" class="form-control" id="inputPassword4" placeholder="Password">
												</div>
												<div class="form-group col-md-6 border-top-0 pt-0">
													<label for="inputPassword5">Re New Password</label>
													<input type="password" name="new_password_confirmation" class="form-control" id="inputPassword5" placeholder="Password">
												</div>
											</div>

											<div class="row">
												<div class="col-md-12 text-end mt-3">
													<button type="submit" class="btn btn-primary modal-confirm">Save</button>
												</div>
											</div>
										</form>

										<script type="text/javascript">

											$(document).ready(function()
												{
													
												$('#updatesocialmedia').on('submit', function(event)        
													{

														event.preventDefault();

														jQuery.ajax({

															url:"{{url('/updatesocialmedia')}}",
															context: $(".socialmedia-content"),                    
															data:jQuery('#updatesocialmedia').serialize(),
															type:'post',
															
															success:function(result)
															{
															$(".socialmedia-content").text("Social media has been updated!");
															}

														})

													});

												}); 

										</script>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3">

							<h4 class="mb-3 mt-0 font-weight-semibold text-dark">Earnings Stats</h4>
							<ul class="simple-card-list mb-3">
								<li class="primary">
									<h3>{{ $user->tasks()->onlyTrashed()->sum('budget') - $totalspendings; }} USD</h3>
									<p class="text-light">Earnings in {{$currentmonth}}</p>
								</li>
								<li class="primary">
									<h3>{{ $earningsforlastMonth->amount }}</h3>
									<p class="text-light">Earnings in {{$lastMonth}}</p>
								</li>
								<li class="primary">
									<h3>{{ $numberofclients}}</h3>
									<p class="text-light">Paying clients in {{$currentmonth}}</p>
								</li>
							</ul>
							
							<h4 class="mb-3 mt-4 pt-2 font-weight-semibold text-dark">Clients</h4>
							@foreach($earningsperclients as $earningsperclient)
							<ul class="simple-bullet-list mb-3">								
								<li class="blue">
									<span class="title">{{$earningsperclient['name']}}</span>
									<span class="description truncate"><strong>{{$earningsperclient['name']}}</strong> has generated <strong>{{$earningsperclient['sum']}} USD</strong> in <strong>{{$currentmonth}}</strong> = <strong>{{round($earningsperclient['sum']/($user->tasks()->onlyTrashed()->sum('budget') - $totalspendings)*100)}} %</strong></span>
								</li>								
							</ul>
							@endforeach
							@endif
							<h4 class="mb-3 mt-4 pt-2 font-weight-semibold text-dark">Messages</h4>
							<ul class="simple-user-list mb-3">
								<li>
									<figure class="image rounded">
										<img src="img/!sample-user.jpg" alt="Joseph Doe Junior" class="rounded-circle">
									</figure>
									<span class="title">Joseph Doe Junior</span>
									<span class="message">Lorem ipsum dolor sit.</span>
								</li>
								<li>
									<figure class="image rounded">
										<img src="img/!sample-user.jpg" alt="Joseph Junior" class="rounded-circle">
									</figure>
									<span class="title">Joseph Junior</span>
									<span class="message">Lorem ipsum dolor sit.</span>
								</li>
								<li>
									<figure class="image rounded">
										<img src="img/!sample-user.jpg" alt="Joe Junior" class="rounded-circle">
									</figure>
									<span class="title">Joe Junior</span>
									<span class="message">Lorem ipsum dolor sit.</span>
								</li>
								<li>
									<figure class="image rounded">
										<img src="img/!sample-user.jpg" alt="Joseph Doe Junior" class="rounded-circle">
									</figure>
									<span class="title">Joseph Doe Junior</span>
									<span class="message">Lorem ipsum dolor sit.</span>
								</li>
							</ul>
						</div>

					</div>					
    
</x-layouts.porto>

<script>
const clientList = document.getElementById('clientList');
const toggleBtn = document.getElementById('toggleClientListBtn');

let isExpanded = false;
let allClients = [];

function renderClients(clients) {
    clientList.innerHTML = '';
    clients.forEach(client => {
        clientList.innerHTML += `
            <li>
                <figure class="image rounded">
                    <img src="images/${client.image}" width="35" height="35" class="rounded-circle">
                </figure>
                <span class="title">${client.name}</span>
                <span class="message truncate">${client.price}</span>
            </li>
        `;
    });
}

// Initial fetch
fetch("{{ route('users.profile') }}", {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
})
.then(res => res.json())
.then(data => {
    allClients = data;

    if (allClients.length > 3) {
        renderClients(allClients.slice(0, 3));
        toggleBtn.style.display = 'inline-block'; // Show button
    } else {
        renderClients(allClients); // Show all, no toggle
    }
});

// Toggle button click
toggleBtn.addEventListener('click', function(e) {
    e.preventDefault();

    if (!isExpanded) {
        renderClients(allClients); // Show all
        toggleBtn.textContent = '(Minimize)';
    } else {
        renderClients(allClients.slice(0, 3)); // Show first 5
        toggleBtn.textContent = '(View All)';
    }

    isExpanded = !isExpanded;
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fullText = @json($user->about);
        const shortText = fullText.slice(0, 105);
        const aboutText = document.getElementById('aboutText');
        const toggleLink = document.getElementById('toggleAbout');
        let expanded = false;

        toggleLink.addEventListener('click', function(e) {
            	e.preventDefault();
                if (expanded) {
                    aboutText.textContent = shortText + '...';
                    toggleLink.textContent = '(View All)';
                } else {
                    aboutText.textContent = fullText;
                    toggleLink.textContent = '(Minimize)';
                }
                expanded = !expanded;
            });
        });
</script>


