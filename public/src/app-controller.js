const MainController = ( () => {
    const setRoute = () => {
        let path;
        

        if (location.hash) {
            path = location.hash.substr(2);
            loadContent(path, '#main');
            activeNav(location.hash);
        
        } else {
            location.hash = '#/dashboard';
        }

        $(window).on('hashchange', function () {
            path = location.hash;
            
            
            activeNav(path);
            loadContent(path.substr(2), '#main');
        });  
    }

    const activeNav = (path) => {
        
        $('a').removeClass('active');

        $('a[href="' + path + '"]').addClass('active');

        $('.btn-sidenav-toggle').trigger('click');
    }

    const loadContent = (path, element) => {
        $.ajax({
            cache: false,
            url: `${path}`,
            dataType: 'HTML',
            beforeSend: function () {
                // LOADER.openPublic()
            },
            success: function (response) {
                $(element).html(response)
            },
            error: function () {
                alert('Access Denied');
            },
            complete: () => {
                // LOADER.closePublic()
            }
        })
    }

    const runningTime = () => {
        let today, h, m , s , t;

        today = new Date();
        h     = today.getHours();
        m     = today.getMinutes();
        s     = today.getSeconds();
        m     = checkTime(m);
        s     = checkTime(s);

        $('.current-time').text(`${h} : ${m} : ${s}`);
        $('.current-date').text(moment().format('LL'));

        t     = setTimeout(runningTime, 500);
    }

    const checkTime = ( i ) => {
        if( i < 10 ) { 
            i = "0" + i
         }
         return i
    }

    return {
        init: () => {
            console.log('init main controller');
            setRoute();
            runningTime();
        }
    }
})();


//dashboard controller 
const DashboardController = ( ( UI, AJAX ) => {
        const load_dashboard = ( ) => {
            AJAX.getRes(
                `/api/dashboard`,
                {},
                null,
                res => {
                    UI.display(res);
                },
                err => {
                    console.log(err);
                }
            )
        }
    return {
        init: () => {
            load_dashboard();
        }
    }
})(DashboardUI, ajaxSetting);

const JurusanController = ( (AJAX, LIB) => {


    const EventListener = ( datatable ) => {

        $('#t_jurusan').on('click', '.btn__edit', function() {
            let id, nama;

            id = $(this).data('id_jurusan');
            nama = $(this).data('nama');

            $('[name=id_jurusan]').val(id);
            $('#jurusan').val(nama);
            $('#modalEdit').modal('open');
        });

        $('#t_jurusan').on('click', '.btn__delete', function() {
            let id_jurusan = $(this).data('id_jurusan');

            if(id_jurusan){
                $('[name=id_to_delete]').val(id_jurusan);
                $('#modalDelete').modal('open');
            }

        })
    }

    const onSubmitFormAdd = ( table ) => {
        $('#form_add').on('submit', function(e) {
            e.preventDefault();
            AJAX.postRes(
                `/api/jurusan`,
                this,
                null,
                res => {
                    table.ajax.reload()
                    $('#modalAdd').modal('close');
                    M.toast({ html: 'Berhasil menambahkan jurusan' })
                },
                err => {
                    console.log(err);
                }
            )
        });
    }

    const onSubmitFormDelete = (table) => {
        $('#form_delete').on('submit', function(e) {
            e.preventDefault();
            let id_jurusan = $('[name=id_to_delete]').val();

            AJAX.deleteRes(
                `/api/jurusan/${id_jurusan}`,
                null,
                res => {
                    table.ajax.reload()
                    $('#modalDelete').modal('close');
                    M.toast({
                        html: 'Berhasil Menghapus Jurusan'
                    })
                },
                err => {
                    console.log(err);
                }
            );
        })
    }

    const onSubmitFormEdit = (table) => {
        $('#form_edit').on('submit', function(e) {
            e.preventDefault();
            let id_jurusan = $('[name=id_jurusan]').val();

            AJAX.putRes(
                `/api/jurusan/${id_jurusan}`,
                this,
                null,
                res => {
                    table.ajax.reload()
                    $('#modalEdit').modal('close');
                    M.toast({
                        html: 'Berhasil update jurusan'
                    })
                },
                err => {
                    console.log(err);
                }
            )

        })
    }

    return {
        data: () => {
            console.log('data jurusan');
            $('#modalEdit').modal();
            $('#modalDelete').modal();
            $('#modalAdd').modal();

            let t_jurusan = $('#t_jurusan').DataTable({
                processing: false,
                language: AJAX.dtLanguage(),
                dom: '<Bf<t>ip>',
                pageLength: 50,
                scrollY: 300,
                scrollX: true,
                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: 'btn btn-small red darken-3 my-action'
                        }
                    },
                    buttons: [
                        {
                            extend: 'collection',
                            text: '<i class="material-icons dp48">file_download</i> ',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_JURUSAN',
                                    title: 'Data Jurusan'
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_JURUSAN',
                                    title: 'Data Jurusan'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_JURUSAN',
                                    title: 'Data Jurusan'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_JURUSAN',
                                    title: '<h4>Data Jurusan</h4>'
                                },
                            ]
                        },
                        {
                            text: '<i class="material-icons dp48">autorenew</i>',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload()
                                M.toast({ html: 'Refresh table success' })
                            },
                        },
                        {
                            text: '<i class="material-icons dp48">add</i>',
                            action: function (e, dt, node, config) {
                                $('#modalAdd').modal('open');
                            },
                        },
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/jurusan`,
                    {},
                    res => {
                        return res.results
                    },
                    err => {
                        console.log(err)
                    }
                ),
                columns: [
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.nama_jurusan} </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.get_kaprodi.get_account.nama_lengkap} </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return moment(row.created_at).format("Y-M-D H:s")
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit" data-id_jurusan="${row.id_jurusan}" data-nama="${row.nama_jurusan}">
                                <i class="material-icons">create</i>
                            </a>
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light red accent-2 white-text btn__delete" data-id_jurusan="${row.id_jurusan}">
                                <i class="material-icons">close</i>
                            </a>
                            `   
                        }
                    }
                ]
            });
            EventListener(t_jurusan);
            onSubmitFormAdd(t_jurusan);
            onSubmitFormDelete(t_jurusan);
            onSubmitFormEdit(t_jurusan);
            
        }
    }
})(ajaxSetting, libSettings);

const AccountController = ( (AJAX, LIB) => {
    let T_ACCOUNT;

    const EventHandler_add = () => {

        let input_pembimbing = `
            <div class="col s12 red darken-4">
                    <div class="mt-2"></div>
                    <h6 class="white-text">Pembimbing</h6>
                    <hr class="light">
            </div>


            <div class="col s12" style="margin-top: 40px;">
                <div id="row-level">
                    <label for="">Level</label>
                    <select class="browser-default" name="to_be_pembimbing" id="pembimbing" data-target="pembimbing" data-error=".pembimbing_error" required>
                        <option value="" selected="">-- Pembimbing --</option>
                        <option value="1">Pembimbing 1</option>
                        <option value="2">Pembimbing 2</option>
                    </select>
                </div>
                <div class="input-field err-container level_error"></div>
            </div>
        `;

        $('[name=level]').on('change', function() {
            if( $(this).val() !== 'TU' ){
                return $('.input-field-pembimbing').html(input_pembimbing);
            }

            $('.input-field-pembimbing').html('');
        })

        $('#form_add_account').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                AJAX.postRes(
                    `/api/account`,
                    form,
                    null,
                    res => {
                        if(res.status){
                            let level = res.results.level.toLowerCase();
                            location.hash = '#/account/'+level;
                            M.toast({ html: res.message })
                        }else{
                            M.toast({ html: res.message })
                        }
                    },
                    err => {
                        console.log(err);
                    }
                )
            }
        });

    }


    return {
        data: ( type ) => {
            T_ACCOUNT = $('#t_account').DataTable({
                processing: false,
                language: AJAX.dtLanguage(),
                dom: '<Bf<t>ip>',
                pageLength: 50,
                scrollY: 400,
                scrollX: true,
                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: 'btn btn-small red darken-3 my-action'
                        }
                    },
                    buttons: [
                        {
                            extend: 'collection',
                            text: '<i class="material-icons dp48">file_download</i> ',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_ACCONT',
                                    title: 'Data account'
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_ACCONT',
                                    title: 'Data account'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_ACCONT',
                                    title: 'Data account'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6]
                                    },
                                    filename: 'DATA_ACCONT',
                                    title: '<h4>Data account</h4>'
                                },
                            ]
                        },
                        {
                            text: '<i class="material-icons dp48">autorenew</i>',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload()
                            },
                        },
                        {
                            text: '<i class="material-icons dp48">add</i>',
                            action: function (e, dt, node, config) {
                                location.hash = '#/account/add';
                            },
                        },
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/account?${type}`,
                    {},
                    res => {
                        return res.results
                    },
                    err => {
                        console.log(err)
                    }
                ),
                columns:[
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<img src="${BASE_URL}/images/default_user.png" width="40px;" class="circle" />`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.nama_lengkap} <br> ${row.level}</h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.nip} </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> <b>${row.email}</b> </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            if(row.no_telp){
                                return row.no_telp;
                            }else{
                                return '-'
                            }
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.level} </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
                                <i class="material-icons">create</i>
                            </a>
                            `
                        }
                    }
                ]

            })
        },

        add: () => {
            console.log('add controller')
            EventHandler_add()
        }
    }
})(ajaxSetting, libSettings);

const PembimbingController = ( (AJAX, LIB) => {
    let T_PEMBIMBING;

    return {
        data: () => {
            T_PEMBIMBING = $('#t_pembimbing').DataTable({
                processing: false,
                language: AJAX.dtLanguage(),
                dom: '<Bf<t>ip>',
                pageLength: 50,
                scrollY: 400,
                scrollX: true,
                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: 'btn btn-small red darken-3 my-action'
                        }
                    },
                    buttons: [
                        {
                            extend: 'collection',
                            text: '<i class="material-icons dp48">file_download</i> ',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    exportOptions: {
                                        columns: [1,2,3]
                                    },
                                    filename: 'DATA_DOSPEM',
                                    title: 'Data Dospem'
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    exportOptions: {
                                        columns: [1,2,3]
                                    },
                                    filename: 'DATA_DOSPEM',
                                    title: 'Data Dospem'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    exportOptions: {
                                        columns: [1,2,3]
                                    },
                                    filename: 'DATA_DOSPEM',
                                    title: 'Data Dospem'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    exportOptions: {
                                        columns: [1,2,3]
                                    },
                                    filename: 'DATA_DOSPEM',
                                    title: '<h4>Data Dospem</h4>'
                                },
                            ]
                        },
                        {
                            text: '<i class="material-icons dp48">autorenew</i>',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload()
                            },
                        },
                        {
                            text: '<i class="material-icons dp48">search</i>',
                            action: function (e, dt, node, config) {
                                $('#modal_search').modal('open')
                            },
                        }
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/pembimbing`,
                    {},
                    res => {
                        return res.results;
                    },
                    err => {
                        console.log(err)
                    }
                ),
                columns:[
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<img src="${BASE_URL}/images/default_user.png" width="40px;" class="circle" />`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.get_account.nama_lengkap} <br> ${row.get_account.level} </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return  `<h6> Pembimbing ${row.pembimbing}  </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data , type, row) => {
                            return row.get_mahasiswa_bimbingan.length + ' Mahasiswa'
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
                                <i class="material-icons">arrow_forward</i>
                            </a>
                            `
                        }
                    }
                ]

            });
        }
    }
})(ajaxSetting, libSettings);


const MahasiswaController = ( (AJAX, LIB, UI) => {
    let T_MAHASISWA;

    const EventListener_add = () => {
        $('#form_add_mahasiswa').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                AJAX.postRes(
                    `/api/mahasiswa`,
                    form,
                    null,
                    res => {
                        if(res.status){
                            $('#form_add_mahasiswa')[0].reset();
                            M.toast({ html: res.message })
                        }else{
                            M.toast({ html: res.message })
                        }
                    },
                    err => {
                        console.log(err);
                    }
                )
            }
        })
    }

    const load_jurusan = ( cb ) => {
        AJAX.getRes(
            `/api/jurusan`,
            {},
            null,
            res => {
                cb(res)
            },
            err => {
                console.log(res);
            }
        )
    }

    return {
        data: () => {
            T_MAHASISWA = $('#t_mahasiswa').DataTable({
                processing: false,
                language: AJAX.dtLanguage(),
                dom: '<Bf<t>ip>',
                pageLength: 50,
                scrollY: 500,
                scrollX: true,
                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: 'btn btn-small red darken-3 my-action'
                        }
                    },
                    buttons: [
                        {
                            extend: 'collection',
                            text: '<i class="material-icons dp48">file_download</i> ',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_MAHASISWA',
                                    title: 'Data Mahasiswa'
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_MAHASISWA',
                                    title: 'Data Mahasiswa'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_MAHASISWA',
                                    title: 'Data Mahasiswa'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_MAHASISWA',
                                    title: '<h4>Data Mahasiswa</h4>'
                                },
                            ]
                        },
                        {
                            text: '<i class="material-icons dp48">autorenew</i>',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload()
                            },
                        },
                        {
                            text: '<i class="material-icons dp48">search</i>',
                            action: function (e, dt, node, config) {
                                $('#modal_search').modal('open')
                            },
                        }
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/mahasiswa`,
                    {},
                    res => {
                        return res.results;
                    },
                    err => {
                        console.log(err)
                    }
                ),
                columns:[
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<img src="${BASE_URL}/images/default_user.png" width="40px;" class="circle" />`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.nama_lengkap} <br><br> ${row.nim}  </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6>  ${row.get_jurusan.nama_jurusan} <br> <br> Angkatan: ${row.angkatan}  </h6>`
                        }
                    },
                    {
                        data: null,
                        render: (ata, type, row) => {
                            if(row.get_judul_skripsi){
                                return `<h6> ${row.get_judul_skripsi.judul}  </h6>`
                            }
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            if(row.no_telp){
                                return row.no_telp
                            }else{
                                return '-'
                            }
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return row.angkatan
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
                                <i class="material-icons">arrow_forward</i>
                            </a>
                            `
                        }
                    }
                ]
            })
        },
        add: () => {
            console.log('add mahasiswa');
            EventListener_add();
            load_jurusan(res => {
                if(res.status){
                    $('#loader_container').hide();
                    $('#main_container').show();
                    UI.displaySelectJurusan(res.results)

                }
            })
        }
    }
})(ajaxSetting, libSettings, MahasiswaUI);
