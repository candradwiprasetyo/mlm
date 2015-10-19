<!-- Content Header (Page header) -->
         <section class="content_new">
                   
               <div class="callout callout-warning">
                                        <h4>Cara Pembayaran </h4>
                                        <p>1. Transfer ke rekening Mandiri 123</p>
                                        <p>2. Lakukan konfirmasi pembayaran dengan mengisi data formulir berikut</p>
                                    </div>
           
                </section>
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
                                    
                      
                                       
                                        <div class="col-md-9">
                                      
                                      	
                                         <div class="form-group">
                                         <label>Nama Bank</label>
                                    <input required type="text" name="i_bank_name" class="form-control" placeholder="Nama Bank" value="<?= @$data['bank_name'] ?>" title="Masukkan Nama Bank"/>
                                			</div>
                                            
                                            <div class="form-group">
                                         <label>Nomor Rekening</label>
                                    <input required type="text" name="i_bank_account_number" class="form-control" placeholder="Nomor Rekening" value="<?= @$data['bank_account_number'] ?>" title="Masukkan Nomor Rekening"/>
                                			</div>
                                            
                                             <div class="form-group">
                                         <label>Atas Nama</label>
                                    <input required type="text" name="i_bank_account_name" class="form-control" placeholder="Atas Nama" value="<?= @$data['bank_account_name'] ?>" title="Masukkan Atas Nama"/>
                                			</div>
                                            
                                            <div class="form-group">
                                         <label>Jumlah Transfer</label>
                                    <input required type="text" name="i_bank_transfer" class="form-control" placeholder="Jumlah Transfer" value="<?= @$data['bank_transfer'] ?>" title="Masukkan Jumlah Transfer"/>
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
                                           <input type="file" name="i_img" id="i_img" <?php if(!$data['row_id']){ echo " required "; } ?>title="Masukkan bukti tranfer" />
                                        </div>
                                    
                                      
                                        </div>
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                
                                  <div class="box-footer">
                                <input class="btn btn-success" type="submit" value="Save"/>
                                <a href="<?= $data_head['close_button']?>" class="btn btn-success" >Close</a>
                             
                             </div>
                            
                            </div><!-- /.box -->
                       </form>
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
               
                </section><!-- /.content -->