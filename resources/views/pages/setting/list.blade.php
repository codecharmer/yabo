<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Setting List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Setting Name</th>
                                <th>Setting Value</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $item)
                                <tr>
                                    <td class="text-left">{{ ++$loop->index }}.</td>
                                    <td class="text-left">
                                        <p class="align-self-center mb-0 admin-name">
                                            @if (strpos($item->option_key, 'payment_paypal') !== false)
                                                <img src="https://cdn.worldvectorlogo.com/logos/paypal-2.svg"
                                                    alt="paypal" style="width: 80px; margin-right:5%">
                                            @elseif(strpos($item->option_key, 'payment_razorpay') !== false)
                                                <img src="https://cdn.worldvectorlogo.com/logos/razorpay.svg"
                                                    alt="razorpay" style="width: 80px; margin-right:5%">
                                            @elseif(strpos($item->option_key, 'payment_squareup') !== false)
                                                <img src="https://cdn.worldvectorlogo.com/logos/square.svg" alt="square"
                                                    style="width: 30px; margin-right:5%">
                                            @endif
                                            {{ ucwords(str_replace('_', ' ', str_replace('social_', '', str_replace('site_', '', str_replace('payment_paypal_', '', str_replace('payment_razorpay_', '', str_replace('payment_squareup_', '', $item->option_key))))))) }}
                                        </p>
                                    </td>
                                    <td class="text-left">
                                        <div class="mr-2 mx-auto rounded-lg">
                                            @if (Str::contains($item->option_value, ['.jpg', '.png', '.jpeg']))
                                                <div class="w-25">
                                                    <img src={{ image_format($item->option_value ?? '') }}
                                                        class="img-fluid shadow rounded-lg" style="width: 80px"
                                                        alt={{ $value->option_key ?? '' }}>
                                                </div>

                                            @elseif (Str::contains($item->option_value, 'https://maps.google.com'))
                                                <iframe width="100%" height="200" id="gmap_canvas"
                                                    src={{ $item->option_value }} frameborder="0" scrolling="no"
                                                    marginheight="0" marginwidth="0"></iframe>
                                            @elseif (Str::contains($item->option_value, ['https://', 'http://']))
                                                <div class="linkPreview">
                                                    <a href={{ $item->option_value }}>{{ $item->option_value }}</a>
                                                </div>
                                            @else
                                                {{ $item->option_value }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href={{ route('settings.edit', $item->option_key) }} class="bs-tooltip"
                                            data-toggle="tooltip" data-placement="top" title="Edit"
                                            data-original-title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                </path>
                                            </svg>
                                        </a>
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
