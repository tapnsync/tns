@extends('user_profile.layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            {{-- <div class="input-group date datepicker wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar"
                        class=" text-primary"></i></span>
                <input type="text" class="form-control border-primary bg-transparent">
            </div>
            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="printer"></i>
                Print
            </button>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                Download Report
            </button> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card border-warning" style="    background: #fffbee;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0 text-warning">Total Profile</h6>
                                <!--<div class="dropdown mb-2">-->
                                <!--    <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"-->
                                <!--        aria-haspopup="true" aria-expanded="false">-->
                                <!--        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>-->
                                <!--    </button>-->
                                    
                                <!--</div>-->
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2 text-warning">{{$totalContacts}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <!--<p class="text-success">-->
                                        <!--    <span>+3.3%</span>-->
                                        <!--    <i data-feather="arrow-up" class="icon-sm mb-1"></i>-->
                                        <!--</p>-->
                                    </div>
                                </div>
                                <!--<div class="col-6 col-md-12 col-xl-7">-->
                                <!--    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card border-success" style="background: #f8fffb;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0 text-success">Active Profiles</h6>
                                <!--<div class="dropdown mb-2">-->
                                <!--    <button class="btn p-0" type="button" id="dropdownMenuButton1"-->
                                <!--        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                <!--        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>-->
                                <!--    </button>-->
                                   
                                <!--</div>-->
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2  text-success">{{$totalContactsActive}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <!--<p class="text-danger">-->
                                        <!--    <span>-2.8%</span>-->
                                        <!--    <i data-feather="arrow-down" class="icon-sm mb-1"></i>-->
                                        <!--</p>-->
                                    </div>
                                </div>
                                <!--<div class="col-6 col-md-12 col-xl-7">-->
                                <!--    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card border-danger" style="background: #fffafb">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0 text-danger">Inactive Profiles</h6>
                                <!--<div class="dropdown mb-2">-->
                                <!--    <button class="btn p-0" type="button" id="dropdownMenuButton2"-->
                                <!--        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                <!--        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>-->
                                <!--    </button>-->
                                    
                                <!--</div>-->
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2 text-danger">{{$totalContactsInActive}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <!--<p class="text-success">-->
                                        <!--    <span>+2.8%</span>-->
                                        <!--    <i data-feather="arrow-up" class="icon-sm mb-1"></i>-->
                                        <!--</p>-->
                                    </div>
                                </div>
                                <!--<div class="col-6 col-md-12 col-xl-7">-->
                                <!--    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
