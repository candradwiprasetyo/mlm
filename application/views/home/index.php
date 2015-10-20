<div class="container" id="mycontent">
			<div class="row">
				
				<!--<div class="col-md-12 banner-top">
					<span class="testbenner">Ini adalah banner responsive</span>
				</div>-->
				
				<div class="col-md-3 col-lg-3" style="margin-bottom:10px">
					<div class="login-left">
                    	<?php
						if(isset($_GET['err']) && $_GET['err'] == 1){
						?>
                        <div class="err_message">Email atau password salah !</div>
                        <?php
						}
						?>
                        <div></div>
						<h4>LOGIN</h4>
							<form action="<?=site_url('home/login')?>" method="post" enctype="multipart/form-data" class="form-login">
								<input type="text" class="" name="i_email" placeholder="Email" >
								<input type="password" class="" name="i_password" placeholder="Password" >
							<button>LOGIN</button><br />
							<a href="<?=site_url('register')?>"  class="btn-new-account"><span>Create New Account</span></a>
						</form>
					</div>
					
					<div class="banner-login">
						<span class="testbenner">
                        	<h4>New Member</h4>
                            
                              <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr bgcolor="#63b5ad" style="color:#fff;">
                                                
                                                <th>Name</th>
                                               <th>City</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   $no = 1;
										   $q_n_member = mysql_query("select a.*, b.city_name from users a
										   							left join cities b on b.city_id  = a.city_id
																	where user_type_id = 2
																	 order by user_id desc limit 5");
										   while($r_n_member = mysql_fetch_array($q_n_member)){
											   ?>
                                            <tr>
                                               
                                                <td><?= $r_n_member['user_name']?></td>
                                                 <td><?= ($r_n_member['city_name']) ? $r_n_member['city_name'] : $r_n_member['other_city_name']?></td>
                                               
                                            </tr>
                                           <?php 
										   $no++;
										   } 
										   ?>
                                            

                                           
                                          
                                        </tbody>
                                        <!--
                                          <tfoot>
                                            <tr>
                                                <td colspan="4"><a href="<?= $data_head['add_button'] ?>" class="btn btn-success " >Add</a></td>
                                               
                                            </tr>
                                        </tfoot>
                                        -->
                                    </table>
                        </span>
					</div>
					
				</div>
				<div class="col-md-9 col-lg-9" id="maincontent">
						<div class="row">
							<div class="col-md-12">
							  	<?= $this->home_model->get_page_content(1) ?>
							</div>
						</div>
                        <!--
					<div class="row marketing-section">
						<div class="col-md-12">
                        <div class="strategy_title">
                        <h3>Our Strategy Marketing</h3>
                        </div>
                        </div>
						<div class="col-md-4 col-sm-4 list-startegy">
							<h3>Build Base</h3>
							<p>building base for lorem epsum dolor sti amet lorem epsum dolor sit amet</p>
						</div>
						<div class="col-md-4 col-sm-4 list-startegy">
							<h3>Build Base</h3>
							<p>building base for lorem epsum dolor sti amet lorem epsum dolor sit amet</p>
						</div>
						<div class="col-md-4 col-sm-4 list-startegy">
							<h3>Build Base</h3>
							<p>building base for lorem epsum dolor sti amet lorem epsum dolor sit amet</p>
						</div>
						<div class="col-md-12 count-user">
								<h2>13,500</h2>
							<span>Already Join our Affiliate , <a href="#">JOIN NOW</a></span>
						</div>
					</div>
                    
						<div class="row">
							<div class="col-md-6 news-section">
								<h3>NEWS</h3>
								<ul class="list-news">
									<li><a href="#">Juan mendapat 1jt rupiah dari pt. X</a><span class="list-news-time">1hr ago</span></li>
									<li><a href="#">PT. DBSXX berhasil meraup untung banyak</a><span class="list-news-time">3hr ago</span></li>
									<li><a href="#">Kancil seoarang yang ulung</a><span class="list-news-time">3hr ago</span></li>
									<li><a href="#">Juan mendapat 1jt rupiah dari pt. X</a><span class="list-news-time">3hr ago</span></li>
									<li><a href="#">Juan mendapat 1jt rupiah dari pt. X</a><span class="list-news-time">3hr ago</span></li>
									<li><a href="#">Juan mendapat 1jt rupiah dari pt. X</a><span class="list-news-time">3hr ago</span></li>
									<li><a href="#">Juan mendapat 1jt rupiah dari pt. X</a><span class="list-news-time">1day ago</span></li>
									<li><a href="#"><span class="btn-news">VIEW ALL</span></a></li>
								</ul>
							</div>
							<div class="col-md-6 news-section">
								<h3>User Activity</h3>
								<ul class="list-news">
									<li><a href="#">Xdrake just join</a><span class="list-news-time">just now</span></li>
									<li><a href="#">Drek just join</a><span class="list-news-time">just now</span></li>
									<li><a href="#">Fahri Got $7</a><span class="list-news-time">1min ago</span></li>
									<li><a href="#">Buaya PF $200</a><span class="list-news-time">1min ago</span></li>
									<li><a href="#">Buaya PF $200</a><span class="list-news-time">1min ago</span></li>
									<li><a href="#">Buaya PF $200</a><span class="list-news-time">1min ago</span></li>
									<li><a href="#">Buaya PF $200</a><span class="list-news-time">1min ago</span></li>
									<li><a href="#"><span class="btn-news">VIEW ALL</span></a></li>
								</ul>
							</div>
						</div>
                        -->
				</div>
			</div>
		</div>