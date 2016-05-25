<div class="page-header">
							<h1>
								Tables
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Static &amp; Dynamic Tables
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th class="center">
														<label class="pos-rel">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</th>
													<th> ID Tipe </th>
													<th> Kode Tipe </th>
													<th> Nama Tipe </th>
													<th> Keterangan </th>
													<th> Aksi </th>
												</tr>
											</thead>

											<tbody>
											<?php foreach ($typ as $types) { ?>
												<tr>
													<td class="center">
														<label class="pos-rel">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</td>

													<td><?php echo $types->type_id; ?></td>
													<td><?php echo $types->type_code; ?></td>
													<td><?php echo $types->type_name; ?></td>
													<td><?php echo $types->type_desc; ?></td>

													<td>
														<div class="hidden-sm hidden-xs btn-group">
															<a href="<?php echo site_url('Type/type_edit/'.$types->type_id);?>">
																<button class="btn btn-xs btn-info">
																	<i class="ace-icon fa fa-pencil bigger-120"></i>
																</button>
															</a>
															
															<a href="<?php echo site_url('Type/type_delete/'.$types->type_id);?>">
																<button class="btn btn-xs btn-danger">
																	<i class="ace-icon fa fa-trash-o bigger-120"></i>
																</button>
															</a>	
														</div>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->

								<div class="hr hr-18 dotted hr-double"></div>

							</div><!-- /.col -->
						</div><!-- /.row -->
					