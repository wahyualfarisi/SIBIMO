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
})()