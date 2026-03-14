<?php
	/* users */
	$user = Auth::user();
?>

<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-circle"></i>
									<span class="indicator">1</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										1 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="{{ asset('/img/foto-untung-yasril.jpeg') }}" class="avatar img-fluid rounded-circle" alt="Ashley Briggs">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Ashley Briggs</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
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
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell-off"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									1 New Notifications
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
												<div class="text-muted small mt-1">2h ago</div>
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
							 <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
				                <i class="align-middle" data-feather="settings"></i>
				              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
				                <img src="{{ asset('/img/foto-untung-yasril.jpeg') }}" class="avatar img-fluid rounded-circle me-1" alt="Nama Pengguna" /> <span class="text-dark">{{Auth::user()->nama_pengguna}}</span>
				              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{url('/profile')}}"><i class="align-middle me-1" data-feather="user"></i> Profil</a>
								<a class="dropdown-item" href="{{url('/ganti-password')}}"><i class="align-middle me-1" data-feather="pie-chart"></i> Ganti Password</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{url('logout')}}">Keluar</a>
							</div>
						</li>
