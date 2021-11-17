<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('dashboard') }}>Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href={{ route('users') }}>Riders</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $user->username }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-8">
                        <div class="card" style="border-radius: 48px;">
                            <div class="card-body p-5">
                                <div class="row">
                                    <div class="col-8">
                                        <h3 class="display-5 font-weight-bold">Rider Orders</h3>
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-12">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Status</th>
                                                    <th>Price</th>
                                                    <th>Kms</th>
                                                    <th>Created date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (is($orders ?? '', 'json'))
                                                    @foreach ($orders as $value)
                                                        <tr>
                                                            <td>{{ ++$loop->index }}.</td>
                                                            <td>
                                                                <p
                                                                    class="bg-dark py-2 px-3 text-white rounded-lg mt-1 text-center">
                                                                    @if ($value->status === 0) Just Booked
                                                                    @elseif ($value->status === 1) Complete
                                                                    @elseif ($value->status === 2) OnGoing
                                                                    @elseif ($value->status === 3) Cancel
                                                                    @endif
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <span class="h4"
                                                                    style="font-family: sans-serif;">
                                                                    {{ price_format($value->price) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="h4">
                                                                    {{ $value->kms }} kms
                                                                </span>
                                                            </td>
                                                            <td>{{ datetime_format($value->created_date) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="card" style="border-radius: 48px;">
                            <div class="card-body p-5 text-center">
                                <div class="position-relative text-center">
                                    <img src="{{ image_format($user->profile_pic) }}"
                                        style="border-radius: 62px; width: 200px; height: 200px; border: 5px solid var(--bs-secondary)">
                                </div>
                                <h3 class="display-5 font-weight-bold mt-5 text-center">
                                    {{ $user->first_name . ' ' . $user->last_name }}
                                </h3>
                                <div class="row">
                                    <div class="col-7">
                                        <a href="tel://{{ $user->mobile }}" class="text-success h3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-phone-call text-success"
                                                style="transform: scale(1.5);">
                                                <path
                                                    d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                            </svg>
                                            <span class="text-secondary">{{ $user->mobile }}</span>
                                        </a>
                                    </div>

                                    @if (is($user->email))
                                        <div class="col">
                                            <a href="mailto://{{ $user->email }}" title="{{ $user->email }}">
                                                <span class="text-secondary">{{ $user->email }}</span>
                                            </a>
                                        </div>
                                    @endif

                                    <div class="col">
                                        <h3>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-dollar-sign text-primary"
                                                style="transform: scale(1.5);">
                                                <line x1="12" y1="1" x2="12" y2="23" />
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                            </svg>
                                            {{ price_format($user->amount) }}
                                        </h3>
                                    </div>
                                </div>
                                <p class="lead mt-3">Joined on
                                    <span class="text-secondary">{{ datetime_format($user->created_date) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
