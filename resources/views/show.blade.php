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
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>--}}
</head>
<body style="font-size:14px; background-color: #e7eff1;">

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
        <div class="input-group mt-3 mb-3 row" >
            <div class="input-group-prepend col-md-12" >
                <p style="font-size: 17px; padding-right: 5px; margin-left: 10px; color:#2323b3" >Select</p>
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                    {{$numberOfEntries}}
                </button> <p style="font-size: 17px; padding-left: 5px; color:#2323b3">Entries</p>
                <div class="dropdown-menu col-md-4">
                    <a class="dropdown-item" href="{{route('get-data',['number' => 5])}}" > 5</a>
                    <a class="dropdown-item active" href="{{route('get-data',['number' => 8])}}"> 8</a>
                    <a class="dropdown-item" href="{{route('get-data',['number' => 10])}}"> 10</a>
                    <a class="dropdown-item" href="{{route('get-data',['number' => 20])}}">20</a>
                </div>
                    <input class="date form-control col-md-2"  autocomplete="off" type="text" name="from_date" placeholder="From date" style="margin-left: auto;">
                    <input class="date form-control col-md-2"  autocomplete="off" type="text" name="to_date" placeholder="To">
                    <input class=" form-control col-md-2"  autocomplete="off" type="email" name="from_email"  placeholder="From abc@xyz.com" >
                    <input class=" form-control col-md-2"  autocomplete="off" type="email" name="to_email" placeholder="To abc@xyz.com">
                    <button type="submit" href="{{ route('data/date') }}" class="btn btn-primary" style="margin-left: 6px; font-size: 0.8em;">Primary</button>
            </div>
        </div>
    </form>
{{--        <div class="row">--}}
{{--            <form method="get"   action="{{ url('api/data/date') }}" class="form-inline">--}}
{{--                {{ csrf_field() }}--}}
{{--                --}}{{--            <div class="form-group mb-2 col-md-4">--}}
{{--                --}}{{--                <label for="staticEmail2" class="sr-only">Email</label>--}}
{{--                --}}{{--                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">--}}
{{--                --}}{{--            </div>--}}
{{--                --}}{{--            <div class="form-group mx-sm-3 mb-2 col-md-4">--}}
{{--                <input class="date form-control col-md-2" type="text" name="from_date" placeholder="From date" style="margin-left: auto;">--}}
{{--                <input class="date form-control col-md-2" type="text" name="to_date" placeholder="To">--}}
{{--                --}}{{--            </div>--}}
{{--                <a class="btn btn-primary mb-2" href="{{route('data/date')}}" > Search</a>--}}

{{--                 <button type="submit" class="btn btn-primary mb-2" style="margin-left: 6px;">Search</button>--}}
{{--            </form>--}}

{{--        </div>--}}

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

    <script type="text/javascript">
        $('.date').datepicker({
            // format: 'yyyy-mm-dd'
            dateFormat: 'dd/mm/yy'
        });
    </script>
</body>
</html>
