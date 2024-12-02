<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:23 GMT -->
<head>

  <!-- Title -->

  <title>Admin</title>


  <!-- Required Meta Tag -->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Admin" />
  <meta name="author" content="" />
  <meta name="keywords" content="Admin" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />


  <!-- Favicon -->

  <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">


  <!-- Core Css -->

  <link rel="stylesheet" href="{{asset('adminAssets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">

  <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
  
  {{-- <link rel="stylesheet" href="{{asset('adminAssets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('adminAssets/css/my-style.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

</head>

<body>


  <!-- Body Wrapper -->

  <div class="page-wrapper " id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <div class="">
    <!-- Sidebar Start -->

    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{URL::to('admin/dashboard')}}" class="text-nowrap logo-img" style="height: 90px">
              <img src="{{Auth::user()->logo}}" class="dark-logo" style="height: 90px" width="90px" alt="" />
              {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" /> --}}
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8 text-muted"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
              <!-- ============================= -->
              <!-- Home -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
              </li>
              <!-- =================== -->
              <!-- Dashboard -->
              <!-- =================== -->
              @if (Auth::user()->type  == 'admin')
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/sub_user_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">User</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/notice')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-rotate-clockwise-2" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Notice</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/popup_alert')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-dotted"></i>
                    </span>
                    <span class="hide-menu">Popup</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/expired_camping_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-dotted"></i>
                    </span>
                    <span class="hide-menu">Expired camping list</span>
                  </a>
                </li>
                
                    
              @else
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-aperture"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </a>
              </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/camping_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-caravan"></i>
                    </span>
                    <span class="hide-menu">Campaign</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/scratchcard_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-dotted"></i>
                    </span>
                    <span class="hide-menu">Scratch Card</span>
                  </a>
                </li>
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/spinner_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-dotted"></i>
                    </span>
                    <span class="hide-menu">Spinner</span>
                  </a>
                </li> --}}
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/scratchcard_form_camping_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-rotate-clockwise-2"></i>
                    </span>
                    <span class="hide-menu">Card Enquiry</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/bike_model')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-rotate-clockwise-2"></i>
                    </span>
                    <span class="hide-menu">Choose Option</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/form_access')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-list-details"></i>
                    </span>
                    <span class="hide-menu">Form Fields Access</span>
                  </a>
                </li>
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/ip_skip')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-notes"></i>
                    </span>
                    <span class="hide-menu">IP Skip</span>
                  </a>
                </li> --}}
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/notice')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-rotate-clockwise-2" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Notice</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/popup_alert')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-dotted"></i>
                    </span>
                    <span class="hide-menu">Popup</span>
                  </a>
                </li>
              @endif
            </ul>
            
          </nav>
          <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
              <div class="john-img">
                <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
              </div>
              <div class="john-title">
                <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                <span class="fs-2 text-dark">Designer</span>
              </div>
              <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                <i class="ti ti-power fs-6"></i>
              </button>
            </div>
          </div>  
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>

    <!-- Sidebar End -->
    <!-- Main wrapper -->

    <div class="body-wrapper">

      <!-- Header Start -->

      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            
          </ul>

   
          
         
          <div class="d-block" style="width: 60%;">
            @php
                  $notice = DB::table('notices')->first();
            @endphp
            @if ($notice != '' && $notice->status == 'active')
                <div>
                  <marquee  direction="left" onmouseover="this.stop();" onmouseleave="this.start();">
                  <p style="color: rgb(0, 0, 0);margin-top: 10px;margin-left: 20px;">
                    {{$notice->notice}}
                  </p>
                </marquee>
                </div>
            @endif
            {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg" width="180" alt="" /> --}}
          </div>
          <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
              <i class="ti ti-dots fs-7"></i>
            </span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
              {{-- <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                aria-controls="offcanvasWithBothOptions">
                <i class="ti ti-align-justified fs-7"></i>
              </a> --}}
              <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

                {{-- @if(Auth::user()->type == 'user')
                <li class="nav-item dropdown">
                  <form action="{{URL::to('admin/change_spin_mode')}}" method="POST">
                    @csrf
                    <div style="display: flex;border-radius: 5px;box-shadow: 0 0 5px rgba(0, 0, 0, 0.9);padding: 5px;background: #fff">
                      <label for="Skip Mode" style="margin-right: 5px">Skip Mode</label>
                      <div class="form-check form-switch">
                      
                        <input class="form-check-input" type="checkbox" name="spin_mode" role="switch" id="spin_mode" @if(Auth::user()->default_spinn == 2) checked @endif  onchange="this.form.submit()">
                        <label class="form-check-label" for="spin_mode">
                          
                          Chances Mode 
                        
                        </label>
                      </div>
                    </div>
                    
                  </form>
                  
                </li>
                @endif --}}

                <li class="nav-item dropdown">
                  <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                      <div class="user-profile-img">
                        <img src="{{asset('adminAssets/images/profile/user-1.jpg')}}" class="rounded-circle" width="35" height="35"
                          alt="" />
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                    aria-labelledby="drop1">
                    <div class="profile-dropdown position-relative" data-simplebar>
                      <div class="py-3 px-7 pb-0">
                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                      </div>
                      <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                        <img src="{{asset('adminAssets/images/profile/user-1.jpg')}}" class="rounded-circle" width="80" height="80"
                          alt="" />
                        <div class="ms-3">
                          <h5 class="mb-1 fs-3">{{Auth::user()->name}}</h5>
                          {{-- <span class="mb-1 d-block text-dark">Designer</span> --}}
                          <p class="mb-0 d-flex text-dark align-items-center gap-2">
                            <i class="ti ti-mail fs-4"></i> {{Auth::user()->email}}
                          </p>
                        </div>
                      </div>
                      <div class="message-body">
                        @if (Auth::user()->type == 'admin')
                        <a href="{{URL::to('admin/sitesetting')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold"> Site Settings </h6>
                            {{-- <span class="d-block text-dark">Account Settings</span> --}}
                          </div>
                        </a>
                        @endif

                        <a href="{{URL::to('admin/profile')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold"> Settings </h6>
                            {{-- <span class="d-block text-dark">Account Settings</span> --}}
                          </div>
                        </a>
                       
                        
                      </div>
                      <div class="d-grid py-4 px-7 pt-8">
                        @if (Auth::user()->type  == 'user')
                        <a href="{{URL::to('admin/print_qr_code')}}"  target="_blank" class="btn btn-outline-warning my-2">Download QR</a>
                       
                          <a href="{{URL::to('u/'.Auth::user()->name_url)}}" target="_blank" class="btn btn-outline-success my-2">Visit My Site</a>
                        
                          <a href="#" onclick="clearAllSpain()" class="btn btn-outline-danger my-2" >Clear Cookie </a>
                        
                          @endif
                        <a href="{{URL::to('logout')}}" class="btn btn-outline-primary">Log Out</a>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <!-- Header End -->
      
        @yield('content')
      
    </div>
    </div>
  </div>


 

  <!--  Mobilenavbar -->
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <nav class="sidebar-nav scroll-sidebar">
      <div class="offcanvas-header justify-content-between">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" alt="" class="img-fluid">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar="" data-simplebar>
        <ul id="sidebarnav">
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
              <span>
                <i class="ti ti-apps"></i>
              </span>
              <span class="hide-menu">Apps</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level my-3">
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-invoice.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-mobile.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-message-box.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Email App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-cart.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                    <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-date.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-lifebuoy.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-application.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">To-do and Daily tasks</span>
                  </div>
                </a>
              </li>
              <ul class="px-8 mt-7 mb-4">
                <li class="sidebar-item mb-3">
                  <h5 class="fs-5 fw-semibold">Quick Links</h5>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Pricing Page</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Authentication Design</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Register Now</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">404 Error Page</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Notes App</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">User Application</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Account Settings</a>
                </li>
              </ul>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-chat.html" aria-expanded="false">
              <span>
                <i class="ti ti-message-dots"></i>
              </span>
              <span class="hide-menu">Chat</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-calendar.html" aria-expanded="false">
              <span>
                <i class="ti ti-calendar"></i>
              </span>
              <span class="hide-menu">Calendar</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-email.html" aria-expanded="false">
              <span>
                <i class="ti ti-mail"></i>
              </span>
              <span class="hide-menu">Email</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <!-- Search Bar -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content rounded-1">
        <div class="modal-header border-bottom">
          <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
          <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
            <i class="ti ti-x fs-5 ms-3"></i>
          </span>
        </div>
        <div class="modal-body message-body" data-simplebar="">
          <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
          <ul class="list mb-0 py-2">
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Modern</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                <span class="fs-3 text-muted d-block">/apps/contacts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Posts</span>
                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Detail</span>
                <span
                  class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Shop</span>
                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Modern</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                <span class="fs-3 text-muted d-block">/apps/contacts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Posts</span>
                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Detail</span>
                <span
                  class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Shop</span>
                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  @php
  $popup = DB::table('popupalerts')->where('user_type','admin')->where('status','active')->orderBy('id','desc')->first();
@endphp
  <div class="modal fade quotation newsShowPopupModal"  tabindex="-1" aria-labelledby="smallQuoteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content"  style="width: 95%;">

        <div class="modal-body">

          <div class="" style="float: right;">
              <button type="button" class="btn-close popup_close"  onclick="popupModalClose()" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
              </button>
          </div>
            <div class="modal-content">
              @if (!empty($popup))
                 
                 @if (!empty($popup->popup_img))
                    <h4>{{$popup->title}}</h4> 
                 @endif
                 @if (!empty($popup->popup_img))
                      <img src="{{$popup->popup_img}}" alt=""  style="height: 405px;">   
                 @endif
               
              @endif
                
              </div>
          
        </div>

      </div>
    </div>
  </div>


<div class="modal fade quotation ClearAllSpainModal"  tabindex="-1" aria-labelledby="smallQuoteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content"  style="width: 95%;">

        <div class="modal-body">

          <div class="" style="float: right;">
              <button type="button" class="btn-close popup_close"  onclick="popupModalClose()" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fas fa-times"></i>
              </button>
          </div>
            <div class="modal-content">

              <form action="{{URL::to('admin/spin_pi_clear')}}" method="POST" style="padding: 25px;">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="delete_conformation">Type <span style="color: red">Delete</span> For Clear Cookies</label>
                    <input type="text" name="delete_conformation" onkeyup="delete_confirmation_type(this.value)"  class="form-control" id="delete_conformation" placeholder="Delete conformation" style="    margin-top: 10px;" required>
                  </div>
             
                  
                </div>
                <div class="form-row text-right" style="    margin-top: 10px;
    text-align: end;">
                  <div class="form-group col-md-12">
                   <button class="btn btn-danger delete_conformation_btn" disabled>Submit</button>
                  </div>
             
                  
                </div>
              </form>
                
            </div>
          
        </div>

      </div>
    </div>
  </div>



  <!-- Customizer -->
  <!-- Import Js Files -->
  <script src="{{asset('adminAssets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('adminAssets/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{asset('adminAssets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- core files -->
  <script src="{{asset('adminAssets/js/app.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/app.minisidebar.init.js')}}"></script>
  <script src="{{asset('adminAssets/js/app-style-switcher.js')}}"></script>
  <script src="{{asset('adminAssets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('adminAssets/js/custom.js')}}"></script>
  <!-- current page js files -->
  <script src="{{asset('adminAssets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/dashboard4.js')}}"></script>
  {{-- <script src="{{asset('adminAssets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}

  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Toastr -->

  
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">



  @yield('js')

 

  <script>
    @if(Session::has('messege'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('messege')}}");
            bresk;
        case 'success':
            toastr.success("{{Session::get('messege')}}");
            bresk;
        case 'worning':
            toastr.worning("{{Session::get('messege')}}");
            bresk;
        case 'error':
            toastr.error("{{Session::get('messege')}}");
            bresk;
    }
    @endif


    
    function dataDelete(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute(
            'href'
            ); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = urlToRedirect;
            } else {
                return false;
            }
        });
    }


    //
    @if (!empty($popup) && $popup->status == 'active')
      @if(!Session::get('popupShow'))
          //alert('fff');
          setTimeout(function(){ $('.newsShowPopupModal').modal('show');}, 1000);
          
      @else
          //alert('ddd');
          $('.newsShowPopupModal').modal('hide');
      @endif
    @endif

    function popupModalClose(){
        //alert('pop');
        @php
            Session::put('popupShow','show');
        @endphp
        $('.newsShowPopupModal').modal('hide');
    } 

    function clearAllSpain(){

        $('.ClearAllSpainModal').modal('show');
    } 



    function delete_confirmation_type(data) {
      if (data == 'Delete') {
          $('.delete_conformation_btn').removeAttr('disabled');  // Enable the button
      } else {
          $('.delete_conformation_btn').attr('disabled', 'disabled');  // Disable the button
      }
    }


  </script>


</body>


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:25 GMT -->
</html>