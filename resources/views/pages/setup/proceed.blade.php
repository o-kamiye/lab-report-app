@include('includes.head')
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<h3 class="text-center">Complete Admin creation</h3>
				<div id="create-admin-form-container">
					<form method="post">
						<label for="fullname">Fullname</label>
						<input id="fullname" class="form-control" type="text" name="fullname" placeholder="e.g. John Smith">
						<label for="passcode">Enter passcode sent to you</label>
						<input id="passcode" class="form-control" type="text" name="passcode" placeholder="e.g. 123456">
						{{ csrf_field() }}
						<button class="btn btn-primary">Create Admin</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@include('includes.footer')
