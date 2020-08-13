<div class="row">
    <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">
                            Plagiatisme
                        </h5>
                    </div>
                    <div class="col s2 m6 l6">
                            <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" id="btn_create_plagiatisme" href="javascript:void(0)">
                                <span class="hide-on-small-onl">Tambah</span>
                            </a>
                    </div>
                </div>
            </div>
    </div>

    <div class="col s12">
        <div class="container">
            <div class="section section-data-tables">
                <div class="row">

                    <div class="col s12" id="table_container">
                        <div class="card">
                            <div class="card-content">

                                <div class="row">

                                    <div class="col s12">
                                        <table id="t_plagiatisme" class="display nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>BAB</th>
                                                    <th>Foto</th>
                                                    <th>Nilai</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>BAB</th>
                                                    <th>Foto</th>
                                                    <th>Nilai</th>
                                                    <th>#</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<form id="form_plagiatisme">
    <div id="modalTambahPlagiatisme" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Tambah Nilai Plagiatisme</h4>
            <div>
                <label>Nilai Plagiatisme %</label>
                <input type="number" name="nilai_plagiatisme" required>
            </div>

            <div class="mt-2">
                <label>Nilai Plagiatisme %</label>
                <select name="bab" class="browser-default" required>
                    <option value=""> -- Pilih BAB -- </option>
                    <option value="BAB 1">BAB 1</option>
                    <option value="BAB 2">BAB 2</option>
                    <option value="BAB 3">BAB 3</option>
                    <option value="BAB 4">BAB 4</option>
                    <option value="BAB 5">BAB 5</option>
                    <option value="ALL BAB">ALL BAB</option>
                </select>
            </div>

            <div class="mt-3">
                <label>Foto</label><br>
                <input type="file" name="foto" required>
            </div>

        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
            <button type="submit" class="btn red darken-3">SUBMIT</button>
        </div>
    </div>
</form>

<form id="form_delete" class="">
    <div id="modalDelete" class="modal bottom-sheet">
        <input type="hidden" name="id_plagiatisme" id="id_plagiatisme_delete">
        <div class="modal-content">
            <h4>Konfirmasi Hapus</h4>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">CANCEL</a>
            <button type="submit" class="btn red darken-3">DELETE</button>
        </div>
    </div>             
</form>

<form id="form_edit_plagiatisme">
        <div id="modalEditPlagiatisme" class="modal modal-fixed-footer">
            <input type="hidden" name="id_plagiatisme" id="id_edit">
            <div class="modal-content">
                <h4>Edit Nilai Plagiatisme</h4>
                <div>
                    <label>Nilai Plagiatisme %</label>
                    <input type="number" name="nilai_plagiatisme" id="nilai_edit" required>
                </div>
    
                <div class="mt-2">
                    <label>Bab</label>
                    <select name="bab_" class="browser-default" id="bab_edit" required>
                        <option value=""> -- Pilih BAB -- </option>
                        <option value="BAB 1">BAB 1</option>
                        <option value="BAB 2">BAB 2</option>
                        <option value="BAB 3">BAB 3</option>
                        <option value="BAB 4">BAB 4</option>
                        <option value="BAB 5">BAB 5</option>
                        <option value="ALL BAB">ALL BAB</option>
                    </select>
                </div>
    
                <div class="mt-3">
                    <label>Foto</label><br>
                    <input type="file" name="foto">
                </div>
    
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">CANCEL</a>
                <button type="submit" class="btn red darken-3">SUBMIT</button>
            </div>
        </div>
</form>

<script>
    $(function() {
        PlagiatismeController.data();
    })
</script>