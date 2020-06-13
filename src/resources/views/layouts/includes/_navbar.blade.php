<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        <a href="index.html"><img src="{{asset('admin/assets/img/logo-dark.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
    </div>
    <div class="container-fluid">											
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">                    
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="lnr lnr-exit"></i> <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>