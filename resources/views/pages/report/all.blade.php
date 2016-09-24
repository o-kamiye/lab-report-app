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
				    <div class="alert alert-success">
				        {{ session('error_status') }}
				    </div>
				@endif

				<h3 class="text-center">Showing all patient reports</h3>
				<div id="add-patient-form-container">
					<div class="panel panel-default">
					<!-- Default panel contents -->
						<div class="panel-heading"><strong>Patient Reports</strong></div>
						<div class="panel-body">
							<p>Showing the list of all patient reports</p>
						</div>

						<!-- Table -->
						<table class="table">
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Patient Details</th>
								<th>Date</th>
								<th></th>
								<th></th>
							</tr>
							<?php $count = 1 ?>
							@foreach ($reports as $report)
							<tr>
								<td>{{$count}}</td>
								<td>{{$report->title}}</td>
								<td>{{$report->fullname}} - {{$report->email}}</td>
								<td>{{$report->date}}</td>
								<td>
									<a href="#">
										<i class="fa fa-pencil-square fa-lg"></i>
									</a>
								</td>
								<td>
									<span id="{{$report->unique_id}}" class="delete">
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
	<script src="/script/report.js"></script>

@include('includes.footer')