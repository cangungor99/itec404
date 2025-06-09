@extends('layouts.app')
@section('title', 'Manage Votes')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Voting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Voting Lists</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-4 animate__animated animate__fadeIn">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-card-checklist text-primary me-2"></i> Manage Voting Sessions</h4>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($votings as $index => $vote)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $vote->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($vote->start_date)->format('Y-m-d H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($vote->end_date)->format('Y-m-d H:i') }}</td>
                            <td>
                                @php
                                $now = \Carbon\Carbon::now();
                                $start = \Carbon\Carbon::parse($vote->start_date);
                                $end = \Carbon\Carbon::parse($vote->end_date);

                                if ($now->lt($start)) {
                                $status = 'Upcoming';
                                } elseif ($now->between($start, $end)) {
                                $status = 'Active';
                                } else {
                                $status = 'Ended';
                                }
                                @endphp
                                <span class="badge
        {{ $status === 'Upcoming' ? 'bg-warning' :
           ($status === 'Active' ? 'bg-success' : 'bg-secondary') }}">
                                    {{ $status }}
                                </span>
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Edit Button: Modal Tetikleyici -->
                                    <button
                                        class="btn btn-outline-primary btn-sm btn-edit-vote"
                                        data-id="{{ $vote->votingID }}"
                                        data-vote='@json($vote)'
                                        data-title="{{ $vote->title }}"
                                        data-description="{{ $vote->description }}"
                                        data-start="{{ $vote->start_date }}"
                                        data-end="{{ $vote->end_date }}"
                                        data-clubid="{{ $vote->clubID }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editVoteModal"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Results -->
                                    <!-- Results (şimdilik yönlendirme yok, modal kullanılacak) -->
                                    <button
                                        class="btn btn-outline-info btn-sm btn-show-results"
                                        data-id="{{ $vote->votingID }}"
                                        title="Results">
                                        <i class="bi bi-bar-chart-line"></i>
                                    </button>


                                    <!-- Delete -->
                                    <form class="delete-vote-form d-inline"
      action="{{ route('admin.votings.destroy', $vote->votingID) }}"
      method="POST"
      data-id="{{ $vote->votingID }}">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-outline-danger btn-sm btn-delete-vote" title="Delete">
        <i class="bi bi-trash"></i>
    </button>
</form>


                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No voting sessions found.</td>
                        </tr>
                        @endforelse
                    </tbody>



                </table>
            </div>

            <div class="text-end mt-4">
                <a href="create_vote.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> New Voting
                </a>
            </div>
        </div>
    </div>


</main>
<!-- Edit Voting Modal -->
<div class="modal fade" id="editVoteModal" tabindex="-1" aria-labelledby="editVoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <form method="POST" id="editVoteForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editVoteModalLabel"><i class="bi bi-pencil-square me-2"></i> Edit Voting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="votingID" id="editVotingID">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Voting Title</label>
                        <input type="text" class="form-control" name="title" id="editTitle" required>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editDescription" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editStartDate" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" name="start_date" id="editStartDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editEndDate" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" name="end_date" id="editEndDate" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editClubID" class="form-label">Select Club</label>
                        <select class="form-select" name="clubID" id="editClubID" required>
                            @foreach ($clubs as $club)
                            <option value="{{ $club->clubID }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Vote</button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Vote Results Modal -->
<div class="modal fade" id="voteResultsModal" tabindex="-1" aria-labelledby="voteResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="voteResultsModalLabel"><i class="bi bi-bar-chart-line me-2"></i> Vote Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="mb-3">Voting Title: <span id="resultVoteTitle" class="fw-bold text-primary"></span></h6>

                <div id="resultsContainer">

                </div>

                <div class="mt-4 text-end">
                    <span class="fw-bold text-success" id="winningOption"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    
    function removeSeconds(datetimeStr) {
        const [datePart, timePart] = datetimeStr.split(' ');
        const [hours, minutes] = timePart.split(':');
        return `${datePart}T${hours}:${minutes}`;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const modalElement = document.getElementById('editVoteModal');
        const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);

        // Modal açıkken tekrar tıklama yapılırsa sorun çıkmasın
        document.querySelectorAll('.btn-edit-vote').forEach(button => {
            button.addEventListener('click', function() {
                const vote = JSON.parse(this.dataset.vote);

                document.getElementById('editVoteForm').action = `/admin/votings/${vote.votingID}`;
                document.getElementById('editVotingID').value = vote.votingID;
                document.getElementById('editTitle').value = vote.title;
                document.getElementById('editDescription').value = vote.description;
                document.getElementById('editStartDate').value = removeSeconds(vote.start_date);
                document.getElementById('editEndDate').value = removeSeconds(vote.end_date);
                document.getElementById('editClubID').value = vote.clubID;

                modalInstance.show();
            });
        });

        modalElement.addEventListener('hidden.bs.modal', function() {
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
        });


        document.querySelectorAll('.btn-show-results').forEach(button => {
            button.addEventListener('click', function() {
                const votingID = this.dataset.id;

                fetch(`/admin/votings/${votingID}/results`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('resultVoteTitle').textContent = `Total Votes: ${data.total}`;
                        const container = document.getElementById('resultsContainer');
                        container.innerHTML = '';

                        data.results.forEach(result => {
                            const bar = document.createElement('div');
                            bar.classList.add('mb-2');
                            bar.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <span>${result.option}</span>
                            <span>${result.votes} vote(s) - ${result.percent}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: ${result.percent}%; min-width: 5%;">
                                ${result.percent}%
                            </div>
                        </div>
                    `;
                            container.appendChild(bar);
                        });

                        const resultsModal = new bootstrap.Modal(document.getElementById('voteResultsModal'));
                        resultsModal.show();
                    })
                    .catch(err => {
                        console.error('Failed to fetch vote results:', err);
                    });
            });
        });

    });

    document.querySelectorAll('.btn-delete-vote').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const voteID = form.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "This voting session will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Formu gönder
                }
            });
        });
    });
</script>

@endpush


<!--end page main-->
@endsection