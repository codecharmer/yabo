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
                                <a href={{ route('coupons') }}>Coupons</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-8 col-sm-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Coupon</h2>
                    </div>
                    <div class="card-body">
                        <form class="p-3" method="POST" enctype="multipart/form-data"
                            action={{ route('coupon.add.post') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control" id="code" name="code"
                                            placeholder="Coupon CODE *" autofocus>
                                        <small class="form-text text-muted">
                                            <span class="text-danger mr-1">*</span>Required Fields
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <select class="selectpicker form-control withoutTagging" name="type"
                                            title=" Select Coupon Type ">
                                            <option value="" hidden>Select Coupon Type</option>
                                            <option value="flat">Flat</option>
                                            <option value="percentage">Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label>Coupon Status</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input class="form-control-checkbox" type="radio" name="is_active"
                                            id="is_active-true" value="1"> Enable &nbsp;
                                        <input class="form-control-checkbox" type="radio" name="is_active"
                                            id="is_active-false" value="0" checked> Disable
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="percentage">Percentage</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input class="form-control" type="number" name="percentage" id="percentage"
                                            value="0" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="max_amount">Maximum Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input class="form-control" type="number" name="max_amount" id="max_amount"
                                            value="0" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="min_order_amount">Min Order Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input class="form-control" type="number" name="min_order_amount"
                                            id="min_order_amount" value="0" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="use_count">Coupon Use Count</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input class="form-control" type="number" name="use_count" id="use_count"
                                            value="0" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="start_from">Start From:</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input type="date" class="form-control datepicker" id="start_from"
                                            name="start_from" min={{ date('Y-m-d') }}
                                            max={{ date('Y-m-d', strtotime('+1 month', time())) }}
                                            placeholder="Select Date" title="Select Date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label for="end_to">End To:</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-4">
                                        <input type="date" class="form-control datepicker" id="end_to" name="end_to"
                                            placeholder="Select Date"
                                            min={{ date('Y-m-d', strtotime('+1 day', time())) }}
                                            max={{ date('Y-m-d', strtotime('+1 month', time())) }}
                                            title="Select Date">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <textarea class="form-control" id="description" name="description"
                                            placeholder="Enter Description"
                                            title="Enter Description">0% off, Maximum discount of 0 </textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="addCoupon" value="addCoupon" class="btn btn-primary mt-4">
                                Add Coupon
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
