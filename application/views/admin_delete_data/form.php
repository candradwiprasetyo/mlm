<script type="text/javascript">
function delete_data(link){
	var a = confirm("Anda yakin ingin menghapus semua data ?");
	if(a==true){
		window.location.href = link;
	}
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
                            

                             
                            <div class="box box-cokelat">
                                
                               
                                <div class="box-body">
                                    
                      
                                       
                                        <div class="col-md-12">
                                      
                                      
                                         <div class="form-group">
                                         <?php
                                          
                						if(isset($_GET['did']) && $_GET['did'] == 1){
               							
										?>
                                        <div style="font-size:20px; color:#00F; text-align:center;">
                                         Hapus data berhasil
                                         </div>
										<?php
										}else{
										 ?>
                                         <div style="font-size:20px; color:#F00; text-align:center;">
                                         Warning ! Data yang sudah terhapus tidak dapat dikembalikan.
                                    	</div>
                                        <?php
										}
										?>
                                         
                                      
                                        </div>
                                      </div>
                                        
 										
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                
                                  <div class="box-footer" style="text-align:center;">
                                <input class="btn btn-success" type="submit" value="DELETE DATA" onclick="delete_data('<?= site_url()?>admin_delete_data/form_action')"/>
                             
                             </div>
                            
                            </div><!-- /.box -->
                      
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
               
                </section><!-- /.content -->