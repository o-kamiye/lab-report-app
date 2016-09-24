@include('includes.head')
	<div class="container-fluid">
		<div class="row">
			@include('includes.sidenav')
			<div class="col-sm-9 col-lg-10">
				<!-- your page content -->
				<h3 class="text-center">Add a new operator</h3>
				@if (isset($errors) && count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<div id="add-patient-form-container" class="col-sm-5">
					<form method="post">
						<label for="fullname">Operator's full name</label>
						<input id="fullname" class="form-control" type="text" name="fullname" placeholder="e.g. John Smith">
						<label for="email">Operator's email</label>
						<input id="email" class="form-control" type="email" name="email" placeholder="e.g. john@smith.com">
						<label for="phone">Patient's phone number (include country code)</label>
						<input id="phone" class="form-control" type="text" name="phone" placeholder="e.g. +2348123456789">
						
						<button id="generate_passcode" data-loading-text="Generating..." type="button">Generate Passcode</button>
						<input id="passcode" class="form-control" type="text" name="passcode" placeholder="e.g. 123456">
						{{ csrf_field() }}
						<button class="btn btn-primary" type="submit">Add Operator</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="/script/patient.js"></script>

@include('includes.footer')