<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="ThemeSelect">
    <title> UBK - SIBIMO </title>
    <link rel="apple-touch-icon" href="{{asset('images/logo2.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo2.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-dark-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themes/vertical-dark-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/login.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->
  <body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 1-column login-bg  blank-page blank-page" data-open="click" data-menu="vertical-dark-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container"><div id="login-page" class="row">
                <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form class="login-form">
                            <div class="row">
                                <div class="input-field col s12">
                                <img src="{{asset('images/logoubk.png')}}" />
                                {{-- <h5 class="ml-4 light">SIBIMO</h5> --}}
                                {{ session('login') }}
                                </div>
                            </div>
                            
                            <div class="row margin">
                                    <div class="col s12">
                                    <p>
                                        <label>
                                        <input name="level" value="KAPRODI" type="radio" required/>
                                        <span>Kaprodi</span>
                                        </label>
                                    </p>
                                    <p>
                                    <label>
                                        <input name="level" value="DOSEN" type="radio" required/>
                                        <span>Dosen</span>
                                    </label>
                                    </p>
                                    <p>
                                    <label>
                                        <input name="level" value="MAHASISWA" type="radio" required/>
                                        <span>Mahasiswa</span>
                                    </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input name="level" value="TU" type="radio" required/>
                                            <span>TU</span>
                                        </label>
                                        </p>
                                </div>
                            </div>

                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="id" type="text" name="id" required>
                                    <label for="id" class="center-align">ID</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" type="password" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                <p>
                                    <label>
                                    <input type="checkbox" id="show_password" />
                                    <span>Tampilkan Password</span>
                                    </label>
                                </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="submit" class="btn waves-effect waves-light border-round red darken-3 right">SUBMIT</button>
                                </div>
                            </div>
                            <div class="row center-align">
                                
                            </div>
                        </form>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('assets/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/custom/custom-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/block-ui/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/vendors/select2/dist/js/select2.full.min.js')}} " type="text/javascript"></script>
    <script src="{{asset('src/app-library.js')}}"></script>
    <!-- END THEME  JS-->
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('[name=level]').select2();

            $('.login-form').on('submit', function(e) {
                e.preventDefault();
                //process
                ajaxSetting.postFree(
                    `/authorization_process`,
                    this,
                    null ,
                    res => {
                        console.log(res);
                        location.href = '/main';
                    },
                    err => {
                        console.log(err);
                    },
                    null
                );


            })

            $('#show_password').on('click', function() {
                if($(this).is(':checked') ){
                    $('#password').attr('type','text');
                }else{
                    $('#password').attr('type','password');
                }
            });

        });
    </script>
 
</body>
</html>