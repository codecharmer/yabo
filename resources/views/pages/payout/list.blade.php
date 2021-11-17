<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Driver Payouts List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payouts</li>
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
                            <a href={{ route('payout.add') }}>
                                <button class="btn btn-primary btn-lg btn-block">Add Payout</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th class="text-center">Amount </th>
                                <th class="text-center">Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is($payouts ?? '', 'json'))
                                @foreach ($payouts as $value)
                                    <tr class="text-center">
                                        <td>{{ ++$loop->index }}.</td>
                                        <td class="text-left">
                                            <div class="mr-2 mx-auto rounded-lg">
                                                <img src="{{ image_format($value->profile_pic) }}"
                                                    class="img-fluid shadow rounded-lg"
                                                    style="max-width: 50px; max-height: 50px;">
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <p class="mb-0 font-weight-bold">{{ $value->first_name }}</p>
                                        </td>
                                        <td>{{ price_format($value->amount) }}</td>
                                        <td class="text-center">
                                            <span class="badge text-white @if ($value->status === 'PENDING') bg-info @elseif ($value->status === 'PROCESSING') bg-primary @elseif ($value->status === 'COMPLETED')bg-success @endif">
                                                {{ $value->status }}
                                            </span>
                                        </td>
                                        <td class="text-left">{{ datetime_format($value->created_date) }}</td>
                                        <td>
                                            <a href="{{ route('payout.edit', $value->id) }}" class="bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
