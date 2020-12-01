@extends('templates.default')

@section('content')


<?php     $Chart = DB::table('chart')->get();     ?>

@foreach ($Chart as $row) 
<?php $data[] = $row;    ?>
@endforeach

<?php print json_encode($data);  ?>




@stop`