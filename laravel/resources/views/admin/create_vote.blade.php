@extends('layouts.app')
@section('title', 'Create Vote')

@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Votes</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Voting</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-3 animate__animated animate__fadeIn">
        <div class="card-body">
            <h4 class="mb-3"><i class="bi bi-bar-chart-steps me-2 text-primary"></i> Create a New Voting Session</h4>

            <form action="{{ route('admin.store_vote') }}" method="POST">
                @csrf
                {{-- Club Selection --}}
                <div class="mb-3">
                    <label for="club_id" class="form-label">Select Club</label>
                    <select class="form-select" id="club_id" name="clubID" required>
                        <option disabled selected value="">Choose a club</option>
                        @foreach ($clubs as $club)
                        <option value="{{ $club->clubID }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>


                {{-- Voting Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Voting Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Board Elections 2025" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the purpose or rules of the vote..."></textarea>
                </div>

                {{-- Start/End Dates --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>

                {{-- Voting Options --}}
                <div id="options-container" class="mb-3">
                    <label class="form-label">Voting Options</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="options[]" placeholder="Option 1" required>
                        <button class="btn btn-outline-secondary remove-option" type="button"><i class="bi bi-trash"></i></button>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-light border add-option">
                        <i class="bi bi-plus-circle me-1"></i> Add Option
                    </button>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send-check me-1"></i> Launch Voting
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>
<!--end page main-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Voting option ekleme-silme işlemleri
    document.querySelector('.add-option').addEventListener('click', function() {
        const container = document.getElementById('options-container');
        const optionIndex = container.querySelectorAll('.input-group').length + 1;

        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="text" class="form-control" name="options[]" placeholder="Option ${optionIndex}" required>
            <button class="btn btn-outline-secondary remove-option" type="button"><i class="bi bi-trash"></i></button>
        `;

        container.appendChild(inputGroup);
    });

    document.getElementById('options-container').addEventListener('click', function(e) {
        if (e.target.closest('.remove-option')) {
            e.target.closest('.input-group').remove();
        }
    });

    // SweetAlert mesajları
    @if($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `{!! implode('<br>', $errors->all()) !!}`,
    });
    @endif

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('
        success ') }}',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "{{ route('admin.manage_votes') }}";
    });
    @endif
</script>
@endpush
