 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">HEWI UNIVERSITY</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="/pmb_web/">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>


     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item" id="navPages">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Pages</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/pmb_web/user">User</a>
                 <a class="collapse-item" href="/pmb_web/var">Var Option</a>
                 <a class="collapse-item" href="/pmb_web/test">Edu Test</a>
                 <a class="collapse-item" href="/pmb_web/periode">Edu Periode</a>
             </div>
         </div>
     </li>


     <!-- Nav Item - Settings Collapse Menu -->
     <li class="nav-item" id="navSettings">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
             <i class="fas fa-fw fa-cog"></i>
             <span>Settings</span>
         </a>
         <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/pmb_web/install-add">Install</a>
                 <a class="collapse-item" href="/pmb_web/install">Data</a>
                 <a class="collapse-item" href="/pmb_web/optional">Optional</a>
                 <a class="collapse-item" href="/pmb_web/logs">Logs</a>
             </div>
         </div>
     </li>



     <!-- Nav Item - Login/Logout Collapse Menu -->
     <li class="nav-item" id="navAuth">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuth" aria-expanded="true" aria-controls="collapseAuth">
             <i class="fas fa-fw fa-folder"></i>
             <span>Admin</span>
         </a>
         <div id="collapseAuth" class="collapse" aria-labelledby="headingAuth" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/pmb_web/fakultas">Fakultas</a>
                 <a class="collapse-item" href="/pmb_web/prodi">Prodi</a>
                 <a class="collapse-item" href="/pmb_web/ujian">Ujian</a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Login/Logout Collapse Menu -->
     <li class="nav-item" id="navTest">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTest" aria-expanded="true" aria-controls="collapseTest">
             <i class="fas fa-fw fa-folder"></i>
             <span>Item</span>
         </a>
         <div id="collapseTest" class="collapse" aria-labelledby="headingAuth" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/pmb_web/testCard">Kartu Ujian</a>
             </div>
         </div>
     </li>




     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>


 </ul>
 <!-- End of Sidebar -->

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         var currentPath = window.location.pathname;
         var navLinks = document.querySelectorAll('.collapse-item');

         navLinks.forEach(function(link) {
             if (link.getAttribute('href') === currentPath) {
                 link.classList.add('active');
                 link.closest('.collapse').classList.add('show');
                 link.closest('.nav-item').querySelector('.nav-link').classList.remove('collapsed');
                 link.closest('.nav-item').querySelector('.nav-link').setAttribute('aria-expanded', 'true');
             }
         });
     });
 </script>