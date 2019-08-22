<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MsProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductCT extends Controller
{
	public function index()
	{

		$data = new MsProductModel();
		$data = $data->all();
		$model['data'] = $data;

		return view('admin.product.index', compact('model'));
	}

	public function show(){
		return view('admin.product.add');
	}

	public function store(Request $request)
	{

		$title = $request->title;
		$desc = $request->desc;
		$status = $request->status;
		$price = $request->price;


		$model = new MsProductModel();
		$model->title = $title;
		$model->desc = $desc;
		$model->price = $price;
		$model->status = $status;
		$model->created_at = Carbon::now('Asia/Jakarta');
		$model->updated_at = Carbon::now('Asia/Jakarta');
		$model->save();

		if($request->file('gambar')) {
			$file = $request->file('gambar');

			$fileName = $file->getClientOriginalName();
			$fileExt  = $file->getClientOriginalExtension();
			$fileMime = $file->getClientMimeType();

			$milliseconds = round(microtime(true) * 1000);

			$updatedFileName = $title.'_img_product_'.$milliseconds.'_'.$model->id.'.'.$fileExt;
			$updatedFileName = str_replace(' ', '_', $updatedFileName);
			if(!Storage::disk('public_uploads')->put('/'.$updatedFileName, file_get_contents($file))) {
				return false;
			}
			
			$model->image = env('IMG_URL', '').$updatedFileName;
			$model->save();
		}
		

		return redirect()->route('product.index')->with('alert-success', 'Save success.');
	}

	public function edit($id)
	{

		$data = MsProductModel::findOrFail($id);
		$model['data'] = $data;

		return view('admin.product.edit', compact('model'));
	}

	public function update(Request $request, $id){

		$title = $request->title;
		$desc = $request->desc;

		$model = MsProductModel::findOrFail($id);
		$model->title = $title;
		$model->desc = $desc;
		$model->updated_at = Carbon::now('Asia/Jakarta');
		$model->save();


		if($request->file('gambar')) {
			$file = $request->file('gambar');

			$fileName = $file->getClientOriginalName();
			$fileExt  = $file->getClientOriginalExtension();
			$fileMime = $file->getClientMimeType();

			$milliseconds = round(microtime(true) * 1000);

			$updatedFileName = $title.'_img_product_'.$milliseconds.'_'.$model->id.'.'.$fileExt;
			$updatedFileName = str_replace(' ', '_', $updatedFileName);
			if(!Storage::disk('public_uploads')->put('/'.$updatedFileName, file_get_contents($file))) {
				return false;
			}
			
			$model->image = env('IMG_URL', '').$updatedFileName;
			$model->save();
		}

		return redirect()->route('product.index')->with('alert-success', 'Edit success.');
	}

	public function delete($id)
	{
		$data = MsProductModel::findOrFail($id);
		return view('admin.product.delete', compact('data'));
	}

	public function destroy($id)
	{
		$model = MsProductModel::findOrFail($id);
		$model->status = 0;
		$model->save();
		// $model->delete();
		return redirect()->route('product.index')->with('alert-success', 'Delete success.');
	}
}

?>
