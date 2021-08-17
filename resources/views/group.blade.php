@extends('layout')

@php
    $id = $group->id;
@endphp

@section('content')
    <div class="group-page-top p-2">
        <div class="h4 d-flex"> 
            <div class="me-2">#</div>
            <div class="flex-grow-1">
                <div>{{ $group->name }}</div>
                <div class="d-flex group-page-top-sub-info">
                    <div class="me-2 text-muted member-count"><span id="member-count">{{ $group->users->count() }}</span> members</div>
                    <div><span><i class="bi bi-plus"></i></span>Add member</div>
                </div>
            </div>

            <div class="my-auto">
                <i class="bi bi-star-fill"></i>
            </div>
            <button id="info-button" class="btn h4 my-auto" data-bs-toggle="offcanvas" data-bs-target="#info-canvas">
                <i class="bi bi-info-circle-fill"></i>
            </button>
            
        </div>
    </div>

      <!-- CANVAS -->

    <div class="offcanvas offcanvas-end p-2" id="info-canvas">
        <div class="canvas-top p-2">
            <div class="h4">Group info</div>
            <div class="text-muted ms-1 mb-3">Created 22/04/2021</div>
        </div>

        <div class="accordion accordion-flush" id="members-list-parent">
            <div class="accordion-item">
                <h5 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#members-list" aria-expanded="false">
                        <span class="text-muted">MEMBERS</span>
                    </button>
                </h5>
                <div id="members-list" class="accordion-collapse collapse" data-bs-parent="#members-list-parent">
                    <ul class="list-group" id="info-members-list">
                        @foreach ($group->users->all() as $member)
                            @if ($group->isAdmin($member->id))
                                <li class="list-group-item members-list-item">
                                    @include('components.profile', [
                                        'name' => $member->name === $user->name ? 'You' : $member->name, 
                                        'identity' => 'admin'
                                    ])
                                </li>
                            @else                     
                                <li class="list-group-item members-list-item">
                                    @include('components.profile', ['name' => $member->name === $user->name ? 'You' : $member->name])
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    
    <!-- END CANVAS -->

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

    <script>
        let id = "<?php echo $group->id; ?>";
    </script>
@endsection