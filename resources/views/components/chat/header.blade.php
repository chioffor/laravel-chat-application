
<div class="group-page-top p-2 d-flex justify-content-between">
    <div class="d-flex sub align-items-center">
        <div class="profile-pic rounded-circle me-2"></div>
        <div class="fw-bold me-3">{{ $group->name }}</div>
        
    </div>
    <div class="d-flex align-items-center">
        <div class="me-2 fw-bold text-decoration-line-through"><a href="#">HOME</a></div>
        <x-dots.button/>
    </div>
</div>

<x-dots.modal :user="$user" :group="$group" :groups="$groups" :otherGroups="$otherGroups"/>