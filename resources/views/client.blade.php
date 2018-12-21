@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ link_to('admin','Home') }} :: User Card
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">
               
                    <div>{{ $client->fio }}</div>
                    <div><b>Email</b>: {{ $client->email }}</div>                      
                    <div><b>Balance</b>: {{ $client->balance }}</div>
                    <div><b>Status</b>: {!! ($client->status ? 'Active' : 'Blocked') !!}</div>
                   
                        
                    {!! Form::open() !!}
                    <div>
                        {{ Form::label('addmoney', 'Add money: ') }}
                        {{ Form::text('addmoney', null, ['placeholder' => 'Enter from 1 to 10000']) }}
                    </div>
                     <div>
                        {{ Form::label('backmoney', 'Back money: ') }}
                        {{ Form::text('backmoney', null, ['placeholder' => 'Enter to ' . $client->balance]) }}
                    </div>
                    <div>
                        {{ Form::label('status', 'To block: ') }}
                        {{ Form::checkbox('status', '1') }}
                    </div>
                        {{ Form::submit('Apply') }}                                      
                    {!! Form::token() . Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
