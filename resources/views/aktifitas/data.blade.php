<div class="row">
    <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h3 class="breadcrumbs-title mt-0 mb-0">
                         Bimbingan
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="main-aktifitas"></div>
   
</div>

<form id="form_start_bimbingan">
    <div id="modalStartBimbingan" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center-align">Mulai Bimbingan</h4>
            
            <div>
                <label> Pilih Pembimbing </label>
                <select name="id_pembimbing" id="id_pembimbing" class="browser-default" required>
                    <option value=""> -- Pembimbing -- </option>
                </select>
            </div>

            <div>
                <label> Pilih Bab </label>
                <select name="bab" id="bab" class="browser-default" required>
                    <option value=""> -- Pilih -- </option>
                    <option value="BAB 1">  BAB 1 </option>
                    <option value="BAB 2">  BAB 2  </option>
                    <option value="BAB 3">  BAB 3  </option>
                    <option value="BAB 4">  BAB 4  </option>
                    <option value="BAB 5">  BAB 5  </option>
                </select>
            </div>

            <div>
                <label>Upload File Bimbingan</label>
                <input type="file" name="file" required/>
            </div>

            <div>
                <label>Deskripsi (optional)</label>
                <textarea class="materialize-textarea" name="deskripsi_bimbingan" id="deskripsi" cols="50" rows="50">

                </textarea>
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
        AktifitasController.init();
    })
</script>