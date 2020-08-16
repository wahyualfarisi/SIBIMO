<div class="row">
        <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row">
                            <div class="col s10 m6 l6">
                                <h5 class="breadcrumbs-title mt-0 mb-0">
                                    <span class="full_name"></span> 
                                </h5>
                            </div>
                    </div>
                </div>
        </div>

        <div class="row" id="loader_container" >
                <div class="col s12">
                    <div class="card">
                        <div class="card-content" style="height: 380px">
                            <div class="progress">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        <div class="col s12" id="main-container" style="display:none;">
            <div class="container">
                <div class="section" id="user-profile">
                <div class="row">
                    <div class="col s12 m3 l3 user-section-negative-margin">
                        <div class="row">
                        <div class="col s12 center-align" >
                            <div class="card-image z-depth-20 grey lighten-3" style="padding: 20px; position:relative;">
                                <div class="mahasiswa_photo" style="padding: 170px 170px 90px 90px;">
                                    
                                </div>
                            </div>
                            <br>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col s12">
                            <a class="grey-text text-darken-2"><span class="material-icons icon-bg-circle red darken-3 medium right mb-3">label</span><p class="full_name">Wahyu Alfarisi</p></a>
                        </div>
                        <div class="col s12">
                            <a class="grey-text text-darken-2"><span class="material-icons icon-bg-circle red darken-3 medium right mb-3">label</span><p id="email">wahyualfarisi30@gmail.com</p></a>
                        </div>
                        <div class="col s12">
                            <a class="grey-text text-darken-2"><span class="material-icons icon-bg-circle red darken-3 medium right mb-3">label</span><p id="phone">081317726873</p></a>
                        </div>
                        <div class="col s12">
                            <a class="grey-text text-darken-2"><span class="material-icons icon-bg-circle red darken-3 medium right mb-3">label</span><p id="nim">7201160111</p></a>
                        </div>
                        <div class="col s12">
                            <a class="grey-text text-darken-2"><span class="material-icons icon-bg-circle red darken-3 medium right mb-3">label</span><p id="jurusan">SISTEM INFORMASI (SI)</p></a>
                        </div>
                        <div class="col s12">
                            <a class="grey-text text-darken-2"><span class="material-icons icon-bg-circle red darken-3 medium right mb-3">label</span><p id="angkatan">2015</p></a>
                        </div>
                        @if (session('level') == 'tu')
                            <div class="col s12 mt-2">
                                <a href="javascript:void(0)" class="grey-text text-darken-2">
                                <button class="btn green darken-1 col s12 btn_edit_mahasiswa"> EDIT MAHASISWA </button>
                                </a>
                            </div>
                            <div class="col s12 mt-2 ">
                                <a class="grey-text text-darken-2">
                                    <button class="btn indigo darken-1 col s12 btn__reset__password"> RESET PASSWORD </button>
                                </a>
                            </div>
                        @endif
                        
                        
                        </div>
                        <hr class="mt-5">
                    </div>
                    
                    <div class="col s12 m9 l9" id="table_container">
                    
                        <div class="col s12">
                            <div class="card" style="background-image: url({{asset('images/ubk.jpg')}}); background-position: center;">
                                <div class="card-content">
                                    <h6 class="white-text">Judul Tugas Akhir</h6>
                                    <h5 class="white-text" id="judul_skripsi">SISTEM INFORMASI PREVENTIVE MAINTENANCE </h5>
                                    <p class="white-text" id="skripsi_status">Status: Active</p>
                                    <p class="white-text" id="skripsi_created">Dibuat pada tanggal: 2020-09-09 18:11:11</p>
                                </div>
                            </div>
                        </div>

                        <div id="pembimbing-content">


                        </div>
                     
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    @if (session('level') === 'tu')
                                        <button type="submit" class="btn right btn_add_judul indigo darken-1"> Tambah Judul </button>
                                    @endif
                                    <h6>Histori Judul Tugas Akhir</h6>
                                    <table id="table_data_judul">
                                        <thead>
                                            <tr>
                                                <th>Judul Skrispsi</th>
                                                <th>Status</th>
                                                <th>Di buat tanggal</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="t_history_judul"></tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    
                
                </div>
                </div><!-- START RIGHT SIDEBAR NAV -->
    
        
            </div>
        </div>

</div>

<form id="form_update_pembimbing">
    <div id="modalUpdatePembimbing" class="modal modal-fixed-footer" style="height: 250px;">
        <div class="modal-content">
            <h4 class="status_pembimbing">Update pembimbing</h4>
                <input type="hidden" name="id_pembimbing">
                <div>
                    <label>Pilih Dosen</label>
                    <select name="id_account" class="browser-default" required>
                        <option value=""> -- Pilih dosen -- </option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
            <button type="submit" class="btn red darken-3">UPDATE</button>
        </div>
    </div>
</form>

<form id="form_edit_mahasiswa">
    <div id="modalEditMahasiswa" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Edit Mahasiswa</h4>

            <div>
                <label>NIM</label>
                <input type="text" name="nim" id="nim">
            </div>

            <div>
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap">
            </div>

            <div>
                <label>Email</label>
                <input type="text" name="email" id="email">
            </div>

            <div>
                <label>No. Telp</label>
                <input type="text" name="no_telp" id="no_telp">
            </div>

            <div>
                <label>Tahun Angkatan</label>
                <input type="text" name="angkatan" id="angkatan">
            </div>

            <div>
                <label>Jurusan</label>
                <select name="id_jurusan" class="browser-default" id="id_jurusan" required>
                    <option value=""> -- Pilih Jurusan -- </option>
                </select>
            </div>
                
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
            <button type="submit" class="btn red darken-3">UPDATE</button>
        </div>
    </div>
</form>

<form id="form_reset_password">
    <div id="modalResetPassword" class="modal modal-fixed-footer" style="height: 250px;">
        <div class="modal-content">
            <h4>Reset Password</h4>
                <div>
                    <label>New Password</label>
                    <input type="text" name="new_password" id="new_password" required>
                </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
            <button type="submit" class="btn red darken-3">RESET</button>
        </div>
    </div>
</form>


<form id="form_add_judul">
    <div id="modalAddJudul" class="modal modal-fixed-footer" style="height: 250px;">
        <div class="modal-content">
            <h4>Tambah Judul Skripsi</h4>
                <input type="hidden" name="id_mahasiswa" value="{{$id_mahasiswa}}">
                <div>
                    <label>Judul</label>
                    <input type="text" name="judul" id="judul" minlength="8" required>
                </div>
                <div>
                    <label>Status</label>
                    <select name="status" id="status" class="browser-default" required>
                        <option value=""> -- Pilih status judul -- </option>
                        <option value="active">  aktif</option>
                        <option value="inactive">Tidak aktif</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
            <button type="submit" class="btn red darken-3">TAMBAH</button>
        </div>
    </div>
</form>

<form id="form_delete_judul">
    <div id="modalDeleteJudul" class="modal bottom-sheet">
        <div class="modal-content">
          <input type="hidden" name="id_judul" id="id_judul_delete">
          <h4 class="judul"></h4>
          <p class="red-text">and yakin ingin menghapus judul ini ?</p>
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
          <button type="submit" class="btn red darken-1">Delete</button>
        </div>
    </div>
</form>

<form id="form_manage_status">
        <div id="ModalManageStatus" class="modal bottom-sheet">
            <div class="modal-content">
              <input type="hidden" name="id_judul" id="id_judul_manage_status">
              <h4 class="judul"></h4>
              <div>
                    <label>Status</label>
                    <select name="status" id="status" class="browser-default" required>
                        <option value=""> -- Pilih status judul -- </option>
                        <option value="active">  aktif</option>
                        <option value="inactive">Tidak aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
              <button type="submit" class="btn red darken-3">UPDATE</button>
            </div>
        </div>
</form>

<script>
    $(function() {
        MahasiswaController.detail( {{ $id_mahasiswa }} );
    })
</script>