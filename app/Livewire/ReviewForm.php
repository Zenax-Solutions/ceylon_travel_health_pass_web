<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;
use Livewire\WithFileUploads;

class ReviewForm extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $content;
    public $rating;
    public $image;
    public $is_published = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'content' => 'required|string',
        'rating' => 'required|integer|between:1,5',
        'image' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function submit()
    {
        $this->validate();

        Review::create([
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
            'rating' => $this->rating,
            'image' => $this->image ? $this->image->store('', 'public') : null,
            'is_published' => $this->is_published,
        ]);

        session()->flash('message', 'Review submitted successfully.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.review-form');
    }
}
