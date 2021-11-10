<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/departments">Departments</a></li>
    <li class="active"><a href="">Edit Department</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-name">Edit Department</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/departments/<?php echo htmlspecialchars( $department["department_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="department_name">Name</label>
              <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo htmlspecialchars( $department["department_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="location_id">Region</label>
                  <input type="text" class="form-control" id="location_id" name="location_id" value="<?php echo htmlspecialchars( $department["location_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onchange="search(this.value, 'locations');" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="location_name">Name</label>
                  <input type="text" class="form-control" id="location_name" value="<?php echo htmlspecialchars( $department["street_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $department["city"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $department["state_province"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->