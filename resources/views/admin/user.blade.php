@section('title', 'User List')
@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        User
                    </h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table style--2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Identitas</th>
                                    <th>Nama Lengkap</th>
                                    <th>Institusi</th>
                                    <th>Email</th>
                                    <th>Tanggal Lahir</th>
                                    <th>No HP</th>
                                    <th>Tanggal Daftar</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model['data'] as $item)
                                <tr style="font-size: 12px">
                                    <td>{{$item->id}}</td>
                                    <td>
                                        @if($item->identitas != null)
                                        <a href="{{$item->identitas}}" target="blank">
                                            <img src="{{$item->identitas}}" style="max-width: 130px; max-height: 80px;" alt="Bukti Pembayaran">
                                        </a>
                                        @else
                                        Belum Upload
                                        @endif
                                    </td>
                                    <td><b>{{$item->nama_lengkap}}</b></td>
                                    <td><b>{{$item->institusi}}</b></td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->tanggal_lahir}}</td>
                                    <td>{{$item->no_hp}}<br>
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
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php echo str_replace('/?', '?', $model['data']->render()); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection