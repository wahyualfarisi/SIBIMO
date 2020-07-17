const DashboardUI = ( () => {
    const tu = () => {

    }

    return {
        display: ( res) => {
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
                    //notification !....
                break;

                case 'DOSEN':

                break;

                case 'KAPRODI':


                break;

                case 'MAHASISWA':


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
                output += `<option value="${item.id_dospem}"> ${item.get_account.nama_lengkap} (${item.get_account.level}) </option>`
            })
        }
        $(dom).html(output);
    }

    const sortPembimbing = (a, b) => {
        let pembimbing1 = parseInt(a.get_dospem.id_pembimbing);
        let pembimbing2 = parseInt(b.get_dospem.id_pembimbing);

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
        displayDospem: (data) => {

            let pembimbing1 = data.filter(item => parseInt(item.pembimbing)  === 1 );
            let pembimbing2 = data.filter(item => parseInt(item.pembimbing)  === 2 );

            displayFieldPembimbing(pembimbing1, '[name=pembimbing_1]')
            displayFieldPembimbing(pembimbing2, '[name=pembimbing_2]')
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

            //pembimbing
            let pembimbing = data_mahasiswa.get_pembimbing.sort(sortPembimbing);

            let output = '';
            pembimbing.forEach(item => {
                output += `
                <div class="col s12 m6 l6">
                    <div class="card">
                        <a class="btn-floating btn-small waves-effect waves-light red right"> <i class="material-icons">mode_edit</i></a>
                        <div class="card-content">
                            <div style="display: inline-flex; width: 100%;" class="mt-4">
                                <img src="${BASE_URL}/images/default_user.png" class="circle" width="50px" alt="">
                                <h5 class="ml-4">
                                    ${item.get_dospem.get_account.nama_lengkap}
                                </h5>
                                <br>
                            </div>
                        </div>
                        <div class="card-action red darken-3">
                            <div id="clients-bar" class="center-align">
                                <span class="white-text date_today">PEMBIMBING ${item.get_dospem.pembimbing}</span>
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
})()