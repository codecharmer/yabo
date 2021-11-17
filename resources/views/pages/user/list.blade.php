<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Users List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                <th>Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Amount</th>
                                <th>Created date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is($users, 'json'))
                                @foreach ($users as $value)
                                    <tr>
                                        <td>{{ ++$loop->index }}.</td>
                                        <td>
                                            <div class="d-flex" style=" align-items: center;">
                                                <img src="{{ image_format($value->profile_pic ?? '') }}"
                                                    style="width: 50px; height: 50px; margin-right:5%"
                                                    class="rounded-circle">
                                                <div>
                                                    {{ $value->first_name . ' ' . $value->last_name }}
                                                    <br />
                                                    <a href="tel://{{ $value->mobile }}"
                                                        style="font-family: sans-serif;">
                                                        {{ $value->mobile }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge rounded-pill bg-{{ get_status($value->status)->class }}">
                                                {{ get_status($value->status)->title }}
                                            </span>
                                        </td>
                                        <td class="text-center" style="font-family: sans-serif;">
                                            {{ price_format($value->amount ?? 0) }}
                                        </td>
                                        <td>{{ datetime_format($value->created_date) }}</td>
                                        <td class="text-center">
                                            <ul class="d-inline-flex list-unstyled">
                                                <li>
                                                    <a href="{{ route('users.show', $value->username) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-eye text-secondary">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                            <circle cx="12" cy="12" r="3" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="d-bloc">
                                                    <a href="tel://{{ $value->mobile }}" class="bs-tooltip"
                                                        data-toggle="tooltip" data-placement="top" title="Call"
                                                        data-original-title="Call">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-phone-call">
                                                            <path
                                                                d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="mailto://{{ $value->email }}" class="bs-tooltip"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="{{ $value->email }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-mail">
                                                            <path
                                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                                            <polyline points="22,6 12,13 2,6" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href={{ route('users.delete', $value->username) }}
                                                        class="bs-tooltip" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-trash text-danger">
                                                            <polyline points="3 6 5 6 21 6" />
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
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
