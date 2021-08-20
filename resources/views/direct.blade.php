@extends('layout')

@section('content')

    <!-- CHAT TOP -->

    <div class="group-page-top p-2">
        @include('components.profile', ["name" => $friend->name, "id" => $id])
    </div>
    
    <!-- END CHAT TOP -->

    <!-- ------------------------------------------------------------------------- -->
    <!-- CHAT BODY -->
    <div class="group-page-chat-div p-2 mt-2" id="group-page-chat-div">
        <ul class="list-group" id="chat-message-info-list-item">
            @foreach ($direct->chats as $chat)
                @if ($chat->user->id === $user->id)
                    <li class="list-group-item mt-1 d-flex chat-list-item sub private-chat-list-item-user">
                @else        
                    <li class="list-group-item mt-1 d-flex chat-list-item sub private-chat-list-item">
                @endif
                    <div class="profile-pic rounded-circle me-2 mt-1"></div>
                    <div class="">
                        <div class="fw-bold">
                            <span>{{ $chat->user->name == $user->name ? "You" : $chat->user->name }}</span>
                            <span class="text-muted">
                                <i class="bi bi-dot"></i>
                                <!-- <span class="time">{{ $chat->getTime() }}</span> -->
                                <span class="time">{{ auth()->check() }}</span>

                            </span>
                        </div>
                        <div class="chat-text text-muted">{{ $chat->chat }}</div>
                        
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- END CHAT BODY -->
    <!-- -------------------------------------------------------- -->

    <!-- CHAT FOOTER -->

    <div class="group-page-chat-input-div bg-light mt-2">
        <form>
            @csrf
            <div class="input-div input-group">
                <textarea rows="2" class="form-control bg-light border-0 message" placeholder="Write a message ..." name="chat-message"></textarea>
                <input type="submit" class="btn btn-secondary send" value="SEND">
            </div>
        </form>
    </div>

    <!-- END CHAT FOOTER -->
    <script>
        let id = "<?php echo $friend->id; ?>";
        let userID = "<?php echo $user->id; ?>";
    </script>
@endsection