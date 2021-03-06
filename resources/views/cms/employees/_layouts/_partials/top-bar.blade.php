 <header id="page-topbar">
     <div class="navbar-header">
         <div class="d-flex">
             <!-- LOGO -->
             <div class="navbar-brand-box">
                 <a href="{{ route('employee.dashboard') }}" class="logo logo-dark">
                     <span class="logo-sm">
                         <img src="{{ asset('cms/images/logo-sm.svg') }}" alt="" height="24">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('cms/images/logo-sm.svg') }}" alt="" height="24"> <span
                             class="logo-txt">Bakes n Cakes</span>
                     </span>
                 </a>

                 <a href="{{ route('employee.dashboard') }}" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="{{ asset('cms/images/logo-sm.svg') }}" alt="" height="24">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('cms/images/logo-sm.svg') }}" alt="" height="24"> <span
                             class="logo-txt">Bakes n Cakes|E-commerce</span>
                     </span>
                 </a>
             </div>

             <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                 <i class="fa fa-fw fa-bars"></i>
             </button>

             <!-- App Search-->
             <form class="app-search d-none d-lg-block">
                 <div class="position-relative">
                     <input type="text" class="form-control" placeholder="Search...">
                     <button class="btn btn-primary" type="button"><i
                             class="bx bx-search-alt align-middle"></i></button>
                 </div>
             </form>
         </div>

         <div class="d-flex">

             <div class="dropdown d-inline-block d-lg-none ms-2">
                 <button type="button" class="btn header-item" id="page-header-search-dropdown"
                     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i data-feather="search" class="icon-lg"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-search-dropdown">

                     <form class="p-3">
                         <div class="form-group m-0">
                             <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search ..."
                                     aria-label="Search Result">

                                 <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>

             <div class="dropdown d-inline-block">
                 <button type="button" class="btn header-item noti-icon position-relative"
                     id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">
                     <i data-feather="bell" class="icon-lg"></i>
                     <span
                         class="badge bg-danger rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
                 </button>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                     <div class="p-3">
                         <div class="row align-items-center">
                             <div class="col">
                                 <h6 class="m-0"> Notifications </h6>
                             </div>
                             <div class="col-auto">
                                 <a href="#!" class="small text-reset text-decoration-underline"> Unread
                                     ({{ auth()->user()->unreadNotifications->count() }})</a>
                             </div>
                         </div>
                     </div>
                     <div data-simplebar style="max-height: 230px;">
                         <div class="d-flex justify-content-around mb-2">
                             <div>
                                 <a href="{{ route('admin.newsletters.markRead') }}"
                                     class="text-reset text-decoration-underline">
                                     @if (auth()->user()->unreadNotifications->count())
                                         Mark all as read
                                     @endif
                                 </a>
                             </div>
                             <div class="text-danger">
                                 <a href="{{ route('admin.newsletters.deleteAllRead') }}"
                                     class="text-reset text-decoration-underline">
                                     @if (auth()->user()->readNotifications->count())
                                         Delete all read
                                     @endif
                                 </a>
                             </div>
                         </div>

                         @foreach (auth()->user()->unreadNotifications as $notification)
                             <a href="#!" class="text-reset notification-item ">
                                 <div class="d-flex bg-light text-dark">
                                     <div class="flex-shrink-0 avatar-sm me-3">
                                         <span class="avatar-title bg-success rounded-circle font-size-16">
                                             <i class="bx bx-badge-check"></i>
                                         </span>
                                     </div>
                                     <div class="flex-grow-1">
                                         <h6 class="mb-1">{{ $notification->data['title'] }}</h6>
                                         <div class="font-size-13 text-muted">
                                             <p class="mb-1">{{ $notification->data['email'] }}</p>
                                             <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                 <span>{{ $notification->created_at->diffForHumans() }}</span>
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         @endforeach

                         @foreach (auth()->user()->readNotifications as $notification)
                             <a href="#!" class="text-reset notification-item">
                                 <div class="d-flex">
                                     <div class="flex-shrink-0 avatar-sm me-3">
                                         <span class="avatar-title bg-success rounded-circle font-size-16">
                                             <i class="bx bx-badge-check"></i>
                                         </span>
                                     </div>
                                     <div class="flex-grow-1">
                                         <h6 class="mb-1">{{ $notification->data['title'] }}</h6>
                                         <div class="font-size-13 text-muted">
                                             <p class="mb-1">{{ $notification->data['email'] }}</p>
                                             <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                 <span>{{ $notification->created_at->diffForHumans() }}</span>
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                             </a>
                         @endforeach

                     </div>
                     <div class="p-2 border-top d-grid">
                         <a class="btn btn-sm btn-link font-size-14 text-center"
                             href="{{ route('admin.newsletters.index') }}">
                             <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                         </a>
                     </div>
                 </div>
             </div>



             <div class="dropdown d-inline-block">
                 <button type="button" class="btn header-item bg-soft-light border-start border-end"
                     id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">
                     <img class="rounded-circle header-profile-user"
                         src="{{ auth()->user()->getFirstOrDefaultMediaUrl('avatars', 'profile') }}"
                         alt="Header Avatar">
                     <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ auth()->user()->name }}</span>
                     <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-end">
                     <!-- item-->
                     <a class="dropdown-item" href="{{ route('employee.profiles.index') }}"><i
                             class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>

                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{ route('logout') }}"><i
                             class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                 </div>
             </div>

         </div>
     </div>
 </header>
