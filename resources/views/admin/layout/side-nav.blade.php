<aside>
	<div class="card">
	    <div class="card-body">
	    	<ul class="navbar-nav">
		      	<li class="nav-item active">
		        	<a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="{{ url('admin/users') }}">Users</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		        		Logout
		        	</a>

		        	<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
		      	</li>
		    </ul>
	    </div>
	</div>
</aside>