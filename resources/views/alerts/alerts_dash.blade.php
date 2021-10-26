@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="./assets/datatables/datatables.min.css" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="./assets/css/datatables.css" />
@endpush

@section('content-title')
<div class="page-title-heading page-title-heading-m">
    <div>
        <h3>SITES</h3>
    </div>
</div>
@endsection

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>ALERTS - <small>Dashboard</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="row ad-cards">
                <div class="col-md-4">
                    <a href="/alerts#new" class="ad-dash-card">
                        <div class="card border-info">
                            <div class="card-body ad-card-body-m text-info">
                                <div class="row">
                                    <div class="col-md-7 ad-card-h">
                                        <h6 class="ad-card-title" >New Alerts</h6>
                                        <h6 class="ad-card-subtitle" >Unviewed Alerts</h6>
                                    </div>
                                    <div class="col-md-5 ad-card-no">
                                        <h2 class="ad-card-number">5</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/alerts#new" class="ad-dash-card">
                        <div class="card border-info">
                            <div class="card-body ad-card-body-m text-info">
                                <div class="row">
                                    <div class="col-md-7 ad-card-h">
                                        <h6 class="ad-card-title" >Pending Alerts</h6>
                                        <h6 class="ad-card-subtitle" >Unassigned Alerts</h6>
                                    </div>
                                    <div class="col-md-5 ad-card-no">
                                        <h2 class="ad-card-number">7</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="ad-dash-card">
                        <div class="card border-info">
                            <div class="card-body ad-card-body-m text-info">
                                <div class="row">
                                    <div class="col-md-8 ad-card-h">
                                        <h6 class="ad-card-title" >Optimizations</h6>
                                        <h6 class="ad-card-subtitle">Cells Under Optimization</h6>
                                    </div>
                                    <div class="col-md-4 ad-card-no">
                                        <h2 class="ad-card-number">3</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <hr class="sd-cards-hr" />

            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-lg-12" style="position: relative;">
                            <canvas id="bar-chart-grouped" style="height: 350px;"></canvas>
                        </div>
                    </div>
                    <hr class="sd-cards-hr" />
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <h5 class="ad-h5">top 20 sites by alerts</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                                <table id="top_ten_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Site Name</th>
                                                <th>Alerts</th>
                                                <th>Technologies</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> Athi River South MSR MGF HUB </td>
                                                <td> 41 </td>
                                                <td> LTE1800, LTE800</td>
                                            </tr>
                                            <tr>
                                                <td> Kiwegi OUTL MGF  </td>
                                                <td> 33 </td>
                                                <td> LTE800, GSM1800, UMTS2100</td>
                                            </tr>
                                            <tr>
                                                <td> Busia Exchange WMX OUTL MGF  </td>
                                                <td> 30 </td>
                                                <td> UMTS900, UMTS2100, LTE800</td>
                                            </tr>
                                            <tr>
                                                <td> Mombasa Mwembe Tayari MRT </td>
                                                <td> 30 </td>
                                                <td> GSM1800, LTE1800, LTE800 </td>
                                            </tr>
                                            <tr>
                                                <td> Kisii Town WMX OUTL MRT </td>
                                                <td> 29 </td>
                                                <td> UMTS900, LTE800, LTE1800   </td>
                                            </tr>
                                            <tr>
                                                <td> Kyulu OUTH MGF </td>
                                                <td> 26 </td>
                                                <td> LTE1800, UMTS900 </td>
                                            </tr>
                                            <tr>
                                                <td> Narok Nyawira street OUTN MGF </td>
                                                <td> 24 </td>
                                                <td> UMTS2100, GSM1800, LTE800 </td>
                                            </tr>
                                            <tr>
                                                <td> SGR Masai Grazing Scheme MGF </td>
                                                <td> 19 </td>
                                                <td> GSM900, LTE1800 </td>
                                            </tr>
                                            <tr>
                                                <td> Utange South MGF </td>
                                                <td> 17 </td>
                                                <td> LTE800, UMTS2100  </td>
                                            </tr>
                                            <tr>
                                                <td> Bella Plaza MGF  </td>
                                                <td> 12 </td>
                                                <td> QUADBAND(U2100/L1800), LTE800 </td>
                                            </tr>
                                            <tr>
                                                <td> JKUAT Taveta Campus OUTH MGF </td>
                                                <td> 12 </td>
                                                <td> QUADBAND(U2100/L1800), GSM900</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Site Name</th>
                                                <th>Alerts</th>
                                                <th>Technologies</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                        </div>
                    </div>
            </div>
            <hr class="sd-cards-hr" />


        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="./assets/datatables/datatables.min.js"></script>
@endpush

@push('page-scripts')
    <script src="./assets/scripts/alerts_dash.js"></script>
@endpush