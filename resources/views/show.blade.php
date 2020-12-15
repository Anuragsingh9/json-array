@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1><h1>This show page</h1></h1>
                <table>
                    <tr>
                        <th>bounce_type</th>
                        <th>bounceSubType</th>
                        <th>timestamp</th>
                        <th>mail_timestamp</th>
                        <th>name</th>
                        <th>value</th>
                        <th>from</th>
                        <th>reply_to</th>
                        <th>to</th>
                        <th>created_at</th>

                    </tr>

                    @foreach($data as $details)
                    <tr>
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
        </div>
    </div>
@endsection
