 <div class="container-fluid">
     <div class="row bg-secondary py-1 px-xl-5">
         <div class="col-lg-6 d-none d-lg-block">
             <div class="d-inline-flex align-items-center h-100">

             </div>
         </div>
         <div class="col-lg-6 text-center text-lg-right">
             <div class="d-inline-flex align-items-center">
                 <div class="btn-group">
                     <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My
                         Account</button>
                     <div class="dropdown-menu dropdown-menu-right">
                         @auth
                             <a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="fas fa-user"></i>
                                 Profile</a>
                             <a class="dropdown-item" href="{{ route('customer.logout') }}"><i
                                     class="fas fa-sign-out-alt"></i> Logout</a>
                         @endauth
                         @guest
                             <a class="dropdown-item" href="{{ route('customer.login') }}">Sign In</a>
                             <a class="dropdown-item" href="{{ route('customer.create') }}">Sign Up</a>
                         @endguest

                     </div>
                 </div>


             </div>

         </div>
     </div>
     <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
         <div class="col-lg-4">
             <a href="{{ '/' }}" class="text-decoration-none">
                 <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                 <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
             </a>
         </div>
         <div class="col-lg-4 col-6 text-left">

         </div>
         <div class="col-lg-4 col-6 text-right">
             <p class="m-0">Customer Service</p>
             <h5 class="m-0">+91 7232026292</h5>
         </div>
     </div>
 </div>
