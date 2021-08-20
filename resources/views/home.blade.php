@extends('layout')

@section('content')
    <div class="top d-flex align-items-center main">
        <div class="profile-pic rounded-circle me-2"></div>
        <div class="">
            <div class="fw-bold">{{ $user->name }}</div>      
            <div class="text-muted">{{ $user->password }}</div>
        </div>          
    </div>
    <hr />

    <div class="input-group mb-3">
        <div class="input-group-text border-0">
            <i class="bi bi-search"></i>
        </div>
        <input type="search" class="form-control border-0 bg-light" placeholder="Search">
    </div>

    <div class="favorites-div">
        <div class="d-flex justify-content-between drop-item mb-3 btn" data-bs-toggle="collapse" data-bs-target="#favorites-list">
            <div class="text-muted">FAVORITES</div>
            <div><i class="bi bi-plus-lg"></i></div>                
        </div>
        <ul class="list-group mb-3 collapse" id="favorites-list">
            @forelse ($user->favorites as $group)
                <a href="{{ url('/home/'.$group->id) }}" class="list-group-item bg-light rounded fw-bold"># {{ $group->name }}</a>
            @empty
                <li class="list-group-item bg-light rounded fw-bold"># No groups</li>
            @endforelse
        </ul>
    </div>

    <div class="direct-messages-div mb-3">
        <div class="d-flex justify-content-between drop-item btn" data-bs-toggle="collapse" data-bs-target="#direct-messages-list" aria-expanded="false">
            <div class="text-muted">DIRECT MESSAGES</div>
            <div class="yoo"><i class="bi bi-plus-lg"></i></div>
        </div>
        <ul class="list-group collapse" id="direct-messages-list">
            @forelse ($user->directs as $direct)
                <a href="{{ url('/home/private/'.$direct->id) }}" class="list-group-item">
                    <div class="top d-flex justify-content-between">
                        <div class="d-flex sub align-items-center my-auto">
                            <div class="profile-pic rounded-circle me-2"></div>
                            <div class="fw-bold">{{ $direct->friend($user->id)->name }}</div> 
                        </div>
                        <div class="text-white group-chats-count my-auto" id="<?php echo $direct->id; ?>">{{ $direct->pivot->unreadCount }}</div>
                    </div>
                </a>
            @empty
                <li class="list-group-item">
                    No directs
                </li>
            @endforelse
            
        </ul>
    </div>

    <div class="groups-div">
        <div class="d-flex justify-content-between mb-2 btn drop-item" data-bs-toggle="collapse" data-bs-target="#groups-list">
            <div class="text-muted">GROUPS</div>
            <div><i class="bi bi-plus-lg"></i></div>
        </div>
        
        <div class="collapse show" id="groups-list">

            <div>
                <form method="POST" action="/create-group" id="group-form">
                    @csrf
                </form>
            </div>

            <div class="create-new-group mb-2 fw-bold text-muted btn">
                <span class="me-2 my-auto"><i class="bi bi-plus"></i></span>
                <span class="create-new-group-text my-auto">Create a new group</span>                        
            </div>

            <div class="yours">
                <div class="d-flex btn align-items-center" data-bs-toggle="collapse" data-bs-target="#your-groups">
                    <div class="text-muted me-2 yours-text">YOURS</div>
                    <div><i class="bi bi-plus"></i></div>
                </div>                                          
                    
                <ul class="list-group collapse" id="your-groups">
                    @forelse ($user->groups as $group)
                        @if ($group->users->contains('id', '=', $user->id))                  
                            <a class="list-group-item" href="{{ url('/home/'.$group->id) }}">
                                <div class="group-item d-flex justify-content-between">
                                    <div class="fw-bold"># {{ $group->name }}</div>
                                    <div class="text-white group-chats-count" id="<?php echo $group->id; ?>">{{ $group->pivot->unreadCount }}</div>
                                </div>
                            </a> 
                        @endif
                    @empty
                    <div class="text-muted ms-4 fw-bold">You have no groups</div>
                    @endforelse                       
                </ul>
                   
            </div>

            <div class="others">
                <div class="d-flex btn align-items-center" data-bs-toggle="collapse" data-bs-target="#other-groups">
                    <div class="text-muted me-2 others-text">ALL GROUPS</div>
                    <div><i class="bi bi-plus"></i></div>
                </div>
                <ul class="list-group collapse show" id="other-groups">
                    @forelse ($groups as $group)                                              
                        <li class="list-group-item">
                            <div class="group-item d-flex justify-content-between">
                                <div class="fw-bold"># {{ $group->name }}</div>
                                @if (!$group->users->contains('id', '=', $user->id))
                                    <a href="{{ url('/home/join/'.$group->id) }}" class="btn btn-primary">Join</a>
                                @else
                                    <a href="{{ url('/home/leave/'.$group->id) }}" class="btn btn-primary">Leave</a>
                                @endif
                                </a>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">
                            <div class="">No groups</div>
                        </li>
                    @endforelse
                </ul>
            </div>
            

        </div>

    </div>

    <script>
    </script>

@endsection