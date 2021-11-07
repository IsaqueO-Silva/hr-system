<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Countries Details
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/countries">Countries</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
        <div class="box box-primary">
          
          <div class="box-header">
            <a href="/countries/create" class="btn btn-success">Add New Country</a>
          </div>

          <?php if( $msgError != '' ){ ?>
          <div class="alert alert-danger alert-dismissible" style="margin:10px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p><strong><?php echo htmlspecialchars( $msgError, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></p>
          </div>
          <?php } ?>

          <div class="box-body no-padding">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Region</th>
                  <th style="width: 240px">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($countries) && ( is_array($countries) || $countries instanceof Traversable ) && sizeof($countries) ) foreach( $countries as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo htmlspecialchars( $value1["country_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["country_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["region_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td>
                    <a href="/countries/<?php echo htmlspecialchars( $value1["country_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                    <a href="/countries/<?php echo htmlspecialchars( $value1["country_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Do you really want to delete this record?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->