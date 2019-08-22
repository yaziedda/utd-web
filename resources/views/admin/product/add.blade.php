@extends('admin.base')
@section('content')
<!-- Main Content Start -->
<section class="main--content">
    <div class="row gutter-20">

        <div class="col-md-12">
            <!-- Panel Start -->
            <div class="panel">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="panel-heading">
                        <h3 class="panel-title">Input Product</h3>
                    </div>
                    <div class="panel-content">
                        <div class="form-group">
                            <label>
                                <span class="label-text">Gambar</span>
                                <input type="file" name="gambar" placeholder="Gambar" class="form-control" required>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <span class="label-text">Title</span>
                                <input type="text" name="title" placeholder="Title" class="form-control" required>
                            </label>
                        </div>
                        <div class="form-group">
                            <span class="label-text">Deskripsi</span>
                            <textarea name="desc" class="form-control" data-trigger="summernote" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>
                                <span class="label-text">Harga</span>
                                <input type="text" name="price" placeholder="Harga" class="form-control" required>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <span class="label-text">Status</span>
                                <select class="form-control" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </label>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-sm btn-rounded btn-success">
                        <a href="/admin/product">
                            <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection