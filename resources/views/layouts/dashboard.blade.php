<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard_assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard_assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('dashboard_assets/images/favicon.svg')}}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">

            <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="{{asset('dashboard_assets/images/faces/1.jpg')}}" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold text-center">{{Auth::user()->name}}</h5>
                                       
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                           <h6 class="text-muted mb-0">  {{ __('Logout') }}</h6>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        

                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                         </div>

               
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title"></li>


                     @if(Auth::user()->role == 1)
                     <li class="sidebar-item  has-sub @yield('profile')">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Profile</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{url('admin/editprofile')}}">Change password</a>
                                </li>
                                
                            </ul>
                        </li>
                            
                        <li class="sidebar-item @yield('faq') ">
                            <a href="{{url('faq/home')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Faq</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('category') ">
                            <a href="{{route('category.index')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('product') ">
                            <a href="{{route('product.index')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Product</span>
                            </a>
                        </li>
                        <li class="sidebar-item @yield('cupon') ">
                            <a href="{{route('cupon.index')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Cupon</span>
                            </a>
                        </li>
                     @else
                     <li class="sidebar-item  ">
                            <a href="{{url('customer/home')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Customer home</span>
                            </a>
                        </li>
                     @endif

                       
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Components</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">Alert</a>
                                </li>
                                
                            </ul>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        
        <div id="main">
            

       
            <div class="page-heading">
                <h3>@yield('"page-heading')</h3>
            </div>

                        

            <div class="page-content">
               



                       
                                        @yield('content')
                            



            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; KRK</p>
                    </div>
                    <div class="float-end">
                      
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('dashboard_assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('dashboard_assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('dashboard_assets/js/main.js')}}"></script>
</body>

</html>