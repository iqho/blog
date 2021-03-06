<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;

class TrashedCategory extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public function render()
    {

        $data['categories'] = Category::onlyTrashed()->where('parent_id', null)->where(function ($sub_query) {
            $sub_query->where('name', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->paginate(10);

        //$data['catall'] = Category::withTrashed()->get();

        return view('livewire.backend.category.trashed-category', compact('data'));
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        session()->flash('message', 'Category Restore Successfully.');
    }

    public function delete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        File::delete([public_path('storage/category-images/'. $category->image)]);
        $category->forceDelete();
        session()->flash('message', 'Category Parmanently Deleted Successfully.');
    }

}
