<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
                        <li >
						<?php echo $this->Html->link(
								'<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
								array('controller' => 'cdoctor',
										'action' => 'dashboard',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                           
                        </li>
						
						<li>
							<?php echo $this->Html->link(
								'<i class="fa fa-calendar"></i> <span>History</span>',
								array('controller' => 'cdoctor',
										'action' => 'history',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                        </li>
						
						<li class="active">
							<?php echo $this->Html->link(
								'<i class="fa fa-stack-exchange"></i> <span>Queue</span>',
								array('controller' => 'cdoctor',
										'action' => 'queue',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                           
                        </li>
                    </ul>
					<?php $this->end(); ?>

					<section class="content-header">
                    <h1>
                        Queue
                        
                    </h1>
                    
                </section>

                <section class="content">
                    
					<div class="row">
					<div class="col-xs-12">
                           

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Queue List </h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
                                                <th>Patient</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>rudi subandini</td>
												<td>-</td>
                                                <td>
												<button class="btn btn-primary" data-toggle="modal" data-target="#show" >More</button>
												<!--<button class="btn btn-primary" data-toggle="modal" data-target="#show2" data-whatever="@mdo">More2</button>-->
												</td>
                                            </tr>
											<tr>
                                                <td>1</td>
                                                <td>rudi subandini</td>
												<td>-</td>
                                                <td>-</td>
                                            </tr>
											<tr>
                                                <td>1</td>
                                                <td>rudi subandini</td>
												<td>-</td>
                                                <td>-</td>
                                            </tr>
											<tr>
                                                <td>1</td>
                                                <td>rudi subandini</td>
												<td>-</td>
                                                <td>-</td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
                                                <th>Patient</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
					</div>
               
                </section>
            </aside>

<div class="modal fade " id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Pasien X</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Anamnesa
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Anamnesa:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" rows="8" name="keluhan" readonly style="resize:none;"></textarea>
										</div>										
                                        
										</div>
		</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Diagnose
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
	  
                
            
			
	
             <div class="box-body table-responsive">
                                    <table id="diagnose" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID-X</th>
                                                <th>Detail</th>
                                                <th>Picked?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                <td><input type="checkbox" id="check" value="pick"></td>
                                            </tr>
										
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>ID-X</th>
                                                <th>Detail</th>
                                                <th>Picked?</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>   
            
			
       

	   </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Treatment
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Treatment:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" rows="8" name="keluhan" ></textarea>
										</div>										
                                        
										</div> </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
          PRESCRIPTION
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
       <div class="box-body table-responsive">
                                    <table id="prescription" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>Name</th>
												<th>Qty</th>
                                                <th>Usage/Note</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>paramex</td>
												<td>10 <small>qty</small></td>
                                                <td>3x1</td>
                                                <td><input type="button" value="&times;" class="btn btn-default delete"/></td>
                                            </tr>
										
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>Name</th>
												<th>Qty</th>
                                                <th>Usage/Note</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
								<hr>
			<div class="row">
                <table class="table table-hover">
                    <tr>
                        <td>#</td>
                    
                        <td><input type="text" class="form-control" id="nm_presc" value="" placeholder="Name"/></td>
						<td><input type="number" class="form-control" id="qty_presc" value="" placeholder="1"/>
						<select id="metr_presc" class="form-control">
							<option>butir</option>
						</select></td>
						 <td><textarea rows="1" id="usg_presc" class="form-control" cols="30" style="resize:none;" placeholder="usage/notes"></textarea></td>
                        <td><input type="button" class="btn btn-primary" id="add" value="Add"></td>
                    
                    </tr>
                </table>
            </div>
	   </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Upload Image
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
         <form enctype="multipart/form-data">
                <input id="file-0a" class="file" type="file" multiple data-min-file-count="1">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>

		</div>
    </div>
  </div>
</div>
										
		
        
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
		<button type="button" class="btn btn-danger">Finish</button>
      </div>
	  </form>
    </div>
  </div>
</div>		
			
<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
echo $this->Html->css('fileinput');
$this->start('additional'); 
echo $this->Html->script('plugins/timepicker/bootstrap-timepicker.min');
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('fileinput.min');
?>	

<script type="text/javascript">
            $(function() {
				var t = $('#main').DataTable( {
					"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	
	
	var t2 = $('#diagnose').DataTable( {
					"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
					"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
        "order": [[ 1, 'asc' ]]
    } );
 
    t2.on( 'order.dt search.dt', function () {
        t2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
				
var t3 = $('#prescription').DataTable( {
					"lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
					"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
        "order": [[ 1, 'asc' ]]
    } );
 
    t3.on( 'order.dt search.dt', function () {
        t3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


$('#add').on( 'click', function () {
					
					t3.row.add( [
					'',$('#nm_presc').val(),$('#qty_presc').val(),$('#usg_presc').val(),'<input type="button" value="&times;" class="btn btn-default delete"/>'
				] ).draw();
				
} );
	
				
$(document).on("click", ".delete", function(){
    var xx = $(this).parent().parent();
        if ( xx.hasClass('selected') ) {
            xx.removeClass('selected');
        }
        else {
		xx.addClass('selected');
        }
		
		t3.row('.selected').remove().draw( false );
});

            });

        </script>
		
		<script>

   
    $(document).ready(function() {
        $("#test-upload").fileinput({
            'showPreview' : false,
            'allowedFileExtensions' : ['jpg', 'png','gif'],
            'elErrorContainer': '#errorBlock'
        });
		
		$("#file-0a").fileinput({
        'allowedFileExtensions' : ['jpg', 'png','gif'],
    });
        
    });
	</script>
<?php $this->end(); ?>