<?php

namespace App\Http\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class AllUsers extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $allusers, $name, $email, $user_id;
    public $updateMode = false;
    
    public function render()
        {
            $query = '%' . $this->searchTerm . '%';

            return view('livewire.backend.all-users', [
                'users'        =>    User::where(function ($sub_query) {
                    $sub_query->where('name', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                })->paginate(10)
            ]);
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
            $this->email = '';
        }

    public function store()
        {
            $validatedDate = $this->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);

            User::create($validatedDate);

            session()->flash('message', 'Users Created Successfully.');

            $this->resetInputFields();

            $this->emit('userStore'); // Close model to using to jquery

        }
    public function edit($id)
        {
            $this->updateMode = true;
            $user = User::where('id',$id)->first();
            $this->user_id = $id;
            $this->name = $user->name;
            $this->email = $user->email;
            
        }

    public function cancel()
        {
            $this->updateMode = false;
            $this->resetInputFields();


        }

    public function update()
        {
            $validatedDate = $this->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);

            if ($this->user_id) {
                $user = User::find($this->user_id);
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
                $this->updateMode = false;
                session()->flash('message', 'Users Updated Successfully.');
                $this->resetInputFields();

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
