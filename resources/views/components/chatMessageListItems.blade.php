

@foreach ($chats as $chat)
    @if ($chat->user->id === $userID)
        <li class="list-group-item mt-1 d-flex border-0 chat-list-item sub private-chat-list-item-user">
    @else
        <li class="list-group-item mt-1 d-flex chat-list-item sub private-chat-list-item">
    @endif     
        <div class="chat-profile-pic rounded-circle me-2 mt-1"></div>
        <div class="">
            <div class="fw-bold">
                <span>{{ $chat->user->id == $userID ? "You" : $chat->user->name }}</span>
                <span class="text-muted">
                    <i class="bi bi-dot"></i>
                    <span class="time">{{ $chat->getTime() }}</span>
                </span>
            </div>
            <div class="chat-text text-muted">{{ $chat->chat }}</div>
            
        </div>
    </li>
@endforeach