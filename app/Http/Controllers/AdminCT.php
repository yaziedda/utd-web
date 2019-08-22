<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MsProductModel;
use App\TrxProductModel;
use App\UserModel;
use App\StaffModel;
use Carbon\Carbon;
use App\MsConfigModel;	
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Input;

class AdminCT extends Controller
{

	public function workshop(){
		return view('workshop');
	}

	public function dashboard(Request $request){

		$user_data_login = $request->session()->get('user_data_admin');

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
		->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc', 'anggota.nama_lengkap',  'anggota.no_hp as no_hp', 'ms_status_trx.name as status_name', DB::raw("CONCAT('#',ms_status_trx.color) as status_color"))
		->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
		->join('ms_status_trx', 'trx_product.status', '=', 'ms_status_trx.id')
		->join('anggota', 'trx_product.id_user', '=', 'anggota.id')
		->where('trx_product.id_product', 1)
		->orderBy('trx_product.id', 'desc')
		->limit(20)
		->get();

		$user_count = DB::table('anggota')->selectRaw('count(*) count')->first();
		$trx_product_count = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '!=', '3')->first();
		$trx_product_count_terjual = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '=', '3')->first();

		$model['user'] = $user_data_login;
		$model['user_count'] = $user_count;
		$model['trx_product_count'] = $trx_product_count;
		$model['trx_product_count_terjual'] = $trx_product_count_terjual;
		$model['trx_product'] = $trx_product;

		return view('admin.index', compact('model'));
	}

	public function transaksi(Request $request){

		$user_data_login = $request->session()->get('user_data_admin');

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
		->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc', 'anggota.nama_lengkap',  'anggota.no_hp as no_hp', 'ms_status_trx.name as status_name', DB::raw("CONCAT('#',ms_status_trx.color) as status_color"))
		->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
		->join('ms_status_trx', 'trx_product.status', '=', 'ms_status_trx.id')
		->join('anggota', 'trx_product.id_user', '=', 'anggota.id')
		->where('trx_product.id_product', 1)
		->orderBy('trx_product.id', 'desc');

		$status = $request->get('status');
		if(!empty($status)){
			$trx_product->where('trx_product.status', $status);
		}

		$tracking_no = $request->get('tracking_no');
		if(!empty($tracking_no)){
			$trx_product->where('trx_product.ticket_id', $tracking_no);
		}

		$trx_product = $trx_product->paginate(20);
		$trx_product = $trx_product->appends(Input::except('page'));

		$user_count = DB::table('anggota')->selectRaw('count(*) count')->first();
		$count_menunggu = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '=', '1')->first();
		$count_proses = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '=', '2')->first();
		$count_terjual = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '=', '3')->first();

		$status = DB::table('ms_status_trx')->get();

		$model['user'] = $user_data_login;
		$model['user_count'] = $user_count;
		$model['count_menunggu'] = $count_menunggu;
		$model['count_proses'] = $count_proses;
		$model['count_terjual'] = $count_terjual;
		$model['trx_product'] = $trx_product;
		$model['status'] = $status;

		return view('admin.transaksi', compact('model'));
	}

	public function user(Request $request){


		$data = DB::table('anggota')->orderBy('id', 'desc');

		$data = $data->paginate(20);
		$data = $data->appends(Input::except('page'));

		$model['data'] = $data;

		return view('admin.user', compact('model'));
	}

	public function transaksiDetail($id){

		$trx_product = new TrxProductModel();
		$trx_product = DB::table('trx_product')
		->select('trx_product.*', 'ms_product.title as product_name', 'ms_product.desc as product_desc', 'ms_product.desc as product_desc', 'anggota.nama_lengkap', 'anggota.no_hp as no_hp', 'ms_status_trx.name as status_name', DB::raw("CONCAT('#',ms_status_trx.color) as status_color"))
		->join('ms_product', 'trx_product.id_product', '=', 'ms_product.id')
		->join('ms_status_trx', 'trx_product.status', '=', 'ms_status_trx.id')
		->join('anggota', 'trx_product.id_user', '=', 'anggota.id')
		->where('trx_product.id', $id)
		->first();

		$user_count = DB::table('anggota')->selectRaw('count(*) count')->first();
		$trx_product_count = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '!=', '3')->first();
		$trx_product_count_terjual = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '=', '3')->first();

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

		$config = new MsConfigModel();
		$config = $config->first();

		$status = DB::table('ms_status_trx')->where('id', '>', '2')->get();

		$model['config'] = $config;
		$model['user_count'] = $user_count;
		$model['trx_product_count'] = $trx_product_count;
		$model['trx_product_count_terjual'] = $trx_product_count_terjual;
		$model['trx_product'] = $trx_product;
		$model['status'] = $status;

		return view('admin.transaksi_detail', compact('model'));
	}

	public function transaksiUpdate(Request $request){
		$id = $request->id;
		$status = $request->status;

		$trx_product = new TrxProductModel();
		$trx_product = $trx_product->where('id', $id)->first();

		if ($trx_product != null) {
			$trx_product->status = $status;
			$trx_product->save();

			return redirect()->to('/admin/transaksi/'.$id);
		}else{
			return redirect()->to('/admin/notfound');
		}
	}

	public function report(Request $request){

		$count_menunggu = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '!=', '3')->first();
		$count_terjual = DB::table('trx_product')->selectRaw('count(*) count')->where('trx_product.id_product', 1)->where('status', '=', '3')->first();
		$total_menunggu = DB::table('trx_product')->selectRaw('sum(amount) count')->where('trx_product.id_product', 1)->where('status', '!=', '3')->first();
		$total_terjual = DB::table('trx_product')->selectRaw('sum(amount) count')->where('trx_product.id_product', 1)->where('status', '=', '3')->first();


		$model['count_menunggu'] = $count_menunggu;
		$model['count_terjual'] = $count_terjual;
		$model['total_menunggu'] = $total_menunggu;
		$model['total_terjual'] = $total_terjual;

		return view('admin.report', compact('model'));
	}

	public function pembayaran(Request $request){
		$user_data_login = $request->session()->get('user_data_admin');

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

		return view('admin.pembayaran', compact('model'));
	}

	public function pembayaranUpload(Request $request)
	{

		$id_trx = $request->id_trx;
		$desc = $request->desc;

		$trx_product = new TrxProductModel();
		$trx_product = $trx_product->where('id', $id_trx)->first();

		$trx_product->description = $desc;
		$trx_product->status = 2;

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

		
		return redirect()->to('/admin/pembayaran');
	}

	public function tiket(Request $request){

		$user_data_login = $request->session()->get('user_data_admin');

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
			
			return view('admin.tiket', compact('model'));	
		}else{
			return redirect()->to('/admin/pembayaran')->with('alert-failed', 'Untuk mendapatkan tiket, lakukan pembayaran lebih dahulu.');
		}

	}

	public function sertifikat(Request $request){
		$user_data_login = $request->session()->get('user_data_admin');

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
			
			return view('admin.sertifikat', compact('model'));	
		}else{
			return redirect()->to('/admin/pembayaran')->with('alert-failed', 'Untuk mendapatkan tiket, lakukan pembayaran lebih dahulu.');
		}
	}

	public function registrasi(){
		return view('admin.registrasi');
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
			return redirect()->to('/admin/registrasi')->with('alert-failed', 'Password tidak sama.');
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
		return redirect()->to('/admin/dashboard');
	}

	public function login(){
		return view('admin.login');
	}

	public function loginUser(Request $request){
		$email = $request->email;
		$password = $request->password;

		$model = new StaffModel();
		$model = $model->where('email', $email)->where('pass', md5($password))->first();

		if ($model != null) {
			session(['user_data_admin' => $model]);
			return redirect()->to('/admin/dashboard');
		}else{
			return redirect()->to('/admin/login')->with('alert-failed', 'Email atau password salah');
		}
	}

	public function logout(Request $request)
	{

		$request->session()->forget('user_data_admin');
		return redirect()->to('/admin/login');
	}
}

?>
