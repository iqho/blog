<?php

namespace App\Http\Livewire\Backend\Widget;

use Livewire\Component;
use App\Models\SideWidget;

class Widget extends Component
{
    public $title, $body, $reorder, $position, $widget_id;
    public $updateMode = false;

    public function render()
    {
        $rightWidgets = SideWidget::orderBy('reorder', 'asc')->where('position', 'right')->get();
        $leftWidgets = SideWidget::orderBy('reorder', 'asc')->where('position', 'left')->get();

        return view('livewire.backend.widget.widget', compact('rightWidgets', 'leftWidgets') );
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->body = '';
        $this->reorder = '';
        $this->position = '';
    }

    public function storeWidget()
    {
        $validatedDate = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'position' => 'required'
        ]);

        SideWidget::create([
            'title' => $this->title,
            'body' => $this->body,
            'reorder' => $this->reorder ? $this->reorder : 1,
            'user_id' => auth()->id(),
            'position' => $this->position ? $this->position : 'right',
        ], $validatedDate);

        session()->flash('message', 'Widget Created Successfully.');
        $this->resetInputFields();
        $this->emit('storeWidget');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $widget = SideWidget::where('id', $id)->first();
        $this->widget_id = $id;
        $this->title = $widget->title;;
        $this->body = $widget->body;
        $this->reorder = $widget->reorder;
        $this->position = $widget->position;
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        $this->emit('storeWidget');
    }

    public function updateWidget()
    {
        $validatedDate = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'position' => 'required'
        ]);

        if ($this->widget_id) {
            $widget = SideWidget::findOrFail($this->widget_id);

            $widget->update([
            'title' => $this->title,
            'body' => $this->body,
            'reorder' => $this->reorder ? $this->reorder : 1,
            'position' => $this->position,
            ], $validatedDate);

            session()->flash('message', 'Widget Updated Successfully.');
            $this->resetInputFields();
            $this->emit('storeWidget');
            $this->updateMode = false;
        }
    }

    public function delete($id)
    {
        $widget = SideWidget::findOrFail($id);
        $widget->delete();
        session()->flash('message', 'Widget Move to Trashed Successfully.');
    }
    
}
