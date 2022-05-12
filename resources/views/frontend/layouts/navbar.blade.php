<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
	  <a class="navbar-brand" href="{{url('/')}}">Mendax</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="{{url('/')}}">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="">About</a>
	      </li>
	      <li class="nav-item dropdown">
	      	<a href="" class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account <i class="fa fa-caret-down"></i></a>
	      @guest	      
	      	<div class="dropdown-menu custdropdown" aria-labelledy="navbarDropdownMenuLink">
	      		<a href="{{url('login')}}" class="dropdown-item">Login</a>
	      		@if (Route::has('register'))
	      			<a href="{{url('register')}}" class="dropdown-item">Register</a>
	      		@endif
	      	</div>
	      @else
	      <div class="dropdown-menu custdropdown" aria-labelledy="navbarDropdownMenuLink">
	        <a class="dropdown-item" href="#">My Profile</a>
	        <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{url('logout')}}">Logout</a>
	      </div>
	      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        	</form>
	      @endguest
	      </li>
	      <li class="nav-item">
	      	<a class="nav-link" href="#">Cart</a>
	      </li>
	    </ul>
	  </div>
	</div>
</nav>