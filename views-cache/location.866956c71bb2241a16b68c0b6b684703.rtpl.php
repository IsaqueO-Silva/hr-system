<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <?php echo htmlspecialchars( $department["department_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - Location
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/departments">Departments</a></li>
        <li class="active"><a href="/departments/<?php echo htmlspecialchars( $department["department_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/location"><?php echo htmlspecialchars( $department["department_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - location</a></li>
    </ol>
    </section>

    <section class="invoice">
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Street address</th>
                                <th>Postal code</th>
                                <th>City / State</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars( $department["street_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $department["postal_code"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $department["city"], ENT_COMPAT, 'UTF-8', FALSE ); ?> / <?php echo htmlspecialchars( $department["state_province"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <div class="clearfix"></div>

</div>
<!-- /.content-wrapper -->