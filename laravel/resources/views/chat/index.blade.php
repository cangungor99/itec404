@extends('layouts.app')
@section('title', 'Chat')
@push('styles')



@section('content')
<style>
    .chat-wrapper {
        height: calc(100vh - 100px);
        /* header + footer'ı baz al */
        display: flex;
        flex-direction: column;
    }

    .chat-content {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        overflow-y: auto;
        padding: 1rem;
        max-height: 750px;
        scroll-behavior: smooth;
    }

    .chat-message-wrapper {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .search-results {
        border-top: 1px solid #eee;
        padding-top: 5px;
    }

    .search-result-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
</style>
<style>
    .chat-message-wrapper {
        flex-grow: 1;
        overflow-y: auto;
        max-height: 500px;
        /* İstersen dinamik hale getirebilirsin */
        padding: 1rem;
        scroll-behavior: smooth;
    }

    /* Mobil görünüm için */
    @media (max-width: 768px) {
        .chat-wrapper {
            flex-direction: column;
        }

        .chat-sidebar {
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
        }

        .chat-message-wrapper {
            max-height: 300px;
            padding: 0.75rem;
        }
    }
</style>


<!--start content-->
<main class="page-content">
    <div class="chat-wrapper">
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <div class="d-flex align-items-center">
                    <div class="chat-user-online">
                        <img src="{{ asset('storage/profile_photos/' . (auth()->user()->profile_photo ?? 'default.png')) }}" width="45" height="45" class="rounded-circle" alt="" />
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <p class="user-name mb-0">{{ auth()->user()->name }} {{ auth()->user()->surname }}</p>

                    </div>

                </div>
                <div class="mb-3"></div>

                <div class="chat-tab-menu mt-3">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-chats-tab" data-bs-toggle="pill" href="#pills-Chats" role="tab" aria-controls="pills-Chats" aria-selected="true">
                                <div class="font-24"><i class='bx bx-conversation'></i></div>
                                <div><small>Chats</small></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-club-tab" data-bs-toggle="pill" href="#pills-ClubChat" role="tab" aria-controls="pills-ClubChat" aria-selected="false">
                                <div class="font-24"><i class='bx bx-conversation'></i></div>
                                <div><small>Club Chat</small></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="chat-sidebar-content">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Chats" role="tabpanel" aria-labelledby="pills-chats-tab">
                        <div class="p-3">
                            <div class="meeting-button d-flex justify-content-between">

                                <div class="dropdown">
                                    <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" data-display="static">
                                        <i class='bx bxs-edit me-2'></i>New Chat<i class='bx bxs-chevron-down ms-2'></i>
                                    </a>
                                    <div class="dropdown-menu p-3" style="min-width: 250px;">
                                        <!-- Arama kutusu burada olacak -->
                                        <div class="mb-2">
                                            <input type="text" id="userSearchInput" class="form-control form-control-sm" placeholder="Search user...">
                                            <div id="searchResults" class="search-results mt-2"></div>

                                        </div>
                                        <div>
                                            <small class="text-muted">Enter a name to start chatting</small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="dropdown mt-3"> <a href="#" class="text-uppercase text-secondary dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">Recent Chats <i class='bx bxs-chevron-down'></i></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Recent Chats</a>
                                    <a class="dropdown-item" href="#">Club Chats</a>

                                </div>
                            </div>
                        </div>
                        <div class="chat-list">
                            <div class="list-group list-group-flush">
                                @isset($recentChats)
                                @include('chat.components.recent-chats')
                                @else
                                <p class="text-muted p-3">Henüz sohbet yok.</p>
                                @endisset
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="pills-ClubChat" role="tabpanel" aria-labelledby="pills-club-tab">
                        <div class="p-3">
                            <h6 class="text-muted mb-2">Katıldığın Kulüpler</h6>
                            <ul class="list-group">
                                @foreach(Auth::user()->memberships()->where('status', 'approved')->with('club')->get() as $membership)
                                @if($membership->club)
                                <li class="list-group-item d-flex justify-content-between align-items-center club-item" data-club-id="{{ $membership->club->clubID }}" data-club-name="{{ $membership->club->name }}">
                                    {{ $membership->club->name }}
                                    <i class="bx bx-right-arrow-alt"></i>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="chat-header d-flex align-items-center">
            <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
            </div>
            <div>
                <h4 class="mb-1 font-weight-bold" id="selectedUserName"></h4>
                <input type="hidden" id="selectedUserID" name="receiver_id">
                <h4 class="mb-1 font-weight-bold d-none" id="selectedClubName"></h4>
            </div>

        </div>
        <div class="chat-content">
            <div class="chat-message-wrapper" id="chatMessages">
                <p class="text-muted">Select an user ...</p>
            </div>
        </div>

        <div class="d-none" id="clubChatSection">
            <div class="chat-content">
                <div class="chat-message-wrapper" id="clubChatMessages">
                    <p class="text-muted">Bir kulüp seçin...</p>
                </div>
            </div>

            <div class="chat-footer d-flex align-items-center" id="clubChatFooter">
                <div class="flex-grow-1 pe-2">
                    <div class="input-group">
                        <input type="text" class="form-control" id="clubMessageInput" placeholder="Mesajınızı yazın...">
                    </div>
                </div>
                <div class="chat-footer-menu">
                    <a href="javascript:;" id="clubSendButton"><i class='bx bx-send'></i></a>
                </div>
            </div>
        </div>

        <div class="chat-footer d-flex align-items-center" id="privateChatFooter">
            <div class="flex-grow-1 pe-2">
                <div class="input-group">
                    <input type="text" class="form-control" id="messageInput" placeholder="Type a message">
                </div>
            </div>
            <div class="chat-footer-menu">
                <a href="javascript:;" id="sendButton"><i class='bx bx-send'></i></a>
            </div>
        </div>
        <!--start chat overlay-->
        <div class="overlay chat-toggle-btn-mobile"></div>
        <!--end chat overlay-->
    </div>
</main>
<!--end page main-->

@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('.dropdown-menu input[type="text"]');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        let resultsContainer = document.createElement('div');
        resultsContainer.classList.add('search-results');
        resultsContainer.style.maxHeight = "200px";
        resultsContainer.style.overflowY = "auto";
        resultsContainer.style.marginTop = "10px";
        dropdownMenu.appendChild(resultsContainer);

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length < 2) {
                resultsContainer.innerHTML = '';
                return;
            }

            fetch(`/chat/user-search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';
                    if (data.length === 0) {
                        resultsContainer.innerHTML = '<p class="text-muted mb-0">No users found.</p>';
                    } else {
                        data.forEach(user => {
                            const item = document.createElement('div');
                            item.className = 'search-result-item p-1';
                            item.innerHTML = `
                            <strong>${user.name} ${user.surname}</strong><br>
                            <small class="text-muted">${user.email}</small>
                        `;
                            resultsContainer.appendChild(item);
                        });
                    }
                });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const chatBox = document.getElementById('chatMessages');
        const userIDInput = document.getElementById('selectedUserID');

        function fetchMessages() {
            const receiverID = userIDInput.value;
            if (!receiverID) return;

            fetch(`{{ route('chat.messages') }}?receiverID=${receiverID}`)
                .then(response => response.text())
                .then(html => {
                    chatBox.innerHTML = html;
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        // Her 5 saniyede bir mesajları yenile
        setInterval(fetchMessages, 5000);
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sendBtn = document.getElementById('sendButton');
        const input = document.getElementById('messageInput');
        const userIDInput = document.getElementById('selectedUserID');
        const chatBox = document.getElementById('chatMessages');

        function sendMessage() {
            const message = input.value.trim();
            const receiverID = userIDInput.value;

            if (!message || !receiverID) return;

            // --- Mesajı hemen göster (Optimistik UI)
            const tempHTML = `
            <div class="chat-content-rightside">
                <div class="d-flex ms-auto">
                    <div class="flex-grow-1 me-2">
                        <p class="mb-0 chat-time text-end">you, şimdi</p>
                        <p class="chat-right-msg">${message}</p>
                    </div>
                </div>
            </div>
        `;
            chatBox.insertAdjacentHTML('beforeend', tempHTML);

            // Mesaj kutusunu temizle
            input.value = "";
            input.focus();

            // Scroll en aşağı
            setTimeout(() => {
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 10);

            // Sunucuya gerçek mesajı gönder
            fetch("{{ route('chat.send') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message: message,
                        receiverID: receiverID
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Gerekirse, optimistik mesajı silip sunucudan geleni tekrar ekleyebilirsin.
                    // Ama hızlı görünmesi için yukarıdaki sistem yeterlidir.
                });
        }

        sendBtn.addEventListener('click', sendMessage);

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('userSearchInput');
        const resultsContainer = document.getElementById('searchResults');

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            if (query.length < 2) {
                resultsContainer.innerHTML = '';
                return;
            }

            fetch(`/chat/user-search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';

                    if (data.length === 0) {
                        resultsContainer.innerHTML = '<p class="text-muted mb-0">No users found.</p>';
                    } else {
                        data.forEach(user => {
                            const item = document.createElement('div');
                            item.className = 'search-result-item p-1 border-bottom';
                            item.innerHTML = `
                            <strong>${user.name} ${user.surname}</strong><br>
                            <small class="text-muted">${user.email}</small>
                        `;
                            item.style.cursor = 'pointer';
                            item.onclick = function() {
                                document.getElementById('selectedUserName').innerText = `${user.name} ${user.surname}`;
                                document.getElementById('selectedUserID').value = user.userID;
                                resultsContainer.innerHTML = '';
                            };
                            resultsContainer.appendChild(item);
                        });
                    }
                });
        });
    });


    function selectUser(userID, fullName) {
        // Kullanıcı bilgilerini ayarla
        document.getElementById('selectedUserID').value = userID;
        document.getElementById('selectedUserName').innerText = fullName;

        // UI geçişleri
        document.getElementById('selectedClubName').classList.add('d-none');
        document.getElementById('selectedUserName').classList.remove('d-none');

        document.getElementById('clubChatSection').classList.add('d-none');
        document.getElementById('chatMessages').parentElement.classList.remove('d-none');

        document.getElementById('clubChatFooter').classList.add('d-none');
        document.getElementById('privateChatFooter').classList.remove('d-none');

        // Eski mesajları temizle
        const chatBox = document.getElementById('chatMessages');
        chatBox.innerHTML = '<p class="text-muted">Loading...</p>';

        // Mesajları çek
        fetch(`{{ route('chat.messages') }}?receiverID=${userID}`)
            .then(response => response.text())
            .then(html => {
                chatBox.innerHTML = html;
                chatBox.scrollTop = chatBox.scrollHeight;
            });

        fetch(`/chat/mark-as-read/${userID}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
    }





    function loadRecentChats() {
        fetch("/chat/recent-chats")
            .then(res => res.text())
            .then(html => {
                document.querySelector('.chat-list .list-group').innerHTML = html;
            });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const clubChatSection = document.getElementById('clubChatSection');
        const clubChatMessages = document.getElementById('clubChatMessages');
        const clubMessageInput = document.getElementById('clubMessageInput');
        const clubSendButton = document.getElementById('clubSendButton');

        let currentClubID = null;

        document.querySelectorAll('.club-item').forEach(item => {
            item.addEventListener('click', function() {
                currentClubID = this.dataset.clubId;
                const clubName = this.dataset.clubName;

                // Bireysel mesaj panelini gizle
                document.getElementById('chatMessages').parentElement.classList.add('d-none');
                document.getElementById('privateChatFooter').classList.add('d-none');

                // Kulüp mesaj panelini göster
                clubChatSection.classList.remove('d-none');
                document.getElementById('clubChatFooter').classList.remove('d-none');

                // Başlık değişimi
                document.getElementById('selectedUserName').classList.add('d-none');
                const clubNameEl = document.getElementById('selectedClubName');
                clubNameEl.classList.remove('d-none');
                clubNameEl.innerText = clubName;

                // Mesajları yükle
                clubChatMessages.innerHTML = '<p class="text-muted">Yükleniyor...</p>';
                fetch(`/chat/club/${currentClubID}`)
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newMessages = doc.querySelector('#chatMessages');
                        if (newMessages) {
                            clubChatMessages.innerHTML = newMessages.innerHTML;
                            clubChatMessages.scrollTop = clubChatMessages.scrollHeight;
                        } else {
                            clubChatMessages.innerHTML = '<p class="text-danger">Mesajlar yüklenemedi.</p>';
                        }

                    });
            });
        });

        clubSendButton.addEventListener('click', function() {
            const message = clubMessageInput.value.trim();
            if (!message || !currentClubID) return;

            // Optimistik gösterim
            const tempHTML = `
            <div class="chat-content-rightside">
                <div class="d-flex ms-auto">
                    <div class="flex-grow-1 me-2">
                        <p class="mb-0 chat-time text-end">you, şimdi</p>
                        <p class="chat-right-msg">${message}</p>
                    </div>
                </div>
            </div>
        `;
            clubChatMessages.insertAdjacentHTML('beforeend', tempHTML);
            clubMessageInput.value = "";
            clubMessageInput.focus();

            fetch(`/chat/club/${currentClubID}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message: message
                })
            }).then(() => {
                clubChatMessages.scrollTop = clubChatMessages.scrollHeight;
            });


            fetch(`/chat/club/mark-as-read/${currentClubID}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

        });
    });




    // İlk sayfa yüklenince ve her 10 saniyede bir güncelle
    loadRecentChats();
    setInterval(loadRecentChats, 10000);
</script>

@endpush
