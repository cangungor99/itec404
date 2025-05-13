@extends('layouts.app')
@section('title', 'EMU Digital Club | Club Resources')
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
                    <li class="breadcrumb-item active" aria-current="page">Club Resources</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-xl-3">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-grid"> <a href="javascript:;" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add File</a>
                    </div>
                </div>
                <div class="fm-menu">
                    <div class="list-group list-group-flush m-3">
                        <a href="javascript:;" class="list-group-item py-1"><i class='bx bx-folder me-2 text-primary'></i><span>All Files</span></a>

                        <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-file-earmark-break-fill me-2 text-info'></i><span>Documents</span></a>
                        <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-file-earmark-image-fill me-2 text-warning'></i><span>Images</span></a>
                        <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-camera-reels-fill me-2 text-primary'></i><span>Videos</span></a>
                        <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-play-btn-fill me-2 text-bronze'></i><span>Audio</span></a>
                        <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-file-earmark-zip-fill me-2 text-option'></i><span>Zip Files</span></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0 text-primary font-weight-bold">45.5 GB <span class="float-end text-secondary">50 GB</span></h5>
                    <p class="mb-0 mt-2"><span class="text-secondary">Used</span><span class="float-end text-primary"></span>
                    </p>
                    <hr>
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="fs-6 text-primary"><i class="bi bi-collection-play-fill"></i></div>
                            <div>Media Files</div>
                            <div class="ms-auto">100 GB</div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="fs-6 text-success"><i class="bi bi-images"></i></div>
                            <div>Images</div>
                            <div class="ms-auto">15 GB</div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 45%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="fs-6 text-warning"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                            <div>Documents</div>
                            <div class="ms-auto">7 GB</div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="fs-6 text-purple"><i class="bi bi-file-earmark-richtext-fill"></i></div>
                            <div>Other Files</div>
                            <div class="ms-auto">5 GB</div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 35%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="d-flex align-items-center gap-2">
                            <div class="fs-6 text-secondary"><i class="bi bi-file-post-fill"></i></div>
                            <div>Unknown Files</div>
                            <div class="ms-auto">8 GB</div>
                        </div>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"><i class="bi bi-search"></i></div>
                        <input class="form-control form-control-lg ps-5" type="text" placeholder="Search the files">
                    </div>

                    <!--end row-->
                    <h5>Folders</h5>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-4">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="font-30 text-primary"><i class='bx bxs-folder'></i>
                                        </div>
                                        <div class="user-groups ms-auto">
                                            <img src="assets/images/avatars/avatar-1.png" width="35" height="35" class="rounded-circle" alt="" />
                                            <img src="assets/images/avatars/avatar-2.png" width="35" height="35" class="rounded-circle" alt="" />
                                        </div>
                                        <div class="user-plus">+</div>
                                    </div>
                                    <h6 class="mb-0 text-primary">CLUB MEETINGS</h6>
                                    <small>15 files</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="font-30 text-primary"><i class='bx bxs-folder'></i>
                                        </div>
                                        <div class="user-groups ms-auto">
                                            <img src="assets/images/avatars/avatar-4.png" width="35" height="35" class="rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <h6 class="mb-0 text-primary">PROJECTS</h6>
                                    <small>345 files</small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end row-->

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Recent Files</h5>
                        </div>
                        <div class="ms-auto"><a href="javascript:;" class="btn btn-sm btn-outline-secondary">View all</a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name <i class='bx bx-up-arrow-alt ms-2'></i>
                                    </th>
                                    <th>Uploaded By</th>
                                    <th>Last Modified</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div><i class='bx bxs-file-pdf me-2 font-24 text-danger'></i>
                                            </div>
                                            <div class="font-weight-bold text-danger">Competitor Analysis Template</div>
                                        </div>
                                    </td>
                                    <td>Only you</td>
                                    <td>Sep 3, 2019</td>
                                    <td><i class='bx bx-dots-horizontal-rounded font-24'></i>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--end row-->
</main>
<!--end page main-->
@endsection
