<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Drivers List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="advanceTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Total Completed Rides</th>
                                <th>Total Rejected Rides</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Wallet</th>
                                <th>Created date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $value)
                                <tr>
                                    <td>{{ ++$loop->index }}.</td>
                                    <td class="text-center">
                                        <span>
                                            <img src={{ image_format($value->profile_pic ?? '') }}
                                                class="rounded-circle shadow"
                                                style="width:63px; height:63px; border: 2px solid #d3d3d3"
                                                alt={{ $value->username }}>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="pr-3 py-0 d-block position-relative">
                                            <p class="font-weight-bold mb-0 text-dark">
                                                {{ $value->first_name }} {{ $value->last_name }}
                                            </p>
                                        </span>
                                        <p class="mb-0 mt-2">
                                            <a href="tel://{{ $value->mobile }}" class="text-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-phone-call text-success">
                                                    <path
                                                        d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                                </svg>
                                                {{ $value->mobile }}
                                            </a>
                                        </p>
                                    </td>
                                    <td><a href="mailto://{{ $value->email }}">{{ $value->email }}</a></td>
                                    <td class="text-center">
                                        @if (isset($value->total_complete) and $value->total_complete != 0)
                                            <span class="text-success h2">{{ $value->total_complete }}+</span>
                                        @else
                                            <span class="h6">No Rides complete yet</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($value->total_reject) and $value->total_reject != 0)
                                            <span class="text-success h2">{{ $value->total_reject }}+</span>
                                        @else
                                            <span class="h6">No Rides rejected yet</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill bg-{{ get_status($value->status)->class }}">
                                            {{ get_status($value->status)->title }}
                                        </span>
                                    </td>
                                    <td class="text-center" style="font-family: sans-serif;">
                                        {{ price_format($value->amount ?? 0) }}
                                    </td>
                                    <td>{{ $value->created_date }}</td>
                                    <td class="text-center">
                                        <ul class="d-inline-flex list-unstyled">
                                            @if (intval($value->payble_amount) > 0)
                                                <li class="d-block">
                                                    <a href="checkout/driver/{{ $value->username }}"
                                                        class="bs-tooltip" data-toggle="tooltip"
                                                        data-placement="top" title="Checkout"
                                                        data-original-title="Call">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-dollar-sign">
                                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="d-block d-md-none">
                                                <a href="tel://{{ $value->mobile }}" class="bs-tooltip"
                                                    data-toggle="tooltip" data-placement="top" title="Call"
                                                    data-original-title="Call">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-phone-call text-success">
                                                        <path
                                                            d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href={{ route('drivers.show', $value->username) }}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-eye text-secondary">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="mailto://{{ $value->email }}" class="bs-tooltip"
                                                    data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="{{ $value->email }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-mail">
                                                        <path
                                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                                        <polyline points="22,6 12,13 2,6" />
                                                    </svg>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('drivers.delete', $value->username) }}"
                                                    title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash text-danger">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
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
