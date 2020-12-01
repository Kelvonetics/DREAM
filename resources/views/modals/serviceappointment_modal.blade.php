<table id="example" class="table table-full table-full-small" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th> Vehicle </th>
			<th> Last Mile </th>
			<th> Current Mile </th>
			<th> Last Date </th>
			<th> Due Date </th>
            <th> Workshop </th>
			<th scope="col" class="actions"> Actions </th>
		</tr>
		</thead>

		<tbody>
		@if($serviceAppointment) 
			@foreach ($serviceAppointment as $serviceAppointment)
				<tr>

					<td> 
                        <?php
                            $vehicle = DB::table('asset')->where('AssetId', '=', $serviceAppointment->AssetId)->first();
                        ?> @if($vehicle) {{$vehicle->LicensePlate}} @endif
                    </td>
					<td>     {{ $serviceAppointment->LastMaintMile }}    </td>
					<td>     {{ $serviceAppointment->CurrentMile }}         </td>
					<td>     {{ $serviceAppointment->LastMaintMile }}       </td>
					<td>     {{ $serviceAppointment->DueDate }}       </td>
                    <td> 
                        <?php
                            $shop = DB::table('workshop')->where('WorkShopId', '=', $serviceAppointment->WorkshopId)->first();
                        ?> @if($client) {{$shop->WorkShopName}} @endif
                    </td>
					<td> <a href="#" class="btn btn-primary" style="color:#fff; font-size:9px" > Manage </a> </td>

				</tr>
			@endforeach
		@endif
		 </tbody>
    </table>