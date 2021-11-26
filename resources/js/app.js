const { toArray } = require('lodash');
require('./bootstrap');

import {
    ChatMessage
} from './chatMessage';

import {     
    appendUserToMembersList,
    displayEmojis,
    scrollPageTop,
    // displayCategoryItems,
    hideEmojiDisplay,
    showEmojiDisplay,
    displayCreateInputDiv,
    appendChat,
    chatDiv,
    checkUrl,
    updateCanvas
} from './helpers';

import {
    newUserJoinedGreetingsTemplate,
    chatTemplate
} from './templates';

import { handleFile } from './handleFiles';
import { events } from './events';

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


if (chatDiv.length) {
    $(scrollPageTop(chatDiv));
}

$(".file-upload").on('change', function() {
    let x = $("#input-file");
    handleFile(x[0].files[0]);
    console.log(x[0].files[0].lastModified);
});

$(events.chatSendButton.class_).on("click", function(e) {
    e.preventDefault();
    events.chatSendButton.processEvent();
});

$(events.emojiPickerButton.class_).on("click", function(e) {
    e.preventDefault();
    events.emojiPickerButton.processEvent();
});

$(events.createNewGroupButton.class_).on("click", function(e) {
    events.createNewGroupButton.processEvent();
});

events.body.on("click", events.emoji.emojiCategory.class_, function(e) {
    events.emoji.emojiCategory.processEvent($(this).attr("id"));   
});

events.body.on("click", events.emoji.emojiSelected.class_, function() {
    let textArea = $(".message");
    let newTextVal = textArea.val() + $(this).text();
    textArea.val(newTextVal);
});

events.body.on("click", `:not(${events.emojiPickerButton.class_}, .emoji-dropleft-content, .emoji-dropleft-content *)`, function (e) {
    if (e.target === this) {
        hideEmojiDisplay();
    } else {
        return;
    }    
    
    e.stopPropagation();
});

$(".collapseGroup").on("click", function() {
    let x = $( this ).parent();
    if ($(".caret", x).hasClass("bi-caret-down-fill")) {
        $(".caret", x).removeClass("bi-caret-down-fill");
        $(".caret", x).addClass("bi-caret-right-fill");
    } else {
        $(".caret", x).removeClass("bi-caret-right-fill");
        $(".caret", x).addClass("bi-caret-down-fill");
    }
});


Echo.private('room')
    .listen('ChatSent', (e) => {
        if (checkUrl(e.data.url))
            appendChat(chatTemplate(e.data));
            updateCanvas(e.data.groupID, e.data.message, e.data.username);
        
    })
    .listen('NewUserJoined', (e) => {
        if (e.data.url === window.location.href ) {
            appendChat(newUserJoinedGreetingsTemplate(e.data.new_user_name));
            appendUserToMembersList(e.data.new_user_name);
        }
    })

