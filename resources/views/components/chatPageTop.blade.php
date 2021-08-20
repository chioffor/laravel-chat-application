

<div class="group-page-top p-2">
    <div class="h4 d-flex"> 
        <div class="me-2">#</div>
        <div class="flex-grow-1">
            <div>{{ $room->name }}</div>
            <div class="d-flex group-page-top-sub-info">
                @if ($groupChat == true)
                    <div class="me-2 text-muted member-count"><span id="member-count">{{ $room->users->count() }}</span> members</div>
                    <div><span><i class="bi bi-plus"></i></span>Add member</div>
                
            </div>
        </div>

        <div class="my-auto fav">
            @if ($user->activeFavorite($id))
                <i class="bi bi-star-fill marked-favorite" id="marked"></i>
            @else
                <i class="bi bi-star-fill unmarked-favorite" id="unmarked"></i>
            @endif
        </div>
        <button id="info-button" class="btn h4 my-auto" data-bs-toggle="offcanvas" data-bs-target="#info-canvas">
            <i class="bi bi-info-circle-fill true"></i>
        </button>
        @endif
        
    </div>
</div>