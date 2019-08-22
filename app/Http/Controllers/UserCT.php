<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MsProductModel;
use App\TrxProductModel;
use App\UserModel;
use Carbon\Carbon;
use App\MsConfigModel;	
use Illuminate\Support\Facades\DB;
use Storage;

class UserCT extends Controller
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

	public function workshop(){
		return view('workshop');
	}

	public function dashboard(Request $request){

		$user_data_login = $request->session()->get('user_data');

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
						->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc')
						->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
						->where('trx_product.id_user', $user_data_login->id)
						->where('trx_product.id_product', 1)
						->first();

		if ($trx_product == null) {
			$id_user = $user_data_login->id;
			$id_product = 1;
			$id_tiket = $id_user.$id_product.Carbon::now()->format('dmYHms');

			$product = new MsProductModel();
			$product = $product->where('id', $id_product)->first();

			$config = new MsConfigModel();
			$config = $config->first();

			$trx_product = new TrxProductModel();

			$trx_product->id_user = $id_user;
			$trx_product->id_product = $id_product;
			$trx_product->ticket_id = $id_tiket;
			$trx_product->amount = $product->price+(rand(0,999));
			$trx_product->status = 1;
			$trx_product->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
			$trx_product->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
			$trx_product->last_update_by = 'SYSTEM';
			$trx_product->save();
		}

		$model['user'] = $user_data_login;
		$model['trx_product'] = $trx_product;

		return view('user.index', compact('model'));
	}

	public function pembayaran(Request $request){
		$user_data_login = $request->session()->get('user_data');

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
						->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc', 'ms_status_trx.name as status_name', DB::raw("CONCAT('#',ms_status_trx.color) as status_color"))
						->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
						->join('ms_status_trx', 'trx_product.status', '=', 'ms_status_trx.id')
						->where('trx_product.id_user', $user_data_login->id)
						->where('trx_product.id_product', 1)
						->first();

		$config = new MsConfigModel();
		$config = $config->first();

		$model['user'] = $user_data_login;
		$model['trx_product'] = $trx_product;
		$model['config'] = $config;

		return view('user.pembayaran', compact('model'));
	}

	public function pembayaranUpload(Request $request)
	{

		$id_trx = $request->id_trx;
		$desc = $request->desc;

		$trx_product = new TrxProductModel();
		$trx_product = $trx_product->where('id', $id_trx)->first();

		$trx_product->description = $desc;
		$trx_product->status = 2;
		$trx_product->updated_at = Carbon::now('Asia/Jakarta');

		if($request->file('gambar')) {
			$file = $request->file('gambar');

			$fileName = $file->getClientOriginalName();
			$fileExt  = $file->getClientOriginalExtension();
			$fileMime = $file->getClientMimeType();

			$milliseconds = round(microtime(true) * 1000);

			$updatedFileName = $id_trx.'_img_payment_'.$milliseconds.'_'.$trx_product->id.'.'.$fileExt;
			$updatedFileName = str_replace(' ', '_', $updatedFileName);
			if(!Storage::disk('public_uploads')->put('/'.$updatedFileName, file_get_contents($file))) {
				return false;
			}
			
			$trx_product->proof_of_payment = env('IMG_URL', '').$updatedFileName;
			$trx_product->save();
		}

		
		return redirect()->to('/user/pembayaran');
	}

	public function tiket(Request $request){

		$user_data_login = $request->session()->get('user_data');

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
						->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc', 'ms_status_trx.name as status_name', DB::raw("CONCAT('#',ms_status_trx.color) as status_color"))
						->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
						->join('ms_status_trx', 'trx_product.status', '=', 'ms_status_trx.id')
						->where('trx_product.id_user', $user_data_login->id)
						->where('trx_product.id_product', 1)
						->first();

		$config = new MsConfigModel();
		$config = $config->first();

		$model['user'] = $user_data_login;
		$model['trx_product'] = $trx_product;
		$model['config'] = $config;

		if ($trx_product->status == 3) {
			$model['user'] = $user_data_login;
			$model['trx_product'] = $trx_product;
			
			return view('user.tiket', compact('model'));	
		}else{
			return redirect()->to('/user/pembayaran')->with('alert-failed', 'Untuk mendapatkan tiket, lakukan pembayaran lebih dahulu.');
		}

	}

	public function sertifikat(Request $request){
		$user_data_login = $request->session()->get('user_data');

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
						->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc', 'ms_status_trx.name as status_name', DB::raw("CONCAT('#',ms_status_trx.color) as status_color"))
						->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
						->join('ms_status_trx', 'trx_product.status', '=', 'ms_status_trx.id')
						->where('trx_product.id_user', $user_data_login->id)
						->where('trx_product.id_product', 1)
						->first();

		$config = new MsConfigModel();
		$config = $config->first();

		$model['user'] = $user_data_login;
		$model['trx_product'] = $trx_product;
		$model['config'] = $config;

		if ($trx_product->status == 3) {
			$model['user'] = $user_data_login;
			$model['trx_product'] = $trx_product;
			
			return view('user.sertifikat', compact('model'));	
		}else{
			return redirect()->to('/user/pembayaran')->with('alert-failed', 'Untuk mendapatkan tiket, lakukan pembayaran lebih dahulu.');
		}
	}

	public function registrasi(){
		return view('user.registrasi');
	}

	public function registrasiUser(Request $request)
	{

		$nama_lengkap = $request->nama_lengkap;
		$institusi = $request->institusi;
		$no_hp = $request->no_hp;
		$tanggal_lahir = $request->tanggal_lahir;
		$alamat = $request->alamat;
		$email = $request->email;
		$password = $request->password;
		$password_konfirmasi = $request->password_konfirmasi;

		if (strcmp($password, $password_konfirmasi) != 0) {
			return redirect()->to('/user/registrasi')->with('alert-failed', 'Password tidak sama.');
		}

		$model = new UserModel();
		$model  = $model->where('email', $email)->first();
		if ($model != null) {
			return redirect()->to('/user/registrasi')->with('alert-failed', 'Email '.$email.' telah digunakan');
		}

		$model = new UserModel();
		$model = $model->where('no_hp', $no_hp)->first();
		if ($model != null) {
			return redirect()->to('/user/registrasi')->with('alert-failed', 'Nomor '.$no_hp.' telah digunakan');
		}


		$model = new UserModel();
		$model->nama_lengkap = $nama_lengkap;
		$model->institusi = $institusi;
		$model->email = $email;
		$model->tanggal_lahir = $tanggal_lahir;
		$model->no_hp = $no_hp;
		$model->alamat = $alamat;
		$model->password = md5($password);
		$model->status = 1;
		$model->created_at = Carbon::now('Asia/Jakarta');
		$model->updated_at = Carbon::now('Asia/Jakarta');
		$model->save();

		if($request->file('gambar')) {
			$file = $request->file('gambar');

			$fileName = $file->getClientOriginalName();
			$fileExt  = $file->getClientOriginalExtension();
			$fileMime = $file->getClientMimeType();

			$milliseconds = round(microtime(true) * 1000);

			$updatedFileName = $nama_lengkap.'_img_identity_'.$milliseconds.'_'.$model->id.'.'.$fileExt;
			$updatedFileName = str_replace(' ', '_', $updatedFileName);
			if(!Storage::disk('public_uploads')->put('/'.$updatedFileName, file_get_contents($file))) {
				return false;
			}
			
			$model->identitas = env('IMG_URL', '').$updatedFileName;
			$model->save();
		}

		session(['user_data' => $model]);
		return redirect()->to('/user/dashboard');
	}

	public function login(){
		return view('user.login');
	}

	public function loginUser(Request $request){
		$email = $request->email;
		$password = $request->password;

		$model = new UserModel();
		$model = $model->where('email', $email)->where('password', md5($password))->first();

		if ($model != null) {
			session(['user_data' => $model]);
			return redirect()->to('/user/dashboard');
		}else{
			return redirect()->to('/user/login')->with('alert-failed', 'Email atau password salah');
		}
	}

	public function logout(Request $request)
    {

        $request->session()->forget('user_data');
        return redirect()->to('/user/login');
    }
}

?>
