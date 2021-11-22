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

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const handleFile = (file) => {
    if (file.name.endsWith(".jpg")) {
        const img = new Image(100, 100);
        let imageDiv = document.getElementById("image-div-main");
        if (imageDiv === null) {
            $(".chat-body").append(
                `<div class="mt-2 d-flex image-div-main border p-2 overflow-auto" id="image-div-main">
                </div>`
            );
        } 
        img.classList.add("img-thumbnail");
        img.classList.add("me-1");
        img.file = file;
        let imgID = Math.floor(Math.random() * 100000);
        $(".image-div-main").append(
            `<div class="image-div" id="image-div-${imgID}">
                <button type="button" class="img-thumbnail-btn-close btn-close" aria-label="Close"></button>
            </div>`
        );
        $("#image-div-" + imgID).append(img);
        
        const reader = new FileReader();
        reader.onload = (function(asyncImg) {
            return function(e) {
                asyncImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}

if (chatDiv.length) {
    $(scrollPageTop(chatDiv));
}

$(".file-upload").on('change', function() {
    let x = $("#input-file");
    handleFile(x[0].files[0]);
    console.log(x[0].files[0].lastModified);
});

$(".create-new-group *").on("click", function(e) {
    $(".create-new-group").remove();
    displayCreateInputDiv();
});

$( ".send" ).on("click", function(e) {
    e.preventDefault();
    let c = new ChatMessage();
    c.sendChatData();
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

