<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Wallet Transactions</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Wallet Transactions</li>
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
                                <th>Transaction ID</th>
                                <th>Payment Type</th>
                                <th>Coupon Code</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Transaction Type</th>
                                <th>Created date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wallet as $value)
                                <tr class="text-center">
                                    <td>{{ ++$loop->index }}.</td>
                                    <td
                                        style="text-align:left; font-weight: bold; font-family: Arial, Helvetica, sans-serif;">
                                        {{ $value->transaction_id }}
                                    </td>
                                    <td class="text-left">{{ $value->payment_type }}</td>
                                    <td class="text-left">
                                        {{ is($value->coupon_code ?? '') ? $value->coupon_code : 'No Coupon applied' }}
                                    </td>
                                    <td>
                                        <div class="d-flex" style=" align-items: center;">
                                            <img src={{ image_format($value->profile_pic ?? '') }}
                                                style="width: 50px; height: 50px; margin-right:5%"
                                                class="rounded-circle">
                                            <div>
                                                {{ $value->first_name . $value->last_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left" style="font-family: sans-serif;">
                                        {{ price_format($value->amount ?? 0) }}
                                    </td>
                                    <td class="text-center">
                                        <span style="border-radius: 18px;"
                                            class="badge font-weight-bold {{ $value->transaction_type === 'debit' ? 'bg-warning' : 'bg-success' }}">
                                            {{ $value->transaction_type }}
                                        </span>
                                    </td>
                                    <td class="text-left">
                                        {{ datetime_format($value->created_date) }}
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
