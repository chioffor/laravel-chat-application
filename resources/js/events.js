import { 
    processChatSendButtonEvent,
    processemojiPickerButtonEvent,
    processcreateNewGroupButtonEvent,
} from "./helpers";

const events = {
    chatSendButton: {
        class_: '.send',
        elem: $('.send'),
        processEvent: function() {
            processChatSendButtonEvent();
        }
    },
    emojiPickerButton: {
        class_: '.emoji-picker-button',
        elem: $( ".emoji-picker-button" ),
        processEvent: function() {
            processemojiPickerButtonEvent();
        }
    },
    emoji: {
        emojiCategory: {
            class_: ".emoji-category",
            elem: $(".emoji-category"),
        },
        emojiSelected: {
            class_: ".emoji-selected",
            elem: $(".emoji-selected"),
        }
    },
    createNewGroupButton: {
        class_: ".create-new-group",
        elem: $(".create-new-group"),
        processEvent: function() {
            processcreateNewGroupButtonEvent();
        }
    },

    body: $("body"),
}

export default events;