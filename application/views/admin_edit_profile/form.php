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
                                    
                      
                                          <div class="row">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Nama</label>
                                                            <input required type="text" name="i_name" class="form-control" placeholder="Nama" value="<?= $data['user_name'] ?>" title=""/>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Telepon</label>
                                                            <input required type="text" name="i_phone" class="form-control" placeholder="Telepon" value="<?= $data['user_phone'] ?>" title=""/>
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
                                             <option value="<?= $r_city['city_id'] ?>" <?php if($data['city_id'] == $r_city['city_id']){ ?> selected="selected"<?php } ?>><?= $r_city['city_name']?></option>
                                             <?php
                                             }
                                             ?>
                                           </select>          
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Foto</label>
                                                            <?php
                                        if($data['row_id']){
										?>
                                        <br />
                                        <img src="<?= base_url(); ?>assets/images/user/<?= $data['user_img']?>" style="width:50%;"/>
                                        <?php
										}
										?>
                                                        <input type="file" name="i_img" id="i_img" />
                                                            </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Email</label>
                                                            <input required type="text" name="i_email" class="form-control" placeholder="Email" value="<?= $data['user_login'] ?>" title=""/>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Password</label>
                                                            <input type="password" name="i_password" class="form-control" placeholder="Password" value="" title=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                        
 										
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                 <div class="box-footer">
                                <input class="btn btn-success" type="submit" value="Save"/>
                               
                             </div>
                                
                            </div><!-- /.box -->
                            </form>
                       
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                    
                    
                   
               
                </section><!-- /.content -->