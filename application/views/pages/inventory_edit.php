<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title> Edit Inventaris </title>

		<meta name="description" content="Inventaris &amp; Barang" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<?php $this->load->view('components/header')?>
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<?php $this->load->view('components/menu')?>
			
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								Edit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Inventaris
								</small>
							</h1>
						</div><!-- /.page-header -->

							<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" action="<?php echo base_url('index.php/inventory/proses_edit_inventory');?>" role="form" method = "POST">
									<input type="hidden" name="id_inventory" value="<?php echo $inv_res->inv_id?>">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Inventaris </label>
										<div class="col-sm-9">
											<input type="text" name= "nama_inventory" id="form-field-1" placeholder="Nama inventory" class="col-xs-10 col-sm-5" value="<?php echo $inv_res->inv_name?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Pengadaan </label>
										<div class="col-xs-10 col-sm-4">
											<div class="input-group">
												<input class="form-control date-picker" name="tanggal_diterima" id="id-date-picker-1" value="<?php echo date('d-m-Y', strtotime($inv_res->inv_date_procurement))?>" type="text" data-date-format="dd-mm-yyyy" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Kedaluarsa </label>
										<div class="col-xs-10 col-sm-4">
											<div class="input-group">
												<input class="form-control date-picker" name="tanggal_expired" id="date-picker-exp"  value="<?php echo date('d-m-Y', strtotime($inv_res->inv_date_expired))?>"type="text" data-date-format="dd-mm-yyyy" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Golongan </label>
										<div class="col-sm-9">
											<select name="class" class="col-xs-10 col-sm-5" id="class">
												<option value="">--Pilih--</option>
												<?php foreach ($class as $val) {
													$cek='';
													if($val->class_id == $inv_res->inv_class_id){
														$cek='selected';
													}
													echo '<option value="'. $val->class_id .'" '. $cek .'>'. $val->class_name .'</option>';
												 } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kategori </label>
										<div class="col-sm-9">
											<select name="category" class="col-xs-10 col-sm-5" id="category">
												<option value="">--Pilih--</option>
												<?php foreach ($category as $val) {
													$cek='';
													if($val->category_id == $inv_res->inv_category_id){
														$cek='selected';
													}
													echo '<option value="'. $val->category_id .'" '. $cek .'>'. $val->category_name .'</option>';
												 } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Group </label>
										<div class="col-sm-9">
											<select name="group" class="col-xs-10 col-sm-5" id="group">
												<option value="">--Pilih--</option>		
												<?php foreach ($group as $val) {
													$cek='';
													if($val->group_id == $inv_res->inv_group_id){
														$cek='selected';
													}
													echo '<option value="'. $val->group_id .'" '. $cek .'>'. $val->group_name .'</option>';
												 } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipe </label>
										<div class="col-sm-9">
											<select name="tipe" class="col-xs-10 col-sm-5" id="tipe">
												<option value="">--Pilih--</option>	
												<?php foreach ($type as $val) {
													$cek='';
													if($val->type_id == $inv_res->inv_type_id){
														$cek='selected';
													}
													echo '<option value="'. $val->type_id .'" '. $cek .'>'. $val->type_name .'</option>';
												 } ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Lokasi Peggunaan </label>
										<div class="col-sm-9">
											<select name="store_place_in_use" class="col-xs-10 col-sm-5" id="store_place_in_use">
												<option value="">--Pilih--</option>	
												<?php
													foreach($storage as $val){
														$cek='';
														if($val->inv_id == $inv_res->inv_store_place_in_use){
															$cek='selected';
														}
														echo '<option value="'. $val->inv_id .'" '. $cek .'>'. $val->inv_name .'|'. $val->inv_number .'</option>';
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Lokasi Penyimpanan</label>
										<div class="col-sm-9">
											<select name="store_place_after_use" class="col-xs-10 col-sm-5" id="store_place_after_use">
												<option value="">--Pilih--</option>	
												<?php
													foreach($storage as $val){
														$cek='';
														if($val->inv_id == $inv_res->inv_store_place_after_use){
															$cek='selected';
														}
														echo '<option value="'. $val->inv_id .'" '. $cek .'>'. $val->inv_name .'|'. $val->inv_number .'</option>';
													}
												?>												
											</select>
											<label><i>*Jika sudah tidak digunakan</i></label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sumber Dana</label>
										<div class="col-sm-9">
											<select name="fund" class="col-xs-10 col-sm-5" id="fund">
												<option value="">--Pilih--</option>	
												<?php
													foreach($fund as $val){
														$cek='';
														if($val->fund_id == $inv_res->inv_fund_id){
															$cek='selected';
														}
														echo '<option value="'. $val->fund_id .'" '. $cek .'>'. $val->fund_name .'</option>';
													}
												?>												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
										<div class="col-sm-9">
											<textarea name = "deskripsi" class="col-xs-10 col-sm-5" id="form-field-8" placeholder="Default Text"><?php echo $inv_res->inv_desc?></textarea>
										</div>
									</div>
									<div class="space-4"></div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
								</form>
							</div><!-- /.col -->
						</div><!-- /.row -->
					
								<div class="hr hr-18 dotted hr-double"></div>

							</div><!-- /.col -->
						</div><!-- /.row -->
						</div><!-- /.row -->

			<?php $this->load->view('components/footer')?>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url()?>assets/theme/ac_master/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url()?>assets/theme/ac_master/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url()?>assets/theme/ac_master/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/theme/ac_master/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/dataTables.colVis.min.js"></script>

		<script src="<?php echo base_url()?>assets/theme/ac_master/js/bootstrap-datepicker.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url()?>assets/theme/ac_master/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//getStoreInUse();
				//getStoreAfterUse();
				//dinamic input type reference to category
				$('#class').change(function(){
					var class_id = $('#class').val();
					var par = {
						'class_id':class_id	
					}
					$.ajax({
						type:'post',
						url:'<?php echo site_url('inventory/get_cat_by_class')?>',
						data:par
					}).success(function(result){
						console.log(result);
						$('#category').empty();
						$('#category').append('<option value="">---Pilih--</option>');
						if(result){
							result = JSON.parse(result);
							console.log(result);		
							for(idx=0; idx<result.length; idx++){
								$('#category').append('<option value="'+result[idx]['category_id']+'">'+result[idx]['category_name']+'</option>');
							}							
						}
						
					});
				})
				
				$('#category').change(function(){
					var cat_id = $('#category').val();
					var par = {
						'cat_id':cat_id	
					}
					//console.log(par);
					$.ajax({
						type:'post',
						url:'<?php echo site_url('inventory/get_group_by_cat')?>',
						data:par
					}).success(function(result){
						$('#group').empty();
						$('#group').append('<option value="">---Pilih--</option>');
						if(result){
							result = JSON.parse(result);
							console.log(result);		
							for(idx=0; idx<result.length; idx++){
								$('#group').append('<option value="'+result[idx]['group_id']+'">'+result[idx]['group_name']+'</option>');
							}							
						}
						
					});
				})
				$('#group').change(function(){
					var group_id = $('#group').val();
					var par = {
						'group_id':group_id	
					}
					$.ajax({
						type:'post',
						url:'<?php echo site_url('inventory/get_type_by_group')?>',
						data:par
					}).success(function(result){
						$('#tipe').empty();
						$('#tipe').append('<option value="">---Pilih--</option>');
						if(result){
							result = JSON.parse(result);
							console.log(result);
		
							for(idx=0; idx<result.length; idx++){
								$('#tipe').append('<option value="'+result[idx]['type_id']+'">'+result[idx]['type_name']+'</option>');
							}							
						}
						
					});
				})
				
				
				//datepicker plugin
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			});
			
			
			function getStoreAfterUse(){
				var id_type = '<?php echo $inv_res->inv_store_place_after_use?>';
				$.ajax({
					url:'<?php echo site_url('type/get_storage_place')?>'
				}).success(function(result){
					$('#store_place_after_use').empty();
					$('#store_place_after_use').append('<option value="">---Pilih--</option>');
					if(result){
						result = JSON.parse(result);
						console.log(result);
		        
						for(idx=0; idx<result.length; idx++){
							var sel = '';
							if(id_type == result[idx]['type_id']){
								sel = 'selected';
							}
							$('#store_place_after_use').append('<option value="'+result[idx]['type_id']+'" '+ sel +'>'+result[idx]['type_name']+'</option>');
						}							
					}
					
				});
			}
			
			function getStoreInUse(){
				var id_type = '<?php echo $inv_res->inv_store_place_in_use?>';
				$.ajax({
					url:'<?php echo site_url('type/get_storage_place')?>'
				}).success(function(result){
					$('#store_place_in_use').empty();
					$('#store_place_in_use').append('<option value="">---Pilih--</option>');
					if(result){
						result = JSON.parse(result);
						console.log(result);
		        
						for(idx=0; idx<result.length; idx++){
							var sel = '';
							if(id_type == result[idx]['type_id']){
								sel = 'selected';
							}
							$('#store_place_in_use').append('<option value="'+result[idx]['type_id']+'"'+ sel +'>'+result[idx]['type_name']+'</option>');
						}							
					}
					
				});
			}
		</script>
	</body>
</html>
