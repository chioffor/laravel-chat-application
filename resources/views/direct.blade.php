@extends('layout')

@section('content')


    <div class="group-page-top p-2 d-flex justify-content-between">
        <!-- <div class="me-2"><i class="bi bi-chevron-compact-left"></i></div> -->
        @include('components.profile', ["name" => $friend->name, "id" => $id])
        <div class="me-2 fw-bold"><a href="/goHome">HOME</a></div>
    </div>
    

    <div class="group-page-chat-div p-2 mt-2" id="group-page-chat-div">
        <ul class="list-group" id="chat-message-info-list-item">
            @include('components.chatMessageListItems', [
                "chats" => $direct->chats,
            ])
        </ul>
    </div>
    

    <div class="group-page-chat-input-div bg-light mt-2">
        @include('components.chatInputDivComponent')
    </div>

    <script>
        let id = "<?php echo $friend->id; ?>";
        let userID = "<?php echo $userID; ?>";

    </script>
@endsection