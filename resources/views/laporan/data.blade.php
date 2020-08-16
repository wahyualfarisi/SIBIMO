<div class="row">   
        <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">
                                Mahasiswa Siap Sidang
                            </h5>
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
                                        <table id="t_mahasiswa" class="display nowrap" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>NIM</th>
                                                    <th>Mahasiswa</th>
                                                    <th>Jurusan</th>
                                                    <th>Judul Tugas Akhir</th>
                                                    <th>Pembimbing</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>NIM</th>
                                                    <th>Mahasiswa</th>
                                                    <th>Jurusan</th>
                                                    <th>Judul Tugas Akhir</th>
                                                    <th>Pembimbing</th>
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

<script>
    $(function() {
        LaporanController.data();
    })
</script>