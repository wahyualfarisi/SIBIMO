<div class="row">
    <div class="row" id="loader_container">
        <div class="col s12">
            <div class="card" style="border-radius: 10px;">
                <div class="card-content center-align" style="height: 380px;">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col s12" id="card-total-data" style="display:none;">
        <div class="card" style="border-radius: 10px; background-image: url({{asset('images/ubk.jpg')}}); background-position: center; ">
          <div class="card-content">
            <div class="col s12">
                <div class="col s2" id="avatar_user">
                    <img src="{{ asset('images/default_user.png') }}" width="100%;" alt="" class="circle">   
                </div>
                    <div class="col s6">
                        <h4 id="info_user" class="white-text">Hallo, Tono  <i class="material-icons green-text">verified_user</i></h4>
                        <h5 class="light white-text" id="user_position">TU</h5>
                        <h5 class="light" id="user_service"></h5>
                        <a href="#/me" class="btn-flat mb-1 waves-effect white-text">
                            <i class="material-icons right">arrow_forward</i> View Profile
                    </a>
                    </div> 
            </div>
            <h4 class="card-title" id="info_user"></h4>
              <div id="card-stats" class="row">

              
            
            </div>
          </div>
        </div>
    </div>

    <div class="col s12">
            <div class="col s12 m4">
                <div class="card card-hover z-depth-1 card-border-gray">
                    <a href="#/bab">
                    <div class="card-content center-align">
                        <h2><b>BAB 1</b></h2>
                        <i class="material-icons red-text">bookmark</i>
                        <p class="mb-2 black-text">2 total Bimbingan<br></p>
                        <p class="mb-2 black-text"><br></p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card card-hover z-depth-1 card-border-gray">
                    <a href="#/bab">
                    <div class="card-content center-align">
                        <h2><b>BAB 2</b></h2>
                        <i class="material-icons red-text">bookmark</i>
                        <p class="mb-2 black-text">12 total Bimbingan<br></p>
                        <p class="mb-2 black-text">89% Plagiatisme<br></p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card card-hover z-depth-1 card-border-gray">
                    <a href="#/bab">
                    <div class="card-content center-align">
                        <h2><b>BAB 3</b></h2>
                        <i class="material-icons red-text">bookmark</i>
                        <p class="mb-2 black-text">12 total Bimbingan<br></p>
                        <p class="mb-2 black-text">69% Plagiatisme<br></p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col s12 m6">
                <div class="card card-hover z-depth-1 card-border-gray">
                    <a href="#/bab">
                    <div class="card-content center-align">
                        <h2><b>BAB 4</b></h2>
                        <i class="material-icons red-text">bookmark</i>
                        <p class="mb-2 black-text">12 total Bimbingan<br></p>
                        <p class="mb-2 black-text">69% Plagiatisme<br></p>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col s12 m6">
                <div class="card card-hover z-depth-1 card-border-gray">
                    <a href="#/bab">
                    <div class="card-content center-align">
                        <h2><b>BAB 5</b></h2>
                        <i class="material-icons red-text">bookmark</i>
                        <p class="mb-2 black-text">12 total Bimbingan<br></p>
                        <p class="mb-2 black-text">69% Plagiatisme<br></p>
                    </div>
                    </a>
                </div>
            </div>
    </div>

</div>

<script>
    $(function() {
      DashboardController.init();
    });
</script>