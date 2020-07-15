const MainController = ( () => {
    const setRoute = () => {
        let path;
        

        if (location.hash) {
            path = location.hash.substr(2);
            loadContent(path, '#main');
            // activeNav('#/dashboard');
        
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
                console.log(response);
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
})()