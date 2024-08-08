 <!-- Left Sidebar Start -->
 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <div class="logo-box">
               
                 <a class='logo logo-dark' href="{{route('home')}}">
                     <span class="logo-sm">
                         <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('assets/admins/images/logo-dark.png') }}" alt="" height="24">
                     </span>
                 </a>
             </div>

             <ul id="side-menu">

                 <li class="menu-title">Quản trị</li>

                 <li>
                     <a class='tp-link' href='#'>
                         <i data-feather="home"></i>
                         <span> Dashboard </span>
                     </a>
                 </li>

                 <li>
                     <a class='tp-link' href='calendar.html'>
                         <i data-feather="users"></i>
                         <span> Quản lí tài khoản </span>
                     </a>
                 </li>

                 <li class="menu-title">Kinh doanh</li>

                 <li>
                    <a class='tp-link' href='{{ route('admins.danhmucs.index') }}'>
                        <i data-feather="align-center"></i>
                        <span> Danh mục sản phẩm </span>
                    </a>
                </li>

                <li>
                    <a class='tp-link' href='{{ route('admins.sanphams.index') }}'>
                        <i data-feather="package"></i>
                        <span> Sản phẩm </span>
                    </a>
                </li>

             </ul>

         </div>
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
 </div>
 <!-- Left Sidebar End -->
