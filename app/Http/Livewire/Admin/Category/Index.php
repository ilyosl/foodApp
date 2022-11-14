<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected  $paginationTheme = 'bootstrap';
    public $category_id;
    public function deleteCategory($category_id) {
        $this->category_id = $category_id;
    }
    public function destroyCategory(){
        $category = Category::find($this->category_id);

        $delPath = 'uploads/category/'.$category->image;
        if(File::exists($delPath)){
            File::delete($delPath);
        }

        $category->delete();

        session()->flash('message', 'Category was deleted');

        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.category.index',['categories' =>$categories]);
    }
}
