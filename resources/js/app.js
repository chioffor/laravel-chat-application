const { toArray } = require('lodash');
require('./bootstrap');

import {
    sendChatData
} from './chatHelpers';

import { 
    chatTemplate, 
    userJoinedTemplate, 
    appendUserToMembersList,
    updateChatsCount,
    scrollPageTop,
} from './helpers';

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const chatDiv = $( "#group-page-chat-div" );

if (chatDiv.length) {
    $(scrollPageTop(chatDiv));
}


function displayCreateInputDiv() {
    $('#group-form').prepend(
        `<div class="input-group mb-2 w-50">
            <input type="text" class="form-control" placeholder="Choose a name" name="group-name">
            <button type="button" class="btn btn-outline-secondary">submit</button>
        </div>`
    );
}




const incrementMembersCount = () => {
    let val = Number($('#member-count').text());
    $('#member-count').text(val + 1);
}



function appendChat(template) {
    $('#chat-message-info-list-item').append(
        template
    );
    scrollPageTop(chatDiv);
}

// function scrollPageTop(elem) {
//     // $('#group-page-chat-div').scrollTop($('#group-page-chat-div')[0].scrollHeight);
//     elem.scrollTop(elem)[0].scrollHeight;
// }

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

$( ".bi-star-fill" ).on("click", function() {
    $.post('/favorite', {id: id}, function(data) {
        console.log('success');
    });
    
});

$( ".members-list-item" ).mouseover(function() {
    $( this ).find(".select-dots").css('visibility', 'visible');
});
$( ".members-list-item" ).mouseleave(function() {
    $( this ).find(".select-dots").css('visibility', 'hidden');
});

Echo.private('room')
    .listen('ChatSent', (e) => {
        let url = window.location.href;
        if (checkUrl(e.data.url.group))
            appendChat(chatTemplate(e.data));
        if (checkUrl(e.data.url.home))
            updateChatsCount('add-one', e.data.id, e.data.url.group);  
    })
    .listen('UserJoinedGroup', (e) => {
        if (checkUrl(e.data.url)) {
            incrementMembersCount();
            appendChat(userJoinedTemplate(e.data));
            appendUserToMembersList(e.data.username);
        }
        console.log(e);
    })
    .listen('ReadChatMessage', (e) => {
        // if (checkUrl(e.data.url)) {
        //     updateChatsCount('reset', e.data.id);
        // }
    })
    .listen('ClickedFavorite', (e) => {
        if (e.data.info == true) {
            $('.bi-star-fill').css("color", "yellow");
        } else {
            $('.bi-star-fill').css("color", "gray");
        }
        console.log(e.data);
    })

