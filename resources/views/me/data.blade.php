<div class="row">
    <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">
                                <span class="jurusan_name">Profile Saya</span> 
                            </h5>
                        </div>
                </div>
            </div>
    </div>
    <section style="margin-top: 30px; margin: 50px;">
        <div class="card">
            <div class="card-content">
                <div style="text-align: center">
                        <div class="image_user">
                            
                        </div>
                        <h4 class="nama_lengkap"></h4>
                </div>
            </div>
        </div>
        
    </section>

    <section style="margin: 50px;">
        <div class="card">
            <div class="card-content">
                <form id="form_update_account">
                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" disabled>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" id="email" disabled>
                    </div>
                    <div>
                        <label>No. Telp</label>
                        <input type="text" name="no_telp" id="no_telp" disabled>
                    </div>
                    <div>
                        <label>Nip</label>
                        <input type="text" name="nip" id="nip" disabled>
                    </div>
                    <div>
                        <label>Alamat</label>
                        <input type="text" name="alamat" id="alamat" disabled>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>


<form id="form_update_avatar">
    <div id="modalUpdateAvatar" class="modal modal-fixed-footer">
            <div class="modal-content">
            <h4>Update Foto</h4>

            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)" >
                    <div class="card-image z-depth-20 grey lighten-3" style="padding: 20px; position:relative;">
                        <div class="before__preview_image" style="padding: 170px 170px 90px 90px;">
                            <img src="" alt="" style="position:absolute; top: 50%; left: 50%; transform:translate(-50%, -50%);" alt="preview image" class="preview_image_profile responsive-img">
                        </div>
                    </div>
                    <input type="file" class="avatar" accept=".gif,.jpg,.jpeg,.png" name="foto" required />
            </div>

            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
                <button type="submit" class="btn red darken-3">UPLOAD</button>
            </div>
    </div>
</form>


<script>
    $(function() {
        ProfileController.init();
    });
</script>