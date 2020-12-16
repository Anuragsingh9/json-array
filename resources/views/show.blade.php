<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="font-size:14px; background-color: #e7eff1;">
{{--<div class="container" style="font-size:14px; background-color: #e7eff1;">--}}
{{--    <br class="row">--}}
    <table class="table table-hover" >

    <h2 style="margin-left: 430px; font-family: inherit;color: darkblue;">Filter Your Data Tables</h2>

    <br>
    <form method="get">
        <div class="input-group mt-3 mb-3">

            <div class="input-group-prepend">
                <p style="font-size: 17px; padding-right: 5px; margin-left: 10px; color:#2323b3" >Select</p>
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                    {{$numberOfEntries}}
                </button> <p style="font-size: 17px; padding-left: 5px; color:#2323b3">Entries</p>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('get-data',['number' => 5])}}" > 5</a>
                    <a class="dropdown-item active" href="{{route('get-data',['number' => 8])}}"> 8</a>
                    <a class="dropdown-item" href="{{route('get-data',['number' => 10])}}"> 10</a>
                    <a class="dropdown-item" href="{{route('get-data',['number' => 20])}}">20</a>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12" style="display: flex; font-size: 25px; color:#2323b3;">
            <div class="col-lg-6">
                Showing  {{$data->count()}} out of {{$count}} entries
            </div>
            <div class="col-lg-6" >
                {{ $data->links() }}
            </div>
        </div>
    </div>
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
                    @foreach($data as $details)

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
{{--</div>--}}
</body>
</html>
