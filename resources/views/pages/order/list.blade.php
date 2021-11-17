<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Orders List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                                <th>User</th>
                                <th>Driver</th>
                                <th>PickUp</th>
                                <th>Drop</th>
                                <th>Price</th>
                                <th>Kms</th>
                                <th>Created date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $value)
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
                                                <p class="h5 mb-0">{{ $value->first_name }}</p>
                                                <a href="tel://{{ $value->mobile }}">{{ $value->mobile }}</a>
                                                <p class="bg-dark py-2 px-3 text-white rounded-lg mt-1 text-center">
                                                    @if ($value->status === 0)
                                                        Just Booked
                                                    @elseif ($value->status === 1)Complete
                                                    @elseif ($value->status === 2)OnGoing
                                                    @elseif ($value->status === 3)Cancel
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (is($value->driverOrder ?? '', 'json'))
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12">
                                                    <img class="rounded-circle shadow"
                                                        alt="{{ $value->driverOrder->username }}"
                                                        src="{{ $value->driverOrder->profile_pic }}"
                                                        style="width:63px; height:63px; border: 2px solid #d3d3d3">
                                                </div>
                                                <div class="col-lg-8 col-md-12">
                                                    <p class="h5 mb-0">
                                                        {{ $value->driverOrder->first_name }}
                                                    </p>
                                                    <a href="tel://{{ $value->driverOrder->mobile }}">
                                                        {{ $value->driverOrder->mobile }}
                                                    </a>
                                                    <p class="bg-dark py-2 px-3 text-white rounded-lg mt-1 text-center">
                                                        @if ($value->driverOrder->status === 0)Complete
                                                        @elseif ($value->driverOrder->status === 1)Accept
                                                        @elseif ($value->driverOrder->status === 2)Accept
                                                        @elseif ($value->driverOrder->status === 3)Reject
                                                        @elseif ($value->driverOrder->status === 4)PickUp Rider
                                                        @elseif ($value->driverOrder->status === 5)OnGoing Drive
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @else <p class="text-center">Driver not found for this ride</p>
                                        @endif
                                    </td>
                                    <td style="width: 10%">
                                        <p class="text-justify">{{ $value->pickup_text }}</p>
                                    </td>
                                    <td style="width:10%">
                                        <p class="text-justify">{{ $value->drop_text }}</p>
                                    </td>
                                    <td>
                                        <span class="h4" style="font-family: sans-serif;">
                                            {{ price_format($value->price ?? 0) }}
                                        </span>
                                    </td>
                                    <td><span class="h4">{{ $value->kms }} kms</span></td>
                                    <td>{{ datetime_format($value->created_date) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
