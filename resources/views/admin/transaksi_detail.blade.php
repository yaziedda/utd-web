<?php 
$title =  'Detail Transaksi '.$model['trx_product']->ticket_id
?>
@section('title', $title)
@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        @if(Session::has('alert-success'))
        <div class="col-md-12">
            <div class="panel">
                <div class="miniStats--panel text-white bg-success">
                    <div class="miniStats--body">
                        <p class="miniStats--caption">Message</p>
                        <h3 class="miniStats--title h4 text-white">{{ Session::get('alert-success') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @elseif(Session::has('alert-failed'))
        <div class="col-md-12">
            <div class="panel">
                <div class="miniStats--panel text-white bg-danger">
                    <div class="miniStats--body">
                        <p class="miniStats--caption">Message</p>
                        <h3 class="miniStats--title h4 text-white">{{ Session::get('alert-failed') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white" style="background-color: <?php echo $model['trx_product']->status_color ?>">
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-shopping-cart text-white"></i>
                        <p class="miniStats--caption">Status</p>
                        <h3 class="miniStats--title h4 text-white">{{$model['trx_product']->status_name}}</h3>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel">
                <div class="miniStats--panel">

                    <!-- Proses -->
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>
                        <p class="miniStats--caption ">
                            ID : <b>{{$model['trx_product']->id}}</b><br>
                            Tracking No : <b>{{$model['trx_product']->ticket_id}}</b><br>
                            Event : <b>{{$model['trx_product']->product_name}}</b><br>
                            Pembeli : <b>{{$model['trx_product']->nama_lengkap}}</b><br>
                            Kontak : <b>{{$model['trx_product']->no_hp}}</b><br>
                            <br>
                            Tanggal Order : <b>{{$model['trx_product']->created_at}}</b><br>
                            Tanggal Upload Pembayaran : <b>{{$model['trx_product']->updated_at}}</b><br>
                            <br>
                            Jumlah Bayar<br>
                            <p class="miniStats--num text-orange"><b>Rp. <?php echo number_format($model['trx_product']->amount) ?></b></p><br>
                            <b>Bukti Pembayaran saat ini adalah</b><br><br>
                            <a href="{{$model['trx_product']->proof_of_payment}}" target="blank">
                                <img src="{{$model['trx_product']->proof_of_payment}}" width="250px">
                            </a><br><br>
                            <b>Keterangan</b><br>
                            {{$model['trx_product']->description}}
                            <br><br>
                            <a href="/admin/transaksi" class="btn btn-rounded btn-success">KEMBALI</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @if($model['trx_product']->status == 2)
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Konfirmasi Pembayaran</h3>
                </div>

                <div class="panel-content">
                    <form action="/admin/transaksi/update" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$model['trx_product']->id}}">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Status Pembayaran</span>
                                <select class="form-control" name="status">
                                    @foreach($model['status'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <input type="submit" value="Kirim" class="btn btn-sm btn-rounded btn-success">
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection