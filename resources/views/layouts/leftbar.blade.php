<div class="xp-leftbar">
    <!-- Start XP Sidebar -->
    <div class="xp-sidebar">
        <!-- Start XP Logobar -->
        <div class="xp-logobar text-center">
            <a href="{{url('/')}}" class="xp-logo"><img src="/assets/images/logo.png" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End XP Logobar -->
        <!-- Start XP Navigationbar -->
        <div class="xp-navigationbar">
            <ul class="xp-vertical-menu">
                <li class="xp-vertical-header">Menu</li>
                @guest
                <li>
                    <a href="{{url('/')}}">
                        <i class="mdi mdi-book-minus"></i><span>Available books</span>
                    </a>
                </li>
                @else
                    <li>
                        <a href="{{url('/')}}">
                            <i class="mdi mdi-book-minus"></i><span>Available books</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('booksManageMenu') }}">
                            <i class="mdi mdi-book-open-page-variant"></i><span>My Books</span>
                        </a>
                    </li>

                    @if (Auth::user()->getUserLevel() == 'admin')
                        <li>
                            <a href="#">
                                <i class="mdi mdi-book-remove"></i><span>Manage All Books</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.book.index') }}">
                                <i class="mdi mdi-book-lock-open"></i><span>Approve Books</span>
                                @if($not_approved_count>0)
                                    <span class="badge badge-pill badge-warning pull-right">{{$not_approved_count}}</span>
                                @endif
                            </a>
                        </li>

                    @endif

                @endguest

            </ul>
        </div>
        <!-- End XP Navigationbar -->
    </div>
    <!-- End XP Sidebar -->
</div>
<!-- End XP Leftbar -->
