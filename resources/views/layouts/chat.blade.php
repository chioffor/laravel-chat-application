@extends('layout')

@section('content')
    <div class="group-page-top p-2">
        <div class="h4 d-flex"> 
            <div class="me-2">#</div>
            <div class="flex-grow-1">
                <div># Gamble</div>
                <div class="d-flex group-page-top-sub-info">
                    <div class="me-2 text-muted member-count"><span id="member-count">2</span> members</div>
                    <div><span><i class="bi bi-plus"></i></span>Add member</div>
                </div>
            </div>

            <div class="my-auto fav">
                <!-- if (user->activeFavorite(id)) -->
                    <i class="bi bi-star-fill marked-favorite" id="marked"></i>
                <!-- else -->
                    <i class="bi bi-star-fill unmarked-favorite" id="unmarked"></i>
                <!-- endif -->
            </div>
            
            
        </div>
    </div>

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


<div class="group-page-chat-input-div bg-light">
    <!-- <form action="{{ url('group/chat/'.$group->id) }}" method="POST"> -->
    <form>
        @csrf
        <div class="input-div input-group">
            <textarea rows="2" class="form-control bg-light border-0 message" placeholder="Write a message ..." name="chat-message"></textarea>
            <input type="submit" class="btn btn-secondary send" value="SEND">
        </div>
    </form>
</div>
@endsection