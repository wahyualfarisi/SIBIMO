const mainUI = ( () => {

    return {
        displayMenuMahasiswa: (data) => {
            let output = '';
            if(data.length > 0){
                data.forEach(item => {
                    output += `
                        <a class="waves-effect waves-cyan" href="#/pembimbing/${item.id_pembimbing}"><i class="material-icons white-text">track_changes</i><span class="menu-title" data-i18n="">${item.get_account.nama_lengkap}</span></a>
                    `
                });
            }else{
                output = ''
            }
            $('#list_pembimbing_menu').html(output);
        }
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
            $('#judul_skripsi').html(data_mahasiswa.get_judul_skripsi.judul);
            $('#skripsi_status').html(`Status: ${data_mahasiswa.get_judul_skripsi.status}`)
            $('#skripsi_created').html(`Di Buat Pada: ${moment(data_mahasiswa.get_judul_skripsi.created_at).format('D MMM YYYY HH:m')}`);

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
})()