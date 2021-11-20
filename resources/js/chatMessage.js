export class ChatMessage {
    constructor() {
        this.textAreaClassName = ".message";
        this.url = window.location.href;
        this.path = window.location.pathname;
        this.groupID = id;
        this.userID = userID;        
    }

    getChatInput() {
        return $( this.textAreaClassName ).val();
    }

    zeroOutTextArea() {
        $( this.textAreaClassName ).val('');
    }

    getPostData() {
        const data = {
            message: this.getChatInput(),
            url: this.url,
            id: this.groupID,
            userID: this.userID,
        }
        return data;
    }

    sendChatData() {
        if (this.getChatInput() !== '') {
            $.post(this.path, this.getPostData(), function(data) {
                console.log(data);
            });
            this.zeroOutTextArea();
        }
    }
}


