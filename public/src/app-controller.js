// 
const MainController = ( (AJAX, UI, LIB) => {
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
               
            },
            success: function (response) {
                $('.loader-sidebar').html('')
                $('.menu_sidebar').css('display','block')
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
            AJAX.placeHolderBigSize('.loader-sidebar', 2)

            setRoute();
            runningTime();
            
        }
    }
})(ajaxSetting, mainUI, libSettings);

// profile controller 
const ProfileController = ( ( AJAX, LIB, UI ) => {

    const EventListener = () => {
        $(document).on('click', '.btn_update_avatar', function() {
            $('#modalUpdateAvatar').modal('open');
        });

        $('[name=foto]').on('change', function(e) {
            e.preventDefault();
            AJAX.previewImage(e, '.preview_image_profile')
        });

        $('#form_update_avatar').on('submit', function(e) {
            e.preventDefault();

            let url;
            if(LEVEL == 'mahasiswa'){
                url = `/api/mahasiswa/update/foto`;
            }else{
                url = `/api/account/update/avatar`;
            }

            AJAX.postFormData(
                `${url}`,
                this,
                null,
                res => {
                    $('#modalUpdateAvatar').modal('close');
                    load_profile()
                },
                err => {
                    console.log(err)
                }
            )
           
            
        })
    }

    const load_profile = () => {
        AJAX.getRes(
            `/api/verify`,
            {},
            null,
            res => {
                UI.display(res)
            },
            err => {
                console.log(err)
            }
        )
    }

    return {
        init: () => {
            EventListener();
            $('#modalUpdateAvatar').modal();
            load_profile()
        }
    }
})(ajaxSetting, libSettings, ProfileUI)

// dashboard controller 
const DashboardController = ( ( UI, AJAX ) => {
        const get_pembimbing = ( cb ) => {
            AJAX.getRes(
                `/api/verify`,
                {},
                null,
                res => {
                    cb(res)
                },
                err => {
                    console.log(err)
                }
            )
        }

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

        const EventListener = () => {
            
            $('table').on('click', '.btn__start__bimbingan',  function() {
                let bab = $(this).data('bab');
                let id_pembimbing = $(this).data('id_pembimbing');
                let nama_pembimbing = $(this).data('nama_pembimbing');

                $('[name=id_pembimbing]').val(id_pembimbing)
                $('[name=nama_pembimbing]').val(nama_pembimbing);
                $('.bab').val(bab)
                $('.bab').text(bab)
                $('#modalStartBimbingan').modal('open')
            });

            $('#form_start_bimbingan').on('submit', function(e) {
                e.preventDefault();
            }).validate({
                submitHandler: (form) => {
                    AJAX.postFormData(
                        `/api/bimbingan/create`,
                        form,
                        null,
                        res => {
                            if(res.status){
                                $('#modalStartBimbingan').modal('close');
                                location.hash = `#/aktifitas`;
                            }else{
                                M.toast({
                                    html: res.message
                                })
                            }
                          
                        },
                        err => {
                            console.log(err)
                        }
                    )
                }
            })

        }

    return {
        init: () => {
            $('#modalStartBimbingan').modal()
            load_dashboard();
            EventListener()
        }
    }
})(DashboardUI, ajaxSetting);

//Jurusan Controller
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

    const OnUpdateKaprodiHandler = (t_mahasiswa, id_jurusan) => {

        $('#t_detail_jurusan').on('click', '.btn_update_kaprodi', function() {
            AJAX.getRes(
                `/api/account?get_dosen`,
                {},
                null,
                res => {
                    if(res.status){
                        const data = res.results;

                        let output = '<option value=""> -- Select Account -- </option>'
                        if( data.length > 0 ){
                            data.forEach(item => {
                                output += `<option value="${item.id_account}"> ${item.nama_lengkap} </option>`
                            })
                        }

                        $('[name=id_account]').html(output);
                    }
                },
                err => {
                    console.log(err);
                }
            )

            $('#modalUpdateKaprodi').modal('open')
        });

        $('#form_update_kaprodi').on('submit', function(e) {
            e.preventDefault();
            AJAX.postRes(
                `/api/jurusan/${id_jurusan}/update_kaprodi`,
                this,
                null, 
                res => {
                    if(res.status){
                        M.toast({
                            html: 'Berhasil mengupdate kaprodi'
                        });
                        $('.td_kaprodi').html(`
                            ${res.results.nama_lengkap} <a href="javascript:void(0)" class="btn_update_kaprodi"> <i class="material-icons green-text" style="font-size: 15px;">create</i> </a>
                        `);
                        $('#modalUpdateKaprodi').modal('close')
                    }
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
                            className: 'btn btn-floating btn-small red darken-3 my-action'
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
                            <a class="mb-1 waves-effect waves-light green-text btn__edit" data-id_jurusan="${row.id_jurusan}" data-nama="${row.nama_jurusan}">
                                <i class="material-icons">create</i>
                            </a>
                            <a class="mb-1 waves-effect waves-light red-text  accent-2 btn__delete" data-id_jurusan="${row.id_jurusan}">
                                <i class="material-icons">close</i>
                            </a>
                            <a href="#/jurusan/${row.id_jurusan}" class="mb-1 grey-text waves-effect waves-light">
                                <i class="material-icons">arrow_forward</i>
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
            
        },

        detail: id_jurusan => {
            $('#modalUpdateKaprodi').modal()
            let t_mahasiswa = $('#t_mahasiswa').DataTable({
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
                            className: 'btn btn-floating btn-small red darken-3 my-action'
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
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/jurusan/${id_jurusan}`,
                    {},
                    res => {
                        
                        $('.jurusan_name').html(`${res.results.nama_jurusan}`);
                        $('[name=id_kaprodi]').val(res.results.get_kaprodi.id_kaprodi);

                        $('.td_kaprodi').html(`
                            ${res.results.get_kaprodi.get_account.nama_lengkap} <a href="javascript:void(0)" class="btn_update_kaprodi"> <i class="material-icons green-text" style="font-size: 15px;">create</i> </a>
                        `)
                        return res.results.get_mahasiswa 
                    },
                    err => {
                        console.log(err)
                    }
                ),
                columns: [
                    {
                        data: null,
                        render: ( data, type, row ) => {
                            return `
                            <img src="${BASE_URL}/images/default_user.png" width="40px;" class="circle">
                            `
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row) => {
                            return row.nama_lengkap 
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row) => {
                            return row.nim
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return row.get_judul_skripsi.judul
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row) => {
                            if(row.no_telp)
                                return row.no_telp 
                            else 
                                return '-'
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row ) => {
                            return row.angkatan
                        }
                    },
                    {
                        data: null,
                        render: ( data, type , row ) => {
                            return `
                            <a href="#/mahasiswa/${row.id_mahasiswa}" class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
                                <i class="material-icons">arrow_forward</i>
                            </a>
                            `
                        }
                    }
                ]
            });

            OnUpdateKaprodiHandler(t_mahasiswa, id_jurusan);
        }
    }
})(ajaxSetting, libSettings);

const AccountController = ( (AJAX, LIB, UI) => {
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

    const fetch_account_by_id = id => {
        AJAX.getRes(
            `/api/account/${id}`,
            {},
            null,
            res => {
                if(res.status){
                    $('#loader_container').hide();
                    $('#main_container').show();
                    UI.embedOnInput(res.results);
                }
            },
            err => {
                console.log(err);
            }
        )
    }

    const formEditHandler = () => {
        $('#form_edit_account').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                let id_account = $('[name=id_account]').val();

                AJAX.putRes(
                    `/api/account/${id_account}`,
                    form,
                    null,
                    res => {
                        if(res.status){
                            M.toast({ html: 'Account berhasil di update' })
                            window.history.back();
                        }
                    },
                    err => {
                        console.log(err);
                    }
                )
            }
        })
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
                            className: 'btn btn-floating btn-small red darken-3 my-action'
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
                            <a href="#/account/edit/${row.id_account}" class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
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
        },

        edit: ( id ) => {
            fetch_account_by_id(id);
            formEditHandler();
        }
    }
})(ajaxSetting, libSettings, AccountUI);

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
    let T_MAHASISWA, DOSPEM = [];

    const EventListener_add = () => {

        $('[name=pembimbing_1]').on('change', function() {
            let selected_id = parseInt($(this).val());
            let dospem = DOSPEM;

            let filterDospem = dospem.filter(item => parseInt(item.id_account) !== selected_id);

            UI.displaySelectDospem(filterDospem, '[name=pembimbing_2]');

        })

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
                            location.hash = '#/mahasiswa/'+res.results.id_mahasiswa;
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

    const load_material_form = ( cb ) => {
        AJAX.getRes(
            `/api/mahasiswa/material/form`,
            {},
            null,
            res => {
                cb(res)
            },
            err => {
                console.log(res);
            }
        );
    }

    const load_detail_mahasiswa = (id_mahasiswa) => {
        AJAX.getRes(
            `/api/mahasiswa/${id_mahasiswa}`,
            {},
            null,
            res => {
                if(res.status){
                    console.log(res);
                    UI.displayDetail(res.results);
                }
            },
            err => {
                console.log(err);
            }
        )
    }

    const EventListener_detail = (id_mahasiswa) => {

        $(document).on('click', '.btn_update_pembimbing', function() {
            let status_pembimbing = $(this).data('pembimbing_status');
            let id_account        = $(this).data('id_account');
            let id_pembimbing     = $(this).data('id_pembimbing');

            $('.status_pembimbing').text(`Update Pembimbing ${status_pembimbing}`)
            load_material_form(res => {
                let dospem = res.results.dospem;

                let filterDospem = dospem.filter(item => item.id_account !== id_account);

                UI.displaySelectDospem(filterDospem, '[name=id_account]')

                $('[name=id_pembimbing]').val(id_pembimbing);
                $('#modalUpdatePembimbing').modal('open');
            } );
            
        });

        $('.btn_edit_mahasiswa').on('click', function() {
            load_material_form(res => UI.displaySelectJurusan(res.results.jurusan) );
            $('#modalEditMahasiswa').modal('open')
        });

        $('.btn__reset__password').on('click', function() {
            $('#modalResetPassword').modal('open')
        });

        //show modal add judul
        $('.btn_add_judul').on('click', function() {
            $('#modalAddJudul').modal('open')
        });

        //show modal delete judul
        $('#table_data_judul tbody').on('click', '.btn__delete__judul', function() {
            let id, judul;
            id = $(this).data('id');
            judul = $(this).data('judul_text');
            
            $('.judul').html(judul);
            $('#id_judul_delete').val(id)
            $('#modalDeleteJudul').modal('open')
        });

        $('#table_data_judul tbody').on('click', '.btn__manage__status', function() {
            let id, judul, status;
            id = $(this).data('id');
            judul = $(this).data('judul_text')
            status = $(this).data('status')

            $('.judul').html(judul);
            $('[name=status]').val(status);
            $('#id_judul_manage_status').val(id)
            $('#ModalManageStatus').modal('open')
        })

        $('#form_edit_mahasiswa').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                AJAX.putRes(
                    `/api/mahasiswa/${id_mahasiswa}`,
                    form,
                    null,
                    res => {
                        if(res.status){
                            $('#modalEditMahasiswa').modal('close')
                            M.toast({
                                html: 'Mahasiswa berhasil di update'
                            });
                            load_detail_mahasiswa( id_mahasiswa )
                        }
                    },
                    err => {
                        console.log(err);
                    }
                )
            }
        });

        $('#form_reset_password').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                AJAX.postRes(
                    `/api/mahasiswa/reset/${id_mahasiswa}`,
                    form,
                    null,
                    res => {
                        M.toast({
                            html: 'Password berhasil di reset'
                        })
                        $('#modalResetPassword').modal('close');
                    },
                    err => {
                        console.log(err);
                    }
                )
            }
        });

        $('#form_add_judul').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                AJAX.postRes(
                    `/api/judul/add`,
                    form,
                    null,
                    res => {
                        console.log(res)
                        if(res.status){
                            load_detail_mahasiswa(id_mahasiswa);
                            $('#modalAddJudul').modal('close')
                            $('[name=judul]').val('')
                            $('[name=status]').val('')
                        }
                    },
                    err => {
                        console.log(res)
                    }
                )
            }
        });

        $('#form_update_pembimbing').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                let id_pembimbing = $('[name=id_pembimbing]').val();

                AJAX.postRes(
                    `/api/pembimbing/${id_pembimbing}/update_pembimbing`,
                    form,
                    null,
                    res => {
                        if(res.status){
                            $('#modalUpdatePembimbing').modal('close');
                            M.toast({
                                html: 'Pembimbing berhasil di update'
                            })
                            load_detail_mahasiswa(id_mahasiswa)
                        }
                    },
                    err => {
                        console.log(err)
                    }
                )
            }
        });

        //Delete Judul
        $('#form_delete_judul').on('submit', function(e) {
            e.preventDefault();
            let id_judul = $('[name=id_judul]').val();
            AJAX.postRes(
                `/api/judul/delete/${id_judul}`,
                null,
                null,
                res => {
                    if(res.status){
                        load_detail_mahasiswa( id_mahasiswa );
                        $('#modalDeleteJudul').modal('close')
                        M.toast({ html: 'Berhasil Menghapus Judul' });
                    }
                    M.toast({ html: res.message })
                },
                err => {
                    M.toast({ html: 'Proses hapus gagal, Silahkan coba kembali ' })
                }
            )
        });

        //Manage status
        $('#form_manage_status').on('submit', function(e) {
            e.preventDefault();
            AJAX.postRes(
                `/api/judul/manage_judul`,
                this,
                null,
                res => {
                    console.log(res);
                    $('#ModalManageStatus').modal('close')
                    load_detail_mahasiswa( id_mahasiswa )
                },
                err => {
                    console.log(err);
                }
            )
        })
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
                            className: 'btn btn-floating btn-small red darken-3 my-action'
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
                            }else{
                                return '-'
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
                            <a href="#/mahasiswa/${row.id_mahasiswa}" class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
                                <i class="material-icons">arrow_forward</i>
                            </a>
                            `
                        }
                    }
                ]
            })
        },
        add: () => {
            EventListener_add();
            load_material_form(res => {
                if(res.status){

                    //push data dospem on var dospem
                    DOSPEM = res.results.dospem

                    $('#loader_container').hide();
                    $('#main_container').show();
                    UI.displaySelectJurusan(res.results.jurusan)

                    //embed pembimbing 1 select
                    UI.displaySelectDospem(res.results.dospem, '[name=pembimbing_1]');
                }
            })
        },
        detail: ( id_mahasiswa ) => {
            $('#modalUpdatePembimbing').modal()
            $('#modalEditMahasiswa').modal()
            $('#modalResetPassword').modal()
            $('#modalAddJudul').modal()
            $('#modalDeleteJudul').modal();
            $('#ModalManageStatus').modal();
            load_detail_mahasiswa( id_mahasiswa );
            EventListener_detail( id_mahasiswa )
        }
    }
})(ajaxSetting, libSettings, MahasiswaUI);

const MeController = ( (AJAX, LIB) => {

    return {
        init: () => {
            console.log('init me controller');
        }
    }
})(ajaxSetting, libSettings);

const AktifitasController = ( ( AJAX, LIB , UI) => {

    const load_aktifitas = () => {
        AJAX.getRes(
            `/api/bimbingan/current`,
            {},
            null,
            res => {
                UI.renderAktifitas(res)
            },
            err => {
                console.log(err)
            }
        )
    }

    const get_pembimbing = ( cb ) => {
        AJAX.getRes(
            `/api/verify`,
            {},
            null,
            res => {
                cb(res)
            },
            err => {
                console.log(err)
            }
        )
    }

    const EventListener = () => {

        $('.main-aktifitas').on('click', '.btn_start_bimbingan', function() {
            get_pembimbing(res => {
                
                UI.renderFieldPembimbing(res.data.pembimbing)
                $('#modalStartBimbingan').modal('open');
            });
        });

        
    }

    const load_detail_bimbingan = id => {
        AJAX.getRes(
            `/api/bimbingan/${id}`,
            {},
            null,
            res => {
                UI.renderDetailBimbingan(res.results)
            },
            err => {
                console.log(err);
            }
        )
    }

    const onSubmitFormDiskusi = id => {

        $('#form-diskusi').on('submit', function(e) {
            e.preventDefault();
            if( $('[name=pesan]').val() === '' ) return false;

            AJAX.postRes(
                `/api/diskusi/create`,
                this,
                null,
                res => {
                    load_detail_bimbingan( id )
                    $('[name=pesan]').val(' ')
                },
                err => {
                    console.log(err)
                }
            )
        })
    }

    const onActionCatatan = ( id ) => {

        function field_file(){
            return `
                <label> File</label>
                <input type="file" name="file" >
            `;
        }

        $('.btn__tambah__catatan').on('click', function() {
            $('#modalAddCatatan').modal('open');
        });

        $('#show_field_file').on('click', function() {
            if( $(this).is(':checked') ){
                $('.field-add-file').html( field_file() )
            }else{
                $('.field-add-file').html( ' ' )
            }
        })

        $('#form_add_catatan').on('submit', function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: (form) => {
                AJAX.postFormData(
                    `/api/catatan/create`,
                    form,
                    null,
                    res => {
                        $('#modalAddCatatan').modal('close');
                        load_detail_bimbingan( id )
                        $('[name=catatan]').val(' ')
                        
                    },
                    err => {

                    }
                );
            }
        })
    }

    const onCloseBimbingan = (id, signaturePad) => {
        $('.btn__tutup__bimbingan').on('click', function() {
            $('#modalTutupBimbingan').modal('open');
        })

        $('.btn_clear').on('click', function(){
            signaturePad.clear()
        });

        $('#form-tutup-bimbingan').on('submit', function(e) {
            e.preventDefault();
            if( signaturePad.isEmpty() )
            return M.toast({
                html: 'Tanda tangan tidak boleh kosong'
            });

            let signToUrl = signaturePad.toDataURL();
            let createToImage = document.createElement('IMG');
            createToImage.src = signToUrl;

            let blob = AJAX.dataURItoBlob(createToImage.src);
            blob.filename = `signature${new Date().getTime()}.png`;
            let replaceName = blob.filename.replace(/\.[^/.]+$/, ".jpg");
 
            let form_data = new FormData();
            form_data.append('id_bimbingan', id);
            form_data.append('status', $('input[name=status]:checked').val() )
            form_data.append('paraf', blob, replaceName);

        
            AJAX.postBlobData(
                `/api/bimbingan/close`,
                form_data,
                null,
                res => {
                   
                    $('#modalTutupBimbingan').modal('close');
                    signaturePad.clear();
                    $('#btn_close_bimbingan').hide()
                },
                err => {
                    console.log(err)
                }
            );
            
        })
    }

    return  {
        init: () => {
            $('#modalStartBimbingan').modal();
            load_aktifitas();
            EventListener()
        },

        detail: id => {
            $('#modalAddCatatan').modal();
            $('#modalTutupBimbingan').modal();
            load_detail_bimbingan( id )
            onSubmitFormDiskusi( id )
            onActionCatatan( id )
            

            var canvas       = document.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas);
    
            onCloseBimbingan( id , signaturePad )
        }
    }
})(ajaxSetting, libSettings, AktifitasUI);

const HistoryBimbinganController = ( (AJAX, LIB) => {
    return {
        data: () => {
            const t_history = $('#t_history').DataTable({
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
                            className: 'btn btn-floating btn-small red darken-3 my-action'
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
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/bimbingan/history`,
                    {},
                    res => {
                        return res.results;
                    },
                    err => {
                        console.log(err)
                    }
                ),
                columns: [
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6> ${row.tanggal_bimbingan} </h6>` ;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row ) => {
                            return `<h6> ${row.get_mahasiswa.nama_lengkap} </h6>
                            <br> ${row.get_mahasiswa.nim} `
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                                <h6> ${row.get_pembimbing.get_account.nama_lengkap} </h6><br> 
                                    Pembimbing ${row.get_pembimbing.pembimbing_status}
                            `;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `<h6>${row.bab} </h6>` 
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return row.get_lembar_bimbingan.revisi
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return row.get_lembar_bimbingan.acc
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <a href="#/aktifitas/${row.id_bimbingan}" class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit">
                                <i class="material-icons">arrow_forward</i>
                            </a>
                            `
                        }
                    }

                ]
            })
        }
    }
})(ajaxSetting, libSettings)

const PlagiatismeController = ( ( AJAX, LIB ) => {
    const EventListener = ( table ) => {

        $('#btn_create_plagiatisme').on('click', function() {
            $('#modalTambahPlagiatisme').modal('open');
        });

        $('#form_plagiatisme').on('submit', function(e) {
            e.preventDefault();            
        }).validate({
            submitHandler: (form) => {
                AJAX.postFormData(
                    `/api/plagiatisme/create`,
                    form,
                    null,
                    res => {
                        if(res.status){
                            $('#modalTambahPlagiatisme').modal('close');
                            M.toast({
                                html: 'Berhasil menambahkan nilai plagiatisme'
                            })
                            table.ajax.reload();
                        }else{
                            M.toast({
                                html: res.message
                            })
                        }
                    },
                    err => {
                        console.log(err)
                    }
                )
            }
        });

        $('#t_plagiatisme').on('click', '.btn__hapus', function() {
            let id = $(this).data('id');

            $('#id_plagiatisme_delete').val(id);
            $('#modalDelete').modal('open');
        });

        $('#form_delete').on('submit', function(e) {
            e.preventDefault();
            let id = $('#id_plagiatisme_delete').val();
            AJAX.deleteRes(
                `/api/plagiatisme/delete/${id}`,
                null,
                res => {
                    $('#modalDelete').modal('close');
                    table.ajax.reload()
                },
                err => {
                    console.error(err)
                }
            );
        });

        $('#t_plagiatisme').on('click', '.btn__edit', function() {
            let id = $(this).data('id');
            let nilai = $(this).data('nilai');
            let bab = $(this).data('bab');

            $('#id_edit').val(id);
            $('#bab_edit').val(bab);
            $('#nilai_edit').val(nilai);

            $('#modalEditPlagiatisme').modal('open');
        });

        $('#form_edit_plagiatisme').on('submit', function(e) {
            e.preventDefault();
            let id = $('#id_edit').val();
            AJAX.postFormData(
                `/api/plagiatisme/update_data/${id}`,
                this,
                null,
                res => {
                    $('#modalEditPlagiatisme').modal('close');
                    table.ajax.reload();
                },
                err => {
                    console.error(err)
                }
            )
        });



    }


    return {
        data: () => {
            $('#modalTambahPlagiatisme').modal();
            $('#modalDelete').modal();
            $('#modalEditPlagiatisme').modal();
            const T_plagiatisme = $('#t_plagiatisme').DataTable({
                processing: false,
                language: AJAX.dtLanguage(),
                dom: '<Bf<t>ip>',
                pageLength: 50,
                scrollY: 350,
                scrollX: true,
                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: 'btn btn-floating btn-small red darken-3 my-action'
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
                                    filename: 'DATA_PLAGIATISME',
                                    title: 'Data Mahasiswa'
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_PLAGIATISME',
                                    title: 'Data Mahasiswa'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_PLAGIATISME',
                                    title: 'Data Mahasiswa'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5]
                                    },
                                    filename: 'DATA_PLAGIATISME',
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
                    ]
                },
                ajax: AJAX.dtSettingSrc(
                    `/api/plagiatisme`,
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
                        render: ( data, type, row ) => {
                            return `<h6> ${row.bab} </h6>`
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row ) => {
                            if(row.foto) {
                                return `
                                <div style="display: grid;">
                                    <img src="/api/foto/plagiatisme/${row.foto}" alt="sc_plagiatisme" width="100px;" />
                                    <a class="black-text" href="/api/foto/plagiatisme/${row.foto}"> Lihat Foto </a>
                                </div>
                                `
                            }
                            return '-'
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row ) => {
                            return `<h6> ${row.nilai_plagiatisme} % </h6>`
                        }
                    },
                    {
                        data: null,
                        render: ( data, type, row ) => {
                            return `
                                <a data-id="${row.id_plagiatisme}" data-bab="${row.bab}" data-nilai="${row.nilai_plagiatisme}" href="javascript:void(0)" class="green-text btn__edit"><i class="material-icons"> create </i> </a>
                                <a data-id="${row.id_plagiatisme}" href="javascript:void(0)" class="red-text btn__hapus"> <i class="material-icons"> close </i> </a>
                            
                            `
                        } 
                    }
                ]
            });

            EventListener( T_plagiatisme )
        }
    }
})(ajaxSetting, libSettings)

const KartuBimbinganController = ( ( AJAX , LIB, UI) => {
    const load_data = () => {
        AJAX.getRes(
            `/api/dashboard`,
            {},
            null,
            res => {
                
                UI.display(res)
            },
            err => {
                console.log(err)
            }
        )
    }

    const EventListener = () => {
        $('.btn-print').on('click', function() {
            window.print()
        })
    }

    return {
        data: () => {
            load_data()  
            EventListener()  
        }
    }
})(ajaxSetting, libSettings, KartuUI)