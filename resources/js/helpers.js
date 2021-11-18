import { EmojiList } from "./emojis";


export const hideEmojiDisplay = () => {
    $(".emoji-dropleft-content").css("display", "none");
}

export const showEmojiDisplay = () => {
    $(".emoji-dropleft-content").css("display", "block");
}

export const displayEmojis = () => {
    const emojisDiv = $('.emoji-categories');
    const emojiChoicesKeys = Object.keys(EmojiList);
    const emojiChoices = emojiChoicesKeys.map(emojiKey => {
        let ch = String.fromCodePoint("0x" + EmojiList[emojiKey][0]);
        return ch;
    });
    let divs = ``;
    emojiChoices.forEach(e => (
        divs += `<div class="me-2 emoji-category" id="${emojiChoicesKeys[emojiChoices.indexOf(e)]}">${e}</div>`
    ));
   
    emojisDiv.html(
        divs
    );
}

export const displayCategoryItems = (t) => {
    const emojiCategorySelectedDiv = $('.emoji-category-selected');
    const emojis = EmojiList[t];
    let emjs = ``;
    emojis.forEach(e => (
        emjs += `<div class="col emoji-selected">${String.fromCodePoint("0x" + e)}</div>`
    ))
    emojiCategorySelectedDiv.html(
        emjs
    );
}

export const userJoinedTemplate = (data) => {
    return (
        `<li class="list-group-item">
            <div><span class="fw-bold">${data.username}</span> <span class="text-muted">has joined the group</span></div>
        </li>`
    )
}

export const userLeftTemplate = (username) => {
    return (
        `<li class="list-group-item">
            <div><span class="fw-bold">${username}</span> <span class="text-muted">has left the group</span></div>
        </li>`
    )
}

// export const appendUserToMembersList = (name, id) => {
//     $('#info-members-list').append(
//         `<li class="list-group-item members-list-item" id="${id}">
//             <div class="d-flex sub align-items-center">
//                 <div class="profile-pic rounded-circle me-2"></div>
//                 <div class="fw-bold me-3 flex-grow-1">${name}</div>  
//                 <div class="dropdown">
//                     <button class="select-dots btn" id="" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
//                     <ul class="dropdown-menu bg-light">
//                         <li class="dropdown-item"><a class="" href="#">Direct Message</a></li>
//                     </ul>
//                 </div>         
//             </div>
//         </li>`
//     )
// }
export const appendUserToMembersList = (name) => {
    $('#members-list').append(
        `<li class="list-group-item d-flex">
            <div><i class="bi bi-circle-fill me-2" style="color: green;"></i></div>
            <div>${name}</div>
        </li>`
    )
}

export const removeUserFromMembersList = (id) => {
    $(`#${id}`).remove();    
}

export const updateChatsCount = (info, id, url) => {
    // const data = {
    //     url: url,
    // };

    $.get(`/updateChatsCount/${id}`, {url: url}, function(data) {
        let element = $('#' + id);
        let val = Number(element.text());
        switch(info) {
            case 'add-one':
                return element.text(val + 1);
            case 'reset':
                return element.text(0);

        }
    });    
}

export const scrollPageTop = (elem) => {
    //$('#group-page-chat-div').scrollTop($('#group-page-chat-div')[0].scrollHeight);
    elem.scrollTop(elem[0].scrollHeight);
}