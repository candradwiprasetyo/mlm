
               
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
                                                <th>Phone</th>
                                                <th>City</th>
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
                                                 <td><?= $row['user_phone']?></td>
                                                 <td><?= $row['city_name']?></td>
                                               <td style="text-align:center;">

                                                
                                                    <a href="javascript:void(0)" onclick="confirm_delete(<?= $row['user_id']; ?>, '<?= site_url().'admin_admin/delete/'; ?>')" class="btn btn-default" ><i class="fa fa-trash-o"></i></a>

                                                </td> 
                                            </tr>
                                           <?php 
										   $no++;
										   endforeach; 
										   ?>
                                            

                                           
                                          
                                        </tbody>
                                        
                                          <tfoot>
                                            <tr>
                                                <td colspan="7"><a href="<?= $data_head['add_button'] ?>" class="btn btn-success " >Add</a></td>
                                               
                                            </tr>
                                        </tfoot>
                                       
                                    </table>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->