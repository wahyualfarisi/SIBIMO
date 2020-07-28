<div class="row">
    <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">
                                <span class="jurusan_name">Sistem Informasi</span> 
                            </h5>
                        </div>
                </div>
            </div>
    </div>

    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <h6>Detail Jurusan</h6>
                <table id="t_detail_jurusan">
                    <tr>
                        <th>Nama Jurusan</th>
                        <td class="jurusan_name"></td>
                    </tr>
                    <tr>
                        <th>Kaprodi</th>
                        <td class="td_kaprodi"> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col s12">
        <div>
            <div class="section section-data-tables">
                <div class="row">
                    <div class="col s12" id="table_container">
                        <div class="card">
                            <div class="card-content">
                                <h6>Daftar Mahasiswa</h6>
                                <div class="row">

                                    <div class="col s12">
                                        <table id="t_mahasiswa" class="display nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Nip</th>
                                                    <th>Mahasiswa</th>
                                                    <th>Judul Tugas Akhir</th>
                                                    <th>No. Telp</th>
                                                    <th>Angkatan</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Nip</th>
                                                    <th>Mahasiswa</th>
                                                    <th>Judul Tugas Akhir</th>
                                                    <th>No. Telp</th>
                                                    <th>Angkatan</th>
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

<form id="form_update_kaprodi">
<div id="modalUpdateKaprodi" class="modal modal-fixed-footer">
        <input type="hidden" name="id_kaprodi">
        
        <div class="modal-content">
          <h4>Update Kaprodi</h4>
           <select name="id_account" class="browser-default" required>
                <option value=""> -- Select Account -- </option>
           </select>
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
          <button type="submit" class="btn btn_submit red daken-2">UPDATE</button>
        </div>
</div>
</form>
<script>
    $(function() {
        var ID_JURUSAN = "{{ $id }}";
        JurusanController.detail( ID_JURUSAN );
    })
</script>