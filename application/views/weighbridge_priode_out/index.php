<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">PT. DAP - Weighbridge Out</h1>
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
                        <div class="row mb-2">
                            <label class="col-2 col-md-3">Period</label>
                            <div class="col-3 col-md-3">
                                <input type="date" class="form-control " name="tgl_msk" id="start" />
                            </div>
                            <label class="col-6 col-md-2">To</label>
                            <div class="col-md-3 col-6">
                                <input type="date" class="form-control" name="tgl_klr" id="end" />
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="button" id="btn-filter" class="btn btn-primary ">Filter
                                <i class="fas fas fa-sort"></i></button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset
                                <i class="fas fas fa-undo"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- <button type="button" class="btn btn-primary" onclick=create()> <i class="fas fa-plus"></i> Input Data</button> -->
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
                                <th>Customer</th>
                                <th>No.Contract</th>
                                <th>ItemName</th>
                                <th>PackageType</th>
                                <th>ContainerType</th>
                                <th>Gross</th>
                                <th>Tare</th>
                                <th>Netto</th>
                                <th>Split</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- <th colspan="11">Total Netto : </th> -->
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