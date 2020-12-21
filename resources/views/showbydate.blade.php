<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="font-size:14px; background-color: #e7eff1;">

<div class="container">

    <table class="table table-hover" >
        <h2 style="margin-left: 430px; font-family: inherit;color: darkblue;">Filter Your Data Tables</h2>
        <br>
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                </div>
        <form method="get" action="{{url('/data/date')}}">
            <div class="input-group mt-3 mb-3 row" style="display: flex; font-size: 25px; color:#2323b3;" >
                <div class="input-group-prepend col-md-12" >
                    {{ $dateData->links() }}
                    <input class="date form-control col-md-2" type="text" autocomplete="off" name="from_date" placeholder="From date" style="margin-left: auto;">
                    <input class="date form-control col-md-2" type="text" autocomplete="off" name="to_date" placeholder="To">
                    <input class=" form-control col-md-2"  autocomplete="off" type="email" name="from_email"  placeholder="From abc@xyz.com" >
                    <input class=" form-control col-md-2"  autocomplete="off" type="email" name="to_email" placeholder="To abc@xyz.com">
                    <button type="submit" href="{{ route('data/date') }}" class="btn btn-primary" style="margin-left: 6px;">Primary</button>
                </div>

            </div>
        </form>
        <thead style="border-bottom: groove;">
        <tr>
            <th>S.No</th>
            <th>Bounce Type</th>
            <th>Bounce Sub Type</th>
            <th>Timestamp</th>
            <th>Mail Timestamp</th>
            <th>Name</th>
            <th>Value</th>
            <th>From</th>
            <th>Reply To</th>
            <th>To</th>
            <th>Created At</th>

        </tr>
        </thead>
        @foreach($dateData as $details)

            <tr style="color:#2323b3">
                <td>{{$loop->iteration}}</td>
                <td>{{ $details->bounce_type }}</td>
                <td>{{ $details->bounceSubType }}</td>
                <td>{{ $details->timestamp }}</td>
                <td>{{ $details->mail_timestamp }}</td>
                <td>{{ $details->name }}</td>
                <td>{{ $details->value }}</td>
                <td>{{ $details->from }}</td>
                <td>{{ $details->reply_to }}</td>
                <td>{{ $details->to }}</td>
                <td>{{ $details->created_at }}</td>
            </tr>
        @endforeach

    </table>

</div>
<script type="text/javascript">
    $('.date').datepicker({
        // format: 'yyyy-mm-dd'
        dateFormat: 'dd/mm/yy'
    });
</script>
</body>
</html>
