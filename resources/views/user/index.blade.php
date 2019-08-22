@section('title', 'Dashboard')
@extends('user.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-6">
            <div class="panel">
                <div class="miniStats--panel text-white bg-blue">
                    <div class="miniStats--header" data-overlay="0.1">
                        Overview
                    </div>
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-user text-white"></i>
                        Welcome
                        <h3 class="miniStats--title h4 text-white">Hi, {{$model['user']->nama_lengkap}}</h3>
                        <p class="miniStats--caption">Asal Institusi : {{$model['user']->institusi}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <div class="miniStats--panel text-white bg-orange">
                    <div class="miniStats--header" data-overlay="0.1">
                        Event
                    </div>
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-white"></i>
                        <h3 class="miniStats--title h4 text-white">{{$model['trx_product']->product_name}}</h3>
                        <p class="miniStats--caption">{!!$model['trx_product']->product_desc!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Data Anda
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table style--2">
                            <thead>
                                <tr>
                                    <th>Kartu Identitas</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Email</th>
                                    <th>Nomor Kontak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{$model['user']->identitas}}" width="100px" alt=""></td>
                                    <td>{{$model['user']->nama_lengkap}}</td>
                                    <td>{{$model['user']->tanggal_lahir}}</td>
                                    <td>{{$model['user']->email}}</td>
                                    <td>{{$model['user']->no_hp}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection