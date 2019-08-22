@section('title', 'Dashboard Admin')
@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-4">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-blue">
                    <div class="miniStats--header" data-overlay="0.1">
                        <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#fff">5,6,9,4,9,5,3,5,9,15,3,2,2,3,9,11,9,7,20,9,7,6</p>

                        <p class="miniStats--label text-blue bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-user text-white"></i>

                        <p class="miniStats--caption">Registrasi</p>
                        <h3 class="miniStats--title h4 text-white">User</h3>
                        <p class="miniStats--num">{{$model['user_count']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-orange">
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-orange bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-white"></i>

                        <p class="miniStats--caption">Transaksi</p>
                        <h3 class="miniStats--title h4 text-white">Semua Tiket</h3>
                        <p class="miniStats--num">{{$model['trx_product_count']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-success">
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-success bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-white"></i>

                        <p class="miniStats--caption">Terjual</p>
                        <h3 class="miniStats--title h4 text-white">Semua Tiket</h3>
                        <p class="miniStats--num">{{$model['trx_product_count_terjual']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Transaksi Terakhir
                    </h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table style--2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Event</th>
                                    <th>Tracking No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model['trx_product'] as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <a href="{{$item->proof_of_payment}}" target="blank">
                                            <img src="{{$item->proof_of_payment}}" style="max-width: 130px; max-height: 80px;" alt="Bukti Pembayaran">
                                        </a>
                                    </td>
                                    <td><b>{{$item->product_name}}</b></td>
                                    <td><a href="#" class="btn-link">{{$item->ticket_id}}</a></td>
                                    <td>{{$item->nama_lengkap}}<br>
                                        <?php
                                        $prefix = '+';
                                        $str = $item->no_hp;

                                        if (substr($str, 0, strlen($prefix)) == $prefix) {
                                            $str = substr($str, strlen($prefix));
                                        } 

                                        $prefix_2nd = '0';
                                        $str_2nd = $item->no_hp;

                                        if (substr($str_2nd, 0, strlen($prefix_2nd)) == $prefix_2nd) {
                                            $str = '62'.substr($str_2nd, strlen($prefix));
                                        } 
                                        ?>
                                        <a href="https://wa.me/{{$str}}" target="blank" class="text-green">Whatsapp</a>
                                    </td>
                                    <td><b>Rp. <?php echo number_format($item->amount)?></b></td>
                                    <td>
                                        <span class="label label-success" style="background-color: <?php echo $item->status_color?>">{{$item->status_name}}</span>
                                    </td>
                                    <td>
                                        <a href="/admin/transaksi/{{$item->id}}" ><i class="fa fa-cogs" alt="Proses"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection