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
        <h2 class="text-right"><?php echo $data['test'];?></h2><br>
        <img class="justify-content-center" src="images/logo.jpg" alt="HODI">
        <h4 class=" text-center mb-4">ANTENNA MONITOR HARDWARE TEST REPORT</h4>

        <h5 class="  text-right mb-4"><?php echo $data['date'] . "  " . $data['time'];?></h5>
        <h5>Name:<span><?php echo $data['name'];?></span></h5>
        <h5>Email:<span><?php echo $data['email'];?></span></h5>
        <h5>Designation:<span><?php echo $data['role'];?></span></h5>

        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped table-bordered mb-2">

                    <tr>
                        <th scope="row">Test Report ID</th>
                        <td><?php echo $data['test_id'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Sensor ID</th>
                        <td><?php echo $data['qr_number'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Sim Card Serial Number</th>
                        <td><?php echo $data['imsi'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Battery</th>
                        <td><?php echo $data['voltage'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">ASU</th>
                        <td><?php echo $data['csq'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td><?php echo $data['date'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Time</th>
                        <td><?php echo $data['time'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Test Result</th>
                        <td><?php echo $data['test'];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6"></div>

        <div class="row">
            <div class="col-md-8">
                <h4> Test Sequence </h4>
                <table class="table table-striped table-bordered">
                    <thead class="bg-info">
                    <tr>
                        <th scope="col">Step</th>
                        <th scope="col">Status</th>
                        <th scope="col">Measurement</th>
                        <th scope="col">Low Limit</th>
                        <th scope="col">High Limit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Connectivity</th>
                        <td><?php echo $data['asu_test'];?></td>
                        <td>ASU</td>
                        <td>7</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <th scope="row">Battery</th>
                        <td><?php echo $data['voltage_test'];?></td>
                        <td>Volts</td>
                        <td>4.8v</td>
                        <td>5.1v</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    @endif
</div>
</body>
</html>
