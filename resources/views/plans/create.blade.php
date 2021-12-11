@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card" style="width:24rem;margin:auto;">
            <div class="card-body">
                    {!! Form::open(['url' => route('store.plan'), 'data-parsley-validate', 'method' => 'post', 'id' => 'payment-form']) !!}
                    @csrf
                    <div class="form-group">
                        <label for="plan name">Plan Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Plan Name">
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost:</label>
                        <input type="text" class="form-control" name="cost" placeholder="Enter Cost">
                    </div>
                    <div class="form-group">
                        <label for="cost">Plan Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter Description">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
