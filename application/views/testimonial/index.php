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
						 <h1>Testimonial</h1>
                        <div class="col-md-12">
								<ul class="list-testimoni">
                                 <?php
if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
} else {
   $pageno = 1;
}

$query = "SELECT count( a.testimonial_desc) from testimonials a
															left join users b on b.user_id = a.user_id
															where testimonial_status = 1 
															order by testimonial_id ";
$result = mysql_query($query);
$query_data = mysql_fetch_row($result);
$numrows = $query_data[0];

$rows_per_page = 10;
$lastpage      = ceil($numrows/$rows_per_page);

$pageno = (int)$pageno;
if ($pageno > $lastpage) {
   $pageno = $lastpage;
} 
if ($pageno < 1) {
   $pageno = 1;
} 

$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
$query = "select a.testimonial_desc, a.testimonial_date, b.user_name, b.user_img
															from testimonials a
															left join users b on b.user_id = a.user_id
															where testimonial_status = 1 
															order by testimonial_id $limit";
$result = mysql_query($query);
$no_testi = 1;
while($r_testi=mysql_fetch_array($result)){
?>
     
	   
									<li>
										<div class="row part-testimoni" <?php if($no_testi%2==1){ ?>style="background: #F3F7D9;"<?php }else{ ?>style="background: #D9F7D9;"<?php } ?>>
											<div class="col-md-3 col-sm-3 testimoni-imgs">
												<img src="<?= base_url() ?>assets/images/user/<?= $r_testi['user_img'] ?>" class="img img-responsive">
											</div>
											<div class="col-md-9 col-sm-9">
												<span class="testimoni-name"><?= $r_testi['user_name'] ?></span>
												<p class="testimoni-text">
													<?= $r_testi['testimonial_desc'] ?>
												</p>
                                                <span class="testimoni-date"><?= $this->access->format_date($r_testi['testimonial_date']) ?></span>
											</div>
										</div>
									</li>
                                    <?php
									$no_testi++;
									}
									?>
								
								</ul>
							</div>
                            
                            <div class="row">
                            <div class="col-md-6">
                            <?php
if ($pageno == 1) {
   //echo "<div class=\"btn-prev-page\"> FIRST PREV </div>";
} else {
   echo "<div class=\"btn-prev-page\"> <a href='".site_url()."testimonial?pageno=1'>FIRST</a></div> ";
   $prevpage = $pageno-1;
   echo "<div class=\"btn-prev-page\"> <a href='".site_url()."testimonial?pageno=$prevpage'>PREV</a></div> ";
} // if
?>
</div>
<!--//echo "<div class=\"page-content\"> Page $pageno of $lastpage </div> ";-->
<div class="col-md-6">
<?php

if ($pageno == $lastpage) {
   //echo "<div class=\"btn-nex-page\"> NEXT LAST</div> ";
} else {
   $nextpage = $pageno+1;
   echo "<div class=\"btn-nex-page\"><a href='".site_url()."testimonial?pageno=$nextpage'>NEXT</a></div> ";
   echo "<div class=\"btn-nex-page\"><a href='".site_url()."testimonial?pageno=$lastpage'>LAST</a></div> ";
} 

?>
</div>
</div>

                            <!--
							<div class="col-md-12 testimoni-pages">
								<span class="btn-prev-page">Previous page</span>		<span class="btn-nex-page">Next page</span>
							</div>
                            -->
					
				</div>
			</div>
		</div>