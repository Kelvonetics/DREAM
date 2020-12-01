
<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>


<div class="row" style="padding:5px 20px; margin:0px 5px">
    
        
             
		<div class="form-group">
        
        <h4>Assign vehicle to   <span id="driversName" style="font-size:17px;"> </span></h4>
            <label class="control-label">Vehicle Asset </label>
            <?php	  	
					$conn = connect(); 

					//$did = $user->DeptId;						
					//$sql = "SELECT * FROM asset WHERE DeptId = '{$did}' ORDER BY DeptId";
					$sql = "SELECT * from asset WHERE NOT EXISTS (SELECT * FROM assetretiredetail	WHERE assetretiredetail.AssetId = asset.AssetId) ORDER BY created DESC";
					$result = $conn->query($sql);
					?>
					<select class='sel-opt' name='AssetId' id='AssetId' style="width:100%; margin-right:-5%" required>
					   <option value="">Select Vehicle </option>
						<?php
					if ($result->num_rows > 0) {
						while($vasset= $result->fetch_assoc())
						 {
							$d_id = $vasset['DeptId'];
							$sql_1 = "";
							$sqlB = "SELECT * FROM department WHERE DeptId = '{$d_id}' ORDER BY DeptName";
							$resultB = $conn->query($sqlB);
							$all_aset = $resultB->fetch_assoc();
							 
							$modelid = $vasset['ModelId'];
							$asmodel = "SELECT * FROM assetmodel WHERE ModelId = '{$modelid}'";
							$model = $conn->query($asmodel);
							$row = $model->fetch_assoc();	
							$mn = $row['ModelName'];
							 
							 
						echo   "<option class='option' value=\"".$vasset['AssetId']."\">".$row['ModelName']." &nbsp;&nbsp;&nbsp; ".$vasset['LicensePlate'].' &nbsp;&nbsp;&nbsp; '.$all_aset['DeptName']."</option>";
						}	
						echo '<option value=""> ------------------------------------------------------------------------ </option>';
					}
					else {  }	
					$sql2 = "SELECT * from asset WHERE NOT EXISTS (SELECT * FROM assetretiredetail	WHERE assetretiredetail.AssetId = asset.AssetId) ORDER BY created DESC";
					$result2 = $conn->query($sql2);
					$allasset = $result2->fetch_assoc();
					
					while($allasset = $result2->fetch_assoc())
						 {
							$dp_id = $allasset['DeptId'];
							$sqlC = "SELECT * FROM department WHERE DeptId = '{$dp_id}' ORDER BY DeptName";
							$resultC = $conn->query($sqlC);
							$allaset = $resultC->fetch_assoc();	
							 
							 $model_id = $allasset['ModelId'];
							$assetmodel = "SELECT * FROM assetmodel WHERE ModelId = '{$model_id}'";
							$modelres = $conn->query($assetmodel);
							$modelrec = $modelres->fetch_assoc();	
							 $modelname = $modelrec['ModelName'];
							 
							echo   "<option class='option' value=\"".$allasset['AssetId']."\"> ".$modelname." &nbsp;&nbsp;&nbsp; ".$allasset['LicensePlate'].' &nbsp;&nbsp;&nbsp; '.$allaset['DeptName']."</option>";
						 }
					echo "</select>";			$conn->close();
				 ?>
                 
                 
</div>


			<div class="form-group">
				<input type="hidden" name="StartTime" id="StartTime" class="form-control" value="" Required> 

				<input type="hidden" name="EndTime" id="EndTime" class="form-control" value="" Required> 

				<input type="hidden" name="AvailFrom" id="AvailFrom" class="form-control"> 

				<input type="hidden" name="AvailTo" id="AvailTo" class="form-control" value="2100-01-01 00:00" Required> 
		
				<input type="hidden" name="UserId" id="userid" class="form-control" value="" Required> 
			
				<input type="hidden" name="DeptId" id="deptid" class="form-control" value="" Required> 
			
				<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 

                <input type="hidden" name="_token" value="{{{ csrf_token() }}}">

                <button type="submit" class="btn btn-primary">Assign Driver</button>
		         <button type="reset" class="btn btn-default">Cancel</button>	
			</div>
		
            
        

		
	  
			 
 </div>          
								
