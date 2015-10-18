<div class="container" id="mycontent">
			<div class="row">
				
				<!--<div class="col-md-12 banner-top">
					<span class="testbenner">Ini adalah banner responsive</span>
				</div>-->
				
				<div class="col-md-3 col-lg-3" style="margin-bottom:10px">
					<div class="login-left">
						<h4>LOGIN</h4>
						<form class="form-login">
								<input type="text" class="" name="username" placeholder="username" >
								<input type="password" class="" name="password" placeholder="password" >
							<button>LOGIN</button><button>Forget Pass</button><br />
							<a href="#"  class="btn-new-account"><span>Create New Account</span></a>
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
							<div class="col-md-12">
                            	<?= $this->home_model->get_page_content(4) ?>
							</div>
						</div>
					
				</div>
			</div>
		</div>