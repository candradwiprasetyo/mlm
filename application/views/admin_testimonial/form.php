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
                                    
                      
                                       
                                        <div class="col-md-9">
                                      
                                      
                                         <div class="form-group">
                                         <label>Title</label>
                                    <input required type="text" name="i_name" class="form-control" placeholder="testimonial title" value="<?= @$data['testimonial_name'] ?>" title="Fill testimonial title"/>
                                			</div>
                                         <div class="form-group">
                                           
                                           <textarea id="editor" name="editor" rows="10" cols="80">
                                            <?php
                                            echo @$data['testimonial_desc']
                                            ?>
                                        </textarea>
                                        </div>
                                      
                                        </div>
                                      
                                        
 										<div class="col-md-3">
                                          <div class="form-group">
                                         <label>Images</label>
                                         <?php
                                        if($data['row_id']){
										?>
                                        <br />
                                        <img src="<?= base_url(); ?>assets/images/testimonial/<?= $data['testimonial_img']?>" style="width:100%;"/>
                                        <?php
										}
										?>
                                           <input type="file" name="i_img" id="i_img" <?php if(!$data['row_id']){ echo " required "; } ?>title="fill testimonial img" />
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