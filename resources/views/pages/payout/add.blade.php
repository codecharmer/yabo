<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item">
                                <a href={{ route('categories') }}>Payouts</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Payout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-8 col-sm-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Payout</h2>
                    </div>
                    <div class="card-body">
                        <form class="p-3" method="POST" enctype="multipart/form-data"
                            action={{ route('payout.add.post') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <select class="selectpicker form-control withoutTagging" name="user_id"
                                            title="Select Driver">
                                            <option value="" hidden>Select Driver</option>
                                            @foreach ($drivers as $value)
                                                <option value="{{ $value->id }}">
                                                    {{ $value->first_name . ' ' . $value->last_name . ' | Available Balance:' . price_format($value->amount) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <select class="selectpicker form-control withoutTagging" name="status"
                                            title="Select Payout Status">
                                            <option value="" hidden>Select Payout Status</option>
                                            <option value="PENDING">PENDING</option>
                                            <option value="PROCESSING">PROCESSING</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="number" class="form-control" id="amount" name="amount" min="1"
                                            placeholder="Amount *" value={{ old('amount') }}>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control" id="transaction_mode"
                                            name="transaction_mode" placeholder="Transaction Mode *"
                                            value={{ old('transaction_mode') }}>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control" id="transaction_id"
                                            name="transaction_id" placeholder="Payout Transaction ID *"
                                            value={{ old('transaction_id') }}>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <textarea type="text" class="form-control" id="message" name="message"
                                            placeholder="Payout Message">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-end">
                                <div class="col-6 text-right ">
                                    <button type="submit" name="savePayout" value="sfddsfs"
                                        class="btn btn-primary mt-4">Save Payout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
