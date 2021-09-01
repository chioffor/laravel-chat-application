
<div class="d-flex sub align-items-center">
    <div class="profile-pic rounded-circle me-2"></div>
    <div class="fw-bold me-3">{{ $name }}</div>
    <div class="text-muted flex-grow-1">{{ $identity ?? '' }}</div>
    
    <div class="dropdown">
        <button class="select-dots btn" id="select-dots-blade" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>    
        <ul class="dropdown-menu bg-light">
            @if ($name !== 'You')
                <li class="dropdown-item"><a class="" href="{{ url('/home/direct/'.$id) }}">Direct Message</a></li>
            @else
                <li class="dropdown-item"><a class="#" href="">You</a></li>
            @endif
        </ul>
    </div>
</div>
