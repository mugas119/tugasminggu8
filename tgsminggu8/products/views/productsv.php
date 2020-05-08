<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(''); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data product <?= $username ?> </h3>
              <?php if($this->session->flashdata('error') == TRUE): ?>
              <div class="alert alert-danger alert-dismissible fade show ml-5" role="alert">
                  <?= $this->session->flashdata('error'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php endif; ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Gambar</th>
                  <th>Nama</th>
                  <th>Brand</th>
                  <th>Category</th>
                  <th>Color</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($product as $p) :
                    ?>
                <tr>
                  <td>
                    <center>
                        <img src="<?= base_url('assets/img/products/'), $p['picture']?>" width="100px" height="100px"/>
                    </center>
                  </td>
                  <td><?= $p['name'] ?></td>
                  <td><?= $p['brand'] ?></td>
                  <td><?= $p['cat_name'] ?></td>
                  <td><?= $p['color'] ?></td>
                  <td><?= $p['price'] ?></td>
                  <td><?= $p['size'] ?></td>
                  <td><?= $p['desc'] ?></td>
                  <td colspan="2">
                      <center>
                      <a class="btn btn-success" href="<?= base_url('products/edit/'), $p['prodid'] ?>">Edit</a>
                      <a class="btn btn-danger" href="<?= base_url('products/delete/'), $p['prodid'] ?>">Delete</a>
                      </center>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->