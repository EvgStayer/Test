@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/admin/client/add/">Add User</a>
                    {!! Form::open() !!}
                        Filters: 
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', '') }}
                        {{ Form::label('balance', 'Balance') }}
                        {{ Form::select('if_balance', ['>' => 'More', '<' => 'Less', '=' => 'Equally']) }}  
                        {{ Form::text('s_balance', '') }}           
                        {{ Form::submit('Find') }}                                      
                    {!! Form::token() . Form::close() !!}
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Next Payment</th>
                            <th>Last Payment</th>
                            <th>Create Date</th>
                            <th>Balans</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($items as $key => $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td><a href="/admin/client/{{$value->id}}/">{{$value->fio}}</a></td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->next_payment}}</td>
                                <td>{{$value->last_payment}}</td>
                                <td>{{$value->created_at}}</td>                      
                                <td>{{$value->balance}}</td>                      
                                <td>{!! ($value->status ? 'Active' : 'Blocked') !!}</td>                      
                            </tr>                       
                        @endforeach                  
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
