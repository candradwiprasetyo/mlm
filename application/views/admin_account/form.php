<script type="text/javascript">

$(document).ready(function(){


    $(".slidingDiv").hide();
	$(".show_hide").show();
	
	/*$('.show_hide').click(function(){
		$(".slidingDiv").slideToggle();
	});*/
	
	

});

function get_show_hide(id){
		//alert("test");
		$(".slidingDiv_"+id).slideToggle();
	}

</script>

<!-- Content Header (Page header) -->
        
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      
                        <!-- right column -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->

                          
                            <div class="title_page"> <?= $data_head['title'] ?></div>
                            

                             <form  class="cmxform" id="createForm" action="<?= $data_head['action']?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="box box-cokelat">
                                
                               
                                <div class="box-body">
                                    
                      
                                       
                                        <div class="col-md-12">
                                      
                                      
                                         <div class="form-group">
                                         <label>My Link</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= @$data['link'] ?>" title="Fill slider title"/>
                                			</div>
                                        
                                        </div>
                                        
                                         <div class="col-md-4">
                                         <div class="form-group">
                                         <label>My Transfer (Rp)</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= number_format($data['my_transfer'], 0, ',', '.') ?>" title="Fill slider title" disabled="disabled" style="text-align:right"/>
                                			</div>
                                        </div>
                                      	
                                        <div class="col-md-4">
                                         <div class="col-md-8">
                                         <div class="form-group">
                                         <label>New Transfer (Rp)</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= number_format($data['new_transfer'], 0, ',', '.') ?>" title="Fill slider title" disabled="disabled" style="text-align:right"/>
                                			</div>
                                            </div>
                                             <div class="col-md-4">
                                         <div class="form-group">
                                         <label>&nbsp;</label>
                                   <a href="<?= $data_head['withdraw']?>" class="btn btn-success" >Withdraw</a>
                                			</div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-4">
                                         <div class="form-group">
                                         <label>Total Transfer (Rp)</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= number_format($data['total_transfer'], 0, ',', '.') ?>" title="Fill slider title" disabled="disabled" style="text-align:right"/>
                                			</div>
                                        </div>
                                        
 										
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                
                                
                            
                            </div><!-- /.box -->
                       </form>
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                    
                    
                     <div class="row">
                        <div class="col-xs-12">
                            
                            
                            <div class="box">
                             
                                <div class="box-body2 table-responsive">
                                   <table id="" class="table table-bordered" style="margin-bottom:0px;">
                                        <thead>
                                            <tr>
                                                <th width="5%">Level</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Transfer</th>
                                                <th>Status</th>
                                               <th>Config</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   
										   $q_member1 = mysql_query("select a.*, b.*, c.city_name
										   							from member_reverals a 
																	join users b on b.user_id = a.user_id
																	join cities c on c.city_id = b.city_id
																	where a.reveral_id = '".$this->session->userdata('user_id')."' and level = 1");
										   while($r_member1 = mysql_fetch_array($q_member1)){
											   
											  $level = 1;
										   ?>
                                            <tr>
                                                <td width="7%"><?= $level?></td>
                                                <?php
                                                $img = ($r_member1['user_img']) ? $r_member1['user_img'] : "default.jpg";
												?>
                                                <td width="8%"><img src="<?= base_url(); ?>assets/images/user/<?= $img ?>" width="30" height="30" /></td>
                                                <td width="17%"><?= $r_member1['user_name']?></td>
                                                <td width="15%"><?= $r_member1['user_login']?></td>
                                                 <td width="10%"><?= $r_member1['user_phone']?></td>
                                                 <td width="20%"><?= $r_member1['city_name']?></td>
                                                 <td width="8%" align="right" ><?= $r_member1['transfer']?></td>
                                                 <td width="5%" ><?= ($r_member1['status']==1) ? "Paid" : "Unpaid"; ?></td>
                                                  <td width="10%" style="text-align:center;">
                                                    <a href="#" class="btn btn-success " onclick="return get_show_hide(<?= $r_member1['member_reveral_id'] ?>)">Show/hide</a>
                                                </td> 
                                            </tr>
                                            
                                             <tr class="slidingDiv_<?= $r_member1['member_reveral_id'] ?>" style="display:none">
                                               <td colspan="9" style="padding:0px;">

										<!-- start level 2 -->
                                        <table id="" class="table table-bordered" style="margin-bottom:0px;">
                                        <tbody>
                                           <?php 
										  
										   $q_member2 = mysql_query("select a.*, b.*, c.city_name
										   							from member_reverals a 
																	join users b on b.user_id = a.user_id
																	join cities c on c.city_id = b.city_id
																	where a.reveral_id = '".$r_member1['user_id']."' and level = 1");
										   while($r_member2 = mysql_fetch_array($q_member2)){
											   $q_member_detail2 = mysql_query("select * from member_reverals 
											   									where reveral_id = '".$this->session->userdata('user_id')."' and user_id = '".$r_member2['user_id']."'");
												$r_member_detail2 = mysql_fetch_array($q_member_detail2);
											    $level = 2;
										   ?>
                                            <tr bgcolor="#fafafa">
                                                <td width="7%">&nbsp;&nbsp;<?= $level?></td>
                                                <?php
                                                $img = ($r_member2['user_img']) ? $r_member2['user_img'] : "default.jpg";
												?>
                                                <td width="8%"><img src="<?= base_url(); ?>assets/images/user/<?= $img ?>" width="30" height="30" /></td>
                                                <td width="17%"><?= $r_member2['user_name']?></td>
                                                <td width="15%"><?= $r_member2['user_login']?></td>
                                                 <td width="10%"><?= $r_member2['user_phone']?></td>
                                                 <td width="20%"><?= $r_member2['city_name']?></td>
                                                 <td width="8%" align="right" ><?= $r_member_detail2['transfer']?></td>
                                                 <td width="5%" ><?= ($r_member_detail2['status']==1) ? "Paid" : "Unpaid"; ?></td>
                                                  <td width="10%" style="text-align:center;">
                                                    <a href="#" class="btn btn-success " onclick="return get_show_hide(<?= $r_member2['member_reveral_id'] ?>)">Show/hide</a>
                                                </td> 
                                            </tr>
                                             <tr class="slidingDiv_<?= $r_member2['member_reveral_id'] ?>" style="display:none">
                                               <td colspan="9" style="padding:0px;">
												
                                        <!-- start level 3 -->
                                        <table id="" class="table table-bordered" style="margin-bottom:0px;">
                                        <tbody>
                                           <?php 
										   
										   $q_member3 = mysql_query("select a.*, b.*, c.city_name
										   							from member_reverals a 
																	join users b on b.user_id = a.user_id
																	join cities c on c.city_id = b.city_id
																	where a.reveral_id = '".$r_member2['user_id']."' and level = 1");
										   while($r_member3 = mysql_fetch_array($q_member3)){
											   $q_member_detail3 = mysql_query("select * from member_reverals 
											   									where reveral_id = '".$this->session->userdata('user_id')."' and user_id = '".$r_member3['user_id']."'");
												$r_member_detail3 = mysql_fetch_array($q_member_detail3);
											   $level = 3;
										   ?>
                                            <tr bgcolor="#f5f5f5">
                                                <td width="7%">&nbsp;&nbsp;&nbsp;&nbsp;<?= $level?></td>
                                                <?php
                                                $img = ($r_member3['user_img']) ? $r_member3['user_img'] : "default.jpg";
												?>
                                                <td width="8%"><img src="<?= base_url(); ?>assets/images/user/<?= $img ?>" width="30" height="30" /></td>
                                                <td width="17%"><?= $r_member3['user_name']?></td>
                                                <td width="15%"><?= $r_member3['user_login']?></td>
                                                 <td width="10%"><?= $r_member3['user_phone']?></td>
                                                 <td width="20%"><?= $r_member3['city_name']?></td>
                                                 <td width="8%" align="right" ><?= $r_member_detail3['transfer']?></td>
                                                 <td width="5%" ><?= ($r_member_detail3['status']==1) ? "Paid" : "Unpaid"; ?></td>
                                                  <td width="10%" style="text-align:center;">
                                                    <a href="#" class="btn btn-success " onclick="return get_show_hide(<?= $r_member3['member_reveral_id'] ?>)">Show/hide</a>
                                                </td> 
                                            </tr>
                                             <tr class="slidingDiv_<?= $r_member3['member_reveral_id'] ?>" style="display:none">
                                               <td colspan="9"  style="padding:0px;">
				
                								 <!-- start level 4 -->
                                        <table id="" class="table table-bordered" style="margin-bottom:0px;">
                                        <tbody>
                                           <?php 
										   
										   $q_member4 = mysql_query("select a.*, b.*, c.city_name
										   							from member_reverals a 
																	join users b on b.user_id = a.user_id
																	join cities c on c.city_id = b.city_id
																	where a.reveral_id = '".$r_member3['user_id']."' and level = 1");
										   while($r_member4 = mysql_fetch_array($q_member4)){
											    $q_member_detail4 = mysql_query("select * from member_reverals 
											   									where reveral_id = '".$this->session->userdata('user_id')."' and user_id = '".$r_member4['user_id']."'");
												$r_member_detail4 = mysql_fetch_array($q_member_detail4);
											   $level = 4;
										   ?>
                                            <tr bgcolor="#f0f0f0">
                                                <td width="7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $level?></td>
                                                <?php
                                                $img = ($r_member4['user_img']) ? $r_member4['user_img'] : "default.jpg";
												?>
                                                <td width="8%"><img src="<?= base_url(); ?>assets/images/user/<?= $img ?>" width="30" height="30" /></td>
                                                <td width="17%"><?= $r_member4['user_name']?></td>
                                                <td width="15%"><?= $r_member4['user_login']?></td>
                                                 <td width="10%"><?= $r_member4['user_phone']?></td>
                                                 <td width="20%"><?= $r_member4['city_name']?></td>
                                                 <td width="8%" align="right" ><?= $r_member_detail4['transfer']?></td>
                                                 <td width="5%" ><?= ($r_member_detail4['status']==1) ? "Paid" : "Unpaid"; ?></td>
                                                  <td width="10%" style="text-align:center;">
                                                    <a href="#" class="btn btn-success " onclick="return get_show_hide(<?= $r_member4['member_reveral_id'] ?>)">Show/hide</a>
                                                </td> 
                                            </tr>
                                             <tr class="slidingDiv_<?= $r_member4['member_reveral_id'] ?>" style="display:none">
                                               <td colspan="9"  style="padding:0px;">
												
                                                <!-- start level 5 -->
                                        <table id="" class="table table-bordered" style="margin-bottom:0px;">
                                        <tbody>
                                           <?php 
										   
										   $q_member5 = mysql_query("select a.*, b.*, c.city_name
										   							from member_reverals a 
																	join users b on b.user_id = a.user_id
																	join cities c on c.city_id = b.city_id
																	where a.reveral_id = '".$r_member4['user_id']."' and level = 1");
										   while($r_member5 = mysql_fetch_array($q_member5)){
											   $q_member_detail5 = mysql_query("select * from member_reverals 
											   									where reveral_id = '".$this->session->userdata('user_id')."' and user_id = '".$r_member5['user_id']."'");
												$r_member_detail5 = mysql_fetch_array($q_member_detail5);
											   $level = 5;
										   ?>
                                            <tr bgcolor="#ebebeb">
                                                <td width="7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $level?></td>
                                                <?php
                                                $img = ($r_member5['user_img']) ? $r_member5['user_img'] : "default.jpg";
												?>
                                                <td width="8%"><img src="<?= base_url(); ?>assets/images/user/<?= $img ?>" width="30" height="30" /></td>
                                                <td width="17%"><?= $r_member5['user_name']?></td>
                                                <td width="15%"><?= $r_member5['user_login']?></td>
                                                 <td width="10%"><?= $r_member5['user_phone']?></td>
                                                 <td width="20%"><?= $r_member5['city_name']?></td>
                                                 <td width="8%" align="right" ><?= $r_member_detail5['transfer']?></td>
                                                 <td width="5%" ><?= ($r_member_detail5['status']==1) ? "Paid" : "Unpaid"; ?></td>
                                                  <td width="10%" style="text-align:center;">
                                                   
                                                </td> 
                                            </tr>
                                           
                                           <?php 
										   
										   }
										   ?>
                                        </tbody>
                                    </table>
                                    <!-- end level 3-->
                                                
                                                </td> 
                                            </tr>
                                           <?php 
										   
										   }
										   ?>
                                        </tbody>
                                    </table>
                                    <!-- end level 4-->
                                                
                                                </td> 
                                            </tr>
                                           <?php 
										   
										   }
										   ?>
                                        </tbody>
                                    </table>
                                    <!-- end level 3-->
                                                
                                                </td> 
                                            </tr>
                                           <?php 
										   
										   }
										   ?>
                                        </tbody>
                                    </table>
                                    <!-- end level 2-->
                                                </td> 
                                            </tr>
                                              
                                            
                                           <?php 
										  
										   }
										   ?>
                                        </tbody>
                                       
                                    </table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                 
               
                </section><!-- /.content -->

                