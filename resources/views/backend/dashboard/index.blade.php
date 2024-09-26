@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('heading', 'Dashboard')

@section('contents')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a class="card card-statistic-1" href="javascript:void(0)" style="text-decoration: none">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pending Application</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a class="card card-statistic-1" href="javascript:void(0)" style="text-decoration: none">
                <div class="card-icon bg-danger">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Approved Application</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a class="card card-statistic-1"  style="text-decoration: none" href="javascript:void(0)">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Rejected Application</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
