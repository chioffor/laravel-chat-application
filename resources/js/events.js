import { 
    processChatSendButtonEvent,
    processemojiPickerButtonEvent,
    processcreateNewGroupButtonEvent,
    processEmojiCategoryEvent,

} from "./helpers";

export const events = {
    chatSendButton: {
        class_: ".send",
        processEvent() {
            processChatSendButtonEvent()
        }
    },
   
    emojiPickerButton: {
        class_: '.emoji-picker-button',
        processEvent() {
            processemojiPickerButtonEvent();
        }
    },
    emoji: {
        emojiCategory: {
            class_: ".emoji-category",
            processEvent(id) {
                processEmojiCategoryEvent(id);
            }
        },
        emojiSelected: {
            class_: ".emoji-selected",
        }
    },
    createNewGroupButton: {
        class_: ".create-new-group",
        processEvent() {
            processcreateNewGroupButtonEvent();
        }
    },

    body: $("body"),
}

