<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Categories List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header bg-white pt-3">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-md-3">
                            <a href={{ route('category.add') }}>
                                <button class="btn btn-primary btn-lg btn-block">Add Category</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body mt-3">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name / Slug</th>
                                <th class="text-center">Post Type</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $value)
                                <tr class="text-center">
                                    <td>{{ ++$loop->index }}.</td>
                                    <td class="text-left">
                                        <img src={{ image_format($value->image ?? '') }}
                                            class="img-fluid shadow rounded-lg" alt={{ $value->slug }}
                                            style="max-width: 50px; max-height: 50px;">
                                    </td>
                                    <td class="text-left">
                                        <p class="mb-0 font-weight-bold">
                                            {{ $value->title }}
                                        </p>
                                        <p class="mb-0">
                                            {{ $value->slug }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning">
                                            {{ $value->post_type }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row align-items-center justify-content-evenly">
                                            <div class="avatar border">
                                                <img src={{ image_format($value->profile_pic ?? '') }}
                                                    class="img-fluid shadow">
                                            </div>
                                            <div class="font-weight-bold">
                                                {{ $value->created_by }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ get_status($value->status)->class }}">
                                            {{ get_status($value->status)->title }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ datetime_format($value->created_date) }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href={{ route('category.edit', $value->slug) }}
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2">
                                                        <path
                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href={{ route('category.delete', $value->slug) }}
                                                    class="bs-tooltip text-danger" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Delete"
                                                    title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

</x-app-layout>
