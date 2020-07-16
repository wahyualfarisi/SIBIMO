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
                            className: 'btn btn-small red darken-1 my-action'
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
                            return moment(row.created_at).format("Y-M-D H:s")
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row) => {
                            return `
                            <a class="btn-floating mb-1 btn-flat waves-effect waves-light green white-text btn__edit" data-id_jurusan="${row.id_jurusan}" data-nama="${row.nama_jurusan}">
                                <i class="material-icons">create</i>
                            </a>
                            <a class="btn-floating mb-1 btn-flat waves-effect waves-light red accent-2 white-text btn__delete" data-id_jurusan="${row.id_jurusan}">
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