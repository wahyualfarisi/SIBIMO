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

    <div class="col s12 center-align">
        <h4>Progress Bimbingan Kamu </h4>
    </div>

    <div class="col s12 m6 l6">
           <div class="card border-radius-6">
                <div class="card-content">
                    <div class="display_image_pembimbing_1 left mr-5"></div>
                    <h4 class="nama_pembimbing_1"></h4>
                    <h5>Pembimbing 1</h5>
                    
                </div>
                <div class="card-action center-align">
                        <a href="javascript:void(0)">Mulai Bimbingan</a> 
                </div>
               <div class="card-content" style="height: 550px; overflow: auto;">
                   
                   <table>
                       <thead>
                           <tr>
                               <th>Tanggal Bimbingan</th>
                               <th>BAB</th>
                               <th>Revisi</th>
                               <th>ACC</th>
                               <th>Paraf</th>
                           </tr>
                       </thead>
                       <tbody id="t_pembimbing_1">
                           {{-- <tr>
                               <th>2020-09-01</th>
                               <th>BAB 1</th>
                               <th>  </th>
                               <th> <i class="material-icons green-text">done</i> </th>
                               <th></th>
                           </tr> --}}
                       </tbody>
                   </table>
                </div>
                
           </div>
    </div>


    <div class="col s12 m6 l6">
        <div class="card border-radius-6">
                <div class="card-content">
                    <div class="display_image_pembimbing_2 left mr-5"></div>
                    <h4 class="nama_pembimbing_2"></h4>
                    <h5>Pembimbing 2</h5>
                </div>
                <div class="card-action center-align">
                        <a href="javascript:void(0)"></a> 
                </div>
                <div class="card-content" style="height: 550px; overflow: auto;">
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal Bimbingan</th>
                                <th>BAB</th>
                                <th>Revisi</th>
                                <th>ACC</th>
                                <th>Paraf</th>
                            </tr>
                        </thead>
                        <tbody id="t_pembimbing_2">
                                {{-- <tr>
                                    <th>2020-09-01</th>
                                    <th>BAB 1</th>
                                    <th>  </th>
                                    <th> <i class="material-icons green-text">done</i> </th>
                                    <th></th>
                                </tr> --}}
                        </tbody>
                    </table>
                    
                </div>
                
            </div>
    </div>

</div>

<script>
    $(function() {
      DashboardController.init();
    });
</script>