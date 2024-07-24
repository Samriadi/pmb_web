 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/">

         <div class="sidebar-brand-text mx-4 sidebar-title">ALMARISAH MADANI</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="/admin/">
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
                 <?php if (is_superadmin()) : ?>
                     <a class="collapse-item" href="/admin/user">User</a>
                 <?php endif; ?>
                 <a class="collapse-item" href="/admin/var">Var Option</a>
                 <a class="collapse-item" href="/admin/test">Edu Test</a>
                 <a class="collapse-item" href="/admin/periode">Edu Periode</a>
             </div>
         </div>
     </li>


     <!-- Nav Item - Settings Collapse Menu -->
     <li class="nav-item" id="navProfile">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
             <i class="fas fa-fw fa-cog"></i>
             <span>Settings</span>
         </a>
         <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/admin/install">Install</a>
                 <a class="collapse-item" href="/admin/data">Data</a>
                 <a class="collapse-item" href="/admin/optional">Optional</a>
                 <a class="collapse-item" href="/admin/logs">Logs</a>
             </div>
         </div>
     </li>



     <li class="nav-item" id="navAuth">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuth" aria-expanded="true" aria-controls="collapseAuth">
             <i class="fas fa-fw fa-folder"></i>
             <span>Admin</span>
         </a>
         <div id="collapseAuth" class="collapse" aria-labelledby="headingAuth" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/admin/fakultas">Data Fakultas</a>
                 <a class="collapse-item" href="/admin/prodi">Data Prodi</a>
                 <a class="collapse-item" href="/admin/ujian">Data Kelulusan</a>
                 <a class="collapse-item" href="/admin/pendaftar">Data Pendaftar</a>
                 <a class="collapse-item" href="/admin/verified">Data Verified</a>
                 <a class="collapse-item" href="/admin/tagihan">Data Tagihan</a>
                 <a class="collapse-item" href="/admin/csv">Data Download</a>
                 <a class="collapse-item" href="/admin/promo">Data Promo</a>
                 <a class="collapse-item" href="/admin/pendaftar-verified">Data Terverifikasi</a>
                 <a class="collapse-item" href="/admin/test-pendaftar">Data Jadwal Tes</a>
                 <a class="collapse-item" href="/admin/pembayaran">Data Pembayaran</a>
                 <a class="collapse-item" href="/admin/nim">Data NIM</a>
                 <?php
                    function isMobileDevice()
                    {
                        return preg_match("/(android|blackberry|iphone|ipod|iemobile|opera mini)/i", $_SERVER['HTTP_USER_AGENT']);
                    }
                    if (isMobileDevice()) {
                    ?>
                     <!-- <a class="collapse-item" href="/admin/testcard?page=mobile">Kartu Ujian</a> -->
                 <?php } else { ?>
                     <!-- <a class="collapse-item" href="/admin/testcard?page=web">Kartu Ujian</a> -->
                 <?php } ?>

             </div>
         </div>
     </li>

     <li class="nav-item" id="navHelp">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHelp" aria-expanded="true" aria-controls="collapseHelp">
             <i class="fas fa-fw fa-folder"></i>
             <span>Help</span>
         </a>
         <div id="collapseHelp" class="collapse" aria-labelledby="headingHelp" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/admin/panduan?page=fakultas">Panduan Fakultas</a>
                 <a class="collapse-item" href="/admin/panduan?page=prodi">Panduan Prodi</a>
                 <a class="collapse-item" href="/admin/panduan?page=ujian">Panduan Ujian</a>
             </div>
         </div>
     </li>

     <li class="nav-item" id="navPmb">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePmb" aria-expanded="true" aria-controls="collapsePmb">
             <i class="fas fa-fw fa-folder"></i>
             <span>PMB</span>
         </a>
         <div id="collapsePmb" class="collapse" aria-labelledby="headingPmb" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="/admin/kelulusan">Konfirmasi Kelulusan</a>
             </div>
         </div>
     </li>

     <li class="nav-item" id="navProfile">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLogout" aria-expanded="true" aria-controls="collapseLogout">
             <i class="fas fa-fw fa-cog"></i>
             <span>Auth</span>
         </a>
         <div id="collapseLogout" class="collapse" aria-labelledby="headingLogout" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" name="logoutButton" id="logoutButton">Logout</a>
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
         var currentPath = window.location.href;
         var navLinks = document.querySelectorAll('.collapse-item');

         navLinks.forEach(function(link) {
             if (link.href === currentPath) {
                 link.classList.add('active');
                 link.closest('.collapse').classList.add('show');
                 link.closest('.nav-item').querySelector('.nav-link').classList.remove('collapsed');
                 link.closest('.nav-item').querySelector('.nav-link').setAttribute('aria-expanded', 'true');
             }
         });
     });
 </script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     $(document).ready(function() {
         $('#logoutButton').on('click', function() {
             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, logout!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: '/admin/logout',
                         type: 'POST',
                         success: function(response) {
                             if (response.status === 'success') {
                                 Swal.fire({
                                     title: 'Success!',
                                     text: 'You have been logged out.',
                                     icon: 'success',
                                     timer: 1000,
                                     showConfirmButton: false
                                 }).then((result) => {
                                     window.location.href = '/admin';
                                 });
                             } else {
                                 Swal.fire(
                                     'Error!',
                                     'There was a problem logging you out.',
                                     'error'
                                 );
                             }
                         },
                         error: function() {
                             Swal.fire(
                                 'Error!',
                                 'There was a problem logging you out.',
                                 'error'
                             );
                         }
                     });
                 }
             });
         });
     });
 </script>