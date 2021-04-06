<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <h3>PT.DAP - Weighbridge Data Entry</h3>
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?= $timbangan['MSK'] ?></h3>
              <p>Incoming</p>
            </div>
            <div class="icon">
              <i class="fas fa-truck-moving"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-cyan">
            <div class="inner">
              <h3><?= $timbangan['KLR'] ?></h3>
              <p>Out</p>
            </div>
            <div class="icon">
              <i class="fas fa-truck-loading"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?= $timbangan['success'] ?></h3>
              <p>Success</p>
            </div>
            <div class="icon">
              <i class="fas fa-check"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <h3><?= $timbangan['unsuccess'] ?></h3>
              <p>Unloading/Loading</p>
            </div>
            <div class="icon">
              <i class="fas fa-dolly-flatbed"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?= $timbangan['all'] ?></h3>
              <p>Data</p>
            </div>
            <div class="icon">
              <i class="fas fa-database"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h3>PT. DSIP - Weighbridge Data Entry</h3>
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?= $timbangan_dsip['MSK'] ?></h3>
                <p>Incoming</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck-moving"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-cyan">
              <div class="inner">
                <h3><?= $timbangan_dsip['KLR'] ?></h3>
                <p>Out</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck-loading"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?= $timbangan_dsip['success'] ?></h3>
                <p>Success</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lime">
              <div class="inner">
                <h3><?= $timbangan_dsip['unsuccess'] ?></h3>
                <p>Unloading/Loading</p>
              </div>
              <div class="icon">
                <i class="fas fa-dolly-flatbed"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                <h3><?= $timbangan_dsip['all'] ?></h3>
                <p>Data</p>
              </div>
              <div class="icon">
                <i class="fas fa-database"></i>
              </div>
            </div>
          </div>
        </div>


        <!-- <h4>Color</h4>
      <div class="row">
        <?php
        $color = ['Red', 'Orange', 'Yellow', 'Green', 'Blue', 'Purple', 'Brown', 'Magenta', 'Tan', 'Cyan', 'Olive', 'Maroon', 'Navy', 'Aquamarine', 'Turquoise', 'Silver', 'Lime', 'Teal', 'Indigo', 'Violet', 'Pink', 'Black', 'White', 'Gray'];
        $i = 1;
        ?>
        <!-- ./col -->
        <?php foreach ($color as $value) { ?>
          <!-- <div class="col-lg-3 col-6">
            <!-- small box -->
          <!-- <div class="small-box bg-<?= strtolower($value) ?>">
              <div class="inner">
                <h3><?= $i++ ?></h3>
                <p><?= $value ?></p>
              </div>
              <div class="icon">
                <i class="fas fa-palette"></i>
              </div>
            </div>
          </div> -->
        <?php } ?>
        <!-- </div> -->
      </div>
  </section>
</div>