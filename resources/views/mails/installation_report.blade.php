<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Antenna Monitor</title>
</head>
<body>
<div class="container ">
    @if(isset($data))
        <img class="justify-content-center" src="images/logo.jpg" alt="HODI">
        <h4 class=" text-center mb-4">ANTENNA MONITOR INSTALLATION REPORT</h4>

        <h5 class="  text-right mb-4"><?php echo $data['date'] . "  " . $data['time'];?></h5>
        <h5>Name:<span><?php echo $data['name'];?></span></h5>
        <h5>Email:<span><?php echo $data['email'];?></span></h5>
        <h5>Designation:<span><?php echo $data['role'];?></span></h5>
    <br>
        <h5>Report ID:<span><?php echo $data['report_id'];?></span></h5>
        <h5>Site Name:<span><?php echo $data['site_name'];?></span></h5>
        <h5>Sectors Installed:<span><?php echo $data['sectors_count'];?></span></h5>

        <div class="row">
            <div class="col-md-8">

                <table class="table table-striped table-bordered">
                    <thead class="bg-info">
                    <tr>
                        <th scope="col">Sector</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Pitch</th>
                        <th scope="col">Roll</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($readings as $value)
                    <tr>


                        <td>{{$value['sector_id']}}</td>
                        @foreach($value['monitor_data'] as $r)
                        <td>{{$r['heading']}}</td>
                        <td>{{$r['pitch']}}</td>
                        <td>{{$r['roll']}}</td>
                            @endforeach
                    </tr>


                      @endforeach

                    </tbody>
                </table>
            </div>
        </div>
       <h6 class="text-center"><?php echo $data['site_name'] ." Installation Report" ;?></h6>
    @endif
</div>
</body>
</html>
