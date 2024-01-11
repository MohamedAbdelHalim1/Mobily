@extends('admin.layouts.layout')

@section('title')
<title>Dashboard</title>

@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                      
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>



                         <!-- Pending orders Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($pending_orders)}}</div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- indeleviery orders Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                In Delivery Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($delivering_orders)}}</div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>


                           <!-- Deliverd orders Card Example -->
                           <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Deliverd Orders</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($deliverd_orders)}}</div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>



                            
                           <!-- Number of customer Card Example -->
                           <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Customers</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($customers)}}</div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>


        </div>



    </div>
    <!-- /.container-fluid -->


@endsection