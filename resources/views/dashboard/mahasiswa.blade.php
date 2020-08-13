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
                        <h5 class="white-text kartu_bimbingan_btn"> </h5> 
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
               
               <div class="card-content" style="height: 550px; overflow: auto;">
                   
                   <table>
                       <thead>
                           <tr>
                               <th>Tanggal Bimbingan</th>
                               <th>Permasalahan</th>
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
                <div class="card-content" style="height: 550px; overflow: auto;">
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal Bimbingan</th>
                                <th>Permasalahan</th>
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

<form id="form_start_bimbingan">
    <div id="modalStartBimbingan" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center-align">Mulai Bimbingan <span class="bab"></span></h4>
            
            <div>
                <label> Pembimbing </label>
                <input type="hidden" name="id_pembimbing">
                <input type="text" name="nama_pembimbing" readonly>
            </div>

            <div style="margin-top: 30px;">
                <label> Pilih Bab </label>
                <input type="text" name="bab" class="bab"  readonly>
            </div>

            <div style="margin-top: 30px;">
                <label>Upload File Bimbingan</label><br>
                <input type="file" name="file" class="input-field" required/>
            </div>

            <div style="margin-top: 30px;">
                <label>Deskripsi (optional)</label>
                <input type="text" name="deskripsi_bimbingan">
            </div>


        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
            <button class="btn btn-flat" type="submit">Mulai</button>
        </div>
    </div>
</form>

<script>
    $(function() {
      DashboardController.init();
    });
</script>