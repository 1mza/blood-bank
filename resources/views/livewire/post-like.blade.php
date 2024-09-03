<div>
    <a  wire:click="toggleLike" class="favourite">
        @if ($isLiked)
            <i class="fas fa-heart"></i>
        @else
            <i class="far fa-heart"></i>
        @endif
    </a>
</div>
