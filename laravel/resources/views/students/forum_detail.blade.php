@extends('layouts.app')
@section('title', 'Forum Detail')
@section('content')

<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="forum.php"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Forum Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Forum Title -->
    <div class="card shadow-sm mb-4 fade-in">
        <div class="card-body">
            <h3 class="fw-bold"><i class="bi bi-code-slash text-primary me-2"></i> Software Development Talks</h3>
            <p class="text-muted mb-0">A space to discuss algorithms, programming languages, and tech career paths.</p>
        </div>
    </div>

    <!-- Forum Posts -->
    <div class="card mb-3 shadow-sm fade-in">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold mb-1"><i class="bi bi-person-circle me-1"></i>John Doe</h6>
                <small class="text-muted"><i class="bi bi-clock"></i> May 6, 2025 - 14:32</small>
            </div>
            <p class="mt-2 mb-1">I think JavaScript is still dominating frontend development, but TypeScript is the real hero here!</p>
            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-reply"></i> Reply</button>
        </div>

        <!-- Nested Reply -->
        <div class="ms-4 mt-3 border-start ps-3">
            <div class="card mb-2">
                <div class="card-body py-2">
                    <small class="fw-bold"><i class="bi bi-person-circle me-1"></i>Jane Smith</small>
                    <p class="mb-0">Totally agree! Type safety has saved me so many times.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Another Post -->
    <div class="card mb-3 shadow-sm fade-in">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold mb-1"><i class="bi bi-person-circle me-1"></i>Michael Scott</h6>
                <small class="text-muted"><i class="bi bi-clock"></i> May 7, 2025 - 09:10</small>
            </div>
            <p class="mt-2 mb-1">Don’t forget about Python! It’s still king in the AI world.</p>
            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-reply"></i> Reply</button>
        </div>
    </div>

    <!-- Comment Form -->
    <div class="card shadow-sm mt-4 fade-in">
        <div class="card-body">
            <h5 class="fw-bold"><i class="bi bi-pencil-square me-2"></i>Add a Comment</h5>
            <form>
                <div class="mb-3">
                    <textarea class="form-control" rows="4" placeholder="Write your message..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send me-1"></i> Post</button>
            </form>
        </div>
    </div>
</main>
@endsection
