@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">
        <div class="col-xl-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Product
                    </h3>

                    <div class="dropdown">
                            <a href="/admin/product/show"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table style--2">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model['data'] as $item)
                                <tr>
                                    <td>
                                        <img src="{{$item->image}}" width="100px" height="50px" alt="">
                                    </td>
                                    <td>{{$item->id}}</td>
                                    <td><a href="#" class="btn-link">{{$item->title}}</a></td>
                                    <td>Rp. <?php echo number_format($item->price)?></td>
                                    <td>
                                        @if($item->status == 0)
                                        <span class="label label-danger">Tidak Aktif</span>
                                        @else
                                        <span class="label label-success">Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-trash-alt"></i></a>
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