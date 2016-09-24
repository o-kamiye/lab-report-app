@include('includes.head')
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				@if (session('error'))
				    <div class="alert alert-danger">
				        {{ session('error') }}
				    </div>
				@endif
				<h3 class="text-center">Create application's first admin user</h3>
				<div id="create-admin-form-container">
					<form method="post">
						<label for="email">Email</label>
						<input id="email" type="text" name="email" class="form-control" placeholder="e.g. john@smith.com">
						<label for="phone">Phone Number</label>
						<input id="phone" type="text" name="phone" class="form-control" placeholder="e.g. +2348123456789">
						{{ csrf_field() }}
						<button class="btn btn-primary">Proceed</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')