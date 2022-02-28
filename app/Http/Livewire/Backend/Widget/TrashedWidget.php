<?php

namespace App\Http\Livewire\Backend\Widget;

use Livewire\Component;
use App\Models\SideWidget;

class TrashedWidget extends Component
{
    public function render()
    {
        $rightWidgets = SideWidget::onlyTrashed()->orderBy('reorder', 'asc')->where('position', 'right')->get();
        $leftWidgets = SideWidget::onlyTrashed()->orderBy('reorder', 'asc')->where('position', 'left')->get();

        return view('livewire.backend.widget.trashed-widget', compact('rightWidgets', 'leftWidgets'));
    }

    public function restore($id)
    {
        SideWidget::onlyTrashed()->findOrFail($id)->restore();
        session()->flash('message', 'Widget Restore Successfully.');
    }

    public function delete($id)
    {
        SideWidget::onlyTrashed()->findOrFail($id)->forceDelete();
        session()->flash('message', 'Widget parmanently Deleted Successfully.');
    }
}
