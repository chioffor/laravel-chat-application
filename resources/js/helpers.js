import { EmojiList } from "./emojis";
import { ChatMessage} from './chatMessage';







export const processChatSendButtonEvent = () => {
    let c = new ChatMessage();
    c.sendChatData();
}

export const processemojiPickerButtonEvent = () => {
    let emojiContent = $('.emoji-dropleft-content');
    let display = $('.emoji-dropleft-content').css("display");
    if (display == 'none') { 
        showEmojiDisplay();       
        displayEmojis();
        displayCategoryItems('emoticons');     
                
    } else {        
        emojiContent.css("display", "none");           
    }
}

export const processcreateNewGroupButtonEvent = () => {
    $(".create-new-group").remove();
    displayCreateInputDiv();
}







//

export const chatDiv = $( "#chat-body");

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
    let imgDiv = document.getElementById("image-div-main");
    if (imgDiv !== null) {
        $("#chat-message-info-list-items").scrollTop($("#chat-message-info-list-items")[0].scrollHeight);
    } else {
        elem.scrollTop(elem[0].scrollHeight);
    }
}

export const displayCreateInputDiv = () => {
    $('#group-form').append(
        `<div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Choose a name" name="group-name">
            <input type="submit" class="btn btn-outline-secondary" value="Submit">
        </div>`
    );
}

export const appendChat = (template) => {
    $('#chat-message-info-list-items').append(
        template
    );
    scrollPageTop(chatDiv);
}

export const checkUrl = (url) => {
    return url === window.location.href;
}

export const updateCanvas = (groupID, chatMessage, chatUsername) => {
    let x = chatMessage.length > 25 ? chatMessage.substring(0, 25) + "..." : chatMessage;
    if ($("#last-chat-info-" + groupID).length === 0) {
        $("#collapseGroup-" + groupID).html(
            `<a href="/main" class="d-flex align-items-center p-2" id="last-chat-info-${groupID}">
                <div class="chat-profile-pic me-2">
                    <span class="circle" id="canvas-last-chat-username-initial-${groupID}">
                        ${chatUsername[0].toUpperCase()}
                    </span>
                </div>                     
                <div class="chat-text-sec me-2">
                    <div class="chat-username text-muted me-2" id="canvas-last-chat-username-${groupID}">${chatUsername}</div>
                    <div class="chat-text fw-bold canvas-last-chat" id="canvas-last-chat-${groupID}">
                        ${x}
                    </div>
                </div>
            </a>`
        )
    } else {
        $("#canvas-last-chat-username-initial-" + groupID).text(chatUsername[0].toUpperCase())
        $("#canvas-last-chat-" + groupID).text(x);
        $("#canvas-last-chat-username-" + groupID).text(chatUsername);
    }
}