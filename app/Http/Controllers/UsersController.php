<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserTypeDb;
use Auth;
use Spatie\Permission\Models\Role;
use Session;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    protected $listUser = "";

    public function __construct()
    {
        $this->middleware(['auth', 'usersManager']);

    }
    //Trang chủ quản trị user
    protected function index()
    {
        $users = User::paginate(10);
        return view('usersManager.index')->with('users', $users);
    }
    //Trang Edit
    protected function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        $userType = UserTypeDb::orderBy('created_at')->pluck('userTypeName', 'id');
        return view('usersManager.edit', compact('user', 'roles',  'userType'));
    }
    protected function _view(Request $rq)
    {
        $user = User::findOrFail($rq->id);
        $userType = DB::table('partner_type')->where('id', $user->typePartner)->first();
        return view('usersManager.view',['user'=>$user, 'userType'=>$userType]);
    }
    //Tạo User Mới
    protected function create()
    {
        $roles = Role::get();
        $userType = UserTypeDb::orderBy('created_at')->pluck('userTypeName', 'id');
        return view('usersManager.create', ['roles'=>$roles,'userType'=>$userType]);
    }

    protected function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);
        $faker = Faker::create();
        $data_save = ['name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'partnerCode' => $faker->uuid,
            'typePartner' => intval($request->userType)
        ];
        $user = User::create($data_save);
        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect()->route('users-manager.index');
    }
    //Thay đổi quyền user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'userType' => 'required|max:2',
            'repassword' => 'required|min:6',
            'active' => 'require|max:2'
        ]);
        if($request->repassword == "adminGTV"){
            $user['typePartner'] = $request->userType;
            $user['active'] = $request->active;
            $user->save();
        }else{
            Session::flash('error_mes', 'Lỗi! Mật Khẩu Quản Trị Không Đúng');
            return redirect()->route('users-manager.edit', $id);
        }
        $roles = $request['roles'];
        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }
        return redirect()->route('users-manager.index');
    }
    //Xóa User
    protected function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users-manager.index');
    }
}
