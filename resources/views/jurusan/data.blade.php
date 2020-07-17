<div class="row">
    <div class="col s12">
        <div class="container">
            <div class="section section-data-tables">
                <div class="row">

                    <div class="col s12" id="table_container">
                        <div class="card">
                            <div class="card-content">

                                <div class="row">

                                    <div class="col s12">
                                        <table id="t_jurusan" class="display nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Jurusan</th>
                                                    <th>Kaprodi</th>
                                                    <th>Created at</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Jurusan</th>
                                                    <th>Kaprodi</th>
                                                    <th>Created at</th>
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

<!-- -->

<form id="form_add">
        <div id="modalAdd" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>Tambah Jurusan</h4>
                    <div class="input-field col s12">
                        <div>
                            <label>Nama Jurusan</label>
                            <input placeholder="Placeholder" id="nama_jurusan" name="nama_jurusan" type="text" class="validate" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
                <button type="submit" class="waves-effect waves-green btn-flat ">SUBMIT</button>
            </div>
        </div>
</form>

<form id="form_edit">
    <div id="modalEdit" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Edit Jurusan</h4>
            <input type="hidden" name="id_jurusan" />
                <div class="input-field col s12">
                    <div>
                        <label>Nama Jurusan</label>
                        <input placeholder="Placeholder" id="jurusan" name="nama_jurusan" type="text" class="validate" required>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
            <button type="submit" class="waves-effect waves-green btn-flat ">EDIT</button>
        </div>
    </div>
</form>

<form id="form_delete">
<div id="modalDelete" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Konfirmasi Delete</h4>
        <input type="hidden" name="id_to_delete">
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat">BATAL</a>
        <button type="submit" class="waves-effect waves-green btn-flat red darken-1 white-text ">DELETE</button>
    </div>
</div>
</form>


<script>
    $(function() {
        JurusanController.data();
    })
</script>