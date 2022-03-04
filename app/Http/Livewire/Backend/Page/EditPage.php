<?php

namespace App\Http\Livewire\Backend\Page;

use Livewire\Component;
use App\Models\Admin\Page;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EditPage extends Component
{
    use WithFileUploads;
    public $title, $slug, $description, $featured_image, $featured_image2, $publish_status, $is_sticky, $is_nav, $page_order, $page, $tags, $current_slug;
    public $checkMode = false;


    public function mount($id)
    {
        $page = Page::where('id', $id)->first();
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->description = $page->description;
        $this->meta_description = $page->meta_description;
        $this->featured_image = $page->featured_image;
        $this->is_sticky = $page->is_sticky;
        $this->is_nav = $page->is_nav;
        $this->page_order = $page->page_order;
        $this->publish_status = $page->publish_status;
        $this->tags = $page->tags;

        $this->current_slug = $page->slug;


        if (auth()->user()->user_type == 1) {
            return $this->page = $page;
        }
        elseif (auth()->id() == $page->user->id) {
            return [$this->page = $page, $this->current_slug];
        }
        else {
            return redirect(route('admin-panel.all-pages'));
        }
    }

    public function render()
    {
        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkSlug'] = Page::where('slug', '=', Str::slug($this->slug))->where('slug', '!=', $this->current_slug)->exists();

        return view('livewire.backend.page.edit-page', compact('data'));
    }

    public function generateSlug()
    {
        $this->checkMode = true;
        if (Str::length($this->title) == 0) {
            $myslug = '';
        } else {
            $slug = Str::slug($this->title);
            $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        }
        return $this->slug = $myslug;
    }

    public function updatePage(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255'],
            'description' => 'required',
            'meta_description' => ['required', 'string', 'min:2', 'max:500'],
            'publish_status' => ['required', 'boolean'],
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'tags' => 'required',
        ]);

        $page_id = $request->page_id;

        if ($page_id) {
            $page = Page::findOrFail($page_id);

            if ($request->slug !== $page->slug) {
                $slug = Str::slug($request->slug);
                $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
                $newCount = $count > 0 ? ++$count : '';
                $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

                if(!empty($request->featured_image2)) {
                    if($page->featured_image !== null) {
                        File::delete([public_path('storage/page-images/' . $page->featured_image)]);
                    }
                    $newImgName = $myslug . "." . $request->featured_image2->extension();
                    $request->featured_image2->storeAs('page-images', $newImgName, 'public');
                }
                elseif($page->featured_image !== null) {
                    $path_info = pathinfo(public_path('storage/page-images/' . $page->featured_image));
                    $getExt = $path_info['extension'];
                    $newImgName = $myslug . "." . $getExt;
                    $currentPath = (public_path('storage/page-images/' . $page->featured_image));
                    $newPath = (public_path('storage/page-images/' . $newImgName));
                    File::move($currentPath, $newPath); // If Change Slug than change also image name too
                }
                else{
                    $newImgName = NULL;
                }
            }
            else {
                $myslug = $request->slug;

                if(!empty($request->featured_image2)) {
                    if($page->featured_image !== null) {
                        File::delete([public_path('storage/page-images/' . $page->featured_image)]);
                    }
                    $newImgName = $myslug . "." . $request->featured_image2->extension();
                    $request->featured_image2->storeAs('page-images', $newImgName, 'public');
                }
                else{
                    $newImgName = $page->featured_image;
                }
            }

            $page->update([
                'title' => $request->title,
                'slug' => $myslug,
                'description' => $request->description,
                'meta_description' => $request->meta_description,
                'featured_image' => $newImgName,
                'is_sticky' => $request->is_sticky ? $request->is_sticky : 0,
                'is_nav' => $request->is_nav ? $request->is_nav : 0,
                'page_order' => $request->page_order ? $request->page_order : 1,
                'publish_status' => $request->publish_status,
                'tags' => $request->tags,
            ]);

        }

        return redirect(route('admin-panel.all-pages'))->with('message', 'Page Updated Successfully');
    }
}
