<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('payouts') }}">Payouts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Payout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mt-5" id="cancel-row">
            <div class="col-xl-8 col-lg-8 col-sm-12">
                <div class="card" style="border-radius: 48px;">
                    <div class="card-header p-5 pb-0" style="border-radius: 48px;">
                        <h2>Payout</h2>
                    </div>
                    <div class="card-body p-5">
                        <form class="p-3" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <select class="selectpicker form-control withoutTagging" name="status"
                                            title="Select Payout Status">
                                            <option value="" hidden>Select Payout Status</option>
                                            <option value="PENDING" @if ($payout->status === 'PENDING') selected @endif>
                                                PENDING
                                            </option>
                                            <option value="PROCESSING" @if ($payout->status === 'PROCESSING') selected @endif>
                                                PROCESSING
                                            </option>
                                            <option value="COMPLETED" @if ($payout->status === 'COMPLETED') selected @endif>
                                                COMPLETED
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control" id="transaction_mode"
                                            name="transaction_mode" placeholder="Transaction Mode *"
                                            value="{{ $payout->transaction_mode }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control" id="transaction_id"
                                            name="transaction_id" placeholder="Payout Transaction ID *"
                                            value="{{ $payout->transaction_id }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <textarea type="text" class="form-control" id="message" name="message"
                                            placeholder="Payout Message">{{ $payout->message }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-6 text-right ">
                                    <button type="submit" name="updateStatus" value="sfddsfs"
                                        class="btn btn-primary mt-4">Update Payout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-12">
                <div class="card" style="border-radius: 48px;">
                    <div class="card-header p-5 pb-0" style="border-radius: 48px;">
                        <h2>Payout Account Details</h2>
                    </div>
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Bank Name : </strong>{{ $driver->bank_name }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Branch Name : </strong>{{ $driver->branch_name }}
                                    </li>
                                    <li class="list-group-item"><strong>IFSC : </strong>{{ $driver->ifsc }}</li>
                                    <li class="list-group-item"><strong>PAN : </strong>{{ $driver->pan }}</li>
                                    <li class="list-group-item"><strong>MICR : </strong>{{ $driver->micr }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
