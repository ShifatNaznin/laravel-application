<nav class="sidebar sidebar-bunker" id="non-printable">
    <div class="sidebar-header" style="padding: 24px 20px 0px 20px !important;text-align: center;">
        <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('admin') }}/assets/dist/img/logo.png" alt=""
                style="height: 50px !important;">
            <p style="color: #fff;
            font-size: 11px;
            letter-spacing: .6px;
            text-transform: uppercase;
            padding-top: 1px;">
                Department of Fisheries (DOF) </p>
        </a>
    </div>
    <!--/.sidebar header-->
    <div class="profile-element profile-element-2 d-flex align-items-center flex-shrink-0">
        <div class="avatar online">
            <img src="{{ asset('admin') }}/assets/dist/img/avatar-1.jpg" class="img-fluid rounded-circle" alt="">

        </div>
        <div class="profile-text">
            <h6 class="m-0">{{ Auth::user()->name }}</h6>
            <span><a href="{{ route('home') }}" style="color: #fff;">{{ Auth::user()->email }}</a></span>
        </div>
    </div>

    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="nav-label nav-label-2">Main Menu</li>
                <li class="{{ Route::is('home') ? 'mm-active' : '' }}"><a href="{{ route('home') }}">
                        <i class="typcn typcn-home-outline mr-2"></i>Dashboard</a></li>
                <li class="{{ Route::is('assetList') ? 'mm-active' : '' }}"><a href="{{ route('assetList') }}">
                        <i class="typcn typcn-home-outline mr-2"></i>Asset List</a></li>
                <li class="{{ Route::is('dataList') ? 'mm-active' : '' }}"><a href="{{ route('dataList') }}">
                        <i class="typcn typcn-home-outline mr-2"></i>Data List</a></li>
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-book mr-2"></i>
                        Reports
                    </a>
                    <ul class="nav-second-level">
                        <li class="{{ Route::is('typeReport') ? 'mm-active' : '' }}">
                            <a href="{{ route('typeReport') }}">
                               Type Reports
                            </a>
                        </li>
                        <li class="{{ Route::is('assetReport') ? 'mm-active' : '' }}">
                            <a href="{{ route('assetReport') }}">
                               Asset Reports
                            </a>
                        </li>
                        <li class="{{ Route::is('monthlyReport') ? 'mm-active' : '' }}">
                            <a href="{{ route('monthlyReport') }}">
                                Monthly Report
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>