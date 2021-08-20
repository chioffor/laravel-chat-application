
<div class="group-page-chat-input-div bg-light">
    <!-- <form action="{{ url('group/chat/'.$group->id) }}" method="POST"> -->
    <form>
        @csrf
        <div class="input-div input-group">
            <textarea rows="2" class="form-control bg-light border-0 message" placeholder="Write a message ..." name="chat-message"></textarea>
            <input type="submit" class="btn btn-secondary send" value="SEND">
        </div>
    </form>
</div>