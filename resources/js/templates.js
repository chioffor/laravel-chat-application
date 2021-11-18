export function welcomeTemplate(name) {
    return (
        `<li class="list-group-item">
            <div>
                Welcome <span class="fw-bold">${name}</span> to this awesome app.
                To view more, click on the 3dots on the top right corner of the header
            </div>
        </li>`
    )
}

export const newUserJoinedGreetingsTemplate = (username) => {
    return (
        `<li class="list-group-item">
            <div class="just-joined">
                <span class="fw-bold">${username}</span> just joined. Say hi to <span class="fw-bold">${username}</span>                
            </div>
        </li>`
    )
}

const getTemp = (username, message, time, class_) => {
    return (
        `<li class="${class_}">
            <div class="chat-profile-pic me-2 mt-2"><span class="circle mt-2">${username[0]}</span></div>
            <div class="">
                <div class="fw-bold">
                    <span class="chat-username">${username}</span>
                    <span class="text-muted">
                        <i class="bi bi-dot"></i>
                        <span class="time">${time}</span>
                    </span>
                </div>
                <div class="chat-text text-muted">${message}</div>
            </div>
        </li>`
    )
}

export const chatTemplate = (data) => {
    let chatUserID = data.userID;
    let user_chat_class = "list-group-item chat-list-item chat-list-item-user d-flex mt-1 sub";
    let other_chat_class = "list-group-item chat-list-item chat-list-item d-flex mt-1 sub";
   
    if (userID == chatUserID) 
        return getTemp(data.username, data.message, data.time, user_chat_class);
    else 
        return getTemp(data.username, data.message, data.time, other_chat_class);
    
}