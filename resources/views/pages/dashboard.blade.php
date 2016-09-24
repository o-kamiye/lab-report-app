@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				@if (session('new_patient'))
				    <div class="alert alert-success">
				        {{ session('new_patient') }}
				    </div>
				@endif
				<h3 class="text-center">Welcome User. We're happy to have you back with us</h3>
			</div>
		</div>
	</div>

@include('includes.footer')