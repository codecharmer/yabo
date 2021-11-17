<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Vehicles List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Model / Brand / Color / Toll</th>
                                <th>Seats</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Manufacture Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $value)
                                <tr class="text-center">
                                    <td>{{ ++$loop->index }}.</td>
                                    <td class="text-left">
                                        <div class="mr-2 mx-auto rounded-lg">
                                            <img src={{ image_format($value->image ?? '') }}
                                                class="img-fluid shadow rounded-lg" style="width: 80px; height: 80px;">
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <p class="mb-1 font-weight-bold">{{ $value->model }}</p>
                                        <p class="mb-1 badge bg-dark">{{ $value->brand }}</p>
                                        <p class="mb-1 badge bg-primary">{{ $value->color }}</p><br>
                                        <p class="mb-0 badge bg-light">{{ $value->vehicle_no }}</p>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning">{{ $value->seats }}</span>
                                    </td>

                                    <td>
                                        <div class="font-weight-bold badge rounded-pill bg-secondary">
                                            {{ $value->category_name }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge rounded-pill bg-{{ get_status($value->status)->class }}">
                                            {{ get_status($value->status)->title }}
                                        </span>
                                    </td>
                                    <td>{{ $value->manufacture_year }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
