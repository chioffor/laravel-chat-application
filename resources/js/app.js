const { toArray } = require('lodash');
require('./bootstrap');

import {
    ChatMessage
} from './chatMessage';

import {     
    appendUserToMembersList,
    displayEmojis,
    scrollPageTop,
    displayCategoryItems,
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
import Event from './events';

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

Event.createNewGroupButton.elem.on("click", function(e) {
    Event.createNewGroupButton.processEvent();
});

Event.chatSendButton.elem.on("click", function(e) {
    e.preventDefault();
    Event.chatSendButton.processEvent();
});

Event.emojiPickerButton.elem.on("click", function(e) {
    e.preventDefault();
    Event.emojiPickerButton.processEvent();
});


Event.body.on("click", Event.emoji.emojiCategory.class_, function(e) {    
    displayCategoryItems($(this).attr("id"));
});

Event.body.on("click", Event.emoji.emojiSelected.class_, function() {
    let textArea = $(".message");
    let newTextVal = textArea.val() + $(this).text();
    textArea.val(newTextVal);
});

Event.body.on("click", `:not(${Event.emojiPickerButton.class_}, .emoji-dropleft-content, .emoji-dropleft-content *)`, function (e) {
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

