@section('title', 'Report')
@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-6">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-danger">
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-blue bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-clock text-white"></i>

                        <p class="miniStats--caption">Jumlah</p>
                        <h3 class="miniStats--title h4 text-white">Belum Bayar</h3>
                        <p class="miniStats--num">{{$model['count_menunggu']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-6">
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

                        <p class="miniStats--caption">Total</p>
                        <h3 class="miniStats--title h4 text-white">Belum Bayar</h3>
                        <p class="miniStats--num"><?php echo number_format($model['total_menunggu']->count)?></p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-6">
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

                        <p class="miniStats--caption">Jumlah</p>
                        <h3 class="miniStats--title h4 text-white">Tiket Terjual</h3>
                        <p class="miniStats--num">Rp. {{$model['count_terjual']->count}}</p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <!-- Mini Stats Panel Start -->
                <div class="miniStats--panel text-white bg-primary" >
                    <div class="miniStats--header" data-overlay="0.1">

                        <p class="miniStats--label text-success bg-white">
                            <i class="fa fa-level-up-alt"></i>
                            <!-- <span>10%</span> -->
                        </p>
                    </div>

                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-white"></i>

                        <p class="miniStats--caption">Total</p>
                        <h3 class="miniStats--title h4 text-white">Tiket Terjual</h3>
                        <p class="miniStats--num">Rp. <?php echo number_format($model['total_terjual']->count)?></p>
                    </div>
                </div>
                <!-- Mini Stats Panel End -->
            </div>
        </div>
    </div>
</section>
@endsection