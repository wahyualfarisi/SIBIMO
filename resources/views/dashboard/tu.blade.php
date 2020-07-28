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
        <div class="card" style="border-radius: 10px;  background-image: url({{asset('images/ubk.jpg')}}); background-position: center; ">
          <div class="card-content">
             <div class="col s12" style="margin-bottom: 30px;">
                <div class="col s2" id="image_user">
                     
                </div>
                <div class="col s12 m6 l6">
                    <h4 id="info_user" class="white-text"></h4>
                    <h5 class="light white-text" id="user_position">TU</h5>
                    <h5 class="light" id="user_service"></h5>
                    <a href="#/me" class="btn-flat mb-1 waves-effect white-text">
                        <i class="material-icons right">arrow_forward</i>  View Profile
                   </a>
                </div> 
              </div>
              
              <div class="mb-4" ></div>
          </div>
        </div>

        <div class="card"  style="border-radius: 10px;">
          <div class="card-content">
              <h4 class="card-title" id="info_user"></h4>
              <div id="card-stats" class="row">

                <div class="col s12 m6 xl3">
                    <div class="card" style="border-radius: 10px;">
                      <div class="card-content  black-text">
                          <p class="card-stats-title"><i class="material-icons">trending_up</i> Jurusan</p>
                          <h4 class="card-stats-number black-text total_jurusan">0</h4>
                          <p class="card-stats-compare">
                            
                            <span class="orange-text text-lighten-5"></span>
                          </p>
                      </div>
                      <div class="card-action red darken-3">
                          <div id="clients-bar" class="center-align">
                            <span class="white-text date_today">Jurusan</span>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col s12 m6 xl3">
                    <div class="card" style="border-radius: 10px;">
                      <div class="card-content  black-text">
                          <p class="card-stats-title"><i class="material-icons">person_outline</i> Mahasiswa</p>
                          <h4 class="card-stats-number black-text total_mahasiswa">0</h4>
                          <p class="card-stats-compare">
                            
                            <span class="teal text text-lighten-5 date_from"></span>
                          </p>
                      </div>
                      <div class="card-action teal">
                          <div id="clients-bar" class="center-align">
                            <span class="white-text">Mahasiswa</span>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="col s12 m6 xl3">
                        <div class="card" style="border-radius: 10px;">
                          <div class="card-content black-text">
                              <p class="card-stats-title"><i class="material-icons">person_outline</i>Dosen</p>
                              <h4 class="card-stats-number black-text total_dosen">0</h4>
                              <p class="card-stats-compare">
                                
                                <span class="red-text text-lighten-5 date_from"></span>
                              </p>
                          </div>
                        <div class="card-action blue">
                        <div id="clients-bar" class="center-align">
                                <span class="white-text">Dosen </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col s12 m6 xl3">
                    <div class="card" style="border-radius: 10px;">
                      <div class="card-content black-text">
                          <p class="card-stats-title"><i class="material-icons">notifications_none</i>Notifikasi</p>
                          <h4 class="card-stats-number black-text total_notifikasi">0</h4>
                          <p class="card-stats-compare">
                            
                            <span class="red-text date_from"></span>
                          </p>
                      </div>
                      <div class="card-action green">
                        <div id="clients-bar" class="center-align">
                              <span class="white-text">Notifikasi </span>
                            </div>
                        </div>
                    </div>
                </div>

               

              
            
              </div>
          </div>
        </div>

      </div>

</div>

<script>
    $(function() {
      DashboardController.init();
    });
</script>