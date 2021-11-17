<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <h2 class="font-weight-bold">{{ config('app.name', 'Yabo') }}</h2>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <x-nav-link active="dashboard" route="dashboard" icon="home">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <li class="sidebar-title">Types</li>
                <x-nav-link active="categories" route="categories" icon="layers">
                    {{ __('Categories') }}
                </x-nav-link>

                <x-nav-link active="orders" route="orders" icon="briefcase">
                    {{ __('Orders') }}
                </x-nav-link>

                <x-nav-link active="payouts" route="payouts" icon="briefcase">
                    {{ __('Driver Payouts') }}
                </x-nav-link>

                <x-nav-link active="coupons" route="coupons" icon="credit-card">
                    {{ __('Coupons') }}
                </x-nav-link>

                <x-nav-link active="vehicles" route="vehicles" icon="truck">
                    {{ __('Vehicles') }}
                </x-nav-link>

                <x-nav-link active="ratings" route="ratings" icon="star">
                    {{ __('Rating & Reviews') }}
                </x-nav-link>

                <li class="sidebar-title">Managements</li>
                <x-nav-link active="wallets" route="wallets" icon="dollar-sign">
                    {{ __('Wallet') }}
                </x-nav-link>

                <x-nav-link active="users" route="users" icon="user">
                    {{ __('Riders') }}
                </x-nav-link>

                <x-nav-link active="drivers" route="drivers" icon="users">
                    {{ __('Drivers') }}
                </x-nav-link>

                <x-nav-link active="send-notification" route="send-notification" icon="bell">
                    {{ __('Notifications') }}
                </x-nav-link>

                <x-nav-link active="settings" route="settings" icon="settings">
                    {{ __('Settings') }}
                </x-nav-link>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
