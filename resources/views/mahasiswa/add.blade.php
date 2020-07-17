<div class="row">
        <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">
                            Tambah Mahasiswa
                        </h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Tambah Mahasiswa
                            </li>
                        </ol>
                        </div>
                </div>
            </div>
        </div>
    
        <div class="col s12">
            <div class="container">
                <div class="section">
    
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
    
                    <div class="row" id="main_container" style="display: none;">
                        <form class="col s12" id="form_add_mahasiswa">
                            
                            <div class="card">
                                <div class="card-content">
    
                                    <div class="row">
                                        <div class="col s12  red darken-3">
                                                <div class="mt-2"></div>
                                                <h6 class="white-text">Informasi Mahasiswa </h6>
                                                <hr class="light">
                                        </div>
                                        <div class="col s12">
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <div>
                                                        <label for="nim" class="active">NIM</label>
                                                        <input id="nim" name="nim" type="text" required>
                                                    </div>
                                                </div>
    
                                                <div class="input-field col s6">
                                                    <div>
                                                        <label for="nama_lengkap" class="active">Nama Lengkap</label>
                                                        <input id="nama_lengkap" name="nama_lengkap" type="text" required>
                                                    </div>
                                                </div>
                                            
                                                <div class="input-field col s6">
                                                    <div>
                                                        <label for="email" class="active">Email</label>
                                                        <input id="email" name="email" type="email" class="validate" required>
                                                    </div>
                                                </div>
                                            
                                                <div class="input-field col s6">
                                                    <div>
                                                        <label for="no_telp" class="active">No Telepon</label>
                                                        <input id="no_telp" name="no_telp" type="text" class="validate" required>
                                                    </div>
                                                </div>
    
                                                <div class="input-field col s6">
                                                    <div>
                                                        <label for="alamat" class="active">Alamat</label>
                                                        <textarea name="alamat" class="materialize-textarea" id="alamat" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>

                                                <div class="input-field col s6">
                                                    <div>
                                                        <label for="angkatan" class="active">Angkatan</label>
                                                        <input id="angkatan" name="angkatan" type="text" class="validate" placeholder="Contoh: 2015" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="input-field col s6">
                                                    <div>
                                                        <label>Jurusan </label>
                                                        <select class="browser-default" name="id_jurusan" id="id_jurusan" required>
                                                                
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="input-field-judul">
                                                    <div class="col s12 red darken-4">
                                                            <div class="mt-2"></div>
                                                            <h6 class="white-text">Input Judul Tugas AKhir</h6>
                                                            <hr class="light">
                                                    </div>
                                                    
        
                                                    <div class="col s12" style="margin-top: 40px;">
                                                        <div id="row-level">
                                                            <label for="">Judul</label>
                                                            <textarea name="judul_skripsi" id="judul_skripsi" class="materialize-textarea" cols="30" rows="10" placeholder="Contoh: SISTEM INFORMASI BIMBINGAN ONLINE " required  ></textarea>
                                                        </div>
                                                        <div class="input-field err-container level_error"></div>
                                                    </div>
                                                </div>


                                                <div class="input-field-pembimbing">
                                                        <div class="col s12 red darken-4">
                                                                <div class="mt-2"></div>
                                                                <h6 class="white-text">Pilih Pembimbing 1 dan 2</h6>
                                                                <hr class="light">
                                                        </div>
                                                        
            
                                                        <div class="col s12 m6 l6" style="margin-top: 40px;">
                                                            <div id="row-level">
                                                                <label for="">Pembimbing 1</label>
                                                                <select name="pembimbing_1" class="browser-default" id="pembimbing_1" required>
                                                                    
                                                                </select>
                                                            </div>
                                                            <div class="input-field err-container level_error"></div>
                                                        </div>

                                                        <div class="col s12 m6 l6" style="margin-top: 40px;">
                                                            <div id="row-level">
                                                                <label for="">Pembimbing 2</label>
                                                                <select name="pembimbing_2" class="browser-default" id="pembimbing_2" required></select>
                                                            </div>
                                                            <div class="input-field err-container level_error"></div>
                                                        </div>
                                                </div>
                                               
                                               
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light indigo darken-1 right" type="submit" id="submit_add" name="action">SUBMIT 
                                    </button>
                                </div>
                            </div>
                        </form>
                                
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <script>
        $(function() {
           MahasiswaController.add();
        });
    </script>