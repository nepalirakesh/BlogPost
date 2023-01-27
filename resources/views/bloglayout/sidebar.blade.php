<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/dashboard')}}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">BlogPost</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{Request::routeIs('author.*')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('author.*')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Manage Authors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('author.index') }}" class="nav-link {{Request::routeIs('author.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Author</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('author.create') }}" class="nav-link {{Request::routeIs('author.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Author</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{Request::routeIs('post.*')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('post.*')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Manage Posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{ route('post.index') }} class="nav-link {{Request::routeIs('post.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Post</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('post.create') }} class="nav-link {{Request::routeIs('post.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Post</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{Request::routeIs('tag.*')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('tag.*')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Manage Tags
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('tag.index') }}" class="nav-link {{Request::routeIs('tag.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Tag</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('tag.create') }} class="nav-link {{Request::routeIs('tag.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Tag</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{Request::routeIs('category.*')?'menu-open':''}}">
                    <a href="#" class="nav-link {{Request::routeIs('category.*')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Manage Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{Request::routeIs('category.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link {{Request::routeIs('category.create')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <br>
                <ul class="nav navbar">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
