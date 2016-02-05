  <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
			  <section class="content_new">
                   
               <div class="callout callout-warning">
                                       
                                        <p>Member berhasil dinonaktifkan</p>
                                    </div>
           
                </section>
        	<?php
				}else if(isset($_GET['did']) && $_GET['did'] == 2){
			?>
             <section class="content_new">
                   
               <div class="callout callout-warning">
                                       
                                        <p>Member berhasil diaktifkan</p>
                                    </div>
           
                </section>
            <?php
				}else if(isset($_GET['did']) && $_GET['did'] == 3){
			?>
             <section class="content_new">
                   
               <div class="callout callout-warning">
                                       
                                        <p>Member berhasil dihapus</p>
                                    </div>
           
                </section>
            <?php
				}else if(isset($_GET['did']) && $_GET['did'] == 4){
            ?>
             <section class="content_new">
                   
               <div class="callout callout-warning">
                                       
                                        <p>Aktivasi member berhasil</p>
                                    </div>
           
                </section>
            <?php
                }
			?>
               
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            
                              <div class="title_page"> <?= $data_head['title'] ?></div>
                            
                            <div class="box">
                             
                                <div class="box-body2 table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <!--
                                                <th>Phone</th>
                                                <th>City</th>
                                                -->
                                                 <th>Status Aktivasi</th>
                                                <th>Status Member</th>
                                                <th>Upline</th>
                                                <th>Downline</th>
                                               <th>Config</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   $no = 1;
										   foreach($list as $row): ?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <?php
                                                $img = ($row['user_img']) ? $row['user_img'] : "default.jpg";
												?>
                                                <td><img src="<?= base_url(); ?>assets/images/user/<?= $img ?>" width="40" height="40" /></td>
                                                <td><?= $row['user_name']?></td>
                                                <td><?= $row['user_login']?></td>
                                                <td><?= $this->access->base64url_decode($row['user_password']) ?></td>
                                                <!--
                                                 <td><?= $row['user_phone']?></td>
                                                 
                                                 <td><?= ($row['city_name']) ? $row['city_name'] : $row['other_city_name']?></td>				
                                                 -->
                                                 <td><?= ($row['activation_status'] == 1) ? "Sudah teraktivasi" : "Belum teraktivasi"; ?></td>
                                                  <td><?= ($row['user_active_status'] == 1) ? "Aktif" :  "Tidak Aktif"  ?></td>
                                                  <td><?= $row['upline_name'];  ?></td>
                                                  
                                                 <td style="text-align:center;">

                                                    <a href="<?= site_url() ?>admin_member/form/<?= $row['user_id']?>" class="btn btn-default" >View</a>
                                                 

                                                </td> 
                                                 <td style="text-align:center;">
                                                 <?php
                                                 if($row['user_active_status'] == 1){
												 ?>
	
                                                     <a href="javascript:void(0)" onclick="confirm_nonactive_member(<?= $row['user_id']; ?>, '<?= site_url().'admin_member/nonactive_member/'; ?>')" class="btn btn-default" >Nonaktifkan</a>
                                                     <?php
												 }else{
													 ?>
                                                    
                                                     <a href="javascript:void(0)" onclick="confirm_active_member(<?= $row['user_id']; ?>, '<?= site_url().'admin_member/active_member/'; ?>')" class="btn btn-default" >Aktifkan</a>
                                                     <?php
												 }
													 ?>


                                                     <?php
                                                 if($row['activation_status'] == 0){
                                                 ?>
    
                                                     <a href="javascript:void(0)" onclick="confirm_activation_manual(<?= $row['user_id']; ?>, '<?= site_url().'admin_member/activation_manual/'; ?>')" class="btn btn-default" title="Aktivasi Manual" >Aktivasi Manual</a>
                                                     <?php
                                                 }
                                                 ?>
                                                   
                                                     <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['user_id']; ?>, '<?= site_url().'admin_member/delete/'; ?>')" class="btn btn-default" ><i class="fa fa-trash-o"></i></a>

                                                </td> 
                                               
                                            </tr>
                                           <?php 
										   $no++;
										   endforeach; 
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

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->