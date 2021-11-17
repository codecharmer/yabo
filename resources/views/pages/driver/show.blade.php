<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href={{ route('drivers') }}>Driver</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $driver->username }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section mt-5">
            <div class="card" style="border-radius: 48px;">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="display-1 font-weight-bold">
                                {{ $driver->first_name . ' ' . $driver->last_name }}
                            </h3>
                            <div class="d-md-none d-block p-1"></div>
                            <div class="row">
                                <div class="col-auto">
                                    <h3>
                                        <a href="tel://{{ $driver->mobile }}" class="text-success"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-phone-call text-success"
                                                style="transform: scale(1.5);">
                                                <path
                                                    d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                </path>
                                            </svg>
                                            <span class="text-secondary">{{ $driver->mobile }}</span>
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <h3 class="ml-md-5">
                                        <a href="mailto://{{ $driver->email }}" title="{{ $driver->email }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-mail" style="transform: scale(1.5);">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                            <span class="text-secondary">{{ $driver->email }}</span>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <p class="lead mt-3">Joined on
                                <span class="text-secondary">{{ datetime_format($driver->created_date) }}</span>
                            </p>
                        </div>
                        <div class="col-md-4 text-center text-md-right">
                            <div class="d-md-none d-block p-3"></div>
                            @if (is($driver->profile_pic))
                                <div class="position-relative">
                                    <img src="{{ image_format($driver->profile_pic ?? '') }}"
                                        style="border-radius: 62px; width: 200px; height: 200px; border: 5px solid var(--bs-secondary)">
                                    @if (is($driver->is_active) and $driver->is_active === 1)
                                        <div
                                            style="height: 30px; width: 30px;background:var(--bs-success);border-radius:48px; position:absolute; right: 10px; bottom: 0px; border: 5px solid var(--bs-secondary)">
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="p-4"></div>
                            <div class="row">
                                <div class="col-md-2 text-center text-md-left">
                                    @if (is($driver->vehicle, 'json') and is($driver->vehicle->image))
                                        <img src="{{ image_format($driver->vehicle->image ?? '') }}"
                                            style="border-radius: 62px; width: 200px; height: 200px; border: 5px solid var(--bs-secondary)">
                                    @else
                                        Image not Found
                                    @endif
                                </div>
                                <div class="col-md-3 ">
                                    @if (is($driver->vehicle, 'json'))
                                        <div class="p-4 p-md-0"></div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <h3>{{ $driver->vehicle->model }}</h3>
                                                <p>{{ $driver->vehicle->brand }}</p>
                                                <h4>{{ $driver->vehicle->manufacture_year }}</h4>
                                            </div>
                                            <div class="col-auto">
                                                <h3 class="bg-warning px-3 py-2 rounded-lg text-white">
                                                    {{ $driver->vehicle->seats }} Seater
                                                </h3>
                                            </div>
                                        </div>
                                        <h2 class="bg-light px-3 py-2 rounded-lg text-white">
                                            {{ $driver->vehicle->vehicle_no }}
                                        </h2>
                                        <div class="bg-primary px-3 py-2 rounded-lg text-white">
                                            <h4 class="mb-0 text-white text-center">
                                                {{ $driver->vehicle->title }}
                                            </h4>
                                        </div>
                                    @else
                                        <h2 class="text-center">Vehicle details not provided yet.</h2>
                                    @endif
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="p-4 p-md-0"></div>
                                    @if (is($driver->detail, 'json'))
                                        <h3>Payment Details</h3>
                                        <div class="p-3"></div>
                                        <div class="row">
                                            <div class="col-4">
                                                <p>Account Number : </p>
                                                <p>Bank Name : </p>
                                                <p>Branch Name : </p>
                                                <p>IFSC : </p>
                                                <p>MICR : </p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="font-weight-bold text-secondary">
                                                    {{ $driver->detail->bank_account_no }}
                                                </p>
                                                <p class="font-weight-bold text-secondary">
                                                    {{ $driver->detail->bank_name }}
                                                </p>
                                                <p class="font-weight-bold text-secondary">
                                                    {{ $driver->detail->branch_name }}
                                                </p>
                                                <p class="font-weight-bold text-secondary">
                                                    {{ $driver->detail->ifsc }}
                                                </p>
                                                <p class="font-weight-bold text-secondary">
                                                    {{ $driver->detail->micr }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <h2 class="text-center">Bank details not <br> provided yet.</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="p-4"></div>
                            <div class="row">
                                @if (is($driver->detail, 'json'))
                                    <div class="col-md-4">
                                        <h3>Personal Details</h3>
                                        <div class="p-3"></div>
                                        <div class="row">
                                            <div class="col-md-5 mb-3">
                                                <h5>Aadhar Card</h5>
                                                @if (is($driver->detail->aadhar))
                                                    <a href="{{ $driver->detail->aadhar }}">
                                                        <img src="{{ image_format($driver->detail->aadhar ?? '') }}"
                                                            class="w-100">
                                                    </a>
                                                @else
                                                    Aadhar Card Image not Found
                                                @endif
                                            </div>

                                            <div class="col-md-5 mb-3 offset-md-1">
                                                <h5>Pan Card</h5>
                                                @if (is($driver->detail->pan))
                                                    <a href="{{ $driver->detail->pan }}">
                                                        <img src="{{ image_format($driver->detail->pan ?? '') }}"
                                                            class="w-100">
                                                    </a>
                                                @else
                                                    Pan Card Image not Found
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="p-4 p-md-0"></div>
                                        <h3>Car Details</h3>
                                        <div class="p-3"></div>
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <h5>RC</h5>
                                                @if (is($driver->detail->registration_certificate))
                                                    <a href="{{ $driver->detail->registration_certificate }}">
                                                        <img src="{{ image_format($driver->detail->registration_certificate) }}"
                                                            class="w-100">
                                                    </a>
                                                @else
                                                    RC Image not Found
                                                @endif
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                @if (is($driver->detail->driving_licence))
                                                    <h5>Driving Licence</h5>
                                                    <a href="{{ $driver->detail->driving_licence }}">
                                                        <img src="{{ image_format($driver->detail->driving_licence ?? '') }}"
                                                            class="w-100">
                                                    </a>
                                                @else
                                                    Driving Licence Image not found
                                                @endif
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                @if (is($driver->detail->pollution_certificate ?? ''))
                                                    <h5>Pollution Certificate</h5>
                                                    <a href="{{ $driver->detail->pollution_certificate }}">
                                                        <img src="{{ image_format($driver->detail->pollution_certificate ?? '') }}"
                                                            class="w-100">
                                                    </a>
                                                @else
                                                    Pollution Certificate Image not found
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <h2 class="text-center">Personal Details & car details not provided yet</h2>
                                @endif
                                <div class="col-12">
                                    <form action={{ route('drivers.show.post', $driver->username) }} method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <legend>Update Status</legend>
                                                <div class="form-group">
                                                    <select name="status" id="status"
                                                        class="form-control form-control-lg">
                                                        <option value="" hidden>Select Status</option>
                                                        <option @if ($driver->status === 1) selected @endif value="1">
                                                            Approved
                                                        </option>
                                                        <option @if ($driver->status === 2) selected @endif value="2">
                                                            Pending or Draft
                                                        </option>
                                                        <option @if ($driver->status === 4) selected @endif value="4">
                                                            Block
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <legend>Change Driver online Status</legend>
                                                <div class="form-group">
                                                    <select name="is_active" id="is_active"
                                                        class="form-control form-control-lg">
                                                        <option value="0" hidden>Select Active</option>
                                                        <option @if ($driver->is_active === 0) selected	@endif value="0">
                                                            Offline
                                                        </option>
                                                        <option @if ($driver->is_active === 1) selected	@endif value="1">
                                                            Online
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <textarea name="comment" id="comment" rows="1"
                                                        class="form-control form-control-lg"
                                                        placeholder="Comment">{{ $driver->comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" name="updateStatus" value="sdfsdfs"
                                                    class="btn btn-lg btn-outline-primary">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section mt-5">
            <div class="card" style="border-radius: 48px;">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="display-5 font-weight-bold">Driver Orders</h3>
                        </div>
                        <div class="col-12">
                            <table class="table table-striped" id="minimalTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Driver</th>
                                        <th>Status</th>
                                        <th>PickUp</th>
                                        <th>Drop</th>
                                        <th>Price</th>
                                        <th>Kms</th>
                                        <th>Created date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (is($orders, 'json'))
                                        @foreach ($orders as $key => $value)
                                            <tr>
                                                <td>{{ ++$loop->index }}.</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-12">
                                                            <img src="{{ image_format($value->profile_pic ?? '') }}"
                                                                class="rounded-circle shadow"
                                                                style="width:63px; height:63px; border: 2px solid #d3d3d3">
                                                        </div>
                                                        <div class="col-lg-8 col-md-12">
                                                            <p class="h5 mb-0">{{ $value->first_name }}</p>
                                                            <a
                                                                href="tel://{{ $value->mobile }}">{{ $value->mobile }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p
                                                        class="bg-dark py-2 px-3 text-white rounded-lg mt-1 text-center">
                                                        @if ($value->status === 0)Just
                                                            Booked
                                                        @elseif ($value->status === 1)Complete
                                                        @elseif ($value->status === 2)OnGoing
                                                        @elseif ($value->status === 3)Cancel @endif
                                                    </p>
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
                                                <td>
                                                    <span class="h4">{{ $value->kms }} kms</span>
                                                </td>
                                                <td>
                                                    {{ datetime_format($value->created_date) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
