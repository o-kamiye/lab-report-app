@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav_patient')
			<div class="col-sm-9 col-lg-10">
				<h3 class="text-center">Showing all reports for {{ $patient->fullname }}</h3>
				<div id="add-patient-form-container">
					<div class="panel panel-default">
					<!-- Default panel contents -->
						<div class="panel-heading"><strong>Patient Reports</strong></div>
						<div class="panel-body">
							<p>Showing the list of all recorded reports</p>
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
									<a href="/report/view/{{$report->unique_id}}">
										<i class="fa fa-eye fa-lg"></i>
									</a>
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