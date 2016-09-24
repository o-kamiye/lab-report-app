<div class="col-sm-3 col-lg-2">
	<nav class="navbar navbar-default navbar-fixed-side navbar-inverse">
		<!-- normal collapsible navbar markup -->
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Pathology Report</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Patients <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/patient/add">Add New Patient</a></li>
							<li><a href="/patient/show_all">Show Patients</a></li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/report/add">Add New Report</a></li>
							<li><a href="/report/show_all">Show Reports</a></li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tests <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/test/add">Add New Test</a></li>
							<li><a href="/test/show_all">Show Tests</a></li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Operator <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/operator/add">New Operator Account</a></li>
						</ul>
					</li>

					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Edit</a></li>
							<li><a href="/signout">Sign Out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>