@extends('layouts.app')
@section('title', 'Student Forums')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Forums</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <!-- Forum List Section -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createForumModal">
        <i class="bi bi-plus-circle me-1"></i> Create New Forum
    </button>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold"><i class="bi bi-chat-dots me-2"></i>Forum Discussions</h4>
            <input type="text" class="form-control w-25" placeholder="Search forums..." disabled>
        </div>

        <div class="row">
            <!-- Forum Card 1 -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-start border-4 border-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-code-slash text-primary me-2"></i> Software Development Talks</h5>
                        <p class="card-text text-muted">A space to discuss algorithms, programming languages, and tech career paths.</p>
                        <div class="d-flex justify-content-between mt-3">
                            <small class="text-secondary"><i class="bi bi-calendar-event"></i> May 6, 2025</small>
                            <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forum Card 2 -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-start border-4 border-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-leaf text-success me-2"></i> Sustainability & Environment</h5>
                        <p class="card-text text-muted">Share eco-friendly ideas and green initiatives around the campus community.</p>
                        <div class="d-flex justify-content-between mt-3">
                            <small class="text-secondary"><i class="bi bi-calendar-event"></i> May 2, 2025</small>
                            <a href="#" class="btn btn-sm btn-outline-success">View</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forum Card 3 -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-start border-4 border-danger">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-controller text-danger me-2"></i> Gaming & Entertainment</h5>
                        <p class="card-text text-muted">Discuss tournaments, new game releases, and club events here.</p>
                        <div class="d-flex justify-content-between mt-3">
                            <small class="text-secondary"><i class="bi bi-calendar-event"></i> April 27, 2025</small>
                            <a href="#" class="btn btn-sm btn-outline-danger">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create New Forum Modal -->
    <div class="modal fade" id="createForumModal" tabindex="-1" aria-labelledby="createForumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="#" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createForumModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Create New Forum
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="forumTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="forumTitle" name="title" placeholder="Enter forum title" required>
                    </div>
                    <div class="mb-3">
                        <label for="forumDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="forumDescription" name="description" rows="3" placeholder="Write a short description..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="clubID" class="form-label">Select Club</label>
                        <select class="form-select" id="clubID" name="clubID" required>
                            <option selected disabled value="">Choose a club</option>
                            <option value="1">Software Club</option>
                            <option value="2">Eco Club</option>
                            <option value="3">Gaming Club</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>



</main>
<!--end page main-->
@endsection
