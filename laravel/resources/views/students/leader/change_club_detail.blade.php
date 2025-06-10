@extends('layouts.app')
@section('title', 'Change Club Detail')
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Club Details</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title mb-4"><i class="bi bi-pencil-square me-2"></i>Edit Club Details</h5>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Club Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter club name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>



                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control" placeholder="Brief description about the club..."></textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Club Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save2 me-2"></i>Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</main>
@endsection
