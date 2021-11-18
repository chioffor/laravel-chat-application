const { toArray } = require('lodash');
require('./bootstrap');

import {
    sendChatData
} from './chatHelpers';

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
    checkUrl
} from './helpers';

import {
    newUserJoinedGreetingsTemplate,
    chatTemplate
} from './templates';

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


if (chatDiv.length) {
    $(scrollPageTop(chatDiv));
}


$(".create-new-group").on("click", function() {
    this.remove();
    displayCreateInputDiv();
});

$( ".send" ).on("click", function(e) {
    e.preventDefault();
    sendChatData();
});

$( ".emoji-picker-button" ).on("click", function(e) {
    e.preventDefault();
    let emojiContent = $('.emoji-dropleft-content');
    let display = $('.emoji-dropleft-content').css("display");
    if (display == 'none') { 
        showEmojiDisplay();       
        displayEmojis();
        displayCategoryItems('emoticons');     
                
    } else {        
        emojiContent.css("display", "none");           
    }
});

$("body").on("click", ".emoji-category", function(e) {    
    displayCategoryItems($(this).attr("id"));
});

$("body").on("click", ".emoji-selected", function() {
    let textArea = $(".message");
    let newTextVal = textArea.val() + $(this).text();
    textArea.val(newTextVal);
});

$("body *").on("click", ":not(.emoji-picker-button, .emoji-dropleft-content, .emoji-dropleft-content *)", function (e) {
    if (e.target === this) {
        hideEmojiDisplay();
    } else {
        return;
    }    
    
    e.stopPropagation();
});

Echo.private('room')
    .listen('ChatSent', (e) => {
        if (checkUrl(e.data.url))
            appendChat(chatTemplate(e.data));
        
    })
    .listen('NewUserJoined', (e) => {
        if (e.data.url === window.location.href ) {
            appendChat(newUserJoinedGreetingsTemplate(e.data.new_user_name));
            appendUserToMembersList(e.data.new_user_name);
        }
    })

