@include('includes.head')
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				@if (session('login_error'))
				    <div class="alert alert-danger">
				        {{ session('login_error') }}
				    </div>
				@endif
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<div id="login-form-container">
					<form method="post">
						<label for="email">Email</label>
						<input id="email" type="email" name="email" class="form-control" placeholder="e.g. john@smith.com">
						{{ csrf_field() }}
						<button class="btn btn-primary">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')