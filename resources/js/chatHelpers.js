

function getMessage(id) {
    return $(id).val();
}

function zeroOutTextArea(id) {
    $(id).val('');
}

export const sendChatData = () => {
    let elementId = '.message';
    let message = getMessage(elementId);
    if (message != '') {
        let url = window.location.href;
        let path = window.location.pathname;
        //let id = id;
        const data = {
            message: message,
            url: url,
            id: id,
            userID: userID,
        };
        $.post(path, data, function(data) {
            console.log(data);
        });
    //alert(message);
        zeroOutTextArea(elementId);
    }
}

