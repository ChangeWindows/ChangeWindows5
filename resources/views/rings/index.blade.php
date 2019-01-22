@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Rings</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row px-n10">
    <div class="col">
        <p class="h3"><i class="fab fa-fw fa-windows"></i> PC</p>
        <div class="row row-gutter">
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['pc']['skip'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['pc']['active'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['pc']['slow'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['pc']['release'] ) ?></div>
            <div class="col-xl-4 col-lg-12 col-md-4 col-sm-4 col-12"><?php getTile( $flights['pc']['target'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-4 col-6"><?php getTile( $flights['pc']['broad'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-4 col-6"><?php getTile( $flights['pc']['ltsc'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-xbox"></i> Xbox</p>
        <div class="row row-gutter">
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['skip'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['active'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['preview'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['release'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['target'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> IoT</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iot']['slow'] ) ?></div>
            <div class="col"><?php getTile( $flights['iot']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['iot']['broad'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Server</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['server']['slow'] ) ?></div>
            <div class="col"><?php getTile( $flights['server']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['server']['ltsc'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Holographic</p>
        <div class="row row-gutter">
            <div class="col-xl-6 col-lg-6 col-sm-6 col-6"><?php getTile( $flights['holo']['active'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-6"><?php getTile( $flights['holo']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-12 col-sm-4 col-12"><?php getTile( $flights['holo']['target'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['holo']['broad'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['holo']['ltsc'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Team</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['team']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['team']['broad'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Mobile</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['mobile']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['mobile']['broad'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> SDK</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['sdk']['target'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> ISO</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iso']['target'] ) ?></div>
        </div>
    </div>
</div>
@endsection