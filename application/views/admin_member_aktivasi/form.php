<!-- Content Header (Page header) -->
        
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      
                        <!-- right column -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->

                          
                            <div class="title_page"> <?= $data_head['title'] ?></div>
                            

                            

                            <div class="box box-cokelat">
                                
                               
                                <div class="box-body">
                                    
                      
                                       
                                        <div class="col-md-6">
                                      
                                      
                                         <div class="form-group">
                                         <label>Nama</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= @$data['user_name'] ?>" title="Fill slider title" disabled="disabled"/>
                                   
                                			</div>
                                            
                                            <div class="form-group">
                                         <label>Email</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= @$data['user_login'] ?>" title="Fill slider title" disabled="disabled"/>
                                			</div>
                                            
                                           
                                      
                                        </div>
                                        
                                        <div class="col-md-6">
                                      
                                      
                                       
                                            <div class="form-group">
                                         <label>Telepon</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= @$data['user_phone'] ?>" title="Fill slider title" disabled="disabled"/>
                                			</div>
                                            
                                            <div class="form-group">
                                         <label>Kota</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="Slider title" value="<?= ($data['city_name']) ? $data['city_name'] : $data['other_city_name'] ?>" title="Fill slider title" disabled="disabled"/>
                                			</div>
                                         
                                      
                                        </div>
                                        
                                        <div class="row">
                                                	<div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Nama Bank (Pencairan Komisi)</label>
                                                            <input required type="text" name="i_user_bank_name" class="form-control" placeholder="Nama Bank" value="<?= $data['user_bank_name'] ?>" title="" disabled="disabled"/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Nomor Rekening (Pencairan Komisi)</label>
                                                            <input required type="text" name="i_user_bank_account_number" class="form-control" placeholder="Nomor Rekening" value="<?= $data['user_bank_account_number'] ?>" title="" disabled="disabled"/>
                                                        </div>
                                                    </div>
                                                 </div>
                                                 <div class="row"> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label>Atas Nama (Pencairan Komisi)</label>
                                                            <input required type="text" name="i_user_bank_account_name" class="form-control" placeholder="Atas Nama" value="<?= $data['user_bank_account_name'] ?>" title="" disabled="disabled"/>
                                                        </div>
                                                    </div>
                                        		</div>
                                      
                                        
 										
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                
                                
                            </div><!-- /.box -->
                       
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                    
                    
                    
                     <div class="row">
                      
                        <!-- right column -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->

                          
                            <div class="title_page"> Data Pembayaran</div>
                            

                             <form  class="cmxform" id="createForm" action="<?= $data_head['action']?>" method="post" enctype="multipart/form-data" role="form">

                            <div class="box box-cokelat">
                                
                               
                                <div class="box-body">
                                    
                      
                                       
                                        <div class="col-md-9">
                                      
                                      	
                                         <div class="form-group">
                                         <label>Nama Bank</label>
                                    <input required type="text" name="i_bank_name" class="form-control" placeholder="Nama Bank" value="<?= @$data['bank_name'] ?>" title="Masukkan Nama Bank" disabled="disabled"/>
                                     <input required type="hidden" name="i_user_id" class="form-control" placeholder="Slider title" value="<?= @$data['user_id'] ?>" title="Fill slider title" disabled="disabled"/>
                                			</div>
                                            
                                            <div class="form-group">
                                         <label>Nomor Rekening</label>
                                    <input required type="text" name="i_bank_account_number" class="form-control" placeholder="Nomor Rekening" value="<?= @$data['bank_account_number'] ?>" title="Masukkan Nomor Rekening" disabled="disabled"/>
                                			</div>
                                            
                                             <div class="form-group">
                                         <label>Atas Nama</label>
                                    <input required type="text" name="i_bank_account_name" class="form-control" placeholder="Atas Nama" value="<?= @$data['bank_account_name'] ?>" title="Masukkan Atas Nama" disabled="disabled"/>
                                			</div>
                                            
                                            <div class="form-group">
                                         <label>Jumlah Transfer</label>
                                    <input required type="text" name="i_bank_transfer" class="form-control" placeholder="Jumlah Transfer" value="<?= @$data['bank_transfer'] ?>" title="Masukkan Jumlah Transfer" disabled="disabled"/>
                                			</div>
                                         
                                      
                                        </div>
                                      
                                        
 										<div class="col-md-3">
                                          <div class="form-group">
                                         <label>Bukti Transfer</label>
                                         <?php
                                        if($data['row_id']){
										?>
                                        <br />
                                        <img src="<?= base_url(); ?>assets/images/activation/<?= $data['transfer_img']?>" style="width:100%;"/>
                                        <?php
										}
										?>
                                         
                                        </div>
                                    
                                      
                                        </div>
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                
                                  <div class="box-footer">
                                <input class="btn btn-success" type="submit" value="Aktivasi"/>
                                <a href="<?= $data_head['close_button']?>" class="btn btn-success" >Close</a>
                             
                             </div>
                            
                            </div><!-- /.box -->
                       </form>
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
               
                </section><!-- /.content -->