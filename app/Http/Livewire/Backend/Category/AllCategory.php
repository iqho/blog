<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class AllCategory extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $name, $slug, $image, $image2, $image3, $parent_id, $imageurl, $newImageName;

    public function render()
        {
            $data['categories'] = Category::where('parent_id', null)->where(function ($sub_query) {
                    $sub_query->where('name', 'like', '%' . $this->searchTerm . '%');
                })->orderBy('id', 'desc')->paginate(10);

            $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();


            $data['checkEmpty'] = Str::length($this->slug);
            $data['checkSlug'] = Category::where('slug', '=', Str::slug($this->slug))->exists();

            return view('livewire.backend.category.all-category', compact('data'));
        }

    public function setPage($url)
        {
            $this->currentPage = explode('page=', $url)[1];
            Paginator::currentPageResolver(function () {
                return $this->currentPage;
            });
        }

    public function updateStatus($id)
        {
            $categories = Category::findOrFail($id);
            if($categories->status == 1){
                $categories->status = 0;
            } else {
                $categories->status = 1;
            }
            $categories->save();
            session()->flash('message', 'Category Status Successfully Updated !');
        }

    private function resetInputFields()
        {
            $this->name = '';
            $this->slug = '';
            $this->reset('image');
            $this->reset('image2');
            $this->reset('image3');
            $this->parent_id = '';
            $this->resetErrorBag();
        }

    public function generateSlug()
        {
            $slug = Str::slug($this->name);
            $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
            return $this->slug = $myslug;
        }

    public function storeCategory()
        {
            $validatedDate = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'min:2', 'max:255'],
                'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'parent_id' => 'nullable|numeric'
            ]);

        $slug = Str::slug($this->slug);
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        if (!empty($this->image)) {
            $newImageName = $myslug.".".$this->image->extension();
            $this->image->storeAs('category-image', $newImageName, 'public');
            //$imageurl = url('storage') . '/' . $image;
        } else {
            $newImageName = "";
        }

            Category::create([
                'name' => $this->name,
                'slug' => $myslug,
                'image' => $newImageName,
                'created_by' => auth()->id(),
                'parent_id' => $this->parent_id ? $this->parent_id : NULL,
            ], $validatedDate);
            session()->flash('message', 'Category Created Successfully.');
            $this->resetInputFields();
            $this->emit('storeCategory');

        }

    public function edit($id)
        {
            $category = Category::where('id', $id)->first();
            $this->category_id = $id;
            $this->name = $category->name;;
            $this->slug = $category->slug;
            $this->image2 = $category->image;
            $this->parent_id = $category->parent_id;
        }
    public function cancel()
    {
       $this->resetInputFields();
    }

    public function updateCategory()
        {
            $validatedDate = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'min:2', 'max:255'],
                'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'parent_id' => 'nullable|numeric'
                ]);

            if ($this->category_id) {

                $category = Category::find($this->category_id);

                if( $this->slug != $category->slug ) {
                    $slug = Str::slug($this->slug);
                    $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
                    $newCount = $count > 0 ? ++$count : '';
                    $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

                    if($category->image != null && empty($this->image3)){
                    // This Section for Only when slug change with image name change otherwise keep old slug name image
                    $path_info = pathinfo(public_path('storage/category-image/'. $category->image));
                    $getExt = $path_info['extension'];
                    $newImgName = $myslug.".".$getExt;
                    $currentPath = (public_path('storage/category-image/'. $category->image));
                    $newPath = (public_path('storage/category-image/'. $newImgName));
                    File::move($currentPath, $newPath); // If Change Slug than change also image name too
                    }
                }
                else{
                    $myslug = $this->slug;
                }

                if (!empty($this->image3)) {

                File::delete([public_path('storage/category-image/'. $category->image)]); // Delete Old Image and Store New Image

                $newImageName = $myslug.".".$this->image3->extension();
                $this->image3->storeAs('category-image', $newImageName, 'public');
                //$image = url('storage') . '/' . $image3;

                $category->update([
                    'name' => $this->name,
                    'slug' => $myslug,
                    'image' => $newImageName,
                    'created_by' => auth()->id(),
                    'parent_id' => $this->parent_id ? $this->parent_id : NULL,
                ], $validatedDate);
                }
                else{
                $category->update([
                    'name' => $this->name,
                    'slug' => $myslug,
                    'created_by' => auth()->id(),
                    'parent_id' => $this->parent_id ? $this->parent_id : NULL,
                ], $validatedDate);
                }

            $this->resetInputFields();
            session()->flash('message', 'Category Updated Successfully.');
            $this->emit('categoryUpdate'); // Close model to using to jquery
             }

        }

    public function delete($id)
        {
            $posts = Post::where('category_id', $id)->count();
            if($posts > 0){
                return Redirect::to(route('admin.category'))->with('message', 'Category Have $posts Post. Please Move to Another Category Than Delete this Category');
           }
           else{

            $category = Category::findOrFail($id);
            if(count($category->subcategory))
            {
                $subcategories = $category->subcategory;
                foreach($subcategories as $cat)
                {
                    $cat = Category::findOrFail($cat->id);
                    $cat->parent_id = null;
                    $cat->save();
                }
            }
            // Post::whereCategoryId($id)->update(['category_id' => 1]);
            $category->delete();
           }

            //return redirect()->back()->with('delete', 'Category has been deleted successfully.');
            session()->flash('message', 'Category Move to Trashed Successfully.');
        }
}
