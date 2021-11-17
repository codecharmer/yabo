<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mt-5" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Send Notifications</h2>
                    </div>
                    <div class="card-body">
                        <form class=" p-3" method="POST" enctype="multipart/form-data"
                            action={{ route('send-notification-post') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_type">User Type</label>
                                        <div class="form-check px-0 mt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type"
                                                    id="usertype1" value="USER" required>
                                                <label class="form-check-label" for="usertype1">Rider</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type"
                                                    id="usertype2" value="DRIVER" required>
                                                <label class="form-check-label" for="usertype2">Driver</label>
                                            </div>
                                        </div>
                                        <small id="usertype1" class="form-text text-muted">
                                            Select notification user group.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control d-none @error('riders') is-invalid @enderror"
                                            id="riders" placeholder="Select a Rider">
                                            <option value="" hidden>Select a Rider</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->app_token_id }}">
                                                    {{ $value->first_name . ' ' . $value->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control d-none @error('drivers') is-invalid @enderror"
                                            id="drivers" placeholder="Select a Driver">
                                            <option value="" hidden>Select a Driver</option>
                                            @foreach ($drivers as $value)
                                                <option value="{{ $value->app_token_id }}">
                                                    {{ $value->first_name . ' ' . $value->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" placeholder="Enter Nofification Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message:</label>
                                        <Textarea class="form-control @error('message') is-invalid @enderror"
                                            id="message" name="message" rows="7" maxlength="1024"
                                            placeholder="Enter Nofification Message Here"></Textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="sendNotification" value="sendNotification"
                                class="btn btn-primary mt-4">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const riders = document.getElementById('riders');
        const drivers = document.getElementById('drivers');
        const userType1 = document.getElementById('usertype1');
        const userType2 = document.getElementById('usertype2');

        userType1.addEventListener('click', showSelectBox);
        userType2.addEventListener('click', showSelectBox);

        function showSelectBox() {
            if (userType2.checked) {
                drivers.classList.remove('d-none');
                riders.classList.add('d-none');
                drivers.setAttribute('name', 'drivers');
                riders.removeAttribute('name');
            } else {
                riders.classList.remove('d-none');
                drivers.classList.add('d-none');
                riders.setAttribute('name', 'riders');
                drivers.removeAttribute('name');
            }
        }
    </script>
</x-app-layout>
