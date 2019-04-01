@extends('layouts.app')
@section('title', 'Driver Logs')
@section('content')
    <h4 class="text-center">Enter Search Parameters</h4><br/>
    <form method="post" action="{{route('view_report')}}">
        @csrf
        {{--
                <input name="_method" type="hidden" value="PATCH">
        --}}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="make">Date from</label>
                <input type="date" class="form-control" name="dateFrom" value="{{$data['dateFrom']}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="model">Date to:</label>
                <input type="date" class="form-control" name="dateTo" value="{{$data['dateTo']}}">
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <button type="submit" name="display" value="display" class="btn btn-primary col-2" style="margin-left:38px">
                    Display
                </button>

                <button type="submit" name="export" value="export" class="btn btn-primary col-2" style="margin-left:38px">
                    Download
                </button>

            </div>
        </div>
    </form>
@endsection