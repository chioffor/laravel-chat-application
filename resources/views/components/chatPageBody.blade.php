
<div class="group-page-chat-div bg-light p-2" id="group-page-chat-div">
    <ul class="list-group" id="chat-message-info-list-item">
        @foreach ($group->chats as $chat)          
            <li class="list-group-item mt-1 d-flex d-sm-flex d-lg-flex sub">
                <div class="profile-pic rounded-circle me-2 mt-1"></div>
                <div class="">
                    <div class="fw-bold">
                        {{ $chat->user->name }}
                        <span class="text-muted">
                            <i class="bi bi-dot"></i>
                            <span class="time">{{ $chat->getTime() }}</span>
                        </span>
                    </div>
                    <div class="chat-text text-muted">{{ $chat->chat }}</div>
                    
                </div>
            </li>
        @endforeach
    </ul>
</div>