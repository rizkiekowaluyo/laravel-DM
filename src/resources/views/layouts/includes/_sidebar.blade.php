<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li class=""><a href="{{url('/dashboard')}}"  class="{{ Request::path() === '/dashboard' ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>					
                <li {{ Request::is('/disasterskmeans')? 'active' : '' }}>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Bencana</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{url('/disasters')}}">Kelola Data Bencana</a></li>
                            <li><a href="{{url('/disasterkmeans')}}">K-Means</a></li>								
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Geografi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages2" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{url('/geographics')}}" class="">Kelola Data Geografi</a></li>
                            <li><a href="{{url('/geographickmeans')}}" class="{{ Request::is() === '/geographickmeans' ? 'active' : '' }}">K-Means</a></li>								
                        </ul>
                    </div>
                </li>						
                <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Korelasi</span></a></li>
            </ul>
        </nav>
    </div>
</div>