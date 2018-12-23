@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   {{ link_to('admin','Home') }} :: Add user
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
                    {!! Form::open() !!}
                        {{ Form::label('fio', 'Name:*') }}
                        {{ Form::text('fio', null, ['placeholder' => 'Robert Dragon']) }}
                        {{ Form::label('email', 'Email:*') }}
                        {{ Form::text('email', null, ['placeholder' => 'username@gmail.com']) }}
                        {{ Form::submit('Add') }}
                    {!! Form::token() . Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
