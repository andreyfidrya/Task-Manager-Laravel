<x-layouts.porto title="User Profile" header="User Profile" username={{$username}}>

@if(isset($earningsofclients))
      @php      
      $earningsperclients = collect($earningsofclients)->sortBy('sum')->reverse()->toArray();
      @endphp	  

<div class="row">
						<div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">

							<section class="card">
								<div class="card-body">
									<div class="thumb-info mb-3">
										<img src="img/!logged-user.jpg" class="rounded img-fluid" alt="John Doe">
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
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
													60%
												</div>
											</div>
										</div>
										<div class="widget-content-expanded">
											<ul class="simple-todo-list mt-3">
												<li class="completed">Update Profile Picture</li>
												<li class="completed">Change Personal Information</li>
												<li>Update Social Media</li>
												<li>Follow Someone</li>
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
										<a rel="tooltip" data-bs-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
										<a rel="tooltip" data-bs-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>
										<a rel="tooltip" data-bs-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
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
									<li class="nav-item active">
										<button class="nav-link" data-bs-target="#overview" data-bs-toggle="tab">Overview</button>
									</li>
									<li class="nav-item">
										<button class="nav-link" data-bs-target="#edit" data-bs-toggle="tab">Edit</button>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">

										<div class="p-3">

											<h4 class="mb-3 font-weight-semibold text-dark">Update Status</h4>

											<section class="simple-compose-box mb-3">
												<form method="get" action="/">
													<textarea name="message-text" data-plugin-textarea-autosize placeholder="What's on your mind?" rows="1"></textarea>
												</form>
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
															<a href="#" class="btn btn-primary btn-xs">Post</a>
														</li>
													</ul>
												</div>
											</section>

											<h4 class="mb-3 pt-4 font-weight-semibold text-dark">Timeline</h4>

											<div class="timeline timeline-simple mt-3 mb-3">
												<div class="tm-body">
													<div class="tm-title">
														<h5 class="m-0 pt-2 pb-2 text-dark font-weight-semibold text-uppercase">November 2023</h5>
													</div>
													<ol class="tm-items">
														<li>
															<div class="tm-box">
																<p class="text-muted mb-0">7 months ago.</p>
																<p>
																	It's awesome when we find a good solution for our projects, Porto Admin is <span class="text-primary">#awesome</span>
																</p>
															</div>
														</li>
														<li>
															<div class="tm-box">
																<p class="text-muted mb-0">7 months ago.</p>
																<p>
																	What is your biggest developer pain point?
																</p>
															</div>
														</li>
														<li>
															<div class="tm-box">
																<p class="text-muted mb-0">7 months ago.</p>
																<p>
																	Checkout! How cool is that!
																</p>
																<div class="thumbnail-gallery">
																	<a class="img-thumbnail lightbox" href="img/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
																		<img class="img-fluid" width="215" src="img/projects/project-4.jpg">
																		<span class="zoom">
																			<i class="bx bx-search"></i>
																		</span>
																	</a>
																</div>
															</div>
														</li>
													</ol>
												</div>
											</div>
										</div>

									</div>
									<div id="edit" class="tab-pane">

										<form class="p-3">
											<h4 class="mb-3 font-weight-semibold text-dark">Personal Information</h4>
											<div class="row row mb-4">
												<div class="form-group col">
													<label for="inputAddress">Address</label>
													<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
												</div>
											</div>
											<div class="row mb-4">
												<div class="form-group col">
													<label for="inputAddress2">Address 2</label>
													<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label for="inputCity">City</label>
													<input type="text" class="form-control" id="inputCity">
												</div>
												<div class="form-group col-md-4 border-top-0 pt-0">
													<label for="inputState">State</label>
													<select id="inputState" class="form-control">
														<option selected>Choose...</option>
														<option>...</option>
													</select>
												</div>
												<div class="form-group col-md-2 border-top-0 pt-0">
													<label for="inputZip">Zip</label>
													<input type="text" class="form-control" id="inputZip">
												</div>
											</div>

											<hr class="dotted tall">

											<h4 class="mb-3 font-weight-semibold text-dark">Change Password</h4>
											<div class="row">
												<div class="form-group col-md-6">
													<label for="inputPassword4">New Password</label>
													<input type="password" class="form-control" id="inputPassword4" placeholder="Password">
												</div>
												<div class="form-group col-md-6 border-top-0 pt-0">
													<label for="inputPassword5">Re New Password</label>
													<input type="password" class="form-control" id="inputPassword5" placeholder="Password">
												</div>
											</div>

											<div class="row">
												<div class="col-md-12 text-end mt-3">
													<button class="btn btn-primary modal-confirm">Save</button>
												</div>
											</div>

										</form>

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
