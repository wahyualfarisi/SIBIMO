console.log('App Setting is running...')


const loaderSetting = (() => {
    return {
        openPublic: () => {
            $.blockUI({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="ball-clip-rotate-multiple loader-success">
                          <div></div>
                          <div></div>
                        </div>
                      </div>
                    </div>
                    <h5 class="center-align mt-5" style="color: white">Please Wait</h5>
                `,
                overlayCSS: {
                    backgroundColor: 'rgb(22, 50, 110)',
                    opacity: 1,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        openPrivate: el => {
            $(el).block({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="square-spin loader-success">
                          <div></div>
                        </div>
                      </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: 'transparent',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        openButton: el => {
            $(el).block({
                message: `
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-green-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: 'rgb(22, 50, 110)',
                    opacity: 1,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        closeButton: el => {
            $(el).unblock()
        },
        closePublic: () => {
            $.unblockUI()
        },
        closePrivate: el => {
            $(el).unblock()
        }
    }
})()

const ajaxSetting = (() => {
    return {
        getFree: (path, data = {}, loader, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'GET',
                data: data,
                headers: {
                    'Accept': 'application/json',
                },
                beforeSend: function () {
                    loader
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err.responseJSON)
                },
                complete: function () {
                    complete
                }
            })
        },
        getRes: (path, data = {}, loader, success, error, complete) => {
            $.ajax({
                cache: false,
                url: path,
                type: 'GET',
                data: data,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    loader
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err.responseJSON)
                },
                complete: function () {
                    complete
                }
            })
        },
        postFree: (path, form, loader, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'JSON',
                data: $(form).serialize(),
                headers: {
                    'Accept': 'application/json',
                },
                beforeSend: function () {
                    loader
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    console.log(err);
                    error(err.responseJSON)
                },
                complete: function () {
                    complete
                }

            })
        },
        postQS: (path, data = { }, loader, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    loader
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err.responseJSON)
                },
                complete: function () {
                    complete
                }

            })
        },
        postRes: (path, form, loader, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'POST',
                dataType: 'JSON',
                data: $(form).serialize(),
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    $.blockUI({ 
                        message: `
                        <div class="loader-wrapper">
                            <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                            </div>
                        </div>
                        <h6 class="center-align mt-5" style="color: grey">'Please wait ...'</h6>
                        `
                     }); 
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err)
                },
                complete: function () {
                    $.unblockUI(); 
                }

            })
        },
        postFormData: (path, form, loader, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    $.blockUI({ 
                        message: `
                        <div class="loader-wrapper">
                            <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                            </div>
                        </div>
                        <h6 class="center-align mt-5" style="color: grey">'Please wait ...'</h6>
                        `
                     }); 
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err)
                },
                complete: function () {
                    $.unblockUI(); 
                }

            })
        },
        postBlobData: (path, form, message, success, error) => {
            $.ajax({
                url: path,
                type: 'POST',
                data: form,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    $.blockUI({ 
                        message: `
                        <div class="loader-wrapper">
                            <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                            </div>
                        </div>
                        <h6 class="center-align mt-5" style="color: grey">${message}</h6>
                        `
                     }); 
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err)
                    
                },
                complete: function () {
                    $.unblockUI(); 
                }

            })
        },
        putBlobData: (path, form, message, success, error) => {
            $.ajax({
                url: path,
                type: 'PUT',
                data: form,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    $.blockUI({ 
                        message: `
                        <div class="loader-wrapper">
                            <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                            </div>
                        </div>
                        <h6 class="center-align mt-5" style="color: grey">${message}</h6>
                        `
                     }); 
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err)
                    
                },
                complete: function () {
                    $.unblockUI(); 
                }

            })
        },
        getRedirect: (path, data = {}, message, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'GET',
                data: data,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    $.blockUI({ 
                        message: `
                        <div class="loader-wrapper">
                            <div class="loader-container">
                            <div class="ball-clip-rotate-multiple loader-success">
                                <div></div>
                                <div></div>
                            </div>
                            </div>
                        </div>
                        <h5 class="center-align mt-5" style="color: grey">${message}</h5>
                        `
                     }); 
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err.responseJSON)
                },
                complete: function () {
                    $.unblockUI(); 
                }
            })
        },
        putRes: (path, form, loader, success, error, complete) => {
            $.ajax({
                url: path,
                type: 'PUT',
                dataType: 'JSON',
                data: $(form).serialize(),
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
                beforeSend: function () {
                    loader
                },
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err)
                },
                complete: function () {
                    complete
                }

            })
        },
        deleteRes: (path, loader, success, error, complete) => {
			$.ajax({
				url: path,
				type: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${TOKEN}`,
                },
				beforeSend: function () {
                    loader
				},
                success: function (res) {
                    success(res)
                },
                error: function (err) {
                    error(err)
                },
                complete: function () {
                    complete
                }
			})
        },
        dtLanguage: () => {
			return {
                "search": "Quick Search:",
				zeroRecords: function(){
                    return `
                        <div class="text-center">
                            <img class="img-fluid" style="width: 5%;" src="${BASE_URL}/assets/image/empty-list-3.png">
                            <p>No data </p>
                        </div>`
				},
                loadingRecords: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="line-spin-fade-loader loader-blue">
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                        </div>
                      </div>
                    </div>
                `,
				infoFiltered: ""
			}
        },
        dtSetting: (path, param, resError) => {
			return {
				url: path,
				data: param,
				type: "GET",
                dataType: "JSON",
				beforeSend: function (xhr) {
					xhr.setRequestHeader("Accept", "application/json");
					xhr.setRequestHeader('Authorization', `Bearer ${TOKEN}`);
				},
				error: function (err) {
					resError(err);
				}
			}
        },
        dtSettingSrc: (path, param, callback, resError) => {
			return {
				url: path,
				data: param,
				type: "GET",
				dataType: "JSON",
				beforeSend: function (xhr) {
					xhr.setRequestHeader("Accept", "application/json");
					xhr.setRequestHeader('Authorization', `Bearer ${TOKEN}`);
				},
				dataSrc: function(res){
					return callback(res);
				},
				error: function(err){
					resError(err)
				}
			}
        },
        numberFormat: (angka, prefix) => {
            var numberString = angka.replace(/[^,\d]/g, '').toString()
            var split        = numberString.split(',')
            var sisa         = split[0].length % 3 
            var rupiah       = split[0].substr(0, sisa)
            var ribuan       = split[0].substr(sisa).match(/\d{3}/gi)

            if(ribuan) {
                var seperator = sisa ? '.' : ''
                rupiah += seperator + ribuan.join('.')

            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '' )
        },
        formatTime : (date) => {
            let timeFormat = '', Hours, Minutes;
    
                Hours = date.getHours().toString()
                Minutes = date.getMinutes().toString()
       
                if(Hours.length === 1 ){
                        timeFormat = `0${Hours}.0${Minutes}`
            
                        if(Minutes.length === 2) 
                        timeFormat = `0${Hours}.${Minutes}`
            
                }else if(Minutes.length === 1) 
                        timeFormat = `${Hours}.0${Minutes}`
                else
                        timeFormat = `${Hours}.${Minutes}`
                
                return timeFormat
        },
        setDate : (date) => {
            let newDate = new Date(date)

            newDate.setDate(newDate.getDate() + 1 )
            let y = newDate.getFullYear();
            let mm = newDate.getMonth() + 1;
            let dd = newDate.getDate();

            return `${y}-${mm}-${dd}`
        },
         formatDate : (date) => {

            var monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
              ];
            
              var day         =  new Date(date).getDate()
              var monthIndex  = new Date(date).getMonth();
              var year        = new Date(date).getFullYear();
            
              return day + ' ' + monthNames[monthIndex] + ' ' + year;
        },
        dataURItoBlob: (dataURI) =>
        {
            var byteString;
            if(dataURI.split(',')[0].indexOf('base64') >=0 )
                byteString = atob(dataURI.split(',')[1])
            else
                byteString = unescape(dataURI.split(',')[1])


            var mimestring = dataURI.split(',')[0].split(':')[1].split(',')[0];

            var ia = new Uint8Array(byteString.length);
            for(var i = 0; i < byteString.length; i++)
            {
                ia[i] = byteString.charCodeAt(i)
            }
            return new Blob([ia], {type: mimestring});
        },
        previewImage: ( e, selectorImage ) => {
            // let file = this.files[0]
            var preview = document.querySelector(selectorImage);

            const width    = 800;
            const height   = 800;
            const fileName = e.target.files[0]

            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = event => {
                const img = new Image();
                img.src = event.target.result;
                img.onload = () => {
                        const elem = document.createElement('canvas');
                        elem.width = width;
                        elem.height = height;
                        const ctx = elem.getContext('2d');
                        // img.width and img.height will contain the original dimensions
                        ctx.drawImage(img, 0, 0, width, height);

                        const image = ctx.canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                        preview.src = image
                        
                    }, reader.onerror = error => console.log(error);

             };
        },
        loaderLinear: (dom) => {
            let html = `
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            `;
            $(dom).html(html)
        },
        placeHolderBigSize: (dom, total = 1) => {
            let html = '';
            for(var i = 0; i<total; i++){
                html += `
                <div class="ph-item">
                    <div class="ph-col-12">
                        <div class="ph-row">
                            <div class="ph-col-6"></div>
                            <div class="ph-col-4 empty big"></div>
                            <div class="ph-col-2 big"></div>
                            <div class="ph-col-4"></div>
                            <div class="ph-col-8 empty"></div>
                            <div class="ph-col-6"></div>
                            <div class="ph-col-6 empty"></div>
                            <div class="ph-col-12"></div>
                        </div>
                    </div>
                </div>
                `
            }
            
            $(dom).html(html);
        },
        renderBarcode: (data, id_dom) => {
            let string = JSON.stringify(data);
            let qrcode = new QRCode(id_dom);
            qrcode.makeCode(string);
        },
        
        buttonOnLoad: (dom) => $(dom).attr('disabled', 'disabled').text('Loading ...'),

        buttonClear: (dom, text = 'SUBMIT') => $(dom).text(text).attr('disabled', false),

        searchOnTable: (value, table) => {
            $(`${table} tr`).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            })
        },
        limitString: (title, limit = 20) => {
            const newTitle = [];

            if(title.length > limit) {
                title.split(' ').reduce( (acc , cur) => {
                    if(acc + cur.length <= limit) {
                        newTitle.push(cur)
                    }
                    return acc + cur.length
                }, 0)

                //return the result
                return `${newTitle.join(' ')} ...`
            }

            return title;
        }
        
    }
})()

const libSettings = (() => {

    const filterEvent = table => {
        
        $('#form_filter').on('submit', function (e) {
            e.preventDefault()

            $('.filter-data').each(function () {
                let index = $(this).data('column')
                table.column(index).search(
                    $(`#col-${index}-filter`).val()
                )
            })

            $('#modal_search').modal('close')
            table.draw()
        })
    }

    const resetFilter = table => {
        $('#btn_reset').on('click', function () {
            $('.filter-data').each(function () {
                let index = $(this).data('column')

                $(this).val('')
                table.column(index).search('')
            });
            table.draw(); 
        })
    }

    return {
        DT_FILTER: (table) => {
            $('#modal_search').modal()
            // $('.datepicker').datepicker()
            filterEvent(table);
            resetFilter(table);
        },
        openPublic: () => {
            $.blockUI({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="ball-clip-rotate-multiple loader-success">
                          <div></div>
                          <div></div>
                        </div>
                      </div>
                    </div>
                    <h5 class="center-align mt-5" style="color: grey">Please Wait</h5>
                `,
                overlayCSS: {
                    backgroundColor: 'rgb(14,66,41)',
                    opacity: 1,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        openPrivate: el => {
            $(el).block({
                message: `
                    <div class="loader-wrapper">
                      <div class="loader-container">
                        <div class="square-spin loader-success">
                          <div></div>
                        </div>
                      </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: 'transparent',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        openButton: el => {
            $(el).block({
                message: `
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-green-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                `,
                overlayCSS: {
                    backgroundColor: 'rgb(14,66,41)',
                    opacity: 1,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            })
        },
        closeButton: el => {
            $(el).unblock()
        },
        closePublic: () => {
            $.unblockUI()
        },
        closePrivate: el => {
            $(el).unblock()
        },
        clearScanner: scanner => {
            $(window).on('hashchange', function () {
                scanner.stop();
            })
        },
        clearModal: () => {
            $(window).on('hashchange', function () {
                let modal = $('.modal').hasClass('open');
                
                if(modal){

                }
            })
        },
        loaderAbsoulute: () => {
            return `
                <div style="position: absolute; top: 50%; left: 45%; transition:transform(-50%, -50%);">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>
                </div>
            `;
        },
        displayNoData: (text = '') => {
            return `
                 <div class="center-align" style="position: absolute; top: 40%; left: 40%; transition:transform(-50%, -50%);">
                    <img src="${BASE_URL}assets/image/empty-list-3.png" width="50" class="responsive-img"  />
                    <br>${text}
                 </div>
            `;
        }
    }
})()

const pluginSetting = (() => {
    return {
        init: () => {
            $(".dropdown-settings").dropdown({
                inDuration: 300,
                outDuration: 225,
                constrainWidth: false,
                hover: false,
                gutter: 0,
                coverTrigger: false,
                alignment: "right"
            });

            $(".collapsible").collapsible({
                accordion: true,
                onOpenStart: function () {
                    // Removed open class first and add open at collapsible active
                    $(".collapsible > li.open").removeClass("open");
                    setTimeout(function () {
                        $("#slide-out > li.active > a")
                            .parent()
                            .addClass("open");
                    }, 10);
                }
            });
        }
        
    }
})()

const NotificationSetting = ( () => {


    return {
        setNotification: function(title, body) {
            var notify = new Notification(title, {
                body,
                icon: 'https://images.glints.com/unsafe/1200x0/glints-dashboard.s3.amazonaws.com/company-logo/d0974d338fbb48385553e5a0e6a05653.png',
                click_action : ``
            });

            return notify
        }
    }
})()