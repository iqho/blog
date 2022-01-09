<?php

namespace App\Http\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AllUsers extends Component
{

    use WithPagination;
    use PasswordValidationRules;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $isExits = 'd-none';
    public $isAvailable = 'd-none';

    public $name, $username, $email, $password, $phone_no, $user_type, $bio, $social_media, $user_id;

    public function render()
        {

            $data['users'] = User::latest()->where(function ($sub_query) {
                $sub_query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })->paginate(10);
           // $data['checkuser'] = User::where('username', '=', $this->username)->exists();
            // if($this->username === ""){
            //      $isExits = 'd-none';
            //      $isAvailable = 'd-none';
            // }
            // else{
                if( User::where('username', '=', $this->username)->exists()){
                        $this->isExits = 'd-block text-danger';
                        $this->isAvailable = 'd-none';
                    }
                else{
                    $this->isAvailable = 'd-block text-success';
                    $this->isExits = 'd-none';
                }
                //}

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
            session()->flash('message', 'Users Created Successfully.');
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

            session()->flash('message', 'Users Upated Successfully.');
            $this->resetInputFields();
            $this->emit('userUpdate'); // Close model to using to jquery
             }
        }

    public function delete($id)
        {
            if($id){
                    User::where('id',$id)->delete();
                    session()->flash('message', 'Users Deleted Successfully.');
            }
        }
}
