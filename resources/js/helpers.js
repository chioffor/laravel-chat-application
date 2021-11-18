import { EmojiList } from "./emojis";


export const chatDiv = $( "#group-page-chat-div" );

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


export const appendUserToMembersList = (name) => {
    $('#members-list').append(
        `<li class="list-group-item d-flex">
            <div><i class="bi bi-circle-fill me-2" style="color: green;"></i></div>
            <div>${name}</div>
        </li>`
    )
}


export const scrollPageTop = (elem) => {
    elem.scrollTop(elem[0].scrollHeight);
}

export const displayCreateInputDiv = () => {
    $('#group-form').prepend(
        `<div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Choose a name" name="group-name">
            <input type="submit" class="btn btn-outline-secondary" value="Submit">
        </div>`
    );
}

export const appendChat = (template) => {
    $('#chat-message-info-list-item').append(
        template
    );
    scrollPageTop(chatDiv);
}

export const checkUrl = (url) => {
    return url === window.location.href;
}