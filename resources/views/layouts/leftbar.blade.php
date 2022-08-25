<div class="xp-leftbar">
    <div class="xp-sidebar">
        <div class="xp-logobar text-center">
            <a href="{{url('/')}}" class="xp-logo"><img src="/assets/images/logo.png" class="img-fluid" alt="logo"></a>
        </div>
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
                        <a href="{{ route('books.my-books.index') }}">
                            <i class="mdi mdi-book-open-page-variant"></i><span>My Books</span>
                        </a>
                    </li>
                    @if (auth()->user()->isAdmin())
                        <li>
                            <a href="{{route('admin.books.index')}}">
                                <i class="mdi mdi-book-remove"></i><span>Manage All Books</span>
                                @if($not_approved_count>0)
                                    <span
                                        class="badge badge-pill badge-warning pull-right">{{$not_approved_count}}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</div>
