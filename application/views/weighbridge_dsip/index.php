<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">PT. DSIP - Weighbridge In</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">Weighbridge</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form id="form-filter" class="form-horizontal">
                        <div class="form-group row mb-2">
                            <label class="col-6 col-md-3">No. PO</label>
                            <div class="col-md-3 col-6">
                                <select type="text" name="no_ref" class="no_ref form-control" onchange="listVendor()" id="no_ref" required />
                                <option value="" selected>Pick No. PO</option>
                                <?php foreach ($no_ref as $row) { ?>
                                    <option value="<?= $row->no_ref; ?>"><?= $row->no_ref; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-md-3 col-6" for="Vendor">Vendor</label>
                            <div class=" col-md-3 col-6">
                                <select type="text" name="nm_rls" class="nm_rls form-control" id="nm_rls" disabled required />
                                <option value="" selected></option>
                                <!-- <?php foreach ($nm_rls as $row) { ?>
                                    <option value="<?= $row->nm_rls; ?>"><?= $row->nm_rls; ?></option>
                                <?php } ?> -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-3 col-6" for="itemname">Item Name</label>
                            <div class="col-md-3 col-6">
                                <select type="text" name="nm_brg" class="form-control" id="nm_brg" disabled required />
                                <option value="" selected></option>
                                <?php foreach ($nm_brg as $row) { ?>
                                    <option value="<?= $row->nm_brg; ?>"><?= $row->nm_brg; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="button" id="btn-filter" class="btn btn-primary ">Filter
                                <i class="fas fas fa-filter"></i>
                            </button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset
                                <i class="fas fas fa-undo"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table id="tableTimbangan" class="table table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>WB(Ticket)</th>
                                <th>DateIn</th>
                                <th>TimeIn</th>
                                <th>DateOut</th>
                                <th>TimeOut</th>
                                <th>Qty</th>
                                <th>No.Police</th>
                                <th>No.Container</th>
                                <th>Vendor</th>
                                <th>No.PO</th>
                                <th>ItemName</th>
                                <th>Gross</th>
                                <th>Tare</th>
                                <th>Netto</th>
                                <th>GrossSupp</th>
                                <th>TareSupp</th>
                                <th>NettoSupp</th>
                                <th>PackageType</th>
                                <th>ContainerType</th>
                                <th>Split</th>
                                <th>No.SplitPO</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>