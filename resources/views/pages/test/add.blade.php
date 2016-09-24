@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				<h3 class="text-center">Add a new test</h3>
				@if (isset($errors) && count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<div id="add-test-form-container" class="col-sm-5">
					<form method="post">
						<label for="name">Test Name</label>
						<input id="name" class="form-control" type="text" name="name" placeholder="e.g. Blood test">
						
						{{ csrf_field() }}
						<button class="btn btn-primary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="/script/patient.js"></script>

@include('includes.footer')