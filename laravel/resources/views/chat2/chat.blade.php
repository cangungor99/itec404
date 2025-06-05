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
        flex-grow: 1;
        overflow-y: auto;
        padding: 1rem;
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


<!--start content-->
<main class="page-content">
    <div class="chat-wrapper">
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <div class="d-flex align-items-center">
                    <div class="chat-user-online">
                        <img src="../assets/images/avatars/avatar-1.png" width="45" height="45" class="rounded-circle" alt="" />
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <p class="mb-0">Mustafa Bostan</p>
                    </div>

                </div>
                <div class="mb-3"></div>

                <div class="chat-tab-menu mt-3">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="javascript:;">
                                <div class="font-24"><i class='bx bx-conversation'></i>
                                </div>
                                <div><small>Chats</small>
                                </div>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="javascript:;">
                                <div class="font-24"><i class='bx bx-bell'></i>
                                </div>
                                <div><small>Notifications</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="chat-sidebar-content">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Chats">
                        <div class="p-3">
                            <div class="meeting-button d-flex justify-content-between">

                                <div class="dropdown">
                                    <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" data-display="static">
                                        <i class='bx bxs-edit me-2'></i>New Chat<i class='bx bxs-chevron-down ms-2'></i>
                                    </a>
                                    <div class="dropdown-menu p-3" style="min-width: 250px;">
                                        <!-- Arama kutusu burada olacak -->
                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm" placeholder="Search user...">
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
                                <a href="javascript:;" class="list-group-item">
                                    <div class="d-flex">
                                        <div class="chat-user-online">
                                            <img src="../assets/images/avatars/avatar-2.png" width="42" height="42" class="rounded-circle" alt="" />
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0 chat-title">Louis Litt</h6>
                                            <p class="mb-0 chat-msg">You just got LITT up, Mike.</p>
                                        </div>
                                        <div class="chat-time">9:51 AM</div>
                                    </div>
                                </a>
                                <a href="javascript:;" class="list-group-item active">
                                    <div class="d-flex">
                                        <div class="chat-user-online">
                                            <img src="../assets/images/avatars/avatar-3.png" width="42" height="42" class="rounded-circle" alt="" />
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0 chat-title">Harvey Specter</h6>
                                            <p class="mb-0 chat-msg">Wrong. You take the gun....</p>
                                        </div>
                                        <div class="chat-time">4:32 PM</div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-header d-flex align-items-center">
            <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
            </div>
            <div>
                <h4 class="mb-1 font-weight-bold">Harvey Inspector</h4>

            </div>

        </div>
        <div class="chat-content">

            <div class="chat-content">
                @foreach ($messages as $msg)
                @if ($msg->senderID === auth()->id())
                <!-- Kullanıcıdan gelen mesaj -->
                <div class="chat-content-rightside">
                    <div class="d-flex ms-auto">
                        <div class="flex-grow-1 me-2">
                            <p class="mb-0 chat-time text-end">you, {{ $msg->created_at->format('H:i') }}</p>
                            <p class="chat-right-msg">{{ $msg->message }}</p>
                        </div>
                    </div>
                </div>
                @else
                <!-- Karşıdan gelen mesaj -->
                <div class="chat-content-leftside">
                    <div class="d-flex">
                        <img src="{{ asset('assets/images/avatars/avatar-3.png') }}" width="48" height="48" class="rounded-circle" alt="" />
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0 chat-time">{{ $msg->sender->name ?? 'Kullanıcı' }}, {{ $msg->created_at->format('H:i') }}</p>
                            <p class="chat-left-msg">{{ $msg->message }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>


        </div>
        <div class="chat-footer d-flex align-items-center">
            <div class="flex-grow-1 pe-2">
                <div class="input-group"> <span class="input-group-text"><i class='bx bx-smile'></i></span>
                    <input type="text" class="form-control" placeholder="Type a message">
                </div>
            </div>
            <div class="chat-footer-menu">
                <a href="javascript:;"><i class='bx bx-file'></i></a>

                <a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a>
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
</script>
@endpush