<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/locations">Locations</a></li>
    <li class="active"><a href="">Edit Location</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-name">Edit Location</h3>
        </div>

        <?php if( $msgError != '' ){ ?>
        <div class="alert alert-danger alert-dismissible" style="margin:10px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
        </div>
        <?php } ?>

        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/locations/<?php echo htmlspecialchars( $location["location_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="street_address">Street address</label>
              <input type="text" class="form-control" id="street_address" name="street_address" value="<?php echo htmlspecialchars( $location["street_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
            </div>
            <div class="row">
              <div class="col-xs-12 col-md-2">
                <div class="form-group">
                  <label for="postal_code">Postal code</label>
                  <input type="text" class="form-control" maxlength="10" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars( $location["postal_code"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-6 col-md-5">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars( $location["city"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
              <div class="col-xs-6 col-md-5">
                <div class="form-group">
                  <label for="state_province">State</label>
                  <input type="text" class="form-control" id="state_province" name="state_province" value="<?php echo htmlspecialchars( $location["state_province"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-4 col-md-2">
                <div class="form-group">
                  <label for="country_id">Country</label>
                  <input type="text" class="form-control" id="country_id" name="country_id" value="<?php echo htmlspecialchars( $location["country_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onchange="search(this.value, 'countries');" required>
                </div>
              </div>
              <div class="col-xs-8 col-md-10">
                <div class="form-group">
                  <label for="country_name">Name</label>
                  <input type="text" class="form-control" id="country_name" value="<?php echo htmlspecialchars( $location["country_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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