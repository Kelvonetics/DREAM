
<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>



 
<fieldset id="profiles">
		<table id="example" class="table" cellspacing="1" width="100%" border="0" style="margin-top:-65px">
		<CAPTION>Passenger Details</CAPTION>
			
			<tr class="box-section">
				<td width="50%"> 
					
				<div class="form-group">
					<label for="FirstName" class="control-label label-left"> <i class="fa fa-male" aria-hidden="true"></i> FirstName </label>
						<input type="text" class="" name="FirstName" id="FirstName" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" required />	
				</div>

                <div class="form-group">
					<label for="Email" class="control-label label-left"> <i class="fa fa-envelope" aria-hidden="true"></i> Email </label>
						<input type="email" class="" name="Email" id="Email" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" required />	
				</div>

                <div class="form-group">
					<label for="Street" class="control-label label-left"> <i class="fa fa-map-marker" aria-hidden="true"></i> Street Address </label>
						<input type="text" class="" name="Street" id="Street" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" required />	
				</div>

                <div class="form-group">
					<label for="State" class="control-label label-left"> <i class="fa fa-globe" aria-hidden="true"></i> State</label>
						<input type="text" class="" name="State" id="State" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px; margin:auto 2% auto 4%; color:#999" required />	
				</div>

			  </td>




				<td width="50%"> 
								
				<div class="form-group">
					<label for="LastName" class="control-label label-right"> <i class="fa fa-male" aria-hidden="true"></i>  LastName</label>
						<input type="text" class="" name="LastName" id="LastName" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" required />
				</div>

                <div class="form-group">
					<label for="Phone" class="control-label label-right"> <i class="fa fa-phone" aria-hidden="true"></i> Phone </label>
						<input type="text" class="" name="Phone" id="Phone" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" required />
				</div>

                <div class="form-group">
					<label for="City" class="control-label label-right"> <i class="fa fa-map-marker" aria-hidden="true"></i> City </label>
						<input type="text" class="" name="City" id="City" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" required />
				</div>

                <div class="form-group">
					<label for="NoOfSeats" class="control-label label-right"> <i class="fa fa-group" aria-hidden="true"></i> Number Of Seats </label>
						<input type="text" class="" name="NoOfSeats" id="NoOfSeats" style="border:thin #ede solid;	width:91%;	padding:5px;	border-radius:4px;margin:auto 0% auto 5%; color:#999" required />
				</div>

				</td>
			</tr>

            <tr class="box-section">
				<td colspan="2">
                    <div class="controls"> 
                        <label for="Note" class="control-label" style="margin-left:1%"><span class="fa fa-pencil"></span> Note</label>
                        <textarea name="Note" id="Note" style="border:thin #ede solid;	width:99%;	padding:5px;	border-radius:2px;margin:auto 1% auto 0.5%; color:#999; min-height: 70px;"></textarea>
                    </div>
				</td>
			</tr>

			<tr>
				<td>
                    <div class="form-group"> <label for="Agree" style="margin-left:25px"> <i class="fa fa-toggle-on"></i> I Agree </label>
                        <div class="radio" style="margin-left:25px">
                        
                            <table width="45%">
                                <tr>
                                <td><label class="pull-left">  
                                    <input type="radio" name="Agree" value="1" id="Agree_0" checked />&nbsp;&nbsp;&nbsp; Yes 
                                    </label></td>

                                <td><label class="pull-right">  
                                    <input type="radio" name="Agree" value="0" id="Agree_1" />&nbsp;&nbsp;&nbsp; No
                                    </label></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                
				</td>
				<td>
                    <div class="form-group" style="padding:20px 5px">
						<button type="submit" class="btn btn-primary pull-right" id="">Join Ride</button>
					</div>
					<input type="hidden" name="RideShareId" id="RideShareId" value="">
                    <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}">
				</td>
			</tr>

		</table>
		
	

	</fieldset>
