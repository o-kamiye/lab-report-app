@include('includes.head')
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div id="login-form-container">
					<form method="post">
						<label for="login">Name or Email</label>
						<input id="login" type="text" name="login" class="form-control" placeholder="e.g. John Smith">
						<label for="phone">Phone Number</label>
						<input id="phone" type="text" name="phone" class="form-control" placeholder="e.g. +2348123456789">
						{{ csrf_field() }}
						<button class="btn btn-primary">Sign Up</button> or <a href="/">Login</a>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')