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

    return {
        displaySelectJurusan: (data) => {
            let output = '<option value="" selected="">-- Pilih Jurusan --</option>';
            if(data.length > 0) {
                data.forEach(item => {
                    output += `<option value="${item.id_jurusan}"> ${item.nama_jurusan} </option>`
                })
            }
            $('#id_jurusan').html(output);
        },
        displayDospem: (data) => {

            let pembimbing1 = data.filter(item => parseInt(item.pembimbing)  === 1 );
            let pembimbing2 = data.filter(item => parseInt(item.pembimbing)  === 2 );

            displayFieldPembimbing(pembimbing1, '[name=pembimbing_1]')
            displayFieldPembimbing(pembimbing2, '[name=pembimbing_2]')

            
        }
    }
})()