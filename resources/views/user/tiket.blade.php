@section('title', 'Tiket')
@extends('user.base')
@section('content')
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-md-12">
            <div class="panel">
                <div class="miniStats--panel">
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
                        Jangan sebar luaskan tiket dan qrcode didalam tiket karna qrcode adalah akses peserta masuk kedalam acara tersebut. <br>
                        Harap tunjukan identitas diri serta qrcode didalam tiket saat melakukan masuk kedalam event tersebut.<br>
                        <br>
                        <i>Catatan: Setiap tiket dikirim langsung ke peserta. Jika Anda memesan lebih dari satu tiket, harap menggunakan email dan nomor handphone yang lain.</i>
                        <br><br>
                        <a href="/user/tiket/download/{{$model['trx_product']->id}}" class="btn btn-rounded btn-success" data-toggle="modal">Download E-Tiket</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection