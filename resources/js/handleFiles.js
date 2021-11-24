import { scrollPageTop } from './helpers';

export const handleFile = (file) => {
    if (file.name.endsWith(".jpg")) {
        const img = new Image(100, 100);
        let imageDiv = document.getElementById("image-div-main");
        if (imageDiv === null) {
            $(".chat-body").append(
                `<div 
                    class="mt-2 d-flex image-div-main border p-2 overflow-auto" 
                    id="image-div-main"
                >
                </div>`
            );
            let chatBodyDiv = $(".chat-body");
            let chatMessageInfoListItemsDiv = $("#chat-message-info-list-items");
            chatBodyDiv.css("height", "70vh");
            chatBodyDiv.css("overflow-y", "hidden");
            chatMessageInfoListItemsDiv.css("height", "50vh");
            chatMessageInfoListItemsDiv.css("overflow-y", "scroll");
            scrollPageTop(chatMessageInfoListItemsDiv);
            //$("#chat-message-info-list-item").scrollTop($("#chat-message-info-list-item")[0].scrollHeight);
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