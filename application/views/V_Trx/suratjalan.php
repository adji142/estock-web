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
            <h2>Surat Jalan</h2>
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

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_kirim">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Kirim Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_kirim" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Faktur <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NoFaktur" id="NoFaktur" required="" placeholder="NoFaktur" class="form-control" readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat Kirim <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="AlamatKirim" id="AlamatKirim" required="" placeholder="AlamatKirim" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Koordinat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Koordinat" id="Koordinat" required="" placeholder="Koordinat" class="form-control " readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Expedisi <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NamaExpedisi" id="NamaExpedisi" required="" placeholder="NamaExpedisi" class="form-control ">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Pol <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NoPol" id="NoPol" required="" placeholder="NoPol" class="form-control ">
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_SaveSuratJalan">Save</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div> -->

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_diterima">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Pesanan Diterima</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post_diterima" data-parsley-validate class="form-horizontal form-label-left">
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Surat Jalan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="NoSuratJalan" id="NoSuratJalan" required="" placeholder="NoSuratJalan" class="form-control" readonly="">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Penerima <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="Penerima" id="Penerima" required="" placeholder="Penerima" class="form-control ">
            </div>
          </div>
          <div class="item" form-group>
            <button class="btn btn-primary" id="btn_SaveTerima">Save</button>
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

    $('#post_kirim').submit(function (e) {
      $('#btn_SaveSuratJalan').text('Tunggu Sebentar.....');
      $('#btn_SaveSuratJalan').attr('disabled',true);

      var NoFaktur = $('#NoFaktur').val();
      var NamaExpedisi = $('#NamaExpedisi').val();
      var NoPol = $('#NoPol').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()

      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_SuratJalan/AddSuratJalan',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_kirim').modal('toggle');
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
            $('#modal_kirim').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_kirim').modal('show');
              $('#btn_SaveSuratJalan').text('Save');
              $('#btn_SaveSuratJalan').attr('disabled',false);
            });
          }
        }
      });
    });

    $('#post_diterima').submit(function (e) {
      $('#btn_SaveTerima').text('Tunggu Sebentar.....');
      $('#btn_SaveTerima').attr('disabled',true);

      var NoTransaksi = $('#NoSuratJalan').val();
      var NamaPenerima = $('#NamaPenerima').val();

      e.preventDefault();
      // var me = $(this);

      var form_data = new FormData(this);
      // 'id':$('#id').val(),'NamaKategori':$('#NamaKategori').val(),'ShowHomePage':$('#ShowHomePagex').val(),'formtype':$('#formtype').val()

      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>C_SuratJalan/UpdatePenerima',
        data    : form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success : function (response) {
          if(response.success == true){
            $('#modal_diterima').modal('toggle');
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
            $('#modal_diterima').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: response.message,
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modal_diterima').modal('show');
              $('#btn_SaveTerima').text('Save');
              $('#btn_SaveTerima').attr('disabled',false);
            });
          }
        }
      });
    });

    $('#searchReport').click(function () {
      $.ajax({
        type: "post",
        url: "<?=base_url()?>C_SuratJalan/ReadHeader",
        data: {'TglAwal':$('#TglAwal').val(),'TglAkhir': $('#TglAkhir').val(), 'StatusTrx' : '', 'KodeCustomer':''},
        dataType: "json",
        success: function (response) {
          bindGrid(response.data);
        }
      });

      $.ajax({
        type: "post",
        url: "<?=base_url()?>C_SuratJalan/ReadDetail",
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
            keyExpr: "NoInvoice",
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
                fileName: "Daftar Surat Jalan"
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
                    dataField: "NoInvoice",
                    caption: "No Invoice",
                    allowEditing:false
                },
                {
                    dataField: "TglInvoice",
                    caption: "Tgl Invoice",
                    allowEditing:false
                },
                {
                    dataField: "NoSuratJalan",
                    caption: "No Surat Jalan",
                    allowEditing:false
                },
                {
                    dataField: "TglSuratJalan",
                    caption: "Tgl Surat Jalan",
                    allowEditing:false
                },
                {
                    dataField: "NamaExpedisi",
                    caption: "Nama Expedisi",
                    allowEditing:false
                },
                {
                    dataField: "NoPol",
                    caption: "No. Pol",
                    allowEditing:false
                },
                {
                    dataField: "Printed",
                    caption: "Printed",
                    allowEditing:false
                },
                {
                    dataField: "StatusDocument",
                    caption: "Status Document",
                    allowEditing:false
                },
                {
                    dataField: "FileItem",
                    caption : "Action",
                    allowEditing : false,
                    cellTemplate: function(cellElement, cellInfo) {
                      var html = "";
                      console.log(cellInfo.data.StatusDocument);
                      switch(cellInfo.data.StatusDocument) {
                        case "Dikirim":
                          html += "<button disabled class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",1)'>Kirim</button>";
                          html += "<button class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoSuratJalan+'"'+",2)'>Cetak</button>";
                          html += "<button class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoSuratJalan+'"'+",3)'>Barang diterima</button>";
                        break;
                        case "diterima" :
                          html += "<button disabled class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",1)'>Kirim</button>";
                          html += "<button class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoSuratJalan+'"'+",2)'>Cetak</button>";
                          html += "<button disabled class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoSuratJalan+'"'+",3)'>Barang diterima</button>";
                        break;
                        case "Belum dikirim" :
                          html += "<button class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",1)'>Kirim</button>";
                          html += "<button disabled class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoSuratJalan+'"'+",2)'>Cetak</button>";
                          html += "<button disabled class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoSuratJalan+'"'+",3)'>Barang diterima</button>";
                        break;
                      }

                      // if (cellInfo.data.StatusDocument == "Dikirim" || (cellInfo.data.StatusDocument != "Canceled" && cellInfo.data.StatusDocument != "Belum dikirim")) {
                      //   html += "<button disabled class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",1)'>Kirim</button>";
                      // }
                      // else{
                      //   html += "<button class='btn btn-round btn-sm btn-success' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",1)'>Kirim</button>";
                      // }

                      // if (cellInfo.data.StatusDocument != "Dikirim") {
                      //   html += "<button disabled class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",2)'>Cetak</button>";
                      // }
                      // else{
                      //   html += "<button class='btn btn-round btn-sm btn-warning' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",2)'>Cetak</button>";
                      // }

                      // if (cellInfo.data.StatusDocument != "Canceled") {
                      //   html += "<button disabled class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",3)'>Batalkan</button>";
                      // }
                      // else{
                      //   html += "<button class='btn btn-round btn-sm btn-danger' onClick = 'btAction("+'"'+cellInfo.data.NoInvoice+'"'+",3)'>Batalkan</button>";
                      // }

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
                url: "<?=base_url()?>C_SuratJalan/ReadDetail",
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
                    dataField: "QtyInvoice",
                    caption: "Qty Invoice",
                    allowEditing:false
                },
                {
                    dataField: "QtyKirim",
                    caption: "Qty Kirim",
                    allowEditing:false
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
    // 1 : Dikirim
    // 2 : Cetak
    // 3 : Barang diterima

    var arr = id.split('|');
    var NoTransaksi = arr[0];
    var KodeCustomer = arr[1];
    var KodeItem = arr[1];

    switch(action){
      case 1:
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>C_Transaksi/ReadHeader',
          data    : {'NoTransaksi':id,'KodeCustomer':'','StatusTrx':'','TglAwal':$('#TglAwal').val(),'TglAkhir': $('#TglAkhir').val()},
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $.each(response.data,function (k,v) {
                $('#NoFaktur').val(v.NoTransaksi);
                $('#AlamatKirim').val(v.AlamatPengiriman);
                $('#Koordinat').val(v.ShowMap);

                $('#modal_kirim').modal('show');
              });
            }
            else{
              
            }
          }
        });
      break;
      case 2:
        Swal.fire({
          title: 'Cetak Surat Jalan',
          text: "Cetak Surat Jalan no : "+ NoTransaksi + " ?",
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
              url     : '<?=base_url()?>C_SuratJalan/UpdatePrinted',
              data    : {'NoTransaksi':NoTransaksi},
              dataType: 'json',
              success : function (response) {
                if (response.success == true) {
                  location.reload();
                  window.open(base_url+'localData/template/suratjalan.php?NoTransaksi=' + NoTransaksi, '_blank').focus();
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
      case 3:
        $('#NoSuratJalan').val(id);
        $('#modal_diterima').modal('show');
      break;
      case 4:
        $('#NoTransaksiDiskon').val(NoTransaksi);
        $('#KodeItem').val(KodeItem);
        $('#modal_Diskon').modal('show');
      break;
    }
  }
</script>