<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class DangNhapController extends Controller
{
	public function getLogin(){
        return view('login');
    }
    public function postLogin(Request $request){
        //định nghĩa các dữ liệu đầu vào cần kiểm tra
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6'
        ];
        //thông báo lỗi tương ứng với các dữ liệu đầu vào
        $messages =[
            'email.required' => 'Bạn phải nhập tên đăng nhập',
            'password.required' => 'Bạn phải nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
        ];
        //tiến hành kiểm tra dữ liệu đầu vào theo thư viện Validator của laravel cung cấp
        $validator = Validator::make($request->all(),$rules,$messages);
        //nếu dữ liệu kiểm tra bị lỗi => sẽ quay lại trang và hiển thị các lỗi
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{ // nếu không bị lỗi, sẽ tiến hành kiểm tra dữ liệu trong database
            $email =  $request->input('email'); // lấy dữ liệu tên đăng nhập đã nhập
            $password =  $request->input('password');// lấy dữ liệu mật khẩu đã nhập

            // lấy dữ liệu trong database theo tên đăng nhập và mật khẩu
            $exist = DB::table('users')->where([
                ['email', '=', $email],
                ['password', '=',  $password]
            ])->get();

            // nếu có bản ghi thì sẽ điều hướng đến trang quản trị
            if(count($exist) > 0){
                $request->session()->put('admin',  (array) $exist[0]);
                return redirect('admin/theloai/danhsach');
            }else{// nếu không có bản ghi thì hiển thị thông báo lên trang đăng nhập
                $error = new MessageBag(['logginMessage'=>'Tên đăng nhập hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($error);
            }

        }
    }
}
?>