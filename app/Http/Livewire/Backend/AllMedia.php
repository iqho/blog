<?php

namespace App\Http\Livewire\Backend;

use App\Models\Media;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AllMedia extends Component
{
    use WithFileUploads;
    public $name, $username, $email, $password, $phone_no, $user_type, $bio, $social_media, $user_id;

    public function render()
        {

        $data['users'] = Media::latest()->get();

         $data['checkEmpty'] = Str::length($this->username);
         $data['checkUser'] = Media::where('slug', '=', $this->username)->exists();

        return view('livewire.backend.media.media', compact('data'));
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

            Media::create([
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
            $user = Media::where('id',$id)->first();
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
                //'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                //'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                'phone_no' => ['nullable', 'string', 'max:255'],
                'social_media' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string', 'max:255'],
                ]);

            if ($this->user_id) {
            $user = Media::find($this->user_id);
            //$user->update($request->filled('password') ? $request->all() : $request->except(['password']));
                if(!empty($this->password)){

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
            Media::where('id',$id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
            }
        }

}
