 <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse text-white min-vh-100 p-3">
     <div class="position-sticky pt-3">
         <h4 class="text-center mb-4"><i class="bi bi-wallet2"></i> KasApp</h4>
         <ul class="nav flex-column nav-pills">
             <li class="nav-item mb-2">
                 <a href="{{ route('dashboard.index') }}"
                     class="nav-link {{ request()->routeIs('dashboard.index') ? 'active text-white' : 'text-white-50' }}"
                     @if (request()->routeIs('dashboard.index')) aria-current="page" @endif>
                     <i class="bi bi-speedometer2 me-2"></i> Dashboard
                 </a>
             </li>

             <li class="nav-item mb-2">
                 <a href="{{ route('akun.index') }}"
                     class="nav-link {{ request()->routeIs('akun.*') ? 'active text-white' : 'text-white-50' }}"
                     @if (request()->routeIs('akun.*')) aria-current="page" @endif>
                     <i class="bi bi-safe me-2"></i> Akun
                 </a>
             </li>

             <li class="nav-item mb-2">
                 <a href="{{ route('kasmasuk.index') }}" class="nav-link {{ request()->routeIs('kasmasuk.*') ? 'active text-white' : 'text-white-50' }}">
                     <i class="bi bi-arrow-down-circle me-2 text-success"></i> Kas Masuk
                 </a>
             </li>
             <li class="nav-item mb-2">
                 <a href="#" class="nav-link text-white-50">
                     <i class="bi bi-arrow-up-circle me-2 text-danger"></i> Kas Keluar
                 </a>
             </li>
             <li class="nav-item mb-2">
                 <a href="#" class="nav-link text-white-50">
                     <i class="bi bi-journals me-2"></i> Buku Besar
                 </a>
             </li>
             <hr>
             <li class="nav-item mb-2">
                 <a href="#" class="nav-link text-white-50">
                     <i class="bi bi-box-arrow-left me-2 text-danger"></i> Logout
                 </a>
             </li>
         </ul>
     </div>
 </nav>
