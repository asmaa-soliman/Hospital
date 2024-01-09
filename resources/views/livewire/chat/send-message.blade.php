        {{-- <nav class="nav">
                <a class="nav-link" data-toggle="tooltip" href="" title="Add Photo"><i class="fas fa-camera"></i></a>
                <a class="nav-link" data-toggle="tooltip" href="" title="Attach a File"><i
                        class="fas fa-paperclip"></i></a> <a class="nav-link" data-toggle="tooltip" href=""
                    title="Add Emoticons"><i class="far fa-smile"></i></a> <a class="nav-link" href=""><i
                        class="fas fa-ellipsis-v"></i></a>
            </nav> --}}
        <div>
            @if ($selected_conversation)
                {{-- فورما من نوع سابميت وادخل جو فانكشن جواها --}}
                <form wire:submit.prevent="sendMessage">
                    <div class="main-chat-footer">
                        <input class="form-control" wire:model="body" placeholder="اكتب رسالتك..." type="text">
                        <button class="main-msg-send" type="submit"><i class="far fa-paper-plane"></i></button>
                    </div>
                </form>
            @endif
        </div>
