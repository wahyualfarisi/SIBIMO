const mainUI = ( () => {

    return {
       
    }
})()

const AccountUI = ( () => {

    return {
        embedOnInput: data => {
            $('[name=nip]').val(data.nip);
            $('[name=email]').val(data.email);
            $('[name=no_telp]').val(data.no_telp);
            $('[name=alamat]').val(data.alamat);
            $('[name=level]').val(data.level);
            $('[name=nama_lengkap]').val(data.nama_lengkap);
        }
    }
})()

const DashboardUI = ( () => {
    const tu = () => {

    }

    const displayFotoAccount = (data) => {
       
        let src;
        if(data.foto) {
            src = `/api/foto/account/${data.foto}`
        }else{
            src = `${BASE_URL}/images/default_user.png`;
        }

        $('#image_user').html(`
            <img src="${src}" width="100%;" alt="" class="circle z-depth-5">   
        `);
    }

    const displayFotoMahasiswa = (data) => {
        let src;

        if(data.foto) {
            src = `/api/foto/mahasiswa/${data.foto}`
        }else{
            src = `${BASE_URL}/images/default_user.png`;
        }

        $('#image_user').html(`
            <img src="${src}" width="100%;" alt="" class="circle z-depth-5">   
        `);
    }


    return {
        display: ( res) => {
            console.log(res);
            //hide loader container
            $('#loader_container').hide();
            $('#card-total-data').show();

            let level = res.level.toUpperCase();
            
            //info user
            $('#info_user').html(`Hallo, ${res.info_user.nama_lengkap}  <i class="material-icons green-text">verified_user</i>`)
            $('#user_position').text(level);

            switch(level)
            {
                case 'TU':
                    //display spesific cards
                    $('.total_jurusan').text(res.results.jurusan.length);
                    $('.total_mahasiswa').text(res.results.mahasiswa);
                    $('.total_dosen').text(res.results.dosen);
                    displayFotoAccount(res.info_user)
                    //notification !....
                break;

                case 'DOSEN':
                    displayFotoAccount(res.info_user)
                break;

                case 'KAPRODI':
                    displayFotoAccount(res.info_user)
                break;

                case 'MAHASISWA':
                    displayFotoMahasiswa(res.info_user);
                break;
            }

        }   
    }
})();

const MahasiswaUI = ( () => {
    const displayFieldPembimbing = (data, dom) => {
        let output = '<option value="" selected="">-- Pilih Pembimbing --</option>';
        if(data.length > 0){
            data.forEach(item => {
                output += `<option value="${item.id_account}"> ${item.nama_lengkap} (${item.level}) </option>`
            })
        }
        $(dom).html(output);
    }

    const sortPembimbing = (a, b) => {
        let pembimbing1 = parseInt(a.pembimbing_status);
        let pembimbing2 = parseInt(b.pembimbing_status);



        let comparison = 0;
        if(pembimbing1 > pembimbing2){
            comparison = 1;
        }else if(pembimbing1 < pembimbing2){
            comparison = -1
        }

        return comparison;
    }

    return {
        displaySelectJurusan: (data) => {
            let output = '<option value="" selected="">-- Pilih Jurusan --</option>';
            if(data.length > 0) {
                data.forEach(item => {
                    output += `<option value="${item.id_jurusan}"> ${item.nama_jurusan} </option>`
                });
            }
            $('#id_jurusan').html(output);
        },
        displaySelectDospem: ( data, dom ) => {
            return displayFieldPembimbing(data, dom);
        },
        displayDetail: (data) => {
            $('#loader_container').hide();
            $('#main-container').show();
            const { data_mahasiswa, histori_judul } = data;
            //render info mhs
            let telp;
            if(data_mahasiswa.no_telp){
                telp = data_mahasiswa.no_telp
            }else{
                telp = '-'
            }
            $('.full_name').text(data_mahasiswa.nama_lengkap);
            $('#email').text(data_mahasiswa.email);
            $('#phone').text(telp);
            $('#nim').text(data_mahasiswa.nim)
            $('#jurusan').text(data_mahasiswa.get_jurusan.nama_jurusan);
            $('#angkatan').text(data_mahasiswa.angkatan);
            //----

            //info judul skripsi
            if(data_mahasiswa.get_judul_skripsi){
                $('#judul_skripsi').html(data_mahasiswa.get_judul_skripsi.judul);
                $('#skripsi_status').html(`Status: ${data_mahasiswa.get_judul_skripsi.status}`)
                $('#skripsi_created').html(`Di Buat Pada: ${moment(data_mahasiswa.get_judul_skripsi.created_at).format('D MMM YYYY HH:m')}`);
            }else{
                $('#judul_skripsi').html('-');
                $('#skripsi_status').html('-');
                $('#skripsi_created').html('-')
            }
            

            //field for form edit mahasiswa
            $('[name=nim]').val(data_mahasiswa.nim);
            $('[name=email]').val(data_mahasiswa.email);
            $('[name=no_telp]').val(data_mahasiswa.no_telp);
            $('[name=angkatan]').val(data_mahasiswa.angkatan);
            $('[name=id_jurusan]').val(data_mahasiswa.id_jurusan);
            $('[name=nama_lengkap]').val(data_mahasiswa.nama_lengkap);

            //embed photo mahasiswa
            let image_source;
            if(data_mahasiswa.foto){
                image_source = `/api/foto/mahasiswa/${data_mahasiswa.foto}`;
            }else{
                image_source = `${BASE_URL}/images/default_user.png`;
            }

            $('.mahasiswa_photo').html(`
                 <img src="${image_source}" alt="" style="position:absolute; top: 50%; left: 50%; transform:translate(-50%, -50%);" alt="preview image" class="preview_image responsive-img">
            `);

            //pembimbing
            let pembimbing = data_mahasiswa.get_pembimbing.sort(sortPembimbing);

            let output = '';
            pembimbing.forEach(item => {
                output += `
                <div class="col s12 m6 l6">
                    <div class="card">
                        <a class="waves-effect waves-light red-text right btn_update_pembimbing" data-id_pembimbing="${item.id_pembimbing}" data-pembimbing_status="${item.pembimbing_status}" data-id_account="${item.get_account.id_account}"> <i style="font-size: 15px;" class="material-icons">mode_edit</i></a>
                        <div class="card-content">
                            <div style="display: inline-flex; width: 100%;" class="mt-4">
                                <img src="${BASE_URL}/images/default_user.png" class="circle" width="50px" alt="">
                                <h5 class="ml-4">
                                    ${item.get_account.nama_lengkap}
                                </h5>
                                <br>
                            </div>
                        </div>
                        <div class="card-action red darken-3">
                            <div id="clients-bar" class="center-align">
                                <span class="white-text date_today">PEMBIMBING ${item.pembimbing_status}</span>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            })
            $('#pembimbing-content').html(output);

            let output_history = '';
            histori_judul.forEach(item => {
                let status;
                if(item.status === 'active'){
                    status = `<span class="badge blue lighten-5 blue-text text-accent-2">Aktif</span>`
                }else{
                    status = `<span class="badge red lighten-5 red-text text-accent-2">Non Aktif</span>`
                }
                output_history += `
                    <tr>
                        <td> ${item.judul} </td>
                        <td> ${status} </td>
                        <td> ${moment(item.created_at).format('D MMM YYYY HH:m')} </td>
                        <td>
                            <a data-judul_text="${item.judul}" data-status=${item.status} data-id="${item.id_judul_skripsi}" href="javascript:void(0)" class="grey-text btn__manage__status">
                                <i class="material-icons" style="font-size: 13px;">visibility</i>
                            </a>
                            <a data-judul_text="${item.judul}" data-id="${item.id_judul_skripsi}" href="javascript:void(0)" class="grey-text btn__delete__judul">
                                <i class="material-icons" style="font-size: 13px;">clear</i>
                            </a>
                        </td>
                    </tr>
                `;
            })
            $('#t_history_judul').html(output_history);

        }
    }
})();

const ProfileUI = ( () => {

    

    const renderAccount = (data) => {
        $('.nama_lengkap').text(data.results.nama_lengkap);

        $('[name=email]').val(data.results.email);
        $('[name=nama_lengkap]').val(data.results.nama_lengkap);
        $('[name=nip]').val(data.results.nip);
        $('[name=no_telp]').val(data.results.no_telp)
        $('[name=alamat]').val(data.results.alamat);

        //check foto 
        let src;
        if( data.results.foto ) {
            src = `/api/foto/account/${data.results.foto}`
            console.log('oke')
        }else{
            src = `${BASE_URL}/images/default_user.png`;
            console.log('no')
        }

        $('.image_user').html(`
            <img src="${src}" width="10%;" alt="" class="circle">
            <a class="btn-floating btn-small waves-effect waves-light red btn_update_avatar"> <i class="material-icons">mode_edit</i></a>
        `)
    }

    const renderMahasiswa = (data) => {
        $('.nama_lengkap').text(data.results.nama_lengkap);
        
        $('[name=email]').val(data.results.email);
        $('[name=nama_lengkap]').val(data.results.nama_lengkap);
        $('[name=nip]').val(data.results.nim);
        $('[name=no_telp]').val(data.results.no_telp)
        $('[name=alamat]').val(data.results.alamat);

        let src;
        if( data.results.foto ) {
            src = `/api/foto/mahasiswa/${data.results.foto}`
            console.log('oke')
        }else{
            src = `${BASE_URL}/images/default_user.png`;
            console.log('no')
        }

        $('.image_user').html(`
            <img src="${src}" width="10%;" alt="" class="circle">
            <a class="btn-floating btn-small waves-effect waves-light red btn_update_avatar"> <i class="material-icons">mode_edit</i></a>
        `);

    }

    return {
        display: (data) => {
            if(data.level === 'ACCOUNT'){
                renderAccount(data)
            }else if(data.level === 'MAHASISWA'){
                renderMahasiswa(data);
            }
        }
    }
})();

const AktifitasUI = ( () => {
    const aktifitas_mahasiswa = (data) => {
        let html = '';

        data.results.forEach(item => {

            let src;

            if(item.get_account.foto){
                src = `/api/foto/account/${item.get_account.foto}`;
            }else{
                src = `${BASE_URL}/images/default_user.png`;
            }

            html += `
            <div class="col s12 m12 l12">
                    <div class="card horizontal border-radius-6">
                        
                        <div class="card-stacked">
                                <div class="card-content">
                                    <div class="left" style="margin-right: 35px;">
                                        <img width="150px" style="border-radius: 50%" src="${src}" />
                                    </div>
                                    <h4>${item.bab}</h4>
                                    <h5>${item.tanggal_bimbingan}</h5>

                                    <h5>Pembimbing ${item.get_pembimbing.pembimbing_status}</h5>
                                    <div>
                                        <h4> ${item.get_account.nama_lengkap} </h4>
                                    </div>
                                </div>
                                <div class="card-action red darken-3">
                                    <a class="white-text right" href="#/aktifitas/${item.id_bimbingan}">
                                    Masuk Ke Halaman diskusi <i style="font-size: 15px;" class="material-icons">keyboard_arrow_right </i>
                                    </a>
                                </div>
                        </div>
                    </div>
            </div>
            `;
        });

        return html;
    }

    const aktifitas_pembimbing = (data) => {
        let html = ''
        data.results.forEach(item => {
            let src;

            if(item.get_mahasiswa.foto){
                src = `/api/foto/mahasiswa/${item.get_mahasiswa.foto}`;
            }else{
                src = `${BASE_URL}/images/default_user.png`;
            }
            html += `
            <div class="col s12 m12 l12">
                    <div class="card horizontal border-radius-6">
                        
                        <div class="card-stacked">
                                <div class="card-content">
                                    <div class="left" style="margin-right: 35px;">
                                        <img width="150px" style="border-radius: 50%" src="${src}" />
                                    </div>
                                    <h4 class="font-weight-800">${item.bab}</h4>
                                    
                                    <h5>${item.tanggal_bimbingan}</h5>

                                    <h4>${item.get_mahasiswa.nama_lengkap}</h4>
                                    <h5><b>${item.get_mahasiswa.nim}</b> </h5>
                                    
                                </div>
                                <div class="card-action red darken-3">
                                    <a class="white-text right" href="#/aktifitas/${item.id_bimbingan}">
                                    Masuk Ke Halaman diskusi <i style="font-size: 15px;" class="material-icons">keyboard_arrow_right </i>
                                    </a>
                                </div>
                        </div>
                    </div>
            </div>
            `;
        });

        return html;
    }

    const showTopCard = ( { get_account, get_mahasiswa, get_pembimbing }) => {
        const default_foto = `${BASE_URL}/images/default_user.png`;
        let foto = default_foto;
        let foto_dospem = default_foto;

        if(get_account.foto){
            foto_dospem = `/api/foto/account/${get_account.foto}`;
        }

        if(get_mahasiswa.foto){
            foto = `/api/foto/mahasiswa/${get_mahasiswa.foto}`
        }
        

        let html = `
        <div class="col s6">
            <h6 class="font-weight-800 mb-3">Mahasiswa</h6>
            <img src="${foto}" width="100px;" class="circle" alt="avatar" />
            <table>
                <tr>
                    <th>Mahasiswa </th>
                    <td>: ${get_mahasiswa.nama_lengkap}</td>
                </tr>
                <tr>
                    <th>Nim </th>
                    <td>: ${get_mahasiswa.nim}</td>
                </tr>
            </table>
        </div>
        <div class="col s6">
            <h6 class="font-weight-800 mb-3">Pembimbing: ${get_pembimbing.pembimbing_status}</h6>
            <img src="${foto_dospem}" width="100px;" class="circle" alt="avatar" />
            <table>
                <tr>
                    <th>Nama Pembimbing </th>
                    <td>: ${get_account.nama_lengkap}</td>
                </tr>
                <tr>
                    <th>Nip </th>
                    <td>: ${get_account.nip}</td>
                </tr>
            </table>
        </div>
        
        `
        return html;
    }

    const displayDiskusi = ( { get_diskusi } ) => {
        let class_chat = '', image = `` , html = '';

        if(get_diskusi.length > 0 ){
            get_diskusi.forEach(item => {

                if(item.get_dospem){
                    
                    class_chat = 'chat-right';

                    if(item.get_dospem.foto){
                        image = `/api/foto/account/${item.get_dospem.foto}`;
                    }else{
                        image = `${BASE_URL}/images/default_user.png`
                    }
                }

                if(item.get_mahasiswa){
                    class_chat = ''
                    if(item.get_mahasiswa.foto){
                        image = `/api/foto/mahasiswa/${item.get_mahasiswa.foto}`;
                    }else{
                        image = `${BASE_URL}/images/default_user.png`
                    }
                }

                html += `
                    <div class="chat ${class_chat}">
                        <div class="chat-avatar">
                            <a class="avatar">
                            <img src="${image}" class="circle" alt="avatar" />
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <p>${item.pesan}</p>
                            </div>
                        </div>
                    </div>
                `
            })
        }else{
            html = ''
        }

        $('.chats').html(html)
    }

    const displayCatatan = ( { get_catatan, get_mahasiswa }) => {
        let html = '', no = 1
        if(get_catatan.length > 0) {
            get_catatan.forEach(item => {
                let file;
                if(item.file){
                    file = `<a href="/api/file/${get_mahasiswa.nim}/catatan/${item.file}"><i style="font-size: 13px" class="material-icons"> attach_file </i> Download attachment </a>`
                }else{
                    file = ''
                }

                html += `<p>${no++}.  ${item.catatan} ${file} </p>`
            })
        }else{
            html = ''
        }

        $('.catatan-content').html(html);
    }

    return {
        renderAktifitas: (data) => {
            let html, btn_start;
            if(data.results.length > 0) {

                html = ''
                if(LEVEL === 'mahasiswa'){
                   html = aktifitas_mahasiswa(data)
                }else if(LEVEL === 'kaprodi' || LEVEL === 'dosen'){
                    html = aktifitas_pembimbing(data);
                }
                
            }else{

                if(LEVEL === 'mahasiswa'){
                    btn_start = '<a class="btn btn-flat waves-effect waves-light btn_start_bimbingan" href="javascript:void(0)">Mulai Bimbingan</a>';
                }else{
                    btn_start = '<a class="btn btn-flat waves-effect waves-light" href="javascript:void(0)"></a>'
                }

                html = `
                    <div id="aktifitas" class="col s12 center-align white" style="padding: 10px;">
                        <img width="30%" src="${BASE_URL}/images/todoList.svg" class="responsive-img maintenance-img" alt="">
                        <h4 class="error-code">Tidak ada aktifitas bimbingan</h4>
                        ${btn_start}
                    </div>
                `;
            }
            $('.main-aktifitas').html(html);
        },

        renderFieldPembimbing: (data) => {
            let html = '';

            if(data.length > 0) {
                    html = `<option value=""> -- Pilih Pembimbing --- </option>`
                data.forEach(item => {
                    html += `
                        <option value="${item.id_pembimbing}"> ${item.get_account.nama_lengkap}  - Pembimbing ${item.pembimbing_status} </option>
                    `;
                });
            }else{
                html = '';
            }

            $('[name=id_pembimbing]').html(html)
        },

        renderDetailBimbingan: (data) => {
            //cek status bimbingan
            if(data.status === 'progress'){
                $('#btn_close_bimbingan').show();
            }

            //display top Card 
            $('#showTopCard').html( showTopCard(data) );

            //display File Bimbingan
            $('.file-bimbingan-content').html( `
                <a href="/api/file/${data.get_mahasiswa.nim}/${data.file}" class="btn grey darken-3 col s12"><i class="material-icons">file_download</i> DOWNLOAD FILE BIMBINGAN</a>
            ` )
            $('.bab_bimbingan').html(data.bab)
            $('.tanggal_bimbingan').html(data.tanggal_bimbingan)

            //display Catatan Bimbingan
            displayCatatan(data);

            //display Diskusi
            displayDiskusi(data);
        }
    }
})();