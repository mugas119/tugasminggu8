<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('')?>dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('')?>products">Product</a></li>
                                <li class="breadcrumb-item active">Edit Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
        <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-lg-10">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- /.form start -->
                                <?php foreach ($edit as $p):?>
                                <form class="user" role="form" method="post" action="<?= base_url('products/saveEdit')?>" enctype="multipart/form-data">
                                
                                    <div class="card-body">
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="prodid" value="<?= $p['prod_id'];?>" hidden>
                                            <?= form_error('prodid', '<small class="text-danger" hidden>', '<small>'); ?>
                                            <label for="exampleInputEmail1">Product's Name</label>
                                            <input type="text" class="form-control" name="prodname" value="<?= $p['prod_name'];?>" placeholder="Enter name">
                                            <?= form_error('prodname', '<small class="text-danger">', '<small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Quantity</label>
                                            <input type="number" class="form-control" name="prodqty" size="4" min="1" step="1" value="<?= $p['prod_qty'];?>" placeholder="Quantity">
                                            <?= form_error('prodqty', '<small class="text-danger">', '<small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Brand / Vendor</label>
                                            <select class="form-control" name="vend">
                                            <?php foreach ($vnd as $v) :
                                             echo "<option value='".$v['vend_id']."'>".$v['vend_name']."</option>";
                                             endforeach ?>
                                            </select>
                                            <?= form_error('vend', '<small class="text-danger">', '<small>'); ?>
                                        </div>
                                        <div class="form-group">
                                          <label>Category</label>
                                          
                                          <select class="form-control" name="prodcat">
                                          <?php foreach ($cat as $c) :
                                             echo "<option value='".$c['cat_id']."'>".$c['cat_name']."</option>";
                                             endforeach ?>
                                          </select>
                                          <?= form_error('prodcat', '<small class="text-danger">', '<small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="text" class="form-control" name="prodprice" value="<?= $p['prod_price'];?>" placeholder="Price">
                                            <?= form_error('prodprice', '<small class="text-danger">', '<small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Image Upload</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="upload_image" name="upload_image" class="custom-file-input">
                                                    <label class="custom-file-label">Choose file</label>
                                                    <?= form_error('upload_image', '<small class="text-danger">', '<small>'); ?>    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea type="text" class="form-control" name="proddesc" placeholder="Description">
                                            <?= $p['prod_desc'];?>
                                          </textarea>
                                            <?= form_error('desc', '<small class="text-danger">', '<small>'); ?>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <?php endforeach ?>
                                    <div class="card-footer">
                                        <input type="submit" name="submit" id="btnSubmit"class="btn btn-primary" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col (left) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->