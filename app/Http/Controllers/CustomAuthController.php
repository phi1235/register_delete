<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

//Unknow
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('crud_user.login');
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    
    }

    public function registration()
    {
        return view('crud_user.registration');
    }

    public function customRegistration(Request $request) 
{ 
    $request->validate([ 
        'name' => 'required|string|max:255', 
        'email' => 'required|string|email|max:255|unique:users', 
        'password' => 'required|string|min:6|confirmed',
        'phone' => 'required|string|max:15', 
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]); 

    $data = $request->all(); 

    // Xử lý việc lưu file ảnh và lấy đường dẫn đã lưu
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('profile_images');
    }
    
    $check = $this->create($data); 

    return redirect("dashboard")->withSuccess('You have signed-in'); 
}

public function create(array $data) 
{ 
    return User::create([ 
        'name' => $data['name'], 
        'email' => $data['email'], 
        'password' => Hash::make($data['password']), 
        'phone' => $data['phone'], // Lưu trữ số điện thoại
        // Lưu trữ đường dẫn ảnh với 'image_path' là tên cột trong database
        'image' => $data['image'] ?? null, 
    ]); 
} 
    public function listUser()
    {
        if(Auth::check()){
            $users = User::paginate(3); // Số lượng người dùng trên mỗi trang (trong trường hợp này là 10)
            return view('crud_user.list', ['users' => $users]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

   
    public function readUser(Request $request) {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.read', ['users' => $user]);
    }
   
    public function deleteUser(Request $request) {
        $user_id = $request->get('id');
        $user = User::destroy($user_id);

        return redirect("list")->withSuccess('You have signed-in');
    }
   
   
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
   
}