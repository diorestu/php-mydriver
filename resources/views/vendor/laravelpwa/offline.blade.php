@extends('layouts.frontend')

@section('title')
Dashboard
@endsection

@section('content')
<!-- Header -->
<div class="navbar two-action no-hairline">
    <div class="navbar-inner d-flex align-items-center justify-content-between">
        <div class="left">
            <a href="#" class="link icon-only"><i class="material-icons">menu</i></a>
        </div>
    </div>
</div>
<!-- /Header -->

<!-- Page Content -->
<div class="page-content mt-0">

    <div class="container mt-4">
        <div class="dash-widget pb-2 pt-1">
            <div class="dash-widget-info">
                

            </div>
        </div>
        <div class="dashboard-area mt-4">
            <h5 class="mt-2">Menu</h5>
            <div class="row">
            </div>
        </div>
    </div>
</div>

@endsection
