<?php

namespace App\Http\Livewire\Backend\Category;

use App\Models\Admin\Category;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

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

        $data['catall'] = Category::all();

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
        Category::withTrashed()->find($id)->restore();
        session()->flash('message', 'Category Restore Successfully.');
    }
    public function delete($id)
    {
        //Product::onlyTrashed()->find(2)->forceDelete();
        $category = Category::onlyTrashed()->findOrFail($id);
        if(count($category->subcategory))
        {
            $subcategories = $category->subcategory;
            foreach($subcategories as $cat)
            {
                $cat = Category::onlyTrashed()->findOrFail($cat->id);
                $cat->parent_id = null;
                $cat->save();
            }
        }
        $category->forceDelete();
        //return redirect()->back()->with('delete', 'Category has been deleted successfully.');
        session()->flash('message', 'Category Deleted Successfully.');
    }
}
