export const chatTemplate = (type, data) => {
    return (
        `<li class="list-group-item d-flex mt-1 sub">
            <div class="profile-pic rounded-circle me-2 mt-1"></div>
            <div class="">
                <div class="fw-bold">
                    ${data.username}
                    <span class="text-muted">
                        <i class="bi bi-dot"></i>
                        <span class="time">${data.time}</span>
                    </span>
                </div>
                <div class="chat-text text-muted">${data.message}</div>
            </div>
        </li>`
    );
}

export const userJoinedTemplate = (data) => {
    return (
        `<li class="list-group-item">
            <div><span class="fw-bold">${data.username}</span> <span class="text-muted">has joined the group</span></div>
        </li>`
    )
}

export const appendUserToMembersList = (name) => {
    $('#info-members-list').append(
        `<li class="list-group-item members-list-item">
            <div class="d-flex sub align-items-center">
                <div class="profile-pic rounded-circle me-2"></div>
                <div class="fw-bold me-3">${name }</div>            
            </div>
        </li>`
    )
}

export const updateChatsCount = (info, id, url) => {
    const data = {
        id: id,
        url: url,
    };

    $.post('/updateChatsCount', data, function(data) {
        let element = $('#' + id);
        let val = Number(element.text());
        switch(info) {
            case 'add-one':
                return element.text(val + 1);
            case 'reset':
                return element.text(90);

        }
    });    
}