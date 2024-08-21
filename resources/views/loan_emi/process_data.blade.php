@extends('../layouts.app')

@section('content')
    <div class="container mt-5">
        @if($emiDetails->isNotEmpty())
        <h2>EMI Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Client ID</th>
                    
                        @foreach(array_keys($emiDetails->first()->toArray()) as $column)
                            @if($column !== 'clientid')
                                <th>{{ $column }}</th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($emiDetails as $detail)
                    <tr>
                        <td>{{ $detail->clientid }}</td>
                        @foreach(array_keys($detail->toArray()) as $column)
                        @if($column !== 'clientid')
                        <td>{{ $detail->$column }}</td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('process.data') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Process Data</button>
        </form>
    </div>
@endsection