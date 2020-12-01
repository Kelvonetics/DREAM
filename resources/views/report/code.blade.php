@extends('templates.default')

@section('content')


<style type="text/css">
    #chart-container 
    {
        width: 640px;
        height: auto;
    }
</style>

<div id="chart-container">
    <canvas id="mycanvas"></canvas>
</div>


<!-- javascript -->

<script>
    $(document).ready(function()
    {
	    $.ajax(
        {
            url: "{{route('report.data')}}",
            method: "GET",
            success: function(data) 
            {
                console.log(data);
                var player = [];
                var score = [];

                for(var i in data) 
                {
                    player.push("Player " + data[i].playerid);
                    score.push(data[i].score);
                }

                var chartdata = 
                {
                    labels: player,
                    datasets : 
                    [
                        {
                            label: 'Player Score',
                            backgroundColor: 'rgba(200, 200, 200, 0.75)',
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: score
                        }
                    ]
                };

                var ctx = $("#mycanvas");

                var barGraph = new Chart(ctx, 
                {
                    type: 'bar',
                    data: chartdata
                });
            },
            error: function(data) 
            {
                console.log(data);
            }
	});
});
</script>

@stop