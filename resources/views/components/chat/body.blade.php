<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    
</div>

<div class="group-page-chat-div chat-body p-2 border mt-2" id="group-page-chat-div">
    <ul class="list-group" id="chat-message-info-list-item">
        @if (!$newUser)
            @foreach ($chats as $chat)
                @if ($chat->created_at > $user->created_at)
                    @if ($chat->user->id === $user->id)
                        <li class="list-group-item mt-2 d-flex border-0 chat-list-item sub chat-list-item-user">
                    @else
                        <li class="list-group-item mt-2 d-flex chat-list-item sub chat-list-item">
                    @endif
                        
                        <div class="chat-profile-pic me-2"><span class="circle">{{ strtoupper($chat->user->name[0]) }}</span></div>                      
                        <div class="chat-text-sec me-2 flex-grow-1">
                            <span class="chat-username text-muted me-2">{{ $chat->user->name }}</span>
                            <span class="chat-text">{{ $chat->chat }}</span>
                        </div>
                    </li>
                @endif
            @endforeach
        @else 
            <li class="list-group-item">
                <div>
                    Welcome <span class="fw-bold">{{ $user->name }}</span> to this awesome app.
                    To view more, click on the 3dots on the top right corner of the header
                </div>
            </li>
        @endif
        
    </ul>
</div>