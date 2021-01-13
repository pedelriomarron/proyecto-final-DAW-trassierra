     <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

         <!-- Sidebar - Brand -->
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
             <div class="sidebar-brand-icon rotate-n-15">
                 <img src="{{ asset('img/logo_white.svg/') }}" width="50vw" alt="Logo">
             </div>
             <div class="sidebar-brand-text mx-3">EV <sup>v.1</sup></div>
         </a>

         <!-- Divider -->
         <hr class="sidebar-divider my-0">

         <!-- Nav Item - Dashboard -->
         <li class="nav-item  {{ set_active(['admin']) }} ">
             <a class="nav-link" href="{{ route('admin') }}">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>@lang('dashboard_dashboard')</span></a>
         </li>
         <!-- Divider 
         <li class="nav-item {{ set_active(['home']) }} ">
             <a class="nav-link" href="{{ route('home') }}">
                 <i class="fas fa-home"></i> <span>@lang('dashboard_back-to-home')</span></a>
         </li>
-->
         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Heading -->
         <div class="sidebar-heading">
             Settings
         </div>
         @hasanyrole('Admin|writter')
         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item ">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                 aria-expanded="true" aria-controls="collapseTwo">
                 <i class="fas fa-fw fa-cog"></i>
                 <span>@lang('dashboard_admin-tables-title')</span>
             </a>
             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">@lang('dashboard_admin-tables-sub'):</h6>
                     <a class="collapse-item" href="{{ route('brands.index') }}">@lang('dashboard_admin-brands')</a>
                     <a class="collapse-item"
                         href="{{ route('bodystyles.index') }}">@lang('dashboard_admin-bodystyles')</a>
                     <a class="collapse-item" href="{{ route('drives.index') }}">@lang('dashboard_admin-drives')</a>
                     <a class="collapse-item" href="{{ route('segments.index') }}">@lang('dashboard_admin-segments')</a>
                 </div>
             </div>
         </li>
         @endhasanyrole
         @hasanyrole('Admin|Expert|Editor')
         <!-- Nav Item - Utilities Collapse Menu -->
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                 aria-expanded="true" aria-controls="collapseUtilities">
                 <i class="fas fa-car"></i>
                 <span>@lang('dashboard_cars')</span>
             </a>
             <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('cars.index') }}">@lang('dashboard_cars-admin')</a>
                     @hasanyrole('Admin|Editor')
                     <a class="collapse-item" href="{{ route('cars.create') }}">@lang('dashboard_cars-create')</a>
                     @endhasanyrole

                 </div>
             </div>
         </li>
         @endhasanyrole
         <li class="nav-item  {{ set_active(['admin/api']) }} ">
             <a class="nav-link" href="{{ route('admin.api') }}">
                 <i class="fas fa-database"></i>
                 <span>@lang('dashboard_api')</span></a>
         </li>

         @hasanyrole('Admin|writter')
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
             Administrador
         </div>

         <li class="nav-item {{ set_active(['users*']) }}">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                 aria-expanded="true" aria-controls="collapseUser">
                 <i class="fas fa-users"></i>
                 <span>@lang('dashboard_users')</span>
             </a>
             <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('users.index') }}"> @lang('dashboard_user-admin')</a>
                     <a class="collapse-item" href="{{ route('users.create') }}">@lang('dashboard_user-create')</a>
                     <a class="collapse-item" href="{{ route('experts.index') }}">@lang('dashboard_admin-experts')</a>
                 </div>
             </div>
         </li>
         <li class="nav-item {{ set_active(['roles*']) }}">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
                 aria-expanded="true" aria-controls="collapseRoles">
                 <i class="fas fa-users-cog"></i>
                 <span>@lang('dashboard_roles')</span>
             </a>
             <div id="collapseRoles" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('roles.index') }}"> @lang('dashboard_roles-admin')</a>
                     <a class="collapse-item" href="{{ route('roles.create') }}">@lang('dashboard_roles-create')</a>
                 </div>
             </div>
         </li>
         <li class="nav-item {{ set_active(['log-viewer*']) }}">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLogs"
                 aria-expanded="true" aria-controls="collapseLogs">
                 <i class="fa fa-fw fa-book"></i>

                 <span>@lang('dashboard_logs')</span>
             </a>
             <div id="collapseLogs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item"
                         href="{{ route('log-viewer::dashboard') }}">@lang('dashboard_logs-dashboard')</a>
                     <a class="collapse-item"
                         href="{{ route('log-viewer::logs.list') }}">@lang('dashboard_logs-logs')</a>
                 </div>
             </div>
         </li>
         @endhasanyrole



         <!-- Divider            <hr class="sidebar-divider d-none d-md-block">-->

         <hr class="sidebar-divider my-0">
         <li class="nav-item">
             <a class="nav-link">
                 <language-switcher locale="{{ app()->getLocale() }}"
                     link-en="{{ route('locale', ['locale' => 'en']) }}"
                     link-es="{{ route('locale', ['locale' => 'es']) }}" flag="{{ asset('img/flags/')}}">
                 </language-switcher>
             </a>
         </li>
         <hr class="sidebar-divider d-none d-md-block">


         <!-- Sidebar Toggler (Sidebar)  -->

         <div class="text-center d-none d-md-inline">
             <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>

     </ul>
     <!-- End of Sidebar -->
