@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Dashboard</h1>
        <br><br>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $category }}</h3>
                        <p>Book Category</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag">{{ $category }}</i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $book }}</h3>
                        <p>Books</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag">{{ $book }}</i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $staffuser }}</h3>
                        <p>Staff User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag">{{ $staffuser }}</i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $reader }}</h3>
                        <p>Reader Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag">{{ $reader }}</i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            // menu active
            $(".dashboard_route").addClass('active');

        });
    </script>
@endsection
