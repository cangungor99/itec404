@extends('layouts.app')

@section('title', 'Manage Club Resources')

@section('content')

    
<main class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Club</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Resources</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-12 col-xl-3">
    <div class="card">
<div class="card-body border-bottom">
    <form action="upload_resource.php" method="POST" enctype="multipart/form-data">
        <!-- Club Dropdown Eklendi -->
        <div class="mb-3">
            <label for="club" class="form-label">Choose Club</label>
            <select class="form-control" id="club" name="club" required>
                <option value="">Select a club</option>
                <option value="club1">Club 1</option>
                <option value="club2">Club 2</option>
                <option value="club3">Club 3</option>
                <!-- Diğer kulüpleri buraya ekleyebilirsiniz -->
            </select>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">File Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Choose File</label>
            <input class="form-control" type="file" name="file" id="file" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="2"></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Upload Resource</button>
        </div>
    </form>
</div>
</div>

        
    </div>

    <div class="col-12 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="mb-0">Uploaded Resources</h5>
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3">
                            <i class="bi bi-search"></i>
                        </div>
                        <input class="form-control ps-5" type="text" placeholder="Search resources...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Created</th>
                                <th>Related</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample Document</td>
                                <td>Monthly report template</td>
                                <td><a href="#">report.docx</a></td>
                                <td>2025-05-09</td>
                                <td>IT Club</td>
                                <td>
                                    <a href="#" class="text-info"><i class="bi bi-pencil-square"></i></a>
                                    <a href="#" class="text-danger ms-2"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <!-- Additional rows dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection
