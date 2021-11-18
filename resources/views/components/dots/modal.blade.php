<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
</div>

<div class="modal fade" id="optionsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="profile-pic rounded-circle me-2 mt-1"></div>
                    <div class="fw-bold">{{ $user->name }}</div>
                </div>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    @if ($group)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="members-tab" data-bs-toggle="tab" data-bs-target="#members" type="button" role="tab" aria-selected="true">
                                Members
                            </button>
                        </li>
                    @endif
                   
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="groups-tab" data-bs-toggle="tab" data-bs-target="#groups" type="button" role="tab" aria-selected="false">
                            Groups
                        </button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="directs-tab" data-bs-toggle="tab" data-bs-target="#directs" type="button" role="tab" aria-selected="false">
                            Directs
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content">
                    @if ($group)
                        <div class="tab-pane fade show active" id="members" role="tabpanel" aria-labelledby="members-tab">
                            <div class="p-2">
                                <!-- <div class="h5">Members</div> -->
                                <ul class="list-group" id="members-list" style="height: 400px;">
                                    @foreach($group->users as $member)
                                        <li class="list-group-item d-flex">
                                            <div><i class="bi bi-circle-fill me-2" style="color: green;"></i></div>
                                            <div>{{ $member->name === $user->name ? "You" : $member->name }}</div>
                                        </li>
                                    @endforeach
                                   
                                </ul>
                            </div>

                        </div>
                    @endif
                    @if (!$group)
                        <div class="tab-pane fade show active" id="groups" role="tabpanel" aria-labelledby="groups-tab">
                    @else
                        <div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
                    @endif
                        <ul class="list-group overflow-auto" style="height: 400px;">
                            <li class="list-group-item">
                                <div class="create-new-group fw-bold text-muted btn">
                                    <span class="me-2 my-auto"><i class="bi bi-plus"></i></span>
                                    <span class="create-new-group-text my-auto">Create a new group</span>                        
                                </div>
                                <div>
                                    <form method="POST" action="/create-group">
                                        @csrf
                                        <fieldset id="group-form" disabled>

                                        </fieldset>
                                    </form>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="">
                                    <div class="d-flex btn align-items-center" data-bs-toggle="collapse" data-bs-target="#your-groups">
                                        <div class="fw-bold">YOURS</div>
                                        <div><i class="bi bi-plus"></i></div>
                                    </div>

                                    <ul class="list-group collapse show" id="your-groups">
                                        <!-- <li class="list-group-item">
                                            <a href="/main"># - Main</a>
                                        </li> -->
                                        @foreach($user->groups as $group)
                                            
                                            <li class="list-group-item">
                                                @if ($group->id != 1)
                                                    <a href="{{ url('group/'.$group->id.'/'.$group->name) }}"># - {{ $group->name }}</a>
                                                @else
                                                    <a href="{{ url('/main') }}"># - {{ $group->name }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                                <div class="">
                                    <div class="d-flex btn align-items-center" data-bs-toggle="collapse" data-bs-target="#other-groups">
                                        <div class="fw-bold">OTHERS</div>
                                        <div><i class="bi bi-plus"></i></div>
                                    </div>

                                    <ul class="list-group collapse" id="other-groups">
                                        @forelse($otherGroups as $group)
                                            @if($group->id != 1)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <div><a href="{{ url('group/'.$group->id.'/'.$group->name) }}"># - {{ $group->name }}</a></div>
                                                    <div class=""><a href="{{ url('/join/'.$group->id) }}">Join</a></div>
                                                </li>
                                            @endif
                                        @empty
                                            <li class="list-group-item">
                                                <div>no new groups</div>
                                            </li>
                                        @endforelse
                                    </ul>

                                </div>
                            </li>                         
                                                      
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="directs" role="tabpanel" aria-labelledby="directs-tab">
                        <div style="height: 400px;">
                            <div class="fst-italic">Coming Soon</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>