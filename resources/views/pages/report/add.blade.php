@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				<h3 class="text-center">Add a new patient report</h3>
				@if (isset($errors) && count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<div id="add-report-form-container">
					<form method="post">
						<label for="patient">Patient Email</label>
						<input id="patient" class="form-control third-width" type="email" name="patient" placeholder="e.g. john@smith.com">
						<label for="title">Report Title</label>
						<input id="title" class="form-control third-width" type="text" name="title" placeholder="e.g. Blood Test Report">
						<label for="date">Date</label>
						<input id="date" class="form-control quarter-width" type="date" name="date" placeholder="e.g. 01/01/2016">

						<div class="panel panel-default">
						<!-- Default panel contents -->
							<div class="panel-heading"><strong>Test Report</strong></div>

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
										<input type="text" disabled name="{{ $test->id }}" value="{{ $test->name }}" class="form-control">
									</td>
									<td><input type="text" name="result_{{$test->id}}" class="form-control" placeholder="Enter test result"></td>
									<td><textarea name="comment_{{$test->id}}" class="form-control" placeholder="Additional Comments"></textarea></td>
								</tr>
								@endforeach
								
							</table>
						</div>
						
						{{ csrf_field() }}
						<button class="btn btn-primary" type="submit">Save Report</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')