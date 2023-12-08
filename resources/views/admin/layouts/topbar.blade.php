 <!--Header START-->
 <div class="app-header header-shadow">
     <div class="app-header__logo">
         <div class="logo-src"></div>
         <div class="header__pane ml-auto">
             <div>
                 <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                     <span class="hamburger-box">
                         <span class="hamburger-inner"></span>
                     </span>
                 </button>
             </div>
         </div>
     </div>
     <div class="app-header__mobile-menu">
         <div>
             <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                 <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                 </span>
             </button>
         </div>
     </div>
     <div class="app-header__menu">
         <span>
             <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                 <span class="btn-icon-wrapper">
                     <i class="fa fa-ellipsis-v fa-w-6"></i>
                 </span>
             </button>
         </span>
     </div>
     <div class="app-header__content">
         <div class="app-header-left">
             <div class="search-wrapper">
                 <div class="input-holder">
                     <input type="text" class="search-input" placeholder="Type to search">
                     <button class="search-icon"><span></span></button>
                 </div>
                 <button class="close"></button>
             </div>
         </div>
         <div class="app-header-right">
             <div class="header-dots">
                 <div class="dropdown">
                     <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                         class="p-0 mr-2 btn btn-link">
                         <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                             <span class="icon-wrapper-bg bg-danger"></span>
                             <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                             <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                         </span>
                     </button>
                     <div tabindex="-1" role="menu" aria-hidden="true"
                         class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                         <div class="dropdown-menu-header mb-0">
                             <div class="dropdown-menu-header-inner bg-deep-blue">
                                 <div class="menu-header-image opacity-1"
                                     style="background-image: url('<?php echo url('/'); ?>/assets/images/dropdown-header/city3.jpg');">
                                 </div>
                                 <div class="menu-header-content text-dark">
                                     <h5 class="menu-header-title">Notifications</h5>
                                     <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                                 </div>
                             </div>
                         </div>
                         <div class="scroll-area-sm">
                             <div class="scrollbar-container">
                                 <div class="p-3">
                                 </div>
                             </div>
                         </div>
                         <ul class="nav flex-column">
                             <li class="nav-item-divider nav-item"></li>
                             <li class="nav-item-btn text-center nav-item">
                                 <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">All
                                     Notification</button>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>

             <div class="header-btn-lg pr-0">
                 <div class="widget-content p-0">
                     <div class="widget-content-wrapper">
                         <div class="widget-content-left">
                             <div class="btn-group">
                                 <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                     <img width="42" class="rounded-circle"
                                         src="<?php echo url('/'); ?>/assets/images/default-150x150.png" alt="">
                                     <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                 </a>
                                 <div tabindex="-1" role="menu" aria-hidden="true"
                                     class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                     <div class="dropdown-menu-header">
                                         <div class="dropdown-menu-header-inner bg-info">
                                             <div class="menu-header-image opacity-2"
                                                 style="background-image: url('<?php echo url('/'); ?>/assets/images/dropdown-header/city3.jpg');">
                                             </div>
                                             <div class="menu-header-content text-left">
                                                 <div class="widget-content p-0">
                                                     <div class="widget-content-wrapper">
                                                         <div class="widget-content-left mr-3">
                                                             <img width="42" class="rounded-circle"
                                                                 src="<?php echo url('/'); ?>/assets/images/default-150x150.png"
                                                                 alt="">
                                                         </div>
                                                         <div class="widget-content-left">
                                                             <div class="widget-heading">Alina Mcloughlin
                                                             </div>
                                                             <div class="widget-subheading opacity-8">A short profile
                                                                 description
                                                             </div>
                                                         </div>
                                                         <div class="widget-content-right mr-2">
                                                             <a class="btn-pill btn-shadow btn-shine btn btn-focus"
                                                                 href="{{ route('logout') }}">Logout </a>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div> <!--Header END-->
