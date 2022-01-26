<?php
    require_once(APPPATH."views/parts/Header.php");
    require_once(APPPATH."views/parts/Sidebar.php");
    $active = 'dashboard';
?>
<link href="<?php echo base_url();?>Assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12">
			<div class="">
				<div class="x_content">
					<div class="col-md-12 col-sm-12 ">
						<div class="x_panel">
							<div class="x_title">
								<h2>Setting <small>Cut off Transaksi</small></h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
                				<div class="item form-group">
						            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Setting <span class="required">*</span>
						            </label>
						            <div class="col-md-6 col-sm-6 ">
						              <input type="text" name="SettingID" id="SettingID" required="" placeholder="SettingID" class="form-control" readonly="" value="cutoff">
						            </div>
						        </div>

						        <div class="item form-group">
						            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Value Setting <span class="required">*</span>
						            </label>
						            <div class="col-md-6 col-sm-6 ">
						              <input type="time" name="SettingValue" id="SettingValue" required="" class="form-control">
						            </div>
						        </div>
							</div>
						</div>
					</div>

		            <div class="col-md-6 col-sm-12  form-group">
		              <button class="btn btn-success" name="Simpan" id="Simpan">Simpan</button>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
  require_once(APPPATH."views/parts/Footer.php");
?>
<script src="<?php echo base_url();?>Assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo base_url();?>Assets/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="<?php echo base_url();?>Assets/vendors/google-code-prettify/src/prettify.js"></script>

<script type="text/javascript">
	$(function () {
		var html = 'Ready..'
		$(document).ready(function () {
	      $.ajax({
	    		async: false,
		        type: "post",
		        url: "<?=base_url()?>C_Setting/Read",
		        data: {'SettingID':$('#SettingID').val()},
		        dataType: "json",
		        success: function (response) {
		        	if (response.success == true) {
		        		$.each(response.data,function (k,v) {
		        			$('#SettingID').val(v.SettingID);
		        			$('#SettingValue').val(v.SettingValue);
		        		})
		        	}
		        }
		      });
	    });

	    $('#Simpan').click(function () {
	    	var kriteria = '';
	        var skrip = '';
	        var userid = '';
	        var roleid = 4;

	        $('#Simpan').text('Tunggu Sebentar.....');
          	$('#Simpan').attr('disabled',true);

	    	$.ajax({
	    		async: false,
		        type: "post",
		        url: "<?=base_url()?>C_Setting/Add",
		        data: {'SettingID':$('#SettingID').val(),'SettingValue':$('#SettingValue').val()},
		        dataType: "json",
		        success: function (response) {
		        	if (response.success == true) {
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
		        		Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            });
		        		$('#Simpan').text('Simpan');
          				$('#Simpan').attr('disabled',false);
		        	}
		        }
		      });
	    });
	});
</script>