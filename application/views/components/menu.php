<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<li class="active">
                        <a href="<?php echo base_url('index.php/home')?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Inventaris </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/inventory/inventory_read')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Lihat Inventory
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/inventory/inventory_add')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Inventaris
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Kondisi </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/Condition/condition_read')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Lihat Kondisi
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/Condition/condition_add')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Kondisi
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Kategori </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/Category/category_read')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Lihat Kategori
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/Category/category_add')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Kategori
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Tipe </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/Type/type_read')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Lihat Tipe
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/Type/type_add')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Tipe
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Riwayat </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/History/history_read')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Lihat Riwayat
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/History/history_add')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Riwayat
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> User </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/User/User_read')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Lihat User
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url('index.php/User/user_add')?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah User
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
						
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
