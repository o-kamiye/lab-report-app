@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav_patient')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				<h3 class="text-center">{{$report->title}}</h3>
				<div class="panel panel-default">
				<!-- Default panel contents -->
					<div class="panel-heading"><strong class="text-uppercase">{{$patient->fullname}}</strong><strong class="pull-right">{{$report->date}}</strong></div>

					<!-- Table -->
					<table class="table table-bordered">
						<tr>
							<th>Test Name</th>
							<th>Test Result</th>
							<th>Comment</th>
						</tr>
						@foreach ($tests as $test)
						<tr>
							<td>
								{{ $test->name }}
							</td>
							<td>
								{{ $test->result }}
							</td>
							<td>
								{{ $test->comment }}
							</td>
						</tr>
						@endforeach
						
					</table>
				</div>
				<div>
					<a title="Download report" href="/report/download/{{$report->unique_id}}">
						<i class="fa fa-file-pdf-o fa-3x"></i>
					</a>
					<a id="send-report-mail" title="Mail report" href="#">
						<i class="fa fa-paper-plane-o fa-3x"></i>
					</a>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')