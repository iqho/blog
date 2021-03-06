<?php

namespace App\Http\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class AllUsers extends Component
{

    use WithPagination;
    use PasswordValidationRules;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $name, $username, $email, $password, $phone_no, $user_type, $bio, $social_media, $user_id;

    public function render()
        {

        $data['users'] = User::latest()->where(function ($sub_query) {
                $sub_query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('username', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone_no', 'like', '%' . $this->searchTerm . '%');
            })->paginate(20);

         $data['checkEmpty'] = Str::length($this->username);
         $data['checkUser'] = User::where('username', '=', $this->username)->exists();

         $data['checkEmailEmpty'] = Str::length($this->email);
         $regex = "/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i";
         $data['checkValidEmail'] = preg_match($regex, $this->email) ? 1 : 0;
         $data['checkEmail'] = User::where('email', '=', $this->email)->exists();

        return view('livewire.backend.all-users', compact('data'));
        }

    public function setPage($url)
        {
            $this->currentPage = explode('page=', $url)[1];
            Paginator::currentPageResolver(function () {
                return $this->currentPage;
            });
        }

    public function updateStatus($id){

        $users = User::findOrFail($id);

        if($users->status == 1){
            $users->status = 0;
        } else {
            $users->status = 1;
        }
        $users->save();
        session()->flash('message', 'User Status Successfully Updated !');
        }

    private function resetInputFields(){
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->phone_no = '';
        $this->bio = '';
        $this->social_media = '';
        $this->user_type = '';
    }

    public function storeUser()
        {
            $validatedDate = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:3', 'max:100', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],
                'user_type' => ['required'],
            ]);
            $this->password = Hash::make($this->password);
            User::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password,
                'phone_no' => $this->phone_no,
                'bio' => $this->bio,
                'social_media' => $this->social_media,
                'user_type' => $this->user_type
            ], $validatedDate);
            //User::create($validatedDate);
            session()->flash('message', 'User Created Successfully.');
            $this->resetInputFields();
            $this->emit('userStore'); // Close model to using to jquery
        }

    public function edit($id)
        {
            $user = User::where('id',$id)->first();
            $this->user_id = $id;
            $this->name = $user->name;;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->phone_no = $user->phone_no;
            $this->bio = $user->bio;
            $this->social_media = $user->social_media;
            $this->user_type = $user->user_type;
        }
    public function cancel()
    {
       $this->resetInputFields();
    }

    public function updateUser()
        {
            $validatedDate = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                'phone_no' => ['nullable', 'string', 'max:255'],
                'social_media' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string', 'max:255'],
                ]);

            if ($this->user_id) {
            $user = User::find($this->user_id);
            //$user->update($request->filled('password') ? $request->all() : $request->except(['password']));
                if(!empty($this->password)){
                $new_password = Hash::make($this->password);
                $user->update([
                    'name' => $this->name,
                    'username' => $this->username,
                    'email' => $this->email,
                    'password' => $new_password,
                    'phone_no' => $this->phone_no,
                    'bio' => $this->bio,
                    'social_media' => $this->social_media,
                    'user_type' => $this->user_type
                ], $validatedDate);
                }
                else{
                $user->update([
                    'name' => $this->name,
                    'username' => $this->username,
                    'email' => $this->email,
                    'phone_no' => $this->phone_no,
                    'bio' => $this->bio,
                    'social_media' => $this->social_media,
                    'user_type' => $this->user_type
                ], $validatedDate);
                }

            $this->resetInputFields();
            session()->flash('message', 'User Upated Successfully.');
            $this->emit('userUpdate'); // Close model to using to jquery
             }
        }

    public function delete($id)
        {
            if($id){
            User::where('id',$id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
            }
        }
}
