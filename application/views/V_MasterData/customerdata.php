<?php
    require_once(APPPATH."views/parts/Header.php");
    require_once(APPPATH."views/parts/Sidebar.php");
    $active = 'dashboard';
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Customer</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="dx-viewport demo-container">
                <div id="data-grid-demo">
                  <div id="gridContainer">
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_Konfirmasi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Verifikasi Customer</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="KodeCustomer" id="KodeCustomer" placeholder="KodeCustomer" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NamaCustomer" id="NamaCustomer" placeholder="NamaCustomer" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NoTlp <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NoTlp" id="NoTlp" placeholder="NoTlp" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Email" id="Email" placeholder="Email" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="FullAddress" id="FullAddress" placeholder="FullAddress" class="form-control " readonly="">
            </div>
            <a id="Koordinat" name="Koordinat" href = '' target='_blank'>Lihat di map</a>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Verifikasi ? <span class="required">*</span>
            </label>
            <div class="col-md-5 col-sm-5 ">
              <input type="checkbox" name="verifikasi" id="verifikasi" class="form-control" value="0">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Keterangan" id="Keterangan" placeholder="Keterangan" class="form-control " >
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_Konfirmasi">Save</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_Reject">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Reject Registrasi Customer</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_Reject" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="KodeCustomer_Reject" id="KodeCustomer_Reject" placeholder="KodeCustomer" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NamaCustomer_Reject" id="NamaCustomer_Reject" placeholder="NamaCustomer" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NoTlp <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NoTlp_Reject" id="NoTlp_Reject" placeholder="NoTlp" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Email" id="Email_Reject" placeholder="Email_Reject" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="FullAddress_Reject" id="FullAddress_Reject" placeholder="FullAddress" class="form-control " readonly="">
            </div>
            <a id="Koordinat_Reject" name="Koordinat_Reject" href = '' target='_blank'>Lihat di map</a>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Keterangan_Reject" id="Keterangan_Reject" placeholder="Keterangan" class="form-control " >
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_Reject">Save</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_Mitra">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Registrasi Mitra Estock</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_Mitra" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="KodeCustomer_Mitra" id="KodeCustomer_Mitra" placeholder="KodeCustomer" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Customer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NamaCustomer_Mitra" id="NamaCustomer_Mitra" placeholder="NamaCustomer" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NoTlp <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NoTlp_Mitra" id="NoTlp_Mitra" placeholder="NoTlp" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Email_Mitra" id="Email_Mitra" placeholder="Email" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="FullAddress_Mitra" id="FullAddress_Mitra" placeholder="FullAddress" class="form-control " readonly="">
            </div>
            <a id="Koordinat_Mitra" name="Koordinat_Mitra" href = '' target='_blank'>Lihat di map</a>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jadikan Mitra ? <span class="required">*</span>
            </label>
            <div class="col-md-5 col-sm-5 ">
              <input type="checkbox" name="isMitra" id="isMitra" class="form-control" value="0">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Potongan RP <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input required="" type="number" name="PotonganRupiah" id="PotonganRupiah" placeholder="Potongan Rupiah" class="form-control " value="0">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Potongan % <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input required="" type="number" name="PotonganPersen" id="PotonganPersen" placeholder="Potongan Persen" class="form-control " value="0">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Keterangan_Mitra" id="Keterangan_Mitra" placeholder="Keterangan" class="form-control " >
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_Mitra">Save</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->

    </div>
  </div>
</div>
<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<script type="text/javascript">
  var _URL = window.URL || window.webkitURL;
    var _URLePub = window.URL || window.webkitURL;
  $(function () {
    $(document).ready(function () {
      var where_field = '';
      var where_value = '';
      var table = 'users';

      $.ajax({
        type: "post",
        url: "<?=base_url()?>C_Customer/Read",
        data: {'id':''},
        dataType: "json",
        success: function (response) {
          bindGrid(response.data);
        }
      });
    });
    $('#verifikasi').click(function () {
      if ($("#verifikasi").prop("checked") == true) {
        $('#verifikasi').val("1");
      }
      else{
        $('#verifikasi').val("0"); 
      }
    });

    $('#isMitra').click(function () {
      if ($("#isMitra").prop("checked") == true) {
        $('#isMitra').val("1");
      }
      else{
        $('#isMitra').val("0"); 
      }
    });

    $('#post_').submit(function (e) {
      $('#btn_Save').text('Tunggu Sebentar.....');
      $('#btn_Save').attr('disabled',true);

      var KodeCustomer = $('#KodeCustomer').val();
      var Remark = $('#Remark').val();
      var StatusVerifikasi = $('#verifikasi').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_Customer/verifikasiCustomer',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_Konfirmasi').modal('toggle');
            Swal.fire({
              type: 'success',
              title: 'Horay..',
              text: 'Data Berhasil disimpan!',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
          else{
            $('#modal_Konfirmasi').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_Konfirmasi').modal('show');
              $('#btn_Save').text('Save');
              $('#btn_Save').attr('disabled',false);
            });
          }
        }
      });
    });

    $('#post_Reject').submit(function (e) {
      $('#btn_Reject').text('Tunggu Sebentar.....');
      $('#btn_Reject').attr('disabled',true);

      var KodeCustomer = $('#KodeCustomer').val();
      var Remark = $('#Remark').val();
      var StatusVerifikasi = $('#verifikasi').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_Customer/RejectCustomer',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_Reject').modal('toggle');
            Swal.fire({
              type: 'success',
              title: 'Horay..',
              text: 'Data Berhasil disimpan!',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
          else{
            $('#modal_Reject').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_Reject').modal('show');
              $('#btn_Reject').text('Save');
              $('#btn_Reject').attr('disabled',false);
            });
          }
        }
      });
    });

    $('#post_Mitra').submit(function (e) {
      $('#btn_Mitra').text('Tunggu Sebentar.....');
      $('#btn_Mitra').attr('disabled',true);

      var KodeCustomer = $('#KodeCustomer_Mitra').val();
      var isMitra = $('#isMitra').val();
      var PotonganRupiah = $('#PotonganRupiah').val();
      var PotonganPersen = $('#PotonganPersen').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_Customer/setMitra',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_Mitra').modal('toggle');
            Swal.fire({
              type: 'success',
              title: 'Horay..',
              text: 'Data Berhasil disimpan!',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
          else{
            $('#modal_Mitra').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_Mitra').modal('show');
              $('#btn_Mitra').text('Save');
              $('#btn_Mitra').attr('disabled',false);
            });
          }
        }
      });
    });

    $('.close').click(function() {
      location.reload();
    });

    $("#Attachment").change(function(){
      var file = $(this)[0].files[0];
      img = new Image();
      img.src = _URL.createObjectURL(file);
      var imgwidth = 0;
      var imgheight = 0;
      img.onload = function () {
        imgwidth = this.width;
        imgheight = this.height;
        $('#width').val(imgwidth);
        $('#height').val(imgheight);
      }
      readURL(this);
      encodeImagetoBase64(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
          
        reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    function encodeImagetoBase64(element) {
      $('#picture_base64').val('');
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
          // $(".link").attr("href",reader.result);
          // $(".link").text(reader.result);
          $('#picture_base64').val(reader.result);
        }
        reader.readAsDataURL(file);
    }
    function bindGrid(data) {

      $("#gridContainer").dxDataGrid({
        allowColumnResizing: true,
            dataSource: data,
            keyExpr: "KodeCustomer",
            showBorders: true,
            allowColumnReordering: true,
            allowColumnResizing: true,
            columnAutoWidth: true,
            showBorders: true,
            paging: {
                pageSize: 10
            },
            pager: {
                visible: true,
                allowedPageSizes: [5, 10, 'all'],
                showPageSizeSelector: true,
                showInfo: true,
                showNavigationButtons: true
            },
            editing: {
                mode: "row",
                texts: {
                    confirmDeleteMessage: ''  
                }
            },
            searchPanel: {
                visible: true,
                width: 240,
                placeholder: "Search..."
            },
            export: {
                enabled: true,
                fileName: "Daftar Artikel Warna"
            },
            columns: [
                {
                    dataField: "KodeCustomer",
                    caption: "Kode Customer",
                    allowEditing:false
                },
                {
                    dataField: "NamaCustomer",
                    caption: "Nama Customer",
                    allowEditing:false
                },
                {
                    dataField: "NoTlp",
                    caption: "No. Tlp",
                    allowEditing:false
                },
                {
                    dataField: "Email",
                    caption: "Email",
                    allowEditing:false
                },
                {
                    dataField: "ContactPerson",
                    caption: "CP",
                    allowEditing:false
                },
                {
                    dataField: "NamaTermin",
                    caption: "Termin",
                    allowEditing:false
                },
                {
                  dataField: "FileItem",
                  caption : "Alamat",
                  allowEditing : false,
                  cellTemplate: function(cellElement, cellInfo) {
                    var html = "";
                    html += "<a href = 'https://maps.google.com/?q="+cellInfo.data.Koordinat+"' target='_blank'> "+cellInfo.data.FullAddress+" </a>";
                    cellElement.append(html);
                  }
                },
                {
                    dataField: "Koordinat",
                    caption: "Koordinat",
                    allowEditing:false,
                    visible : false
                },
                {
                    dataField: "Mitra",
                    caption: "Mitra ?",
                    allowEditing:false,
                },
                {
                    dataField: "SaldoPiutang",
                    caption: "Piutang",
                    allowEditing:false,
                },
                {
                    dataField: "PotonganPersen",
                    caption: "Pot. %",
                    allowEditing:false,
                },
                {
                    dataField: "PotonganRupiah",
                    caption: "Pot. Rp",
                    allowEditing:false,
                },
                {
                    dataField: "VerifiedName",
                    caption: "Verified",
                    allowEditing:false,
                },
                {
                    dataField: "Verified",
                    caption: "Verified",
                    allowEditing:false,
                    visible:false
                },
                {
                  dataField: "FileItem",
                  caption : "Action",
                  allowEditing : false,
                  cellTemplate: function(cellElement, cellInfo) {
                    var html = "";
                    var x = '"'+cellInfo.data.KodeCustomer+'"';
                    if (cellInfo.data.Verified == "0") {
                      // $('#TempCustCode').val(cellInfo.data.KodeCustomer);
                      html += "<button class='btn btn-round btn-sm btn-success' onClick = 'btAction("+x+",1)'>Verifikasi</button>";
                      html += "<button class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+x+",2)'>Reject</button>";
                    }
                    else{
                      html += "<button class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+x+",3)'>Batal Verifikasi</button>";
                      html += "<button disabled class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+x+",2)'>Reject</button>";
                    }

                    if (cellInfo.data.Mitra == "") {
                      html += "<button class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+x+",4)'>Jadikan Mitra</button>";
                    }
                    else{
                      html += "<button class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+x+",5)'>Batal Jadikan Mitra</button>";
                    }
                    cellElement.append(html);
                  }
                }
            ],
        });
    
        // add dx-toolbar-after
        // $('.dx-toolbar-after').append('Tambah Alat untuk di pinjam ');
    }
  });
  
  function btAction(id, action) {
    // 1 verifikasi
    // 2 Batal Verifikasi
    // 3 Mitra
    // 4 Batal Mitra
    // console.log(id);
    switch(action){
      case 1:
        GetData(id);
        break;
      case 2:
        GetData_Reject(id);
        break;
      case 3 :
        GetData(id);
        break;
      case 4:
        GetData_Mitra(id);
        break;
      case 5:
        GetData_Mitra(id);
        break;
    }
  }
  function GetData(id) {
    // console.log(id);
    var where_field = 'id';
    var where_value = id;
    var table = 'users';
    $.ajax({
      type: "post",
      url: "<?=base_url()?>C_Customer/Read",
      data: {'KodeCustomer':id},
      dataType: "json",
      success: function (response) {
        // console.log(response)
        $.each(response.data,function (k,v) {
          $('#KodeCustomer').val(v.KodeCustomer);
          $('#NamaCustomer').val(v.NamaCustomer);
          $('#NoTlp').val(v.NoTlp);
          $('#Email').val(v.Email);
          $('#FullAddress').val(v.FullAddress);
          $('#Koordinat').attr('href', "https://maps.google.com/?q=" +v.Koordinat);

          if (v.Verified == "1") {
            $("#verifikasi").prop('checked', true);
          }
          else{
            $("#verifikasi").prop('checked', false);
          }

        });
        $('#modal_Konfirmasi').modal('show');
      }
    });
  }
  function GetData_Reject(id) {
    // console.log(id);
    var where_field = 'id';
    var where_value = id;
    var table = 'users';
    $.ajax({
      type: "post",
      url: "<?=base_url()?>C_Customer/Read",
      data: {'KodeCustomer':id},
      dataType: "json",
      success: function (response) {
        // console.log(response)
        $.each(response.data,function (k,v) {
          $('#KodeCustomer_Reject').val(v.KodeCustomer);
          $('#NamaCustomer_Reject').val(v.NamaCustomer);
          $('#NoTlp_Reject').val(v.NoTlp);
          $('#Email_Reject').val(v.Email);
          $('#FullAddress_Reject').val(v.FullAddress);
          $('#Koordinat_Reject').attr('href', "https://maps.google.com/?q=" +v.Koordinat);
          

        });
        $('#modal_Reject').modal('show');
      }
    });
  }
  function GetData_Mitra(id) {
    // console.log(id);
    var where_field = 'id';
    var where_value = id;
    var table = 'users';
    $.ajax({
      type: "post",
      url: "<?=base_url()?>C_Customer/Read",
      data: {'KodeCustomer':id},
      dataType: "json",
      success: function (response) {
        // console.log(response)
        $.each(response.data,function (k,v) {
          $('#KodeCustomer_Mitra').val(v.KodeCustomer);
          $('#NamaCustomer_Mitra').val(v.NamaCustomer);
          $('#NoTlp_Mitra').val(v.NoTlp);
          $('#Email_Mitra').val(v.Email);
          $('#FullAddress_Mitra').val(v.FullAddress);
          $('#Koordinat_Mitra').attr('href', "https://maps.google.com/?q=" +v.Koordinat);
          $('#PotonganPersen').val(v.PotonganPersen);
          $('#PotonganRupiah').val(v.PotonganRupiah);

          if (v.Mitra == "MITRA") {
            $("#isMitra").prop('checked', true);
          }
          else{
            $("#isMitra").prop('checked', false);
          }
        });
        $('#modal_Mitra').modal('show');
      }
    });
  }
</script>