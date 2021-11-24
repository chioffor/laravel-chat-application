

<div class="group-page-chat-input-div bg-light mt-2 border">
    <form>
        @csrf
        <div class="input-div d-flex justify-content-between">
            <textarea rows="2" class="form-control bg-light border-0 message me-2" placeholder="Write a message ..." name="chat-message"></textarea>
            <button class="btn emoji-picker-button" id="emoji-picker-button" style="font-size: 2rem;">&#x1f642;</button>

            <div class="emoji-dropleft">
                <div class="emoji-dropleft-content shadow-lg bg-body rounded ms-2" id="emoji-dropleft-content">
                    <div class="d-flex emoji-categories overflow-auto">
                       
                    </div>
                    <hr />
                    <div class="emoji-category-selected row row-cols-auto overflow-auto" id="" style="height: 100px;">

                    </div>
                </div>
            </div>
            
           
            <label class="file-upload btn me-2">
                <input type="file" id="input-file"/>
                <i class="bi bi-image" style="font-size: 2rem;"></i>
            </label>
            <button class="btn send btn-secondary" type="button">send</i></button>
        </div>
    </form>
</div>

