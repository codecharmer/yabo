<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ratings List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ratings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reviewer Name</th>
                                <th>Review </th>
                                <th>Rate </th>
                                <th>Review For</th>
                                <th>Created date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ratings as $value)
                                <tr class="text-center">
                                    <td>{{ ++$loop->index }}.</td>

                                    <td class="text-left">
                                        <p class="mb-0 font-weight-bold">
                                            {{ $value->driver_first_name }}&nbsp;{{ $value->driver_last_name }}
                                        </p>
                                        <p class="mb-0">{{ $value->driver_mobile }}</p>
                                    </td>
                                    <td class="text-left">
                                        <p class="mb-0 font-weight-bold">{{ $value->review }}</p>
                                    </td>
                                    <td class="text-left">
                                        <p class="mb-0 font-weight-bold">
                                            <?php for ($i = 0; $i < $value->rate; $i++) : ?>
                                            <i data-feather="star" fill="#FFD700" stroke="#ffb9a794" width="20"
                                                height="20"></i>
                                            <?php endfor; ?>
                                        </p>
                                    </td>
                                    <td class="text-left">
                                        <p class="mb-0 font-weight-bold">
                                            {{ $value->created_by_f }}&nbsp;{{ $value->created_by_l }}
                                        </p>
                                        <p class="mb-0">{{ $value->rider_mobile }}</p>
                                    </td>
                                    <td class="text-left">{{ $value->created_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</x-app-layout>
