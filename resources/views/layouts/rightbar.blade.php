<div class="xp-rightbar">
    <!-- Start XP Topbar -->
    <div class="xp-topbar">
        <!-- Start XP Row -->
        <div class="row">
            <!-- Start XP Col -->
            <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                <div class="xp-menubar">
                    <a class="xp-menu-hamburger" href="javascript:void();">
                       <i class="mdi mdi-sort-variant font-24 text-white"></i>
                     </a>
                 </div>
            </div>
            <!-- End XP Col -->
            <!-- Start XP Col -->
            <div class="col-md-5 col-lg-3 order-3 order-md-2">
                <div class="xp-searchbar">
                    <form action="{{ route('books.search') }}" method="POST" >
                        @method('post')
                        @csrf

                        <div class="input-group">
                          <input type="search" name="searchCriteria" class="form-control" placeholder="Search"
                                 aria-label="Search" aria-describedby="button-addon2" value="{{ $searchCriteria ?? '' }}">
                          <div class="input-group-append">
                            <button class="btn" type="submit" id="button-addon2">GO</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End XP Col -->
            <!-- Start XP Col -->
            <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                <div class="xp-profilebar text-right">
                    <ul class="list-inline mb-0">

                        @guest

                            @if (Route::has('login'))
                                <a class="px-3" href="{{ url('/login') }}">Login <span class="sr-only">(current)</span></a>
                            @endif
                            @if (Route::has('register'))
                                <a class="px-3" href="{{ route('register') }}">Register <span class="sr-only">(current)</span></a>
                            @endif
                        @else

                            <li class="list-inline-item mr-0">
                                <div class="dropdown xp-userprofile">
                                    <a class="dropdown-toggle user-profile-img" href="#" role="button" id="xp-userprofile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/assets/images/topbar/user.jpg" alt="user-profile" class="rounded-circle img-fluid"><span class="xp-user-live"></span></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-userprofile">
                                        <div class="dropdown-item" >Welcome, {{Auth::user()->name}}</div>
                                        <a class="dropdown-item" href="{{ route('user.index') }}"><i class="mdi mdi-settings mr-2"></i> User Settings</a>

                                        <a class="dropdown-item" href="{{ route('api.show') }}"><i class="mdi mdi-cellphone-key mr-2"></i> API Settings</a>


                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout mr-2"></i> Logout</a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
            <!-- End XP Col -->
        </div>
        <!-- End XP Row -->
    </div>
    <!-- End XP Topbar -->
    @yield('rightbar-content')
    <!-- Start XP Footerbar -->
    <div class="xp-footerbar">
        <footer class="footer">
            <p class="mb-0">© 2021 Rytis Klimavicius</p>
        </footer>
    </div>
    <!-- End XP Footerbar -->
</div>
