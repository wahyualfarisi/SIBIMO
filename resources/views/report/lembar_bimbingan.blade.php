<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/lembar_bimbingan.css') }}">
    <title>Kartu Bimbingan</title>
    <script>
         var TOKEN = "{{ $_GET['token'] }}";
    </script>
</head>
<body>
    
    <!-- PAGE 1 -->
    <div class="container">
        <div class="page-1">
                <header>
                    <div class="mt-30">
                        <h3 class="text-bold-5 center-text">KARTU BIMBINGAN <br> SKRIPSI </h3>
                        <hr>
                    </div>
                </header>
            
                <section class="info_mahasiswa mt-30">
                    <table class="table_info_mahasiswa">
                        <tr>
                            <th>NAMA</th>
                            <td class="nama_mahasiswa">: </td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td class="nim_mahasiswa">: </td>
                        </tr>
                        <tr>
                            <th>PROGRAM STUDI</th>
                            <td class="jurusan">: </td>
                        </tr>
                    </table>
                </section>
            
                <section class="info_judul_skripsi mt-100" > 
                    <div class="mt-30">
                        <h3 class="center-text text-bold-4">JUDUL TUGAS AKHIR</h3>
        
                        <h4 class="center-text mt-30 judul_skripsi_text">
                            
                        </h4>
                    </div>
                </section>
        
                <section class="info_logo center-text">
                <img class="logo-page-1" src="{{ asset('app-assets/images/logo/materialize-logo.png') }}" alt="">
                </section>

                <section class="section_footer_page-1 mt-100">
                    <h3 class="center-text text-bold-4">
                        UNIVERSITAS BUNG KARNO <br>
                        FAKULTAS ILMU KOMPUTER
                    </h3>
                    <p class="center-text mt-30">
                        Jl. Kimia No.20 Menteng, Jakarta Pusat 10320
                    </p>
                    <h5 class="center-text">JAKARTA</h5>
                </section>
            
        </div>
    </div>

    <div class="pagebreak"></div>
    <div class="pemisah"></div>

    <!-- PAGE 2 -->
    <div class="container">
        <div class="page-2">

            <section class="header-page-2 mt-100">
                <div class="row">
                        <div class="col-3 text-right">
                            <img class="logo-page-2" src="{{ asset('app-assets/images/logo/materialize-logo.png') }}" alt="">
                        </div>
                        <div class="col s9">
                            <div class="mt-30">
                                <h1 class="text-bold-4">UNIVERSITAS BUNG KARNO <br> FAKULTAS ILMU KOMPUTER</h1>
                            </div>
                        </div>
                </div>
                <hr>
            </section>

            <section>
                <h3 class="center-text">
                    KARTU BIMBINGAN TUGAS AKHIR (SKRIPSI) <br>
                    SEMESTER GANJIL & GENAP <br>
                </h3>
            </section>

            <section class="mt-30">
                <h3 class="center-text text-bold-4">
                    LEMBAR PEMBIMBING 1
                </h3>
            </section>

            <section class="section_table_pembimbing">
                <table class="table_pembimbing">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>PERMASALAHAN</th>
                            <th>REVISI</th>
                            <th>ACC</th>
                            <th>PARAF</th>
                        </tr>
                    </thead>
                    <tbody id="t_pembimbing_1">
                       
                    </tbody>
                </table>
                
                <div class="middle-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Diterima Tanggal : </h4>
                            <h4>Diujikan Tanggal : </h4>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="height: 40px">
                                <div></div>
                            </div>
                            <h4>TTD MAHASISWA</h4>
                        </div>
                    </div>
                    <div class="mt-100"></div>
                    <hr>
                </div>

                <div class="page-2-ttd mt-30">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="text-bold-4 center-text">DOSEN PEMBIMBING 1</h5>
                            <div class="mt-100"></div>
                            <div class="mt-100"></div>
                            <div class="mt-100"></div>
                            <hr>
                            <h5 class="center-text nama_pembimbing_1"></h5>
                        </div>
                        <div class="col-sm-4 center-text foto_mahasiswa">
                            FOTO
                        </div>
                        <div class="col-sm-4 center-text">
                            <h4 class="text-bold-4">KAPRODI</h4>
                            <div class="mt-100"></div>
                            <div class="mt-100"></div>
                            <div class="mt-100"></div>
                            <hr>
                            <h5 class="center-text nama_kaprodi"></h5>
                        </div>
                    </div>
                </div>

            </section>
            
        </div>
    </div>

    <div class="pagebreak"></div>
    <div class="pemisah"></div>

    <!-- PAGE 3 -->
    <div class="container">
            <div class="page-3">
    
                <section class="header-page-2 mt-100">
                    <div class="row">
                            <div class="col-3 text-right">
                                <img class="logo-page-2" src="{{ asset('app-assets/images/logo/materialize-logo.png') }}" alt="">
                            </div>
                            <div class="col s9">
                                <div class="mt-30">
                                    <h1 class="text-bold-4">UNIVERSITAS BUNG KARNO <br> FAKULTAS ILMU KOMPUTER</h1>
                                </div>
                            </div>
                    </div>
                    <hr>
                </section>
    
               
    
                <section class="mt-30">
                    <h3 class="center-text text-bold-4">
                        LEMBAR PEMBIMBING 2
                    </h3>
                </section>
    
                <section class="section_table_pembimbing">
                    <table class="table_pembimbing">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TANGGAL</th>
                                <th>PERMASALAHAN</th>
                                <th>REVISI</th>
                                <th>ACC</th>
                                <th>PARAF</th>
                            </tr>
                        </thead>
                        <tbody id="t_pembimbing_2">
                           
                        </tbody>
                    </table>
                    
                    <div class="page-2-ttd mt-30">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="text-bold-4 center-text">DOSEN PEMBIMBING 2</h5>

                                <div class="mt-100"></div>
                                <div class="mt-100"></div>
                                <div class="mt-100"></div>
                                <hr>
                                <h5 class="center-text nama_pembimbing_2"></h5>
                            </div>
                            <div class="col-sm-6 center-text">
                                <h5 class="text-bold-4">KAPRODI</h5>
                                <div class="mt-100"></div>
                                <div class="mt-100"></div>
                                <div class="mt-100"></div>
                                <hr>
                                <h5 class="center-text nama_kaprodi"></h5>
                            </div>
                        </div>
                    </div>
    
                </section>
                
            </div>
        </div>
    
        <div class="fixed-button">
            <button type="button" class="btn-print">
                PRINT
            </button>
        </div>

        <script src="{{asset('assets/js/vendors.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/printArea.js')}}"></script>
        <script src="{{asset('src/app-library.js')}}"></script>
        <script src="{{asset('src/app-ui.js')}}"></script>
        <script src="{{asset('src/app-controller.js')}}"></script>
</body>
</html>

<script>
    $(function() {
        
        KartuBimbinganController.data()
    })
</script>