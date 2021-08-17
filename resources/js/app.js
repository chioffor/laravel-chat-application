const { toArray } = require('lodash');

require('./bootstrap');
require('./helpers');
import { 
    chatTemplate, 
    userJoinedTemplate, 
    appendUserToMembersList,
    updateChatsCount,
} from './helpers';

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function displayCreateInputDiv() {
    $('#group-form').prepend(
        `<div class="input-group mb-2 w-50">
            <input type="text" class="form-control" placeholder="Choose a name" name="group-name">
            <button type="button" class="btn btn-outline-secondary">submit</button>
        </div>`
    );
}

function getMessage(id) {
    return $(id).val();
}

function zeroOutTextArea(id) {
    $(id).val('');
}

const incrementMembersCount = () => {
    let val = Number($('#member-count').text());
    $('#member-count').text(val + 1);
}

function sendChatData() {
    let elementId = '.message';
    let message = getMessage(elementId);
    let url = window.location.href;
    let groupID = id;
    //alert(groupID);
    const data = {
        message: message,
        url: url,
        groupID: groupID,
    };
    $.post('/chat-message', data, function(data) {
        console.log(data);
    });
    //alert(message);
    zeroOutTextArea(elementId);
}

function appendChat(template) {
    $('#chat-message-info-list-item').append(
        template
    );
    scrollPageTop();
}

function scrollPageTop() {
    $('#group-page-chat-div').scrollTop($('#group-page-chat-div')[0].scrollHeight);
}

function checkUrl(url) {
    return url === window.location.href;
}

$(".create-new-group").on("click", function() {
    this.remove();
    displayCreateInputDiv();
});

$('.send').on("click", function(e) {
    e.preventDefault();
    sendChatData();
});

Echo.private('room')
    .listen('ChatSent', (e) => {
        let url = window.location.href;
        if (checkUrl(e.data.url.group))
            appendChat(chatTemplate(e.data));
        if (checkUrl(e.data.url.home))
            updateChatsCount('add-one', e.data.id);  
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
        if (checkUrl(e.data.url)) {
            updateChatsCount('reset', e.data.id);
        }
    })

