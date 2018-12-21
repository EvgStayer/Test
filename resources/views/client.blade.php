@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User Card
                </div>
                <div class="panel-body">
               
                    <div>{{ $client->fio }}</div>
                    <div>{{ $client->email }}</div>
                      
                    <div><b>Balance</b>: {{ $client->balance }}</div>
                    <div><b>Status</b>: {!! ($client->status ? 'Activ' : 'Block') !!}</div>
                   
                        
                    {!! Form::open() !!}
                    <div>
                        {{ Form::label('addmoney', 'Add money: ') }}
                        {{ Form::text('addmoney') }}
                    </div>
                     <div>
                        {{ Form::label('backmoney', 'Back money: ') }}
                        {{ Form::text('backmoney') }}
                    </div>
                    <div>
                        {{ Form::label('ststus', 'To block: ') }}
                        {{ Form::checkbox('status', false) }}
                    </div>
                        {{ Form::submit('Apply') }}                                      
                    {!! Form::token() . Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
