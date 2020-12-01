<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>
<div class="row" style="padding:5px 20px; margin:0px 5px">
    
        
             
		<div class="form-group">
        
        <h4>Assign Job To   <span id="driversName" style="font-size:17px;"> </span></h4>

        <label for="JobId" class="control-label label-left" style="margin:0px"> <i class="fa fa-cogs"></i> Job</label>
        <select class='sel-opt-left' name='JobId' id='JobId' style="width:100%; margin:0px" required>
            <option value=""> Select Job </option>
            <?php 
                $conn = connect();								
                $sql = "SELECT * FROM client C INNER JOIN job J ON C.ClientId = J.ClientId AND J.Status <> 'Complete' ORDER BY C.FirstName";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($jobs = $result->fetch_assoc())
                     {
                    echo "<option class='option' value=\"".$jobs['JobId']."\">".$jobs['FirstName'].' '.$jobs['LastName'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$jobs['Description']."</option>";
                    }															
                }
                else {  }	$conn->close();
             ?>
        </select>
                 
                 
</div>


			<div class="form-group">
				<input type="hidden" name="JobStartDateTime" id="JobStartDateTime" class="form-control" value="" Required> 

				<input type="hidden" name="JobEndDateTime" id="JobEndDateTime" class="form-control" value="" Required> 
		
				<input type="hidden" name="UserId" id="userid" class="form-control" value="" Required> 
			
				<input type="hidden" name="DeptId" id="deptid" class="form-control" value="" Required> 
			
                <input type="hidden" name="AssetId" id="AssetId" class="form-control" value="0" Required> 
				<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 

                <input type="hidden" name="_token" value="{{{ csrf_token() }}}">

                <button type="submit" class="btn btn-primary">Assign Driver</button>
		         <button type="reset" class="btn btn-default">Cancel</button>	
			</div>
		
            
        

		
	  
			 
 </div>          
								
