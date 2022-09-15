@extends('layouts.app')

@section('style')
@endsection

@section('content')

  <div class="card p-4">

    @include('flash-message')
        <table class="table" id="dt_items">
           <thead>
                <tr class="border-dark">
                    @foreach($table_fields as $k => $v)
                    <th {!!$v!!}>{!!$k!!}</th>
                    @endforeach
                </tr>
                </thead>
        </table>


  </div>


@endsection
@section('script')
<script src="/js/views/{{$table_name}}.js"></script>
@endsection
