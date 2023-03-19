<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Shah Ali Mazar">
        <meta name="author" content="ParkerThemes">
        <link rel="shortcut icon" href="{{asset('custom/img/fav.png')}}">

        <!-- Title -->
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;500&display=swap" rel="stylesheet">


        <!-- *************
            ************ Common Css Files *************
        ************ -->
        <!-- Bootstrap css -->
        {!!Html::style('custom/css/bootstrap.min.css')!!}
        
        <!-- Icomoon Font Icons css -->
        {!!Html::style('custom/fonts/style.css')!!}
        <!-- Main css for green -->
        {!!Html::style('custom/css/green-main.css')!!}


        <!-- *************
            ************ Vendor Css Files *************
        ************ -->

        <!-- Mega Menu -->
        {!!Html::style('custom/vendor/megamenu/css/megamenu.css')!!}

        <!-- Search Filter JS -->
        {!!Html::style('custom/vendor/search-filter/search-filter.css')!!}
        {!!Html::style('custom/vendor/search-filter/custom-search-filter.css')!!}

        <!-- Data Tables -->
        {!!Html::style('custom/vendor/datatables/dataTables.bs4.css')!!}
        {!!Html::style('custom/vendor/datatables/dataTables.bs4-custom.css')!!}
        {!!Html::style('custom/vendor/datatables/buttons.bs.css')!!}
        <!-- Date Range CSS -->
        {!!Html::style('custom/vendor/daterange/daterange.css')!!}

        <!-- Bootstrap Select CSS -->
        {!!Html::style('custom/vendor/bs-select/bs-select.css')!!}
        
    </head>
    <?php
        $baseUrl = URL::to('/');
        $url = Request::path();
    ?>
    <body class="default-sidebar">

        <!-- Loading wrapper start -->
        <div id="loading-wrapper">
            <div class="spinner-border"></div>
        </div>
        <!-- Loading wrapper end -->

        <!-- Page wrapper start -->
        <div class="page-wrapper">
            
            <!-- Sidebar wrapper start -->
            <nav class="sidebar-wrapper">
                
                <!-- Default sidebar wrapper start -->
                <div class="default-sidebar-wrapper">

                    <!-- Sidebar brand starts -->
                    <div class="default-sidebar-brand">
                        <a href="{{URL::to('/home')}}" class="logo">
                            <!-- <img src="{{asset('custom/img/logo.svg')}}" alt="Admin" /> -->
                            <!-- <h5>E-Store</h5><br> -->
                            <h6>{{Auth::user()->name}}</h6>
                        </a>
                    </div>
                    <!-- Sidebar brand starts -->

                    <!-- Sidebar menu starts -->
                    <div class="defaultSidebarMenuScroll">
                        <div class="default-sidebar-menu">
                            <ul>
                                <!-------------- dashboard part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url=='home' || 
                                    $url==config('app.account').'/daily-transaction') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-home2"></i>
                                        <span class="menu-text">Dashboard</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/home'}}"  class="{{($url=='home') ? 'current-page':''}}">{{ __('menu.home') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-------------- user part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.user').'/department' || $url==config('app.user').'/department/create' || $url==(request()->is(config('app.user').'/department/*/edit')) ||
                                    $url==config('app.user').'/designation' || $url==config('app.user').'/designation/create' || $url==(request()->is(config('app.user').'/designation/*/edit')) ||
                                    $url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit')) ||
                                    $url==config('app.user').'/user-role' || $url==config('app.user').'/user-role/create' || $url==(request()->is(config('app.user').'/user-role/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-user"></i>
                                        <span class="menu-text">User Management</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/department'}}" class="{{($url==config('app.user').'/department' || $url==config('app.user').'/department/create' || $url==(request()->is(config('app.user').'/department/*/edit'))) ? 'current-page':''}}">Department</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/designation'}}" class="{{($url==config('app.user').'/designation' || $url==config('app.user').'/designation/create' || $url==(request()->is(config('app.user').'/designation/*/edit'))) ? 'current-page':''}}">Designation</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/user-list'}}" class="{{($url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit'))) ? 'current-page':''}}">User</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/user-role'}}" class="{{($url==config('app.user').'/user-role' || $url==config('app.user').'/user-role/create' || $url==(request()->is(config('app.user').'/user-role/*/edit'))) ? 'current-page':''}}">User Role</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- area part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.area').'/division' || $url==config('app.area').'/division/create' || $url==(request()->is(config('app.area').'/division/*/edit')) ||
                                    $url==config('app.area').'/district' || $url==config('app.area').'/district/create' || $url==(request()->is(config('app.area').'/district/*/edit')) ||
                                    $url==config('app.area').'/area' || $url==config('app.area').'/area/create' || $url==(request()->is(config('app.area').'/area/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-user"></i>
                                        <span class="menu-text">Area Management</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.area').'/division'}}" class="{{($url==config('app.area').'/division' || $url==config('app.area').'/division/create' || $url==(request()->is(config('app.area').'/division/*/edit'))) ? 'current-page':''}}">Division</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.area').'/district'}}" class="{{($url==config('app.area').'/district' || $url==config('app.area').'/district/create' || $url==(request()->is(config('app.area').'/district/*/edit'))) ? 'current-page':''}}">District</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.area').'/area'}}" class="{{($url==config('app.area').'/area' || $url==config('app.area').'/area/create' || $url==(request()->is(config('app.area').'/area/*/edit'))) ? 'current-page':''}}">Area</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- Customer part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.customer').'/business-category' || $url==config('app.customer').'/business-category/create' || $url==(request()->is(config('app.customer').'/business-category/*/edit')) ||
                                    $url==config('app.customer').'/customers' || $url==config('app.customer').'/customers/create' || $url==(request()->is(config('app.customer').'/customers/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Customer</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.customer').'/business-category'}}" class="{{($url==config('app.customer').'/business-category' || $url==config('app.customer').'/business-category/create' || $url==(request()->is(config('app.customer').'/business-category/*/edit'))) ? 'current-page':''}}">Business Category</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.customer').'/customers'}}" class="{{($url==config('app.customer').'/customers' || $url==config('app.customer').'/customers/create' || $url==(request()->is(config('app.customer').'/customers/*/edit'))) ? 'current-page':''}}">Customer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- product part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.product').'/business-category' || $url==config('app.product').'/business-category/create' || $url==(request()->is(config('app.product').'/business-category/*/edit')) ||
                                    $url==config('app.product').'/products' || $url==config('app.product').'/products/create' || $url==(request()->is(config('app.product').'/products/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Product</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.product').'/product-category'}}" class="{{($url==config('app.product').'/product-category' || $url==config('app.product').'/product-category/create' || $url==(request()->is(config('app.product').'/product-category/*/edit'))) ? 'current-page':''}}">Product Category</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.product').'/products'}}" class="{{($url==config('app.product').'/products' || $url==config('app.product').'/products/create' || $url==(request()->is(config('app.product').'/products/*/edit'))) ? 'current-page':''}}">Products</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- change password part ------------>
                                <li class="default-sidebar {{($url=='settings') ? 'active':''}}">
                                    <a href="{{URL::to('settings')}}">
                                        <i class="icon-lock"></i>
                                        <span class="menu-text">Change Password</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar menu ends -->

                </div>
                <!-- Default sidebar wrapper end -->
                
            </nav>
            <!-- Sidebar wrapper end -->

            <!-- *************
                ************ Main container start *************
            ************* -->
            <div class="main-container">

                <!-- Page header starts -->
                <div class="page-header">
                    
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">

                            <!-- Search container start -->
                            <div class="search-container">

                                <!-- Toggle sidebar start -->
                                <div class="toggle-sidebar" id="toggle-sidebar">
                                    <i class="icon-menu"></i>
                                </div>
                                <!-- Toggle sidebar end -->
                            </div>
                            <!-- Search container end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

                            <!-- Header actions start -->
                            <ul class="header-actions">
                                <li class="dropdown">
                                    <a href="{{ route('user-list.show',auth()->user()->id) }}" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                                        <span class="avatar">
                                            {{-- @if (!empty(auth()->user()->image))
                                            <img class="profile-user-img img-responsive img-fluid" src="{{asset('upload/user/'.auth()->user()->image)}}" alt="User profile picture">
                                            @else
                                            <img class="profile-user-img img-responsive img-fluid" src="{{asset('upload/logo/no-image.jpg')}}" alt="User profile picture">
                                            @endif --}}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end sm" aria-labelledby="userSettings" style="width: 21rem">
                                        <div class="header-profile-actions">
                                            <a href="{{ route('user-list.show',auth()->user()->id) }}"><i class="icon-user1"></i>Profile</a>
                                            <a href="{{URL::to('settings')}}"><i class="icon-lock"></i>Change Password</a> 
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-log-out1"></i>Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- Header actions end -->

                        </div>
                    </div>
                    <!-- Row end -->                    

                </div>
                <!-- Page header ends -->
                @yield('content') 
                <!-- App footer start -->
                <div class="app-footer">© BinaryIT <?php echo date('Y')?></div>
                <!-- App footer end -->
            </div>
            <!-- ************************* Main container end ************************** -->

        </div>
        <!-- Page wrapper end -->

        <!-- *************
            ************ Required JavaScript Files *************
        ************* -->
        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        {!!Html::script('custom/js/jquery.min.js')!!}
        {!!Html::script('custom/js/bootstrap.bundle.min.js')!!}
        {!!Html::script('custom/js/modernizr.js')!!}
        {!!Html::script('custom/js/moment.js')!!}
        
        {!!Html::script('custom/js/webcam.min.js')!!}

        <!-- *************
            ************ Vendor Js Files *************
        ************* -->
        
        <!-- Megamenu JS -->
        {!!Html::script('custom/vendor/megamenu/js/megamenu.js')!!}
        {!!Html::script('custom/vendor/megamenu/js/custom.js')!!}

        <!-- Slimscroll JS -->
        {!!Html::script('custom/vendor/slimscroll/slimscroll.min.js')!!}
        {!!Html::script('custom/vendor/slimscroll/custom-scrollbar.js')!!}

        <!-- Search Filter JS -->
        {!!Html::script('custom/vendor/search-filter/search-filter.js')!!}
        {!!Html::script('custom/vendor/search-filter/custom-search-filter.js')!!}

        <!-- Data Tables -->
        {!!Html::script('custom/vendor/datatables/dataTables.min.js')!!}
        {!!Html::script('custom/vendor/datatables/dataTables.bootstrap.min.js')!!}
        
        <!-- Custom Data tables -->
        {!!Html::script('custom/vendor/datatables/custom/custom-datatables.js')!!}

        <!-- Download / CSV / Copy / Print -->
        {!!Html::script('custom/vendor/datatables/buttons.min.js')!!}
        {!!Html::script('custom/vendor/datatables/jszip.min.js')!!}
        {!!Html::script('custom/vendor/datatables/pdfmake.min.js')!!}
        {!!Html::script('custom/vendor/datatables/vfs_fonts.js')!!}
        {!!Html::script('custom/vendor/datatables/html5.min.js')!!}
        {!!Html::script('custom/vendor/datatables/buttons.print.min.js')!!}

        <!-- Apex Charts -->
         <!-- {!!Html::script('custom/vendor/apex/apexcharts.min.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/salesGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/ordersGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/earningsGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/visitorsGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/customersGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/sparkline.js')!!} -->
        
        {!!Html::script('custom/vendor/apex/apexcharts.min.js')!!}
        {!!Html::script('custom/vendor/apex/examples/pie/basic-pie-graph.js')!!}

        <!-- Circleful Charts -->
        <!-- {!!Html::script('custom/vendor/circliful/circliful.min.js')!!}
        {!!Html::script('custom/vendor/circliful/circliful.custom.js')!!} -->

        <!-- Main Js Required -->
        {!!Html::script('custom/js/main.js')!!}

        <!-- Date Range JS -->
        {!!Html::script('custom/vendor/daterange/daterange.js')!!}
        {!!Html::script('custom/vendor/daterange/custom-daterange.js')!!}

        <!-- Bootstrap Select JS -->
        {!!Html::script('custom/vendor/bs-select/bs-select.min.js')!!}
        {!!Html::script('custom/vendor/bs-select/bs-select-custom.js')!!}

        
        <!-- select2 -->
        {!!Html::script('custom/select2/js/select2.min.js')!!}
            
        <script type="text/javascript">
            $(document).ready(function(){
              $('.select2').select2({ width: '100%', height: '100%', placeholder: "Select", allowClear: true });
            });
        </script>

        <!-- Sweet alert -->
        {!!Html::script('custom/sweetalert/sweetalert.min.js')!!}
        <script type="text/javascript">
            $('.confirmdelete').on('click', function (event) {
              event.preventDefault();
                  var $form = $(this).closest('form');
                  swal({
                      title: "Are you sure?",
                      text: $(this).attr('confirm'),
                      type: "warning",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      $form.submit();
                    }
                  });
            });

            $(document).ready( function () {
              $('#dataTable').DataTable({
                "paging":   true,
                "ordering": true,
                "info":     true,
              });
            });

            function printReport() {
                //("#print_icon").hide();
                var reportTablePrint=document.getElementById("printTable");
                newWin= window.open();
                var is_chrome = Boolean(newWin.chrome);
                // var top = '<center><img src="{{URL::to("logo/logo.png")}}" width="40px" height="40px"></center>';
                //   top += '<center><h3>Baby Land Park</h3></center>';
                //   top += '<center><p style="margin-top:-10px">Address</p></center>';
                // newWin.document.write(top);
                newWin.document.write(reportTablePrint.innerHTML);
                if (is_chrome) {
                    setTimeout(function () { // wait until all resources loaded 
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus(); // necessary for IE >= 10
                    newWin.print();  // change window to winPrint
                    newWin.close();// change window to winPrint
                    }, 250);
                }
                else {
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus(); // necessary for IE >= 10

                    newWin.print();
                    newWin.close();
                }
            }
        </script>

        
        @stack("custom_script")  
    </body>
</html>