@extends('templates.default')

@section('content')

<!-- LOGGED IN USER  -->
<?php  $auth_user = Auth::user();  ?>


<style>
	.option { font-size:16px; margin:3px 5px; color:#999 }
	
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
	
.sel-opt
	{
		border:thin #ede solid;
		width:97%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 2%;
	}

.sel-opt-full
	{
		border:thin #ede solid;
		width:98.5%;
		padding:10px 5px;
		border-radius:2px;
		color:#999;
		margin:auto 1%;
	}

label 
	{
		color:#666;
		margin:auto 2%;
	}
.label-left
	{
		color:#666; margin:auto 2% auto 1%;
	}
.label-right
	{
		color:#666; margin:auto 4% auto 2%;
	}
.tab-top-bottom
	{
		height:15px;
	}

.part-div
	{
		margin:15px 0px;
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
</style>

<div class="main-content row" autoscroll="true" bs-affix-target="" init-ripples bg="" style="margin-top:-100px">
          <section class="forms-basic">
            <div class="page-header">
              <h1>      <i class="fa fa-female"></i>    Client Administration    </h1>
			  <p class="lead"> The client administration module allows you to manage and analyze customer interactions and data throughout the customer lifecycle, <br>  with the goal of improving business relationships with your customers, assisting in customer retention and driving sales growth.  </p>
            </div>
            
		<!-- right content -->
		  <div class="col-md-3 col-md-push-9 left-side" style="margin:-0px -20px 0px 10px; background-color:#F9F9F9">
		  <div class="pull-right" style="margin:-25px -20px 0px 0px">
			<ul class="list-unstyled">
			  <li class="dropdown">
				<button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart"></i> </button>
			  </li>
			</ul>
		  </div>
		  
			<div class="right-card-view"> <h4 class="grey-text m-b-30">Action Feed</h4> </div>
			<div class="well white white-card"> 				 
            <center> <img src="{{URL::asset('assets/img/avatar.jpg')}}" class="img-responsive" height="150" width="150"> </center>
			    
				<!-- <center> <i class="grey-text m-b-30" > <?php //$client->FirstName .' '.$client->LastName  ?>	</i>  </center> -->
				
			</div>  	
			
			
				<!-- quick report div  -->
				<div class="grey-card" style="padding:0px 0px 0px 25px">
				<table class="table" width="105%" cellpadding="0">
					<tr>
						<td style="width:95%"> 
							<h4 class="grey-text m-b-30">   Quick Reports  </h4>
									</td>
						<td style="width:5%">  <button type="button" class="btn btn-round-sm btn-link" aria-haspopup="true" aria-expanded="false" data-template-url="#" data-toggle="tooltip" title="More stats"> <i class="fa fa-area-chart pull-right"></i> </button>  </td>
					</tr>
				</table>
				
					<div style="margin:-25px 10px 0px -10px" style="margin-top:-10px">
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green"  data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" title='Add New Client Job'>+</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Last 10 Jobs </a></div>
                    </div>
					
					<div class="p-10 p-l-20 p-r-20 clearfix" style="margin-top:-10px">
                      <div class="pull-right" style="margin:-5px -25px"><a href="#" class="btn btn-circle-green" data-toggle="modal" data-target="#invoiceModal" data-tooltip="true" class="waves-effect btn-circle waves-light btn modalBtn" title='Add New Client Job'>+</a></div>
                      <div class="w600"><a style="color:#2196F3;font-weight:lighter" href="#">Invoices From Last 30 Days </a></div>
                    </div>
					
                  </div>
				</div>
				

				<!-- quick information div  -->
				<div class="grey-card">
				<div style="margin:-10px 15px 0px 10px">
					<?php  //$this->element('asset_insight');  ?> 
				</div>
				</div>
			
		  </div>


			  
   <!-- left content -->
   <div class="col-md-9 col-md-pull-3 left-side well white" style="margin:-28px 0px 0px 10px">   
   
     <div>
              
		<form method="post" action="{{route('client.insert')}}" role="form">	
		<fieldset>
        
        <legend> New Client </legend>  
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Client Details</CAPTION>
			<tr class="box-section">
				<td width="50%"> 
					<div class="form-group">
					 <label for="FirstName" class="help-block label-left"> <i class="fa fa-male"></i> First Name * </label>
						<input type="text" name="FirstName" id="FirstName" onblur="convert_fname()" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" required /> 	
					</div>
								  
					<div class="form-group">
					  <label for="Email" class="help-block label-left"> <i class="fa fa-envelope"></i> E-mail * </label>
						<input type="email" name="Email" id="Email" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required />
					</div>							
			    </td>
				<td width="50%"> 
				
					<div class="form-group">
					 <label for="LastName" class="help-block label-right"> <i class="fa fa-male"></i> Last Name </label>
						<input type="text" name="LastName" id="LastName" onblur="convert_lname()" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" /> 	
					</div>
								
					<div class="form-group">	  
					  <div class="controls">
						<label for="Phone" class="help-block label-right"> <i class="fa fa-phone"></i> Phone * </label>
							<input type="text" name="Phone" id="Phone" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required> 
					  </div>							
					</div>
				</td>

			</tr>
			<tr class="box-section">
				<td width="100%" colspan="2"> 
					<div class="form-group">
					 <label for="Company" class="help-block label-left"> <i class="fa fa-bank"></i> Company Name * </label>
						<input type="text" name="Company" id="Company" onblur="convert_comp()" style="border:thin #ede solid;	width:98.5%;	padding:5px;	border-radius:2px;margin:auto 1%; color:#999" required /> 	
					</div>												
			    </td>
			</tr>
			
		</table>
		
		
		
		
		<table id="example" class="table" cellspacing="1" width="100%" border="0">
		<CAPTION>Client Address</CAPTION>				
			<tr class="box-section">
				<td width="48%"> 
					<div class="form-group">   <label for="Address" class="help-block label-left"> <i class="fa fa-map-marker"></i> Address 1 * </label>
						<input type="text" name="Address" id="Address" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required> 
					</div>	
					<div class="form-group">   <label for="City" class="help-block label-left"> <i class="fa fa-map-marker"></i> City </label>
						<input type="text" name="City" id="City" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required> 
					</div>
			    </td>
				<td width="48%"> 
					<div class="form-group">   <label for="Address_2" class="help-block label-right"> <i class="fa fa-map-marker"></i> Address 2 </label>
						<input type="text" name="Address_2" id="Address_2" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" > 
					</div>	
					<div class="form-group">   <label for="State" class="help-block label-right"> <i class="fa fa-map-marker"></i> State </label>
						<input type="text" name="State" id="State" style="border:thin #ede solid;	width:97%;	padding:5px;	border-radius:2px;margin:auto 2%; color:#999" Required> 
					</div>
			    </td>
			</tr>
			
			<tr class="box-section">
				<td width="50%" colspan="2"> 
					<div class="form-group">
								<label for="Country" class="control-label label-left"> <i class="fa fa-globe"></i> Country</label>
								<!-- Country dropdown list -->
								<select class="sel-opt-full" name="Country" id="Country" required style="">
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
			</tr>
		</table>
					 
					 
				 
							
					 
		<table id="example" class="table" cellspacing="1" width="100%" border="0">						
			<tr class="box-section">
				<td width="50%"> 
					
					<div class="form-group">
                        <button type="submit" class="btn btn-primary">Create Client</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                      </div>		
			    </td>
				<td width="50%"> 
					<div class="form-group">
						<input type="hidden" name="CreatedBy" id="CreatedBy" class="form-control" value="{{$auth_user->FirstName.' '.$auth_user->LastName}}" readonly > 
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" >
					</div>	
				</td>
			</tr>
		
		</table>

						
                      
		</fieldset>

		  </form>
		  </div>
		  
		  </div>
		  


  </section>
</div>


		<!-- SCRIPT TO CAPITALIZE EVERY FIRST LETTER -->
<script>
	function convert_fname() 
	{
		var str = document.getElementById('FirstName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('FirstName').value = cap;
	}
	
	function convert_lname() 
	{
		var str = document.getElementById('LastName').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LastName').value = cap;
	}
	
	function convert_comp() 
	{
		var str = document.getElementById('Company').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('Company').value = cap;
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
	
	function convert_lga() 
	{
		var str = document.getElementById('LGA').value;
		var splitStr = str.toLowerCase().split(' ');
	   for (var i = 0; i < splitStr.length; i++) {
		   // You do not need to check if i is larger than splitStr length, as your for does that for you
		   // Assign it back to the array
		   splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
	   }
	   // Directly return the joined string
	   var cap = splitStr.join(' '); 
			document.getElementById('LGA').value = cap;
	}
	
	function check_num()
	{
		var phone = document.getElementById('Phone').value;
		if(isNaN(phone)) { alert('Please, Enter Valid Phone Numbers!'); }
	}
	
</script>



@stop