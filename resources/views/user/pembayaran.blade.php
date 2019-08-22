@section('title', 'Pembayaran')
@extends('user.base')
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

                    @if($model['trx_product']->status == 1 || $model['trx_product']->status == 4 || $model['trx_product']->status == 5)
                    <!-- Belum Bayar -->
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>

                        <p class="miniStats--caption text-orange">Pembayaran</p>
                        <h3 class="miniStats--title h4">{{$model['trx_product']->product_name}}</h3>
                        <p class="miniStats--num text-orange"><b>Rp. <?php echo number_format($model['trx_product']->amount) ?></b></p>
                        <br>
                        <p class="miniStats--caption ">
                            <b>Hai, {{$model['user']->nama_lengkap}}</b><br>
                            Silahkan melakukan pembayaran pendaftaran ke :<br>
                            --------<br>
                            Jenis Bank : <b>{{$model['config']->bank_name}}</b><br>
                            No. Rekening : <b>{{$model['config']->bank_an}}</b> a.n <b>{{$model['config']->bank_no_rek}}</b><br>
                            Nominal : <b>Rp <?php echo number_format($model['trx_product']->amount) ?></b><br>
                            --------<br>
                            Rincian Biaya sebagai berikut :<br>
                            <br>
                            Biaya Pendaftaran <b>Rp <?php echo number_format($model['trx_product']->amount) ?></b><br>
                            <br>
                            INGAT! Nominal harus sesuai dengan yang disebutkan diatas. Jika tidak, maka data tidak akan diproses.<br>
                            <br>
                            Setelah melakukan pembayaran, upload bukti pembayaran dan mohon menunggu verifikasi oleh panitia UBP TECHNO DAY 4.0 2019 maksimal 2 x 24 jam. <br>
                            <b>Contact Person : {{$model['config']->contact}}</b><br>
                        </p>
                    </div>
                    @elseif($model['trx_product']->status == 2)

                    <!-- Proses -->
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>
                        <p class="miniStats--caption ">
                            <b>Hai, {{$model['user']->nama_lengkap}}</b><br>
                            <br>
                            Tunggu sebentar ya, Bukti Pembayaran anda sedang diproses panitia. Mohon bersabar.<br>
                            Jika anda melakukan kesalahan dalam pengunggahan bukti pembayaran, anda dapat mengunggahnya kembali dan bukti pembayaran lama akan terhapus dan tergantikan dengan yang baru.<br>
                            <br>
                            Mohon menunggu verifikasi oleh panitia UBP TECHNO DAY 4.0 2019 maksimal 2 x 24 jam. <br>
                            <b>{{$model['config']->contact}}</b><br>
                            <br>
                            <b>Bukti Pembayaran saat ini adalah</b><br><br>
                            <a href="{{$model['trx_product']->proof_of_payment}}" target="blank">
                                <img src="{{$model['trx_product']->proof_of_payment}}" width="350px">
                            </a><br><br>
                            <b>Keterangan</b><br>
                            {{$model['trx_product']->description}}
                        </p>
                    </div>
                    @elseif($model['trx_product']->status == 3)
                    <!-- Sudah Bayar -->
                    <div class="miniStats--body">
                        <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>
                        <p class="miniStats--caption ">
                            <b>Hai, {{$model['user']->nama_lengkap}}</b><br>
                            <br>
                            Terima kasih telah melakakun pembayaran. Berikut detail acara tersebut :<br>
                            <br>
                            {!!$model['trx_product']->product_desc!!}
                        </p>
                        <br>
                        Kamu dapat mendownload tiket kamu dimenu tiket atau <a href="/user/tiket">disini</a>, jangan sebar luaskan tiket dan qrcode didalam tiket karna qrcode adalah akses peserta masuk kedalam acara tersebut. <br>
                        Harap tunjukan identitas diri serta qrcode didalam tiket saat melakukan masuk kedalam event tersebut.<br>
                        <br>
                        <i>Catatan: Setiap tiket dikirim langsung ke peserta. Jika Anda memesan lebih dari satu tiket, harap menggunakan email dan nomor handphone yang lain.</i>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if($model['trx_product']->status == 1 || $model['trx_product']->status == 2 || $model['trx_product']->status == 4)
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Konfirmasi Pembayaran</h3>
                </div>

                <div class="panel-content">
                    <form action="/user/pembayaran-upload" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>
                                <span class="label-text">Bukti Pemabayran</span>
                                <fieldset id="foobar">
                                    <input type="hidden" name="id_trx" value="<?php echo $model['trx_product']->id?>">
                                    <input type="file" name="gambar"  class="form-control">
                                </fieldset>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>
                                <span class="label-text">Keterangan</span>
                                <textarea class="form-control" name="desc"></textarea>
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