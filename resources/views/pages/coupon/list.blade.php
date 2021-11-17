<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Coupons List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Coupons</li>
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
                            <a href={{ route('coupon.add') }}>
                                <button class="btn btn-primary btn-lg btn-block">Add Coupons</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body mt-3">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Promo Code</th>
                                <th class="text-center">Coupon Type</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Use Count</th>
                                <th class="text-center">Start From</th>
                                <th class="text-center">End To</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $value)
                                <tr class="text-center">
                                    <td>#{{ ++$loop->index }}.</td>
                                    <td class="text-center">
                                        <p class="mb-0 font-weight-bold">
                                            {{ $value->code }}
                                        </p>
                                    </td>
                                    <td class="text-left">
                                        {{ $value->type }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill @if ((bool) $value->is_active === true) bg-success @else bg-danger @endif">
                                            @if ((bool) $value->is_active == true) Active @else Deactive @endif
                                        </span>
                                    </td>
                                    <td class="text-left">
                                        {{ $value->use_count }}
                                    </td>
                                    <td class="text-left">
                                        {{ datetime_format($value->start_from) }}
                                    </td>
                                    <td class="text-left">
                                        {{ datetime_format($value->end_to) }}
                                    </td>
                                    <td>
                                        @if ($value->is_active === 1)
                                            <a href={{ route('coupon.delete', $value->id) }}
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
                                        @endif

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
