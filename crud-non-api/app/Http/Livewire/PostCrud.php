<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostCrud extends Component
{
    public $posts, $name, $address, $desc, $category, $post_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.post-crud');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm()
    {
        $this->name = '';
        $this->address = '';
        $this->description = '';
        $this->category = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'category' => 'required',
        ]);

        Post::updateOrCreate(
            ['id' => $this->post_id],
            [
                'name' => $this->name,
                'address' => $this->address,
                'description' => $this->description,
                'category' => $this->category,
            ]
        );
        session()->flash(
            'message',
            $this->post_id
                ? 'Data Berhasil diperbaharui.'
                : 'Data Berhasil Ditambahkan.'
        );
        $this->closeModal();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->name = $post->name;
        $this->address = $post->address;
        $this->description = $post->description;
        $this->category = $post->category;

        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
