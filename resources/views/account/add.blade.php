<div class="row">
    <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0">
                        Tambah Account
                    </h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="#/dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#/account">Dosen pembimbing</a>
                        </li>
                        <li class="breadcrumb-item">Tambah Account
                        </li>
                    </ol>
                    </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div class="container">
            <div class="section">

                <div class="row" id="loader_container" style="display: none;">
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

                <div class="row" id="main_container" style="">
                    <form class="col s12" id="form_add_account">
                        
                        <div class="card">
                            <div class="card-content">

                                <div class="row">
                                    <div class="col s12  red darken-3">
                                            <div class="mt-2"></div>
                                            <h6 class="white-text">Informasi account </h6>
                                            <hr class="light">
                                    </div>
                                    <div class="col s12">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <div>
                                                    <label for="nip" class="active">NIP</label>
                                                    <input id="nip" name="nip" type="text" required>
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
                                                    <label for="no_telp" class="active">No Telefon</label>
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
                                                    <label>Level / Jabatan </label>
                                                    <select class="browser-default" name="level" id="level" required>
                                                            <option value="" selected="">-- Pilih level --</option>
                                                            <option value="TU">TU</option>
                                                            <option value="DOSEN">DOSEN</option>
                                                            <option value="KAPRODI">KAPRODI</option>
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="input-field-pembimbing">
                                                {{-- <div class="col s12 red darken-4">
                                                        <div class="mt-2"></div>
                                                        <h6 class="white-text">Pembimbing</h6>
                                                        <hr class="light">
                                                </div>
                                                
    
                                                <div class="col s12" style="margin-top: 40px;">
                                                    <div id="row-level">
                                                        <label for="">Level</label>
                                                        <select class="browser-default" name="pembimbing" id="pembimbing" data-target="pembimbing" data-error=".pembimbing_error" required="">
                                                            <option value="" selected="">-- Pembimbing --</option>
                                                            <option value="1">Pembimbing 1</option>
                                                            <option value="2">Pembimbing 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field err-container level_error"></div>
                                                </div> --}}
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
        AccountController.add();
    });
</script>