const MainController = ( (AJAX, UI) => {
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

    const getInitMahasiswa = () => {
        AJAX.getRes(
            `/api/verify`,
            {},
            null,
            res => {

                UI.displayMenuMahasiswa(res.data.pembimbing);
                
            },
            err => {
                console.log(err);
            }
        )
    }

    return {
        init: () => {
            console.log('init main controller');
            setRoute();
            runningTime();
            if(LEVEL === 'mahasiswa'){
                getInitMahasiswa();
            }
        }
    }
})(ajaxSetting, mainUI);

//profile controller 
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
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light green white-text btn__edit" data-id_jurusan="${row.id_jurusan}" data-nama="${row.nama_jurusan}">
                                <i class="material-icons">create</i>
                            </a>
                            <a class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light red accent-2 white-text btn__delete" data-id_jurusan="${row.id_jurusan}">
                                <i class="material-icons">close</i>
                            </a>
                            <a href="#/jurusan/${row.id_jurusan}" class="btn-floating btn-small mb-1 btn-flat waves-effect waves-light blue white-text">
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

        $('.btn_add_judul').on('click', function() {
            $('#modalAddJudul').modal('open')
        });

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
})(ajaxSetting, libSettings)
