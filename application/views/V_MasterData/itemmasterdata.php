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
                    <h2>Buku</h2>
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

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Item Master Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="post_" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Item <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="text" name="KodeItem" id="KodeItem" required="" placeholder="Kode Item" class="form-control " readonly="">
                      <input type="hidden" name="formtype" id="formtype" value="add">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Item <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="text" name="NamaItem" id="NamaItem" required="" placeholder="Nama Item" class="form-control ">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Deskripsi Item <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <textarea name="Description" id="Description" placeholder="Description" class="form-control"></textarea>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kategori Item <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <select class="form-control" id="KodeKategori" name="KodeKategori">
                        <?php
                          $rs = $this->db->query("select * from tkategori")->result();
                          foreach ($rs as $key) {
                            echo "<option value = '".$key->id."'>".$key->NamaKategori."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Gambar <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="file" id="Attachment" name="Attachment" accept=".jpg" />
                      <img src="" id="profile-img-tag" width="200" />
                      <!-- <textarea id="picture_base64" name="picture_base64"></textarea> -->
                      <textarea id="picture_base64" name="picture_base64" style="display: none;"></textarea>
                      <input type="text" name="ImageLink" id="ImageLink">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Harga <span class="required">*</span>
                    </label>
                    <div class="col-md-5 col-sm-5 ">
                      <input type="text" name="LastPrice" id="LastPrice" required="" placeholder="Harga" class="form-control ">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Harga Lain lain <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="text" name="OtherPrice" id="OtherPrice" required="" placeholder="Harga Lain lain" class="form-control ">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Qty Minimum Beli <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="text" name="QtyMinimum" id="QtyMinimum" required="" placeholder="Qty Minimum" class="form-control ">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Satuan <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                      <select class="form-control" id="KodeSatuan" name="KodeSatuan">
                        <?php
                          $rs = $this->db->query("select * from tsatuan")->result();
                          foreach ($rs as $key) {
                            echo "<option value = '".$key->KodeSatuan."'>".$key->NamaSatuan."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Active ? <span class="required">*</span>
                    </label>
                    <div class="col-md-5 col-sm-5 ">
                      <input type="checkbox" name="StatusPublikasi" id="StatusPublikasi" class="form-control" value="0">
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
<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<script type="text/javascript">
  $(function () {
    var _URL = window.URL || window.webkitURL;
    var _URLePub = window.URL || window.webkitURL;

    $(document).ready(function () {

      var where_field = '';
      var where_value = '';
      var table = 'users';

      $.ajax({
        type: "post",
        url: "<?=base_url()?>C_ItemMasterData/Read",
        data: {'KodeItem':'','script':''},
        dataType: "json",
        success: function (response) {
          bindGrid(response.data);
        }
      });
      $('#StatusPublikasi').click(function () {
        if ($("#StatusPublikasi").prop("checked") == true) {
          $('#StatusPublikasi').val("1");
        }
        else{
          $('#StatusPublikasi').val("0"); 
        }
        console.log($('#StatusPublikasi').val());
      });

    });

    $('#post_').submit(function (e) {
      $('#btn_Save').text('Tunggu Sebentar.....');
      $('#btn_Save').attr('disabled',true);

      var KodeItem = $('#KodeItem').val();
      var NamaItem = $('#NamaItem').val();
      var KodeSatuan = $('#KodeSatuan').val();
      var KodeKategori = $('#KodeKategori').val();
      var LastPrice = $('#LastPrice').val().replace(',','');
      var picture = $('#Attachment').prop('files')[0];
      var OtherPrice = $('#OtherPrice').val().replace(',','');
      var QtyMinimum = $('#QtyMinimum').val().replace(',','');
      var StatusPublikasi = $('#StatusPublikasi').val();
      var formtype = $('#formtype').val();
      var ImageLink = $('#ImageLink').val();

      e.preventDefault();
      // var me = $(this);
      var form_data = new FormData(this);

      console.log(form_data);
      $.ajax({
          type    : 'post',
          url     : '<?=base_url()?>C_ItemMasterData/CRUD',
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

    $('#LastPrice').focus(function () {
      $('#LastPrice').val($('#LastPrice').val().replace(',',''));
    });
    $('#OtherPrice').focusout(function () {
      $('#OtherPrice').val(addCommas($('#OtherPrice').val()));
      // console.log($('#harga').val());
    });

    $('.close').click(function() {
      location.reload();
    });
    function bindGrid(data) {

      $("#gridContainer").dxDataGrid({
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
            editing: {
                mode: "row",
                allowAdding:true,
                allowUpdating: true,
                // allowDeleting: true,
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
                fileName: "Daftar Item Master Data"
            },
            paging: {
                pageSize: 10
            },
            pager: {
                visible: true,
                allowedPageSizes: [5, 10,20,30, 'all'],
                showPageSizeSelector: true,
                showInfo: true,
                showNavigationButtons: true
            },
            columns: [
                {
                    dataField: "KodeItem",
                    caption: "Kode Item",
                    allowEditing:false
                },
                {
                    dataField: "NamaItem",
                    caption: "Nama Item",
                    allowEditing:false
                },
                {
                    dataField: "NamaKategori",
                    caption: "Nama Kategori",
                    allowEditing:false
                },
                {
                    dataField: "LastPrice",
                    caption: "Harga",
                    allowEditing:false
                },
                {
                    dataField: "QtyMinimum",
                    caption: "Qty Minimum Beli",
                    allowEditing:false
                },
                {
                    dataField: "NamaSatuan",
                    caption: "Satuan",
                    allowEditing:false
                },
                {
                    dataField: "StatusPublikasi",
                    caption: "Status",
                    allowEditing:false
                },
            ],
            onEditingStart: function(e) {
                GetData(e.data.KodeItem);
            },
            onInitNewRow: function(e) {
              $.ajax({
                  async:false,
                  type: "post",
                  url: "<?=base_url()?>C_Buku/GetIndex",
                  data: {'Kolom':'KodeItem','Table':'itemmasterdata','Prefix':'1'},
                  dataType: "json",
                  success: function (response) {
                    // bindGrid(response.data);
                    $('#KodeItem').val(response.nomor);
                  }
                });
                $('#modal_').modal('show');
            },
        });

        // add dx-toolbar-after
        // $('.dx-toolbar-after').append('Tambah Alat untuk di pinjam ');
    }

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
  function GetData(id) {
    var where_field = 'id';
    var where_value = id;
    var table = 'users';
    $.ajax({
      type: "post",
      url: "<?=base_url()?>C_ItemMasterData/Read",
      data: {'KodeItem':id},
      dataType: "json",
      success: function (response) {
        $.each(response.data,function (k,v) {
          $('#KodeItem').val(v.KodeItem);
          $('#KodeKategori').val(v.KodeKategori).change();
          $('#NamaItem').val(v.NamaItem);
          $('#Description').val(v.Description);
          $('#LastPrice').val(v.LastPrice);
          $('#OtherPrice').val(v.OtherPrice);
          $('#QtyMinimum').val(v.QtyMinimum);
          $('#KodeSatuan').val(v.KodeSatuan).change();
          $('#ImageLink').val(v.ImageLink);

          if (v.StatusPublikasi == "0") {
            $("#StatusPublikasi").prop('checked', false);
            $("#StatusPublikasi").val("0");
          }
          else{
            $("#StatusPublikasi").prop('checked', true);
            $("#StatusPublikasi").val("1");
          }

          $('#formtype').val("edit");

          $('#modal_').modal('show');
        });
      }
    });
  }
</script>