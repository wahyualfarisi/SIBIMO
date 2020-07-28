
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="ThemeSelect">
    <meta name="theme-color" content="#3949ab">
	<meta name="msapplication-navbutton-color" content="#3949ab">
	<meta name="apple-mobile-web-app-status-bar-style" content="#3949ab">

    <title>Mahasiswa | SIBIMO</title>
    <link rel="apple-touch-icon" href="{{ asset('images/logo2.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo2.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-dark-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-dark-menu-template/style.css')}}">
   
    <!-- FULL CALENDAR -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/app-calendar.css')}}">
    <link href="{{asset('assets/vendors/fullcalendar/core/main.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/fullcalendar/daygrid/main.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/loaders/loaders.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/loaders/loaders-palette.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/intro.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/dropify/css/dropify.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/select2/dist/css/select2-materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/placeholder.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/app-sidebar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/app-email.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pagination.css')}}">
    
    <script>
        var TOKEN = "{{ session('credentials') }}";
        var BASE_URL = "{{ URL::to('/') }}"
        var LEVEL = "{{ session('level') }}"
    </script>

  </head>
  <body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed"> 
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    <div class="header-search-wrapper hide-on-med-and-down">
                        <h5 style="font-weight: 700" class="menu_name"><span class="current-time">00:00:00</span></h5>
                    </div>
                    <ul class="navbar-list right">
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons grey-text">settings_overscan</i></a></li>
                        <!-- <li>
                                <a class="waves-effect waves-block waves-light show_notif" href="#/notifications"><i class="material-icons">notifications_none</i></a>
                        </li> -->
                        <!-- <li><a class="waves-effect waves-block waves-light notification-button total__notification" id="notification_total" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons grey-text">notifications_none</i></a></li> -->
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><i class="material-icons grey-text">person</i></a></li>
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light sidenav-trigger total__notif" href="javascript:void(0)" data-target="slide-out-right"><i class="material-icons grey-text">assignment </i></a></li>
                    </ul>

                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li class="divider"></li>
                        <li><a class="grey-text text-darken-1" href="#/me"><i class="material-icons green-text">verified_user</i> My Profile </a></li>
                        <li><a class="grey-text text-darken-1" href="#/setting"><i class="material-icons blue-text">settings</i> Setting </a></li>
                        <li><a class="grey-text text-darken-1" href="/authorization_clear" id="logout"><i class="material-icons red-text">keyboard_tab</i> Logout</a></li>
                    </ul>

                    <ul class="dropdown-content" id="notifications-dropdown">
                        <li>
                            <h6>NOTIFICATIONS</h6>
                        </li>
                        <li class="divider"></li>
                        <div class="show-notification">
                           
                        </div>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- END: Header-->



    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded" style="background: #732619 !important;">
        <div class="brand-sidebar" style="background: #562525 !important;">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="#/dashboard" style="text-align: center;">
                <img src="{{ asset('images/logo2.png') }}" alt=""/>
                <span class="logo-text hide-on-med-and-down">Mahasiswa</span>
            </a>
            <a class="navbar-toggler" href="javascript:void(0)">
                <i class="material-icons">radio_button_checked</i>
            </a>
        </h1>
        </div>
       
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            
            <li class="bold">
                <a class="waves-effect waves-cyan " href="#/dashboard"><i class="material-icons white-text">track_changes</i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>
            <li class="bold">
                <a class="waves-effect waves-cyan " href="#/notifikasi"><i class="material-icons white-text">track_changes</i><span class="menu-title" data-i18n="">Notifikasi</span></a>
            </li>

            <li class="navigation-header">
                <a class="navigation-header-text">PEMBIMBING</a><i class="navigation-header-icon material-icons">more_horiz</i>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan " href="#/pembimbing/1"><i class="material-icons white-text">track_changes</i><span class="menu-title" data-i18n="">Fauziah S.KOM, M.KOM</span></a>
                <a class="waves-effect waves-cyan " href="#/pembimbing/2"><i class="material-icons white-text">track_changes</i><span class="menu-title" data-i18n="">ALEX S.KOM, M.KOM</span></a>
            </li>
           
            
            <li class="navigation-header">
                <a class="navigation-header-text">BIMBINGAN</a><i class="navigation-header-icon material-icons">more_horiz</i>
            </li>

            <li class="bold">
                <a class="waves-effect waves-cyan " href="#/fakultas"><i class="material-icons white-text">bookmark</i><span class="menu-title" data-i18n="">Aktifitas</span></a>
            </li>

            <li class="bold">
                    <a class="waves-effect waves-cyan " href="#/jurusan"><i class="material-icons white-text">bookmark</i><span class="menu-title" data-i18n="">History Bimbingan</span></a>
            </li>




         
           
            
        </ul>
        <div class="navigation-background"></div>
        <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium indigo darken-1 waves-effect waves-light hide-on-large-only" href="javascript:void(0)" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main"></div>
    <!-- END: Page Main-->

    <aside id="right-sidebar-nav">
        <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
            <div class="row">
                <div class="slide-out-right-title">
                    <div class="col s12 border-bottom-1 pb-0 pt-1">
                        <div class="row">
                            <div class="col s2 pr-0 center">
                                <i class="material-icons vertical-text-middle"><a href="javascript:void(0)" class="sidenav-close">clear</a></i>
                            </div>
                            <div class="col s10 pl-0">
                                <ul class="tabs">
                                    <li class="tab col s12 p-0">
                                    <a href="#messages">
                                        <span>Online</span>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-out-right-body">
                    <div id="messages" class="col s12">
                        <div class="collection border-none">
                            <ul class="collection p-0 users-online">
                                <!-- <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0">
                                    <span class="">
                                    <i class="material-icons" style="font-size: 50px;" >person</i>
                                    <i></i>
                                    </span>
                                    <div class="user-content">
                                    <h6 class="line-height-0">Elizabeth Elliott</h6>
                                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">STORE</p>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
 
                    <div id="logs" class="col s12">
                   
                    </div>
                </div>
            </div>
        </div>

    </aside>


    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
            <div class="footer-copyright">
                <div class="container"><span>&copy; 2019 <a href="#" style="color:#00000;" target="_blank">SIBIMO</a> All rights reserved.</span><span class="right hide-on-small-only"></span></div>
            </div>
    </footer>


    <!-- END: Footer-->
    <script src="{{asset('assets/js/vendors.min.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('assets/vendors/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/custom/custom-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/vendors/block-ui/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/vendors/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/vendors/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/fullcalendar/core/main.js')}}"></script>
    <script src="{{asset('assets/vendors/fullcalendar/interaction/main.js')}}"></script>
    <script src="{{asset('assets/vendors/fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{asset('assets/js/custom/popper.min.js')}}" ></script>
    <script src="{{asset('assets/js/JIC.min.js')}}"></script>
    <script src="{{asset('assets/js/printArea.js')}}"></script>
    <script src="{{asset('assets/js/pagination.js')}}" ></script>
    <script src="{{asset('assets/js/moment.js')}}" ></script>
    <script src="{{asset('src/app-library.js')}}"></script>
    <script src="{{asset('src/app-ui.js')}}"></script>
    <script src="{{asset('src/app-controller.js')}}"></script>
    <script>
        $(function() {
            MainController.init();
        })
    </script>

  </body>
</html>