<table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th> Vehicle </th>
			<th> Fuel Station </th>
			<th> Fuel PurchaseDate </th>
			<th> No Litres </th>
			<th> Fuel Cost </th>
            <th> Purchaser </th>
			<th scope="col" class="actions"> Actions </th>
		</tr>
		</thead>

		<tbody>
		@if($lastfuel)
			@foreach ($lastfuel as $lastfuel)
				<tr>

					<td> 
                        <?php
                            $vehicle = DB::table('asset')->where('AssetId', '=', $lastfuel->AssetId)->first();
                        ?> @if($vehicle) {{$vehicle->LicensePlate}} @endif
                    </td>
					<td>     {{ $lastfuel->FuelStation }}    </td>
					<td>     {{ $lastfuel->FuelPurchaseDate }}         </td>
					<td>     {{ $lastfuel->NoLitres }}       </td>
					<td>     {{ $lastfuel->FuelCost }}       </td>
                    <td> 
                        <?php
                            $User = DB::table('users')->where('UserId', '=', $lastfuel->UserId)->first();
                        ?> @if($User) {{$User->FirstName.' '.$User->LastName}} @endif
                    </td>
					<td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a> </td>

				</tr>
			@endforeach
		@endif
		 </tbody>
    </table>