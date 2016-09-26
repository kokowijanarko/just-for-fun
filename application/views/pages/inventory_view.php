<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title> Data Inventaris </title>

		<meta name="description" content="Inventaris &amp; Barang" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/theme/ac_master/css/datepicker.min.css" />
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
								Tampil Data
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Inventaris
								</small>
							</h1>
						</div><!-- /.page-header -->
						
						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" action="<?php echo $url ?>" role="form" method = "POST">
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tahun Pengadaan </label>
										<div class="col-xs-10 col-sm-4">
											<div class="input-group">
												<input class="form-control date-picker" name="year" id="date-picker"  type="text" data-date-format="yyyy" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group" id='month'>
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bulan Pengadaan </label>
										<div class="col-xs-10 col-sm-4">
											<div class="input-group">
												<input class="form-control date-picker" name="month" id="date-picker-month"  type="text" data-date-format="mm" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</div>
									</div>									
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> Sumber Dana </label>
										<div class="col-sm-9">
											<select name="fund" class="col-xs-10 col-sm-5" id="fund">
												<option value="all">--Semua--</option>
												<?php foreach ($fund as $val) { ?>
													<option value="<?php echo $val->fund_id; ?>"> <?php echo $val->fund_name; ?> </option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> Tempat Penyimpanan / Penggunaan </label>
										<div class="col-sm-9">
											<select name="storage" class="col-xs-10 col-sm-5" id="fund">
												<option value="all">--Semua--</option>
												<?php foreach ($storage as $val) { ?>
													<option value="<?php echo $val->inv_id; ?>"> <?php echo $val->inv_name .'|'. $val->inv_number; ?> </option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div id="fg-class" class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> Golongan </label>
										<div class="col-sm-9">
											<select name="class" class="col-xs-10 col-sm-5" id="class">
												<option value="all">--Semua--</option>
												<?php foreach ($class as $val) { ?>
													<option value="<?php echo $val->class_id; ?>"> <?php echo $val->class_name; ?> </option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div id="fg-category" class="form-group hide">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> Kategori </label>
										<div class="col-sm-9">
											<select name="category" class="col-xs-10 col-sm-5" id="category">
												<option value="all">--Semua--</option>										
											</select>
										</div>
									</div>
									<div id="fg-group" class="form-group hide">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> Group </label>
										<div class="col-sm-9">
											<select name="group" class="col-xs-10 col-sm-5" id="group">
												<option value="all">--Semua--</option>										
											</select>
										</div>
									</div>
									<div id="fg-type" class="form-group hide">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> Tipe </label>
										<div class="col-sm-9">
											<select name="type" class="col-xs-10 col-sm-5" id="tipe">
												<option value="all">--Semua--</option>									
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Submit
										</button>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
								
								<div class="row">
									<?php 
											isset($message)? print_r($message):null;
											// var_dump($filter);
											if(isset($report)){
												$rep_class = '';
												$act_class = 'hide';
											}else{
												$rep_class = 'hide';
												$act_class = '';
											}
										?>	
									<div class="col-xs-12 <?php echo $rep_class ?>">
										<div style="float:right">
											<a href='<?php echo site_url('report_inventory/print_report/'.$filter['class_id'].'/'.$filter['category_id'].'/'.$filter['group_id'].'/'.$filter['type_id'].'/'.$filter['period']);?>' target="_blank">
												<button class="btn btn-success">
													Cetak Laporan
												</button>
											</a>
											<a href='<?php echo site_url('report_inventory/print_inv_label/'.$filter['class_id'].'/'.$filter['category_id'].'/'.$filter['group_id'].'/'.$filter['type_id'].'/'.$filter['period']);?>' target="_blank">
												<button class="btn btn-success">
													Cetak Kode Inv.
												</button>
											</a>
										</div>
									</div>
									<br>
									<br>
									<br>
									<div class="col-xs-12">
													
										
										
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>													
													<th width="25px"> No</th>
													<th> Inventaris </th>
													<th> Golongan </th>
													<th> Kategori</th>
													<th> Group</th>
													<th> Tipe</th>
													<th> Lokasi</th>
													<th> Lokasi Penyimpanan</th>
													<th> Sumber Dana</th>
													<th> Tanggal Pengadaan </th>
													<th> Tanggal Kedaluarsa </th>
													<th> Keterangan </th>
													<th class="<?php echo $act_class ?>"> Aksi </th>
												</tr>
											</thead>

											<tbody>
											<?php $no=1; foreach ($inven as $invens) { ?>
													<td><?php echo $no; ?></td>
													<td><?php echo $invens->inv_name .' | '. $invens->inv_number; ?></td>
													<td><?php echo $invens->class; ?></td>
													<td><?php echo $invens->category; ?></td>
													<td><?php echo $invens->group; ?></td>
													<td><?php echo $invens->type; ?></td>
													<td><?php echo $invens->store_place_in_use; ?></td>
													<td><?php echo $invens->store_place_after_use; ?></td>
													<td><?php echo $invens->fund; ?></td>
													<td><?php echo $invens->inv_date; ?></td>
													<td><?php echo $invens->date_expired; ?></td>
													<td><?php echo $invens->desc; ?></td>

													<td class="<?php echo $act_class ?>">
														<div class="hidden-sm hidden-xs btn-group">
															<a href="<?php echo site_url('inventory/edit_inventory/'.$invens->inv_id);?>">
																<button class="btn btn-xs btn-info">
																	<i class="ace-icon fa fa-pencil bigger-120"></i>
																</button>
															</a>
															
															<a href="<?php echo site_url('inventory/delete_inventory/'.$invens->inv_id);?>">
																<button class="btn btn-xs btn-danger">
																	<i class="ace-icon fa fa-trash-o bigger-120"></i>
																</button>
															</a>	
														</div>
													</td>
												</tr>
												
												<?php $no++;} ?>
											</tbody>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->								
							</div><!-- /.col -->
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
				$('#month').addClass('hide');
				$('#date-picker').datepicker({
					viewMode: "years", 
					minViewMode: "years",
					autoclose: true
				})
				$('#date-picker').change(function(){
					$('#month').removeClass('hide');
					var year = $('#date-picker').val();
					console.log(year);
					
					$('#date-picker-month').datepicker({
					viewMode: "months", 
					minViewMode: "months",
					yearRange: '2015:2017',
					autoclose: true
				})
				})
				
				
					
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
						$('#category').append('<option value="all">--Semua--</option>');
						if(result){
							result = JSON.parse(result);
							console.log(result);		
							for(idx=0; idx<result.length; idx++){
								$('#category').append('<option value="'+result[idx]['category_id']+'">'+result[idx]['category_name']+'</option>');
							}
						}
						
					});
					$('#fg-category').removeClass('hide');
					
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
						$('#group').append('<option value="all">--Semua--</option>');
						if(result){
							result = JSON.parse(result);
							console.log(result);		
							for(idx=0; idx<result.length; idx++){
								$('#group').append('<option value="'+result[idx]['group_id']+'">'+result[idx]['group_name']+'</option>');
							}							
						}
						
					});
					$('#fg-group').removeClass('hide');
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
						$('#tipe').append('<option value="all">--Semua--</option>');
						if(result){
							result = JSON.parse(result);
							console.log(result);
		
							for(idx=0; idx<result.length; idx++){
								$('#tipe').append('<option value="'+result[idx]['type_id']+'">'+result[idx]['type_name']+'</option>');
							}							
						}
						
					});
					$('#fg-type').removeClass('hide');
				})
				
				//initiate dataTables plugin
				var oTable1 = 
				$('#dynamic-table')
				.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					
					"aaSorting": [],
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
				//oTable1.fnAdjustColumnSizing();
			
			
				//TableTools settings
				TableTools.classes.container = "btn-group btn-overlap";
				TableTools.classes.print = {
					"body": "DTTT_Print",
					"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
					"message": "tableTools-print-navbar"
				}
			
				//initiate TableTools extension
				var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
					"sSwfPath": "<?php echo base_url()?>assets/theme/ac_master/swf/copy_csv_xls_pdf.swf",
					
					"sRowSelector": "td:not(:last-child)",
					"sRowSelect": "multi",
					"fnRowSelected": function(row) {
						//check checkbox when row is selected
						try { $(row).find('input[type=checkbox]').get(0).checked = true }
						catch(e) {}
					},
					"fnRowDeselected": function(row) {
						//uncheck checkbox
						try { $(row).find('input[type=checkbox]').get(0).checked = false }
						catch(e) {}
					},
			
					"sSelectedClass": "success",
			        "aButtons": [
						{
							"sExtends": "copy",
							"sToolTip": "Copy to clipboard",
							"sButtonClass": "btn btn-white btn-primary btn-bold",
							"sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
							"fnComplete": function() {
								this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
									1500
								);
							}
						},
						
						{
							"sExtends": "csv",
							"sToolTip": "Export to CSV",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
						},
						
						{
							"sExtends": "pdf",
							"sToolTip": "Export to PDF",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
						},
						
						{
							"sExtends": "print",
							"sToolTip": "Print view",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
							
							"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
							
							"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Press <b>escape</b> when finished.</p>",
						}
			        ]
			    } );
				//we put a container before our table and append TableTools element to it
			    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
				
				//also add tooltips to table tools buttons
				//addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
				//so we add tooltips to the "DIV" child after it becomes inserted
				//flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
				setTimeout(function() {
					$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
						var div = $(this).find('> div');
						if(div.length > 0) div.tooltip({container: 'body'});
						else $(this).tooltip({container: 'body'});
					});
				}, 200);
				
				
				
				//ColVis extension
				var colvis = new $.fn.dataTable.ColVis( oTable1, {
					"buttonText": "<i class='fa fa-search'></i>",
					"aiExclude": [0, 6],
					"bShowAll": true,
					//"bRestore": true,
					"sAlign": "right",
					"fnLabel": function(i, title, th) {
						return $(th).text();//remove icons, etc
					}
					
				}); 
				
				//style it
				$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
				
				//and append it to our table tools btn-group, also add tooltip
				$(colvis.button())
				.prependTo('.tableTools-container .btn-group')
				.attr('title', 'Show/hide columns').tooltip({container: 'body'});
				
				//and make the list, buttons and checkboxed Ace-like
				$(colvis.dom.collection)
				.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
				.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
				.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
			
			
				
				///////////////////////////////
				// table checkboxes
				// $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				// select/deselect all rows according to table header checkbox
				// $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					// var th_checked = this.checked;//checkbox inside "TH" table header
					
					// $(this).closest('table').find('tbody > tr').each(function(){
						// var row = this;
						// if(th_checked) tableTools_obj.fnSelect(row);
						// else tableTools_obj.fnDeselect(row);
					// });
				// });
				
				// select/deselect a row when the checkbox is checked/unchecked
				// $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					// var row = $(this).closest('tr').get(0);
					// if(!this.checked) tableTools_obj.fnSelect(row);
					// else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
				// });
				
			
				
				
					$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				// var active_class = 'active';
				// $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					// var th_checked = this.checked;//checkbox inside "TH" table header
					
					// $(this).closest('table').find('tbody > tr').each(function(){
						// var row = this;
						// if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						// else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					// });
				// });
				
				//select/deselect a row when the checkbox is checked/unchecked
				// $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					// var $row = $(this).closest('tr');
					// if(this.checked) $row.addClass(active_class);
					// else $row.removeClass(active_class);
				// });
			
				
			
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
			
			})
		</script>
	</body>
</html>
