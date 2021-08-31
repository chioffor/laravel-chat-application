export const chatTemplate = (data) => {
    // let userID = userID;
    let chatUserID = data.userID;
    console.log('chat ID = ' + chatUserID);
    console.log('USer ID = ' + userID);
    if (userID == chatUserID) {
        return (
            `<li class="list-group-item chat-list-item private-chat-list-item-user d-flex mt-1 sub">
                <div class="chat-profile-pic rounded-circle me-2 mt-1"></div>
                <div class="">
                    <div class="fw-bold">
                        <span>You</span>
                        <span class="text-muted">
                            <i class="bi bi-dot"></i>
                            <span class="time">${data.time}</span>
                        </span>
                    </div>
                    <div class="chat-text text-muted">${data.message}</div>
                </div>
            </li>`
        );
    } else {
        return (
            `<li class="list-group-item chat-list-item private-chat-list-item d-flex mt-1 sub">
                <div class="chat-profile-pic rounded-circle me-2 mt-1"></div>
                <div class="">
                    <div class="fw-bold">
                        <span>${data.username}</span>
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
                <div class="dropdown">
                    <button class="select-dots btn" id="select-dots" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                    <ul class="dropdown-menu bg-light">
                        <li class="dropdown-item"><a class="" href="/home/direct/">Direct Message</a></li>
                    </ul>
                </div>         
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

export const scrollPageTop = (elem) => {
    //$('#group-page-chat-div').scrollTop($('#group-page-chat-div')[0].scrollHeight);
    elem.scrollTop(elem[0].scrollHeight);
}