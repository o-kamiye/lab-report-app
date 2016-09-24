@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				@if (session('new_test'))
				    <div class="alert alert-success">
				        {{ session('new_test') }}
				    </div>
				@endif
				<h3 class="text-center">Showing all tests</h3>
				<div id="add-patient-form-container" class="col-sm-6">
					<div class="panel panel-default">
					<!-- Default panel contents -->
						<div class="panel-heading"><strong>Tests</strong></div>
						<div class="panel-body">
							<p>Showing the list of all tests currently supported in the laboratory</p>
						</div>

						<!-- Table -->
						<table class="table">
							<tr>
								<th>#</th>
								<th>Name</th>
								<th></th>
								<th></th>
							</tr>
						<?php $count = 1; ?>
						@foreach ($tests as $test)
							<tr>
								<th>{{$count}}</th>
								<td>{{$test->name}}</td>
								<td>
									<a href="/test/edit/{{$test->id}}">
										<i class="fa fa-pencil-square fa-lg"></i>
									</a>
								</td>
								<td>
									<a href="/test/delete/{{$test->id}}">
										<i class="fa fa-trash delete fa-lg"></i>
									</a>
								</td>
							</tr>
						<?php $count++; ?>
						@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')