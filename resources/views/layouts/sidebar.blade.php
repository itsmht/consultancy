<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">Menu</li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-consultancy" aria-controls="submenu-consultancy">
                            <i class="fas fa-briefcase"></i> Consultancy
                        </a>   
                        <div id="submenu-consultancy" class="collapse submenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('banners')}}">
                                        <i class="fas fa-briefcase"></i>Banners
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('partners')}}">
                                        <i class="fas fa-briefcase"></i>Partners
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('teams')}}">
                                        <i class="fas fa-briefcase"></i>Team Messages
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('testimonials')}}">
                                        <i class="fas fa-briefcase"></i>Testimonials
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-portfolio" aria-controls="submenu-portfolio">
                                        <i class="far fa-money-bill-alt"></i>Portfolio Management
                                    </a>   
                                    <div id="submenu-portfolio" class="collapse submenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('portfolios')}}">Portfolios</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('portfolioCategories')}}">Portfolio Categories</a>
                                            </li>
                                        </ul>
                                    </div> 
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-edtech" aria-controls="submenu-edtech">
                            <i class="fas fa-graduation-cap"></i> Edtech
                        </a> 
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
