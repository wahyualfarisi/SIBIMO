
<div class="row">
    <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">
                            Overview Bimbingan
                        </h5>
                    </div>
                    @if ( session('level') === 'kaprodi' || session('level') === 'dosen' )
                        <div class="col s2 m6 l6" id="btn_close_bimbingan" style="display: none;">
                            <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right btn__tutup__bimbingan" href="javascript:void(0)">
                                <span class="hide-on-small-onl">Tutup Bimbingan</span>
                            </a>
                        </div>
                    @endif
                   
                </div>
            </div>
    </div>
    <div class="col s12 m8 l8">
        <div class="container">
            <div class="card border-radius-6">
                <div class="card-content" id="showTopCard">
                   
                </div>
            </div>
        </div>
        
    </div>

    <div class="col s12 m4">
            <div class="container">
                <div class="card border-radius-6" style="height: 245px;">
                    <div class="card-content">
                        <h1 class="bab_bimbingan"></h1>
                        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">insert_drive_file</i> File Bimbingan </h5>
                        
                        <div class="file-bimbingan-content mt-3">
                                
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div class="col s12 m8">
        <div class="container">
            <div class="chat-application">

                <div class="app-chat">
                    <div class="content-area content-right">
                    <div class="app-wrapper">
                        <!-- Sidebar menu for small screen -->
                        <a href="#" data-target="chat-sidenav" class="sidenav-trigger hide-on-large-only">
                        <i class="material-icons">menu</i>
                        </a>
                        <!--/ Sidebar menu for small screen -->
    
                        <div class="card card card-default border-radius-6 fixed-width">
                        <div class="card-content chat-content p-0">
                            
    
                            <!-- Content Area -->
                            <div class="chat-content-area">
                            <!-- Chat header -->
                            
                            <div class="chat-header">
                                <div class="row valign-wrapper">
                                    <div class="col">
                                        <p class="m-0 blue-grey-text text-darken-4 font-weight-700">Tanggal: <span class="tanggal_bimbingan" ></span> </p>
                                        <p class="m-0 chat-text truncate bab_bimbingan"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Chat header -->
    
                            <!-- Chat content area -->
                            <div class="chat-area">
                                <div class="chats">
                                    <div class="chats">
                                        
                                        {{-- <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar">
                                                <img src="{{ asset('assets/images/user/12.jpg') }}" class="circle" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-text">
                                                <p>Selamat Sore PAk</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="chat chat-right">
                                            <div class="chat-avatar">
                                                <a class="avatar">
                                                <img src="{{ asset('assets/images/user/12.jpg') }}" class="circle" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-text">
                                                <p>Absolutely!</p>
                                                </div>
                                                <div class="chat-text">
                                                <p>Materialize admin is the responsive material admin template.</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar">
                                                <img src="{{ asset('assets/images/user/12.jpg') }}" class="circle" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-text">
                                                <p>Looks clean and fresh UI.</p>
                                                </div>
                                                <div class="chat-text">
                                                <p>It's perfect for my next project.</p>
                                                </div>
                                                <div class="chat-text">
                                                <p>How can I purchase it?</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="chat chat-right">
                                            <div class="chat-avatar">
                                                <a class="avatar">
                                                <img src="{{ asset('assets/images/user/12.jpg') }}" class="circle" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-text">
                                                <p>Thanks, from ThemeForest.</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar">
                                                <img src="{{ asset('assets/images/user/12.jpg') }}" class="circle" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-text">
                                                <p>I will purchase it for sure.</p>
                                                </div>
                                                <div class="chat-text">
                                                <p>Thanks.</p>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                            <!--/ Chat content area -->
    
                            <!-- Chat footer <-->
                            <div class="chat-footer">
                                <form id="form-diskusi" class="chat-input">
                                    <input type="hidden" name="id_bimbingan" value="{{ $id_bimbingan }}">
                                    <input type="text" name="pesan" placeholder="Type message here.." class="message">
                                    <button type="submit" class="btn waves-effect waves-light send">Send</button>
                                </form>
                            </div>
                            <!--/ Chat footer -->
                            </div>
                            <!--/ Content Area -->
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col s12 m4">
        <div class="container">
            <div class="card border-radius-6">
                <div class="card-content">
                    <div style="display: inline">
                        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">create</i> Catatan Dari Dosen </h5>
                        @if (session('level') === 'kaprodi' || session('level') === 'dosen' )
                            <button type="submit" style="margin-top: -30px;" class="btn right btn__tambah__catatan">+</button>
                        @endif
                    </div>
                   
                    <div class="catatan-content" style="margin-top: 50px;">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="form_add_catatan">
<input type="hidden" name="id_bimbingan" value="{{ $id_bimbingan }}">
<div id="modalAddCatatan" class="modal modal-fixed-footer" style="height: 400px;">
    <div class="modal-content">
        <h4 class="center-align">Tambah Catatan</h4>
        <div>
            <label>Catatan</label>
            <textarea name="catatan" id="catatan" style="height: 100px;" class="materialize-textarea" cols="30" rows="10" required></textarea>
        </div>

        <p>
            <label>
            <input type="checkbox" id="show_field_file" />
            <span class="text">Tambahkan File</span>
            </label>
        </p>

        <div class="field-add-file">
            {{-- <label> File</label>
            <input type="file" name="file" > --}}
        </div>
    </div>
   
    <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
        <button type="submit" class="btn">Submit</button>
    </div>
</div>
</form>

<form id="form-tutup-bimbingan">
<div id="modalTutupBimbingan" class="modal modal-fixed-footer" style="height: 400px;">
    
    <div class="modal-content">
        <h4 class="center-align">Konfirmasi Tutup Bimbingan</h4>
        <div class="row mt-8">
            <div class="col s6">
                <div>
                    <h5>Hasil Bimbingan</h5>
                        <p>
                        <label>
                            <input name="status" value="acc" type="radio" checked/>
                            <span>Acc</span>
                        </label>
                        </p>
                        <p>
                        <label>
                            <input name="status" value="revisi" type="radio" />
                            <span>Revisi</span>
                        </label>
                        </p>
                </div>
            </div>
            <div class="col s6">
                <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 1px solid grey;"></canvas>
                        </div>
                        <div class="m-signature-pad--footer">
                            <div class="description">Tanda tangan di pada kotak tersebut</div>
                            <div class="left">
                            <button type="button" class="button clear btn_clear" data-action="clear">Clear</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        

    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
        <button type="submit" class="btn">Submit</button>
    </div>
    </div>
</form>

<script>
    $(function() {
        var ID = "{{ $id_bimbingan }}"
        AktifitasController.detail( ID );
    })
</script>