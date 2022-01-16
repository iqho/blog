<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use Illuminate\Pagination\Paginator;

class AllCategory extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $name, $slug, $image, $parent_id, $imageurl, $newImageName;

    public function render()
        {

        $data['categories'] = Category::withTrashed()->where('parent_id', null)->where(function ($sub_query) {
                $sub_query->where('name', 'like', '%' . $this->searchTerm . '%');
            })->orderBy('id', 'desc')->paginate(10);
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();

         $data['checkEmpty'] = Str::length($this->slug);
         $data['checkSlug'] = Category::where('slug', '=', $this->slug)->exists();

        return view('livewire.backend.category.all-category', compact('data'));
        }

    public function setPage($url)
        {
            $this->currentPage = explode('page=', $url)[1];
            Paginator::currentPageResolver(function () {
                return $this->currentPage;
            });
        }

    public function updateStatus($id){

        $categories = Category::findOrFail($id);
        if($categories->status == 1){
            $categories->status = 0;
        } else {
            $categories->status = 1;
        }
        $categories->save();
        session()->flash('message', 'Category Status Successfully Updated !');
        }

    private function resetInputFields(){
        $this->name = '';
        $this->slug = '';
        $this->image = null;
        $this->image = [];
        $this->reset('image');
        $this->parent_id = '';
        $this->resetErrorBag();
    }

    public function storeCategory()
        {
            $validatedDate = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255', 'unique:categories'],
                'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'parent_id' => 'nullable|numeric'
            ]);

            if(!empty($this->image)){
                $newImageName = $this->slug.".".$this->image->extension();
                $image = $this->image->storeAs('category-image', $newImageName, 'public');
                $imageurl = url('storage').'/'.$image;
            }
            else{
                $imageurl = "";
            }
            Category::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'image' => $imageurl,
                'created_by' => auth()->id(),
                'parent_id' => $this->parent_id ? $this->parent_id : NULL,
            ], $validatedDate);
            session()->flash('message', 'Category Created Successfully.');
            $this->resetInputFields();
            $this->emit('storeCategory');
        }


    public function edit($id)
        {
            // $user = User::where('id',$id)->first();
            // $this->user_id = $id;
            // $this->name = $user->name;;
            // $this->username = $user->username;
            // $this->email = $user->email;
            // $this->phone_no = $user->phone_no;
            // $this->bio = $user->bio;
            // $this->social_media = $user->social_media;
            // $this->user_type = $user->user_type;
        }
    public function cancel()
    {
       $this->resetInputFields();
    }

    public function updateUser()
        {
            // $validatedDate = $this->validate([
            //     'name' => ['required', 'string', 'max:255'],
            //     'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            //     'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            //     'phone_no' => ['nullable', 'string', 'max:255'],
            //     'social_media' => ['nullable', 'string', 'max:255'],
            //     'bio' => ['nullable', 'string', 'max:255'],
            //     ]);

            // if ($this->user_id) {
            // $user = User::find($this->user_id);
            // //$user->update($request->filled('password') ? $request->all() : $request->except(['password']));
            //     if(!empty($this->password)){
            //     $new_password = Hash::make($this->password);
            //     $user->update([
            //         'name' => $this->name,
            //         'username' => $this->username,
            //         'email' => $this->email,
            //         'password' => $new_password,
            //         'phone_no' => $this->phone_no,
            //         'bio' => $this->bio,
            //         'social_media' => $this->social_media,
            //         'user_type' => $this->user_type
            //     ], $validatedDate);
            //     }
            //     else{
            //     $user->update([
            //         'name' => $this->name,
            //         'username' => $this->username,
            //         'email' => $this->email,
            //         'phone_no' => $this->phone_no,
            //         'bio' => $this->bio,
            //         'social_media' => $this->social_media,
            //         'user_type' => $this->user_type
            //     ], $validatedDate);
            //     }

            // $this->resetInputFields();
            // session()->flash('message', 'User Upated Successfully.');
            // $this->emit('userUpdate'); // Close model to using to jquery
            //  }
        }

    public function delete($id)
        {
            // if($id){
            // User::where('id',$id)->delete();
            // session()->flash('message', 'User Deleted Successfully.');
            // }
        }
}
