<style>
    .fa-plus-circle {
        color: green;
    }

    .fa-minus-circle {
        color: red;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">PT.DAP - Report Weighbridge Out</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Report Weighbridge</li>
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
                <div class="card-body ">
                    <form id="form-filter">
                        <!-- <div class="row mb-2">
                            <label class="col-2 col-md-3 ">In or Out :</label>
                            <div class="col-3 col-md-3">
                                <select type="text" name="ctatus" id="ctatus" onchange="get_ref()">
                                    <option value="">Pick In/Out</option>
                                    <option value="MSK">In</option>
                                    <option value="KLR">Out</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="row mb-2">
                        <label class="col-2 col-md-3">Period</label>
                        <div class="col-3 col-md-3">
                            <input type="date" class="form-control " name="tgl_msk" id="start" />
                        </div>
                        <label>—</label>
                        <div class="col-md-3 col-6">
                            <input type="date" class="form-control" name="tgl_klr" id="end" />
                        </div>
                    </div> -->
                        <div class="form-group row mb-2">
                            <label class="col-6 col-md-3">Contract/PO No.</label>
                            <div class="col-md-3 col-6">
                                <select type="text" name="no_ref" class="no_ref form-control" id="no_ref" required />
                                <option value="" selected>Pick Contract/PO No.</option>
                                <?php foreach ($no_ref as $row) { ?>
                                    <option value="<?= $row->no_ref; ?>"><?= $row->no_ref; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-warning" onclick="previewData()">
                                <i class="fas fas fa-print"></i>
                                Print By Filter
                            </button>
                            <!-- <button class="btn btn-success" onclick="exportExcel()">
                                <i class="fas fas fa-file-excel"></i>
                                Export To Excel
                            </button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>