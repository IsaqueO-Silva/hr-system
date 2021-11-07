<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/countries">Countries</a></li>
    <li class="active"><a href="">Edit Country</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-name">Edit Country</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/countries/<?php echo htmlspecialchars( $country["country_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="country_name">Name</label>
              <input type="text" class="form-control" id="country_name" name="country_name" value="<?php echo htmlspecialchars( $country["country_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="region_id">Region</label>
                  <input type="number" class="form-control" id="region_id" name="region_id" value="<?php echo htmlspecialchars( $country["region_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onchange="searchRegion(this.value);" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="region_name">Name</label>
                  <input type="text" class="form-control" id="region_name" value="<?php echo htmlspecialchars( $country["region_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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