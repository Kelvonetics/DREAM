@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>


<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	.part-active { border-radius:12px; }
	.parts { padding:8px 0px; border-radius:12px; display:none }
	.labour-active { border-radius:12px; }
	.labours { padding:8px 15px; border-radius:12px; display:none }
	
.pad{
        margin-top: 5px;
        border:1px solid #ddd;
	}
.box-section 
	{ 
		border:#eee thin solid;margin:7px 0px; 
	}
	
.labour-box 
	{ 
		 padding:1px 15px; 
	}
.cost-box 
	{ 
		border:#eee thin solid; margin-top:5px;
	}
	
.sel-opt.sel-opt
{
    border:thin #ede solid;
    width:93%;
    padding:5px;
    border-radius:2px;
    color:#999;
    margin:0px 0px;
}
.sel-opt-left
{
    border:thin #ede solid;
    width:93%;
    padding:7.5px;
    border-radius:2px;
    color:#999;
    margin:auto 2% auto 4%;
}
.sel-opt-right
{
    border:thin #ede solid;
    width:97%;
    padding:7.5px;
    border-radius:2px;
    color:#999;
    margin:auto 4% auto -1%;
}

.inp
{
    border:thin #ede solid;
    width:93%;	padding:5px;	
    border-radius:2px;
    margin:auto -2% auto 2%;
    color:#999;
}

label 
{
    color:#666;
}
.label-left
{
    color:#666; margin:auto 2% auto 4%;
}
.label-right
{
    color:#666; margin:auto 0% auto -1%;
}
.tab-top-bottom
	{
		height:15px;
	}
.costtd
	{
		vertical-align:top; text-align:left;
	}
.part-div
	{
		margin:15px 0px;
	}
.btn-circle 
	{
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
.btn-circle-red
	{
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	  background-color:#f00;
	  color:#fff;
	}
.btn-circle-green
	{
	  width: 30px;
	  height: 25px;
	  text-align: center;
	  padding: 4px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	  background-color:#396;
	  color:#fff;
	}
.right-card-view
	{
		padding:1px 25px 1px 10px; margin-top:-25px;
	}
.white-card
	{
		margin:-15px -20px 0px 6px;
	}
.grey-card
	{
		padding:1px 5px;  margin:0px -20px 0px -25px;
	}
.action-link
	{
		color:blue; text-decoration:none;
	}
.box-right
	{
		border:1px solid #ddd;
		padding:8px 15px;
	}
</style>


<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
  <section class="tables-data">
	<div class="page-header">
	<h1>      <i class="fa fa-wrench"></i>    Workshop </h1> 
    <p class="lead"> The workshop module  allows you to efficiently manage your entire workshop. </p>
	</div>
	
	
	<div class="">
              
		<!-- right content -->
        <div class="col-md-3 col-md-push-9 left-side" style="margin:-50px -20px 0px 10px; background-color:#F9F9F9">
        <div class="pull-right" style="margin:-25px -20px 0px 0px">
        <ul class="list-unstyled">
            <li class="dropdown">
            <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
            </li>
        </ul>
        </div>

        <div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
        <div class="well white white-card"> 				 
        <center> <img src="{{URL::asset('assets/img/workshop.jpg')}}" class="img-responsive" height="150" width="150"> </center>
            
        </div>  	

            <!-- quick information div  -->
            <div class="grey-card">
            <div style="margin:-10px 15px 0px 10px">
            
            </div>
            </div>

        </div>
 
  

		<!-- left content -->
	  <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px"> 
	  <div>
		
      <form method="post" action="{{route('workshop.insert')}}" role="form">
		<LEGEND> New Workshop </LEGEND>
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Workshop Details</CAPTION>
			<tr class="box-section">
				<td width="50%">
					<div class="form-group">
						<label for="WorkShopName" class="control-label label-left"><i class="fa fa-building" aria-hidden="true"></i> Workshop Name</label>
						<input type="text" name="WorkShopName" id="WorkShopName" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" Required onkeyup="convert_name()"> 
					</div>
					
					<div class="form-group">
						<label for="Phone" class="control-label label-left"><i class="fa fa-phone" aria-hidden="true"></i> Phone Number</label>
						<input type="text" name="Phone" id="Phone" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" Required> 
					</div>
			  </td>
				<td width="50%"> 
					<div class="form-group">
						<label for="ContactName" class="control-label label-right"><i class="fa fa-user" aria-hidden="true"></i> Contact Name</label>
						<input type="text" name="ContactName" id="ContactName" style="border:thin #ede solid;	width:97%;	padding:5px;  border-radius:2px;margin:auto 0% auto -1%; color:#999" Required> 
					</div> 
					
					<div class="form-group">
						<label for="Email" class="control-label label-right"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>
						<input type="email" name="Email" id="Email" style="border:thin #ede solid;	width:97%;	padding:5px;  border-radius:2px;margin:auto 0% auto -1%; color:#999" Required> 
					</div>
				</td>

			</tr>
			
			<tr> <td class="lead" style="margin-left:-15px"> Contact Details </td><td>  </td></tr>
			
			<tr class="box-section">
				<td colspan="2">
					<div class="form-group">
						<label for="Address" class="control-label label-left" style="margin-left:20px"><i class="fa fa-map-marker" aria-hidden="true"></i>  Address</label>
						<input type="text" name="Address" id="Address" style="border:thin #ede solid;	width:96%;	padding:5px;	border-radius:2px;margin:auto 2% auto 2%; color:#999" Required onkeyup="convert_addr()">
					</div>
					<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly> 
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"> 							
			    </td>
			</tr>
			</table>
			
			
			<table id="example" class="table" cellspacing="1" width="100%" border="0">
			<tr class="box-section">
				<td width="50%">
					<div class="form-group">
						<label for="City" class="control-label label-left"><i class="fa fa-map-marker" aria-hidden="true"></i>  City</label>
						<input type="text" name="City" id="City" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" Required onkeyup="convert_city()"> 
					</div>
					
					<div class="form-group">
						<label for="Country" class="control-label label-left"><i class="fa fa-globe" aria-hidden="true"></i>  Country</label> <br>
						<!-- Country dropdown list by Kelvin -->
						<select class="sel-opt-left" name="Country" id="Country" required>
									<option value="">Select Country</option>
									<option value="Afghanistan">Afghanistan</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antartica">Antarctica</option>
									<option value="Antigua and Barbuda">Antigua and Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
									<option value="Brunei Darussalam">Brunei Darussalam</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos Islands">Cocos (Keeling) Islands</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Congo">Congo, the Democratic Republic of the</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cota D'Ivoire">Cote d'Ivoire</option>
									<option value="Croatia">Croatia (Hrvatska)</option>
									<option value="Cuba">Cuba</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="East Timor">East Timor</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="France Metropolitan">France, Metropolitan</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Territories">French Southern Territories</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-Bissau">Guinea-Bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
									<option value="Holy See">Holy See (Vatican City State)</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran">Iran (Islamic Republic of)</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
									<option value="Korea">Korea, Republic of</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Lao">Lao People's Democratic Republic</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macau">Macau</option>
									<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia">Micronesia, Federated States of</option>
									<option value="Moldova">Moldova, Republic of</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Netherlands Antilles">Netherlands Antilles</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn">Pitcairn</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russian Federation</option>
									<option value="Rwanda">Rwanda</option>
									<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
									<option value="Saint LUCIA">Saint LUCIA</option>
									<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia (Slovak Republic)</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
									<option value="Span">Spain</option>
									<option value="SriLanka">Sri Lanka</option>
									<option value="St. Helena">St. Helena</option>
									<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syria">Syrian Arab Republic</option>
									<option value="Taiwan">Taiwan, Province of China</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania, United Republic of</option>
									<option value="Thailand">Thailand</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad and Tobago">Trinidad and Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks and Caicos">Turks and Caicos Islands</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Emirates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Vietnam">Viet Nam</option>
									<option value="Virgin Islands (British)">Virgin Islands (British)</option>
									<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
									<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Yugoslavia">Yugoslavia</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
								</select> 
					</div>
			  </td>
				<td width="50%"> 
					<div class="form-group">
						<label for="State" class="control-label label-right"><i class="fa fa-map-marker" aria-hidden="true"></i>  State</label>
						<input type="text" name="State" id="State" style="border:thin #ede solid;	width:97%;	padding:5px;  border-radius:2px;margin:auto 0% auto -1%; color:#999" Require onkeyup="convert_state()"> 
					</div>

					<div class="form-group">
						<label for="UserId" class="control-label label-right"><i class="fa fa-user" aria-hidden="true"></i> User </label>
						<select class="sel-opt-right" name="UserId" id="UserId" required>
						<option value=""> Select User </option>
						@if($users)
							@foreach ($users as $users)
                                <option value="{{{ $users->UserId }}}"> {{ $users->FirstName .' ' .$users->LastName}} </option>
                            @endforeach
						@endif	
						</select>
					</div> 
				</td>
			</tr>
			
			<tr> <td style="margin-left:-15px"> Dealer Address </td><td> </td> </tr>
			
			<tr class="box-section">
				<td width="50%">
					<div class="form-group">
						<label for="OperationHoursFrom" class="control-label label-left"><i class="fa fa-calender"></i> Opens From</label>
						<input type="text" class="timepicker" name="OperationHoursFrom" id="OperationHoursFrom" placeholder="HH:MM" style="border:thin #ede solid;	width:93%;	padding:5px;	border-radius:2px;margin:auto 2% auto 4%; color:#999" Required> 
					</div>		
			   </td>
				<td width="50%"> 
					<div class="form-group">
						<label for="OperationHoursTo" class="control-label label-right"><i class="fa fa-calender"></i> Closes At </label>
						<input type="text" class="timepicker" name="OperationHoursTo" id="OperationHoursTo" placeholder="HH:MM" style="border:thin #ede solid;	width:97%;	padding:5px;  border-radius:2px;margin:auto 0% auto -1%; color:#999" Required> 
					</div>
				</td>

			</tr>
			
			<tr>
			<td colspan="3">
				<div class="form-group" style="margin-left:-6px">
					<button type="submit" class="btn btn-primary">Add Workshop</button>
					<button type="reset" class="btn btn-default">Cancel</button>
				</div>
			</td>
			</tr>
		</table>
		</Form>
	</div>
	</div>
	
	
	</div>

</section>


</div>

   
   
   
   




<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_name() 
	{
		var str = document.getElementById('WorkShopName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('WorkShopName').value = cap;
	}
		
	function convert_addr() 
	{
		var str = document.getElementById('Address').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Address').value = cap;
	}
	
	function convert_city() 
	{
		var str = document.getElementById('City').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('City').value = cap;
	}
	
	function convert_state() 
	{
		var str = document.getElementById('State').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('State').value = cap;
	}
		
	function convert_cont() 
	{
		var str = document.getElementById('ContactName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('ContactName').value = cap;
	}
</script>


@stop