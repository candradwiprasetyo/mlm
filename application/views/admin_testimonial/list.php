  <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Simpan Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 2){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Edit Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 3){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Delete Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 4){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Testimoni ditampilkan
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 5){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Testimoni tidak ditampilkan
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
                                                <th>Images</th>
                                                <th>Name</th>
                                                <th>Testimoni</th>
                                                <th>Status</th>
                                                <th width="10%">Config</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   $no = 1;
										   foreach($list as $row): ?>
                                            <tr>
                                                <td><?= $no?></td>
                                                <td><img src="<?= base_url(); ?>assets/images/user/<?= $row['user_img']?>" width="80" /></td>
                                                 <td><?= $row['user_name']?></td>
                                                <td><?= $row['testimonial_desc']?></td>
                                               <td><?= ($row['testimonial_status'] == 1) ? "Active" : "Non Active"; ?></td>
                                                <td style="text-align:center;">
												<?php
                                                if($row['testimonial_status'] == 0){
												?>
												 <a href="<?= site_url() ?>/admin_testimonial/active/<?= $row['testimonial_id']?>" class="btn btn-default" ><i class="fa fa-check"></i></a>
												<?php
												}else{
												?>
                                                    <a href="<?= site_url() ?>/admin_testimonial/non_active/<?= $row['testimonial_id']?>" class="btn btn-default" >X</a>
                                                <?php
												}
												?>
                                                    <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['testimonial_id']; ?>, '<?= site_url().'/admin_testimonial/delete/'; ?>')" class="btn btn-default" ><i class="fa fa-trash-o"></i></a>

                                                </td> 
                                            </tr>
                                           <?php 
										   $no++;
										   endforeach; 
										   ?>
                                            

                                           
                                          
                                        </tbody>
                                          
                                    </table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->