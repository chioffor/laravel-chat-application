const { toArray } = require('lodash');
require('./bootstrap');

import { EmojiList } from './emojis';
import {
    sendChatData
} from './chatHelpers';

import {     
    appendUserToMembersList,
    removeUserFromMembersList,
    updateChatsCount,
    displayEmojis,
    scrollPageTop,
    displayCategoryItems,
    hideEmojiDisplay,
    showEmojiDisplay
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

const chatDiv = $( "#group-page-chat-div" );
let emojiPickerContentOpen = false;

if (chatDiv.length) {
    $(scrollPageTop(chatDiv));
}

function displayCreateInputDiv() {
    $('#group-form').prepend(
        `<div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Choose a name" name="group-name">
            <input type="submit" class="btn btn-outline-secondary" value="Submit">
        </div>`
    );
}

const incrementMembersCount = () => {
    let val = Number($('#member-count').text());
    $('#member-count').text(val + 1);
}

const decrementMembersCount = () => {
    let val = Number($('#member-count').text());
    $('#member-count').text(val - 1);
}



function appendChat(template) {
    $('#chat-message-info-list-item').append(
        template
    );
    scrollPageTop(chatDiv);
}

function checkUrl(url) {
    return url === window.location.href;
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
    //const textVal = textArea.val();
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
        //let url = window.location.href;
        //if (checkUrl(e.data.url.group))
        appendChat(chatTemplate(e.data));
        // if (checkUrl(e.data.url.home))
        //     updateChatsCount('add-one', e.data.id, e.data.url.group);  
    })
    .listen('NewUserJoined', (e) => {
        if (e.data.url === window.location.href ) {
            appendChat(newUserJoinedGreetingsTemplate(e.data.new_user_name));
            appendUserToMembersList(e.data.new_user_name);
        }
    })

