<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostLike extends Component
{
    public $post;
    public $isLiked;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isLiked = auth('web-clients')->user()->favorites->contains($post->id);
    }

    public function toggleLike()
    {
        if (auth('web-clients')->check()) {
            $client = auth('web-clients')->user();

            if ($this->isLiked) {
                $client->favorites()->detach($this->post->id);
                $this->isLiked = false;
            } else {
                $client->favorites()->attach($this->post->id);
                $this->isLiked = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.post-like');
    }
}
