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

<div id="modalUpdateKaprodi" class="modal modal-fixed-footer">
        <div class="modal-content">
          <h4>Update Kaprodi</h4>
          
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">BATAL</a>
        </div>
</div>
<script>
    $(function() {
        var ID_JURUSAN = "{{ $id }}";
        JurusanController.detail( ID_JURUSAN );
    })
</script>