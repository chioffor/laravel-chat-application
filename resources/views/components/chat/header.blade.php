
<div class="group-page-top p-2 d-flex justify-content-between">
    <div class="d-flex sub align-items-center">
        <div class="profile-pic rounded-circle me-2"></div>
        <div class="fw-bold me-3">{{ $group->name }}</div>
        
    </div>
    <div class="d-flex align-items-center">
        <div class="me-2 fw-bold text-decoration-line-through">
            <a href="#offcanvasHome" class="btn" data-bs-toggle="offcanvas" role="button"><i class="bi bi-envelope-fill"></i></a>
        </div>
        <x-dots.button/>
    </div>
</div>

<div class="offcanvas offcanvas-start" id="offcanvasHome" tabindex="-1">
    <div class="offcanvas-body">
        <div class="d-flex justify-content-between">
            <div>Chats</div>
            <button type="button" class="btn-close text-reset" aria-label="Close" data-bs-dismiss="offcanvas"></button>
        </div>
        <hr />
        <div class="mt-2 p-2 border chats-body">
            @foreach($groups as $group)
                <div>
                    <a href="#collapseGroup-{{ $group->id }}" class="collapse-btn collapseGroup border-0" data-bs-toggle="collapse">                        
                        {{ $group->name }}                                       
                    </a>
                    <i class="caret bi bi-caret-right-fill"></i>
                </div>
                <div class="collapse mt-2" id="collapseGroup-{{ $group->id }}">
                    @if ($group->chats->count() > 0)
                        <a href="/chatapp/main" class="d-flex align-items-center p-2" id="last-chat-info-{{ $group->id }}">
                            <div class="chat-profile-pic me-2">
                                <span class="circle" id="canvas-last-chat-username-initial-{{ $group->id }}">
                                    {{ strtoupper($group->chats->last()->user->name[0]) }}
                                </span>
                            </div>                     
                            <div class="chat-text-sec me-2">
                                <div class="chat-username text-muted me-2" id="canvas-last-chat-username-{{ $group->id }}">{{ $group->chats->last()->user->name }}</div>
                                <div class="chat-text fw-bold canvas-last-chat" id="canvas-last-chat-{{ $group->id }}">
                                    {{ strlen($group->chats->last()->chat) > 25 ? substr($group->chats->last()->chat, 0, 25)."..." : $group->chats->last()->chat }}
                                </div>
                            </div>
                        </a>
                    @endif
                </div>                
            @endforeach

        </div>
    </div>
</div>





<x-dots.modal :user="$user" :group="$group" :groups="$groups" :otherGroups="$otherGroups"/>