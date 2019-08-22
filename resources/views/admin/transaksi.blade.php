@section('title', 'Transaksi')
@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-4">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-blue" style="background-color: #2196F3">
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-blue bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-clock text-white"></i>

                        <p class="miniStats--caption">Status</p>
                        <h3 class="miniStats--title h4 text-white">Menunggu Pembayaran</h3>
                        <p class="miniStats--num">{{$model['count_menunggu']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-orange" style="background-color: #FF8C00">
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-orange bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-user text-white"></i>

                        <p class="miniStats--caption">Status</p>
                        <h3 class="miniStats--title h4 text-white">Menunggu Verifikasi Admin</h3>
                        <p class="miniStats--num">{{$model['count_proses']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-success" style="background-color: #2ecc71">
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-success bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-white"></i>

                        <p class="miniStats--caption">Status</p>
                        <h3 class="miniStats--title h4 text-white">Tiket Terjual</h3>
                        <p class="miniStats--num">{{$model['count_terjual']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Filter Berdasarkan</h3>
                </div>

                <div class="panel-content">
                    <form action="" method="get" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>
                                <span class="label-text">Tracking No</span>
                                <input type="text" name="tracking_no" class="form-control" placeholder="* Contoh : 99999292929" value="<?php if(isset($_GET['tracking_no'])) echo $_GET['tracking_no']; ?>">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <span class="label-text">Status Pembayaran</span>
                                <select class="form-control" name="status">
                                    @foreach($model['status'] as $item)
                                    <option value="{{$item->id}}" <?php if(isset($_GET['status'])) if($item->id == $_GET['status']) echo 'selected'; ?>>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <input type="submit" value="Kirim" class="btn btn-sm btn-rounded btn-success">
                    </form>
                </div>
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
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model['trx_product'] as $item)
                                <tr style="font-size: 12px">
                                    <td>{{$item->id}}</td>
                                    <td>
                                        @if($item->proof_of_payment != null)
                                        <a href="{{$item->proof_of_payment}}" target="blank">
                                            <img src="{{$item->proof_of_payment}}" style="max-width: 130px; max-height: 80px;" alt="Bukti Pembayaran">
                                        </a>
                                        @else
                                        Belum Upload
                                        @endif
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
                                        <a href="https://wa.me/{{$str}}" target="blank" class="text-green">Kontak Ke Whatsapp</a>
                                    </td>
                                    <td><b>Rp. <?php echo number_format($item->amount)?></b></td>
                                    <td>
                                        <span class="label label-success" style="background-color: <?php echo $item->status_color?>">{{$item->status_name}}</span>
                                    </td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        <a href="/admin/transaksi/{{$item->id}}" ><i class="fa fa-cogs" alt="Proses"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php echo str_replace('/?', '?', $model['trx_product']->render()); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection