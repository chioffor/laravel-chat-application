<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    
</div>

<div class="group-page-chat-div chat-body p-2 border mt-2" id="group-page-chat-div">
    <ul class="list-group" id="chat-message-info-list-item">
        @if (!$newUser)
            @foreach ($chats as $chat)
                @if ($chat->created_at > $user->created_at)
                    @if ($chat->user->id === $user->id)
                        <li class="list-group-item mt-1 d-flex border-0 chat-list-item sub chat-list-item-user">
                    @else
                        <li class="list-group-item mt-1 d-flex chat-list-item sub chat-list-item">
                    @endif     
                        <div class="chat-profile-pic mt-2 me-2"><span class="circle mt-2">{{ $chat->user->name[0] }}</span></div>
                        <div class="">
                            <div class="fw-bold">
                                <!-- <span>{{ $chat->user->id == $user->id ? "You" : $chat->user->name }}</span> -->
                                <span class="chat-username">{{ $chat->user->name }}</span>
                                <span class="text-muted">
                                    <i class="bi bi-dot"></i>
                                    <span class="time">{{ $chat->getTime() }}</span>
                                </span>
                            </div>
                            <div class="chat-text text-muted">{{ $chat->chat }}</div>
                            
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