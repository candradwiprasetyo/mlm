
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
                    
                    <div class="banner-login">
						<span class="testbenner">
                       	
                            
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#fff; font-size:12px; font-weight:bold;">
  <tr>
    <td>Total Visitor</td>
    <td align="right" style="font-size:20px"><?= $this->access->get_visitor_all() ?></td>
  </tr>
  <tr>
    <td>Total Visit Today</td>
    <td align="right" style="font-size:20px"><?= $this->access->get_visitor_today() ?></td>
  </tr>
  <tr>
    <td>You are visitor</td>
    <td align="right" style="font-size:20px"><?= $this->access->get_visitor_counter($this->session->userdata('visitor')) ?></td>
  </tr>
</table>

                      </span>
				  </div>
					
				</div>
				<div class="col-md-9 col-lg-9" id="maincontent">
						<div class="row">
                        <?php
						if(isset($_GET['did']) && $_GET['did'] == 1){
						?>
                         <div class="form-group">
                                           <div class="message">Reset Password berhasil. Silahkan cek email Anda</div>
                                         </div>
                        <?php
                        
						}if(isset($_GET['err_reset']) && $_GET['err_reset'] == 1){
						?>
                         <div class="form-group">
                                           <div class="message">Email tidak ditemukan </div>
                                         </div>
                        <?php
                        
						}
						
						
						?>
							<div class="col-md-12">
                            <h1>Reset Password</h1>
                           <br />
                                <form action="<?=site_url('register/reset_password')?>" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label>Masukkan Email</label>
                                                            <input required type="text" name="i_email" class="form-control" placeholder="Email" value="" title=""/>
                                                          <input type="hidden" name="i_reveral_id" class="form-control" placeholder="Nama" value="<?= $this->session->userdata('reveral_id') ?>" title=""/>  
                                                            </div>
                                                    </div>
                                                   
                                                </div>
                                                
                                              
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                                                                   </div>
                                                        <div class="form-group">
                                                            <input class="btn button_signup" type="submit" value="RESET PASSWORD"/>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="new_label" style="text-align:right;height:20px;">
                                                           
                                                            </div>
                                                         </div>
                                                         <div class="form-group">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                             
</div>
						</div>
					
				</div>
			</div>
		</div>