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
            <h2>Transaksi Penjualan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-4 col-sm-12  form-group">
              <input type="date" class="form-control" name="TglAwal" id="TglAwal" value="<?php echo date("Y-m-01");?>">
            </div>
            <div class="col-md-4 col-sm-12  form-group">
              <input type="date" class="form-control" name="TglAkhir" id="TglAkhir" value="<?php echo date("Y-m-d");?>">
            </div>
            <div class="col-md-4 col-sm-12  form-group">
              <!-- <input type="date" class="form-control" name="tglAkhirManual" id="tglAkhirManual"> -->
              <button class="btn btn-success" id="searchReport">Search</button>
            </div>
            <div class="col-md-12 col-sm-12  form-group">
              <div class="dx-viewport demo-container">
                <div id="data-grid-demo">
                  <div id="gridContainer">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12  form-group">
              <div class="dx-viewport demo-container">
                <div id="data-grid-demo">
                  <div id="gridContainerDetail">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Alasan Tolak</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_Keterangan" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan Tolak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Keterangan" id="Keterangan" required="" placeholder="Keterangan" class="form-control ">
              <input type="hidden" name="NoTransaksi" id="NoTransaksi" >
              <input type="hidden" name="KodeCustomer" id="KodeCustomer" >
              <input type="hidden" name="Status" id="Status" value="Ditolak">
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_Save">Save</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_Diskon">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambah Diskon</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_Diskon" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Diskon <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="Number" name="Disc" id="Disc" required="" placeholder="Disc" class="form-control " step="0.01">
              <input type="hidden" name="NoTransaksiDiskon" id="NoTransaksiDiskon" >
              <input type="hidden" name="KodeItem" id="KodeItem" >
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_SaveDisc">Save</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->

    </div>
  </div>
</div>
<!-- /page content -->
<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
      $('#searchReport').click();  
    });

    $('#post_Keterangan').submit(function (e) {
      $('#btn_Save').text('Tunggu Sebentar.....');
      $('#btn_Save').attr('disabled',true);

      var NoTransaksi = $('#id').val();
      var KodeCustomer = $('#NamaKategori').val();
      var Keterangan = $('#Keterangan').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()

      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_Transaksi/UpdateStatus',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_').modal('toggle');
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
            $('#modal_').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_').modal('show');
              $('#btn_Save').text('Save');
              $('#btn_Save').attr('disabled',false);
            });
          }
        }
      });
    });

    $('#post_Diskon').submit(function (e) {
      $('#btn_SaveDisc').text('Tunggu Sebentar.....');
      $('#btn_SaveDisc').attr('disabled',true);

      var NoTransaksi = $('#NoTransaksiDiskon').val();
      var KodeItem = $('#KodeItem').val();
      var Disc = $('#Disc').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()

      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_Transaksi/UpdateDiscount',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_Diskon').modal('toggle');
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
            $('#modal_Diskon').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_Diskon').modal('show');
              $('#btn_SaveDisc').text('Save');
              $('#btn_SaveDisc').attr('disabled',false);
            });
          }
        }
      });
    });

    $('#searchReport').click(function () {
      $.ajax({
        type: "post",
        url: "<?=base_url()?>C_Transaksi/ReadHeader",
        data: {'TglAwal':$('#TglAwal').val(),'TglAkhir': $('#TglAkhir').val(), 'StatusTrx' : '', 'KodeCustomer':''},
        dataType: "json",
        success: function (response) {
          bindGrid(response.data);
        }
      });

      $.ajax({
        type: "post",
        url: "<?=base_url()?>C_Transaksi/ReadDetail",
        data: {'NoTransaksi':''},
        dataType: "json",
        success: function (response) {
          bindGridDetail(response.data);
        }
      });
    })
    function bindGrid(data) {

      var dataGrid = $("#gridContainer").dxDataGrid({
        allowColumnResizing: true,
            dataSource: data,
            keyExpr: "NoTransaksi",
            showBorders: true,
            allowColumnReordering: true,
            allowColumnResizing: true,
            columnAutoWidth: true,
            showBorders: true,
            paging: {
                enabled: false
            },
            selection:{
              mode: "single"
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
                fileName: "Daftar Transaksi"
            },
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
            columns: [
                {
                    dataField: "NoTransaksi",
                    caption: "NoTransaksi",
                    allowEditing:false
                },
                {
                    dataField: "TglFaktur",
                    caption: "Tgl Faktur",
                    allowEditing:false
                },
                {
                    dataField: "TglJatuhTempo",
                    caption: "Tgl Jatuh Tempo",
                    allowEditing:false
                },
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
                    dataField: "NamaTermin",
                    caption: "Termin",
                    allowEditing:false
                },
                {
                    dataField: "AlamatPengiriman",
                    caption: "Alamat Kirim",
                    allowEditing:false
                },
                {
                    dataField: "PaymentTypeName",
                    caption: "Metode Pembayaran",
                    allowEditing:false
                },
                {
                    dataField: "StatusDocument",
                    caption: "Status",
                    allowEditing:false
                },
                {
                    dataField: "Printed",
                    caption: "Printed",
                    allowEditing:false
                },
                {
                    dataField: "FileItem",
                    caption : "Action",
                    allowEditing : false,
                    cellTemplate: function(cellElement, cellInfo) {
                      var html = "";
                      if (cellInfo.data.StatusDocument == "Open") {
                        html += "<button class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'|'+cellInfo.data.KodeCustomer+'"'+",1)'>Konfirmasi</button>";
                        html += "<button class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'|'+cellInfo.data.KodeCustomer+'"'+",2)'>Tolak</button>";
                      }
                      else{
                        html += "<button disabled class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'|'+cellInfo.data.KodeCustomer+'"'+",1)'>Konfirmasi</button>";
                        html += "<button disabled class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'|'+cellInfo.data.KodeCustomer+'"'+",2)'>Tolak</button>";
                      }

                      if (cellInfo.data.StatusDocument != "Dikonfirmasi") {
                        html += "<button disabled class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'"'+",3)'>Cetak</button>";
                      }
                      else{
                        html += "<button class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'"'+",3)'>Cetak</button>";
                      }

                      cellElement.append(html);
                    }
                  },
            ],
            onEditingStart: function(e) {
                GetData(e.data.id);
            },
            onInitNewRow: function(e) {
              $('#modal_').modal('show');
            },
            onSelectionChanged:function (e) {
              var currentselectedrow = e.currentSelectedRowKeys;
              // console.log(e.selectedRowsData[0].Printed);
              $.ajax({
                type: "post",
                url: "<?=base_url()?>C_Transaksi/ReadDetail",
                data: {'NoTransaksi':currentselectedrow[0]},
                dataType: "json",
                success: function (response) {
                  bindGridDetail(response.data,e.selectedRowsData[0].Printed);
                }
              });
              // console.log(currentselectedrow[0]);
            }
        });
        // add dx-toolbar-after
        // $('.dx-toolbar-after').append('Tambah Alat untuk di pinjam ');
    }

    function bindGridDetail(data, Printed) {
      // console.log(Printed);

      var dataGrid = $("#gridContainerDetail").dxDataGrid({
        allowColumnResizing: true,
            dataSource: data,
            keyExpr: "KodeItem",
            showBorders: true,
            allowColumnReordering: true,
            allowColumnResizing: true,
            columnAutoWidth: true,
            showBorders: true,
            paging: {
                enabled: false
            },
            selection:{
              mode: "single"
            },
            editing: {
                mode: "row",
                texts: {
                    confirmDeleteMessage: ''  
                }
            },
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
            columns: [
                {
                    dataField: "NoTransaksi",
                    caption: "NoTransaksi",
                    allowEditing:false
                },
                {
                    dataField: "KodeItem",
                    caption: "Kode Item",
                    allowEditing:false,
                },
                {
                    dataField: "NamaItem",
                    caption: "Nama Item",
                    allowEditing:false
                },
                {
                    dataField: "Qty",
                    caption: "Qty",
                    allowEditing:false
                },
                {
                    dataField: "NamaSatuan",
                    caption: "Satuan",
                    allowEditing:false
                },
                {
                    dataField: "Harga",
                    caption: "Harga",
                    allowEditing:false,
                    format:{
                      type:"decimal",
                      // precision:0
                    }
                },
                {
                    dataField: "Disc",
                    caption: "Discount",
                    allowEditing:false
                },
                {
                    dataField: "LineTotal",
                    caption: "Total",
                    allowEditing:false
                },
                {
                    dataField: "FileItem",
                    caption : "Action",
                    allowEditing : false,
                    cellTemplate: function(cellElement, cellInfo) {
                      var html = "";
                      if (Printed == "0") {
                        html += "<button class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'|'+cellInfo.data.KodeItem+'"'+",4)'>Tambah Discount</button>";
                      }
                      else{
                        html += "<button disabled class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoTransaksi+'|'+cellInfo.data.KodeItem+'"'+",4)'>Tambah Discount</button>";
                      }
                      cellElement.append(html);
                    }
                  },
            ],
        });
        // add dx-toolbar-after
        // $('.dx-toolbar-after').append('Tambah Alat untuk di pinjam ');
    }

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
  });
  function btAction(id,action) {
    // 1 : Konfirmasi
    // 2 : Tolak
    // 3 : Print

    var arr = id.split('|');
    var NoTransaksi = arr[0];
    var KodeCustomer = arr[1];
    var KodeItem = arr[1];
    switch(action){
      case 1:
        Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Konfirmasi Pesanan ini ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Konfirmasi'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type    :'post',
              url     : '<?=base_url()?>C_Transaksi/UpdateStatus',
              data    : {'NoTransaksi':NoTransaksi,'KodeCustomer':KodeCustomer,'Status':'Dikonfirmasi','Keterangan':'Pesanan Berhasil dikonfirmasi'},
              dataType: 'json',
              success : function (response) {
                if(response.success == true){
                  Swal.fire(
                  'Horay!',
                  'Transaksi Berhasil dikonfirmasi.',
                  'success'
                ).then((result)=>{
                    // location.reload();
                    $('#searchReport').click();
                  });
              }
                else{
                  Swal.fire({
                    type: 'error',
                    title: 'Woops...',
                    text: response.message,
                    // footer: '<a href>Why do I have this issue?</a>'
                  }).then((result)=>{
                    // location.reload();
                    $('#searchReport').click();
                  });
                }
              }
            });
            
          }
          else{
            location.reload();
          }
        });
      break;
      case 2:
        $('#NoTransaksi').val(NoTransaksi);
        $('#KodeCustomer').val(KodeCustomer);
        $('#modal_').modal('show');
      break;
      case 3:
        Swal.fire({
          title: 'Cetak invoice',
          text: "Cetak invoice no : "+ NoTransaksi + " ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Cetak'
        }).then((result) => {
          if (result.value) {
            var base_url = <?php echo json_encode(base_url()); ?>;
            // window.location = base_url+'localData/template/invoice.php?NoTransaksi=' + NoTransaksi;
            $.ajax({
              type    :'post',
              url     : '<?=base_url()?>C_Transaksi/UpdatePrinted',
              data    : {'NoTransaksi':NoTransaksi},
              dataType: 'json',
              success : function (response) {
                if (response.success == true) {
                  location.reload();
                  window.open(base_url+'localData/template/invoice.php?NoTransaksi=' + NoTransaksi, '_blank').focus();
                }
                else{
                  location.reload();
                }
              }
            });
          }
          else{
            location.reload();
          }
        });
      break;
      case 4:
        $('#NoTransaksiDiskon').val(NoTransaksi);
        $('#KodeItem').val(KodeItem);
        $('#modal_Diskon').modal('show');
      break;
    }
  }
</script>