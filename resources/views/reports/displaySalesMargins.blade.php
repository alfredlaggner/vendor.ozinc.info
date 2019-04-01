@extends('layouts.app')
@section('title', 'Sales Report')
@section('content')
    <div class="container">
        <div class="d-flex p2">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br/>
            @endif
            <div class=" d-flex flex-column bd-highlight mb-3">
                <div>
                    <div class="row">

                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item">Date from: <b>{{$data['dateFrom']}}</b></li>
                                <li class="list-group-item">Date to: <b>{{$data['dateTo']}}</b></li>
                                <li class="list-group-item">Number of products: <span
                                            style="color:red"><b>{{$itemCount}}</b></span></li>
                            </ul>
                            <a href="{{ route('go-home') }}" class="btn btn-outline-primary" role="button"
                               aria-pressed="true">Home</a>

                        </div>
                    </div>
                </div>
                <div  style="margin-top: 20px">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Acccount</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sline as $sl)
                            <tr>
                                <td>{{date('m-d-Y',strtotime($sl->order_date))}}</td>
                                <td>{{substr($sl->name,0,100)}}</td>
                                <td>{{$sl->quantity}}</td>
                                <td>{{$sl->customer->name}}</td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('go-home') }}" class="btn btn-outline-primary" role="button"
                   aria-pressed="true">Home</a>
            </div>
        </div>
@endsection
