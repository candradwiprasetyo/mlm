<div class="container" id="mycontent">
			<div class="row">
				
				<!--<div class="col-md-12 banner-top">
					<span class="testbenner">Ini adalah banner responsive</span>
				</div>-->
				
				<div class="col-md-3 col-lg-3" style="margin-bottom:10px">
					<div class="login-left">
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
										   							join cities b on b.city_id  = a.city_id
																	 order by user_id desc limit 5");
										   while($r_n_member = mysql_fetch_array($q_n_member)){
											   ?>
                                            <tr>
                                               
                                                <td><?= $r_n_member['user_name']?></td>
                                                 <td><?= $r_n_member['city_name']?></td>
                                               
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
                        <?php
						if(isset($_GET['did']) && $_GET['did'] == 1){
						?>
                         <div class="form-group">
                                           <div class="message">Thanks for signing up.</div>
                                         </div>
                        <?php
                        
						}
						
						?>
							<div class="col-md-12">
                            <h1>Join Us</h1>
                           <br />
                                <form action="<?=site_url('register/signup')?>" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Nama</label>
                                                            <input required type="text" name="i_name" class="form-control" placeholder="Nama" value="" title=""/>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Telepon</label>
                                                            <input required type="text" name="i_phone" class="form-control" placeholder="Telepon" value="" title=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                  
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Kota</label>
                                                              <select id="basic" name="i_city_id" size="1" class="selectpicker show-tick form-control" data-live-search="true" />
                                           <?php
										   $q_city = mysql_query("select * from cities order by city_name");
                                           while($r_city = mysql_fetch_array($q_city)){
                                            ?>
                                             <option value="<?= $r_city['city_id'] ?>"><?= $r_city['city_name']?></option>
                                             <?php
                                             }
                                             ?>
                                           </select>          
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Foto</label>
                                                           
                                                        <input type="file" name="i_img" id="i_img" />
                                                            </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Email</label>
                                                            <input required type="text" name="i_email" class="form-control" placeholder="Email" value="" title=""/>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Password</label>
                                                            <input required type="password" name="i_password" class="form-control" placeholder="Password" value="" title=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                                                                   </div>
                                                        <div class="form-group">
                                                            <input class="btn button_signup" type="submit" value="SIGN UP"/>
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