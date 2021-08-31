@extends('layout')

@php
    $id = $group->id;
@endphp

@section('content')
    <div class="group-page-top p-2">
        <div class="h5 d-flex"> 
            <div class="me-2">#</div>
            <div class="flex-grow-1">
                <div>{{ $group->name }}</div>
                <div class="d-flex group-page-top-sub-info">
                    <div class="me-2 text-muted member-count"><span id="member-count">{{ $group->users->count() }}</span> members</div>
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
            <div class="me-2 fw-bold my-auto"><a href="/goHome">HOME</a></div>
            
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
                                        "name" => $member->name === $user->name ? 'You' : $member->name, 
                                        "identity" => 'admin',
                                        "id" => $member->id
                                    ])
                                </li>
                            @else                     
                                <li class="list-group-item members-list-item">
                                    @include('components.profile', [
                                        "name" => $member->name === $user->name ? 'You' : $member->name,
                                        "id" => $member->id,
                                        "identity" => '',
                                    ])
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
            @include('components.chatMessageListItems', [
                "chats" => $group->chats,
            ])
           
        </ul>
    </div>

    <div class="group-page-chat-input-div bg-light mt-2">
        <!-- <form action="{{ url('group/chat/'.$group->id) }}" method="POST"> -->
        @include('components.chatInputDivComponent')
    </div>

    <script>
        let id = "<?php echo $group->id; ?>";
        let userID = "<?php echo $userID; ?>";
    </script>
@endsection