@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				@if (session('status'))
				    <div class="alert alert-success">
				        {{ session('status') }}
				    </div>
				@endif
				@if (session('error_status'))
				    <div class="alert alert-danger">
				        {{ session('error_status') }}
				    </div>
				@endif

				<h3 class="text-center">Showing all patients</h3>
				<div id="add-patient-form-container">
					<div class="panel panel-default">
					<!-- Default panel contents -->
						<div class="panel-heading"><strong>Patients</strong></div>
						<div class="panel-body">
							<p>Showing the list of all registered patients</p>
						</div>

						<!-- Table -->
						<table class="table">
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th></th>
								<th></th>
							</tr>
						<?php $count = 1 ?>
						@foreach ($patients as $patient)
							<tr>
								<th>{{$count}}</th>
								<td>{{$patient->fullname}}</td>
								<td>{{$patient->email}}</td>
								<td>{{$patient->phone}}</td>
								<td>
									<a href="/patient/edit/{{$patient->unique_id}}">
										<i class="fa fa-pencil-square fa-lg"></i>
									</a>
								</td>
								<td>
									<span id="{{$patient->unique_id}}" class="delete">
										<i class="fa fa-trash fa-lg"></i>
									</span>
								</td>
							</tr>
						<?php $count++ ?>
						@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="/script/patient.js"></script>

@include('includes.footer')