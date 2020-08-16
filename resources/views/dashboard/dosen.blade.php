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
               <div class="col s2" id="image_user">
                    <img src="{{asset('images/default_user.png')}} " width="100%;" alt="" class="circle">   
                </div>
                    <div class="col s6">
                        <h4 id="info_user" class="white-text"></h4>
                        <h5 class="light white-text" id="user_position"></h5>
                        <h5 class="light white-text" id="user_service"></h5>
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

      <div class="col s12 m6 l6">
        <div class="card border-radius-6">
            <div class="card-content" style="height: 350px; overflow: auto;">
                <h5>Recent History Bimbingan </h5>

                <table>
                    <thead>
                        <tr>
                            <th>Tanggal </th>
                            <th>Mahasiswa </th>
                            <th>Permasalahan </th>
                            <th>Status</th>
                            <th>Revisi</th>
                            <th>ACC</th>
                        </tr>
                    </thead>
                    <tbody class="recent_bimbingan"> </tbody>
                </table>
            </div>
        </div>
      </div>

    <div class="col s12 m3 l3">
            <div class="card border-radius-6 gradient-45deg-deep-orange-orange">
          
                <div class="card-content center-align">
                    <h6><b class="white-text">Mahasiswa Bimbingan</b></h6>
                    <h5 class="white-text total_mhs_bimbingan"></h5>
                </div>
                
            </div>
    </div>

     <div class="col s12 m3 l3">
            <div class="card border-radius-6 gradient-45deg-blue-indigo">
                
                <div class="card-content center-align">
                    <h6><b class="white-text">Mahasiswa Siap Sidang</b></h6>
                    <h5 class="white-text total_siap_sidang"> </h5>
                </div>
                
            </div>
    </div>
     


</div>

<script>
    $(function() {
      DashboardController.init();
    });
</script>