@include('includes.head')
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
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
						<label for="code">Enter the verification code sent to your phone and email</label>
						<input id="code" type="number" name="code" class="form-control" placeholder="e.g. 123456">
						{{ csrf_field() }}
						<button class="btn btn-primary">Proceed</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')