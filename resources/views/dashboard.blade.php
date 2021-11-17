<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <h3>Dashboard</h3>
            <p class="text-subtitle text-muted">{{ env('APP_NAME') }} dashboard to track {{ env('APP_NAME') }}'s
                trendings.
            </p>
        </div>
        <section class="section">
            <div class="row mb-2">
                <div class="col-md-6 col-lg-3 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #6c5ce750;background: linear-gradient(to bottom, #6c5ce7, #a29bfe);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">Total Drivers</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p>{{ $totals->drivers ?? 0 }}</p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="drivers" class="drawChart"
                                        data-keys='{{ json_encode($totals->new_drivers->labels) }}'
                                        data-values='{{ json_encode($totals->new_drivers->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #eb3b5a50;background: linear-gradient(to bottom, #eb3b5a, #fc5c65);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">Total Vehicles</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p>{{ $totals->vehicles ?? 0 }}</p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="vehicles" class="drawChart"
                                        data-keys='{{ json_encode($totals->new_vehicles->labels) }}'
                                        data-values='{{ json_encode($totals->new_vehicles->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #4b658450;background: linear-gradient(to bottom, #4b6584, #778ca3);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">Total Orders</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p>{{ $totals->orders ?? 0 }}</p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="orders" class="drawChart"
                                        data-keys='{{ json_encode($totals->new_orders->labels) }}'
                                        data-values='{{ json_encode($totals->new_orders->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #20bf6b50;background: linear-gradient(to bottom, #20bf6b, #26de81);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">Total Users</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p>{{ $totals->users ?? 0 }}</p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas sclass="drawChart"
                                        data-keys='{{ json_encode($totals->new_users->labels) }}'
                                        data-values='{{ json_encode($totals->new_users->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #bf8a2050;background: linear-gradient(to bottom, #ffa538, #deaa26);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">Total User Cancelled</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p>{{ $totals->user_canceled_rides ?? 0 }} </p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas sclass="drawChart"
                                        data-keys='{{ json_encode($totals->new_users->labels) }}'
                                        data-values='{{ json_encode($totals->new_users->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #bf8a2050;background: linear-gradient(to bottom, #ffa538, #deaa26);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">REVENUE</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p style="font-family: Lato, sans-serif">
                                            {{ price_format($totals->revenue ?? 0) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas sclass="drawChart"
                                        data-keys='{{ json_encode($totals->new_users->labels) }}'
                                        data-values='{{ json_encode($totals->new_users->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col">
                    <div class="card card-statistic"
                        style="box-shadow: 1px 2px 5px #bf8a2050;background: linear-gradient(to bottom, #ffa538, #deaa26);">
                        <div class="card-body p-0 pb-3">
                            <div class="d-flex flex-column">
                                <div class="px-3 py-3 d-flex justify-content-between">
                                    <h3 class="card-title">Pending Payout Drivers</h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p>{{ $totals->pending_payouts ?? 0 }}</p>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="userss" class="drawChart"
                                        data-keys='{{ json_encode($totals->new_users->labels) }}'
                                        data-values='{{ json_encode($totals->new_users->data) }}'
                                        style="height:100px !important"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12 col-md-12">
                    <div class="page-title">
                        <h3>Drivers Tracking</h3>
                        <p class="text-subtitle text-muted">You can track all active drivers here.</p>
                    </div>
                    <div id="drivers-map"
                        style="height: 400px; width:100%; border-radius: 24px; box-shadow: #438efd40 0px 8px 20px 0px;">
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col col-md-12 col-lg-6">
                    <div class="page-title">
                        <h3>Latest Driver</h3>
                        <p class="text-subtitle text-muted">You can see all new drivers here.</p>
                    </div>
                    <div style="width:100%; border-radius: 24px; box-shadow: #438efd40 0px 8px 20px 0px;"
                        class="table-responsive">
                        <table class="table table-striped" style="border-radius: 24px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is($totals->recent_drivers ?? '', 'array'))
                                    @foreach ($totals->recent_drivers as $key => $value)
                                        <tr>
                                            <td>{{ ++$loop->index }}.</td>
                                            <td class="text-left">
                                                <span class="pr-3 py-0 d-block position-relative">
                                                    <p class="font-weight-bold mb-0 text-dark">
                                                        {{ $value->first_name ?? '' }}
                                                        {{ $value->last_name ?? '' }}
                                                    </p>
                                                </span>
                                                <p class="mb-0 mt-2">
                                                    <a href="tel://{{ $value->mobile ?? '' }}"
                                                        class="text-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-phone-call text-success">
                                                            <path
                                                                d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                                        </svg>
                                                        {{ $value->mobile ?? '' }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="text-left">{{ $value->email ?? '' }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge rounded-pill bg-{{ get_status($value->status)->class ?? '' }}">
                                                    {{ get_status($value->status)->title ?? '' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <ul class="d-inline-flex list-unstyled">
                                                    @if ($value->status === 0)
                                                        <li class="d-block">
                                                            <a href="javascript:void(0)"
                                                                class="bs-tooltip approve-driver"
                                                                data-user_id="{{ $value->id ?? '' }}"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Approve" data-original-title="Call">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-user-check">
                                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                                                                    </path>
                                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href={{ route('drivers.show', $value->username ?? '') }}>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-eye text-secondary">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                </path>
                                                                <circle cx="12" cy="12" r="3"></circle>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="mailto://{{ $value->email ?? '' }}"
                                                            class="bs-tooltip" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="{{ $value->email ?? '' }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-mail">
                                                                <path
                                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                                                <polyline points="22,6 12,13 2,6" />
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

                <div class="col col-md-12 col-lg-6">
                    <div class="page-title">
                        <h3>Recent Orders</h3>
                        <p class="text-subtitle text-muted">You can see all recent orders here.</p>
                    </div>
                    <div style="border-radius: 24px; box-shadow: #438efd40 0px 8px 20px 0px;" class="table-responsive">
                        <table class="table table-striped" style="border-radius: 24px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">User</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Kms</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is($totals->recent_orders ?? '', 'array'))
                                    @foreach ($totals->recent_orders as $key => $value)
                                        <tr>
                                            <td>{{ ++$loop->index }}.</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12">
                                                        <img src={{ image_format($value->profile_pic ?? '') }}
                                                            class="rounded-circle shadow"
                                                            style="width:63px; height:63px; border: 2px solid #d3d3d3">
                                                    </div>
                                                    <div class="col-lg-8 col-md-12">
                                                        @if (is($value->mobile ?? ''))
                                                            <p class="h5 mb-0">
                                                                {{ $value->first_name ?? '' }}
                                                            </p>
                                                            <a href="tel://{{ $value->mobile ?? '' }}">
                                                                {{ $value->mobile ?? '' }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="bg-dark py-2 px-3 text-white rounded-lg mt-1 text-center">
                                                    @if ($value->status === 0) Just
                                                        Booked
                                                    @elseif($value->status === 1)Complete
                                                    @elseif($value->status === 2) OnGoing
                                                    @elseif($value->status === 3) Cancel
                                                    @endif
                                                </p>
                                            </td>
                                            <td>
                                                <span class="h4" style="font-family: sans-serif;">
                                                    {{ price_format($value->price ?? 0) }}
                                                </span>
                                            </td>
                                            <td><span class="h4">{{ $value->kms ?? 0 }} kms</span></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mb-4 mt-2">
                <div class="col col-md-12">
                    <div class="page-title">
                        <h3>Recent Transactions</h3>
                        <p class="text-subtitle text-muted">You can see all recent transactions here.</p>
                    </div>
                    <div style="width:100%; border-radius: 24px; box-shadow: #438efd40 0px 8px 20px 0px;"
                        class="table-responsive">
                        <table class="table table-striped" style="border-radius: 24px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction ID</th>
                                    <th>User</th>
                                    <th>Payment Type</th>
                                    <th>Transaction Type</th>
                                    <th>Amount</th>
                                    <th>Created date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is($totals->recent_transactions ?? '', 'array'))
                                    @foreach ($totals->recent_transactions as $key => $value)
                                        <tr>
                                            <td>{{ ++$loop->index }}.</td>
                                            <td>{{ $value->id ?? 0 }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12">
                                                        <img src={{ image_format($value->profile_pic ?? '') }}
                                                            class="rounded-circle shadow"
                                                            style="width:63px; height:63px; border: 2px solid #d3d3d3">
                                                    </div>
                                                    <div class="col-lg-8 col-md-12">
                                                        <p class="h5 mb-0">{{ $value->first_name ?? '' }}</p>
                                                        <a href="tel://{{ $value->mobile ?? '' }}">
                                                            {{ $value->mobile ?? '' }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 10%">
                                                <p class="text-justify">{{ $value->payment_type ?? '' }}</p>
                                            </td>
                                            <td>
                                                <p class="bg-dark py-2 px-3 text-white rounded-lg mt-1 text-center">
                                                    @if ($value->transaction_type === 'credit') Credit
                                                    @elseif($value->transaction_type === 'debit') Debit
                                                    @endif
                                                </p>
                                            </td>
                                            <td>
                                                <span class="h4" style="font-family: sans-serif;">
                                                    {{ price_format($value->amount ?? 0) }}
                                                </span>
                                            </td>
                                            <td>{{ datetime_format($value->created_date) ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>
    @php
        $onlineDriversLocations = [];
        foreach ($totals->online_drivers as $key => $driver) {
            array_push($onlineDriversLocations, [$driver->title, $driver->lat, $driver->lng, $key + 1]);
        }
    @endphp
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&language=en">
    </script>
    <script type="text/javascript">
        function initMap() {
            var locations = @json($onlineDriversLocations);

            if (locations?.length > 0) {
                var map = new google.maps.Map(document.getElementById('drivers-map'), {
                    zoom: 10,
                    zoomControl: false,
                    scaleControl: true,
                    rotateControl: false,
                    mapTypeControl: false,
                    streetViewControl: true,
                    fullscreenControl: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: new google.maps.LatLng(locations[0][1], locations[0][2]),
                });

                var infowindow = new google.maps.InfoWindow();
                var marker, i;

                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new
                        google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent('<a href="' + locations[i][0] + '">View Details</a>');
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            } else {
                var map = document.getElementById('drivers-map');
                var h1 = document.createElement('h1');
                h1.style.color = '#6c757d';
                h1.style.textAlign = 'center';
                h1.style.padding = '10%';
                h1.appendChild(document.createTextNode(
                    'Seems like no driver is online now, when the driver comes online, you can track here'));
                map.appendChild(h1)
            }
        }
    </script>
</x-app-layout>
