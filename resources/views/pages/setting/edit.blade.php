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
                                <a href={{ route('settings') }}>Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-8 col offset-lg-2 offset-0">
                <div class="card">
                    <div class="card-header p-4">
                        <h2>
                            Update
                            {{ ucwords(str_replace('_', ' ', str_replace('social_', '', str_replace('site_', '', $setting->option_key)))) }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <form class="p-3" method="POST" enctype="multipart/form-data"
                            action={{ route('settings.edit.post', $setting->option_key) }}>
                            @csrf
                            @if (Str::contains($setting->option_value, ['.jpg', '.png', '.jpeg']) || $setting->option_key === 'site_logo')
                                <x-form-image name="option_value">
                                    <x-slot name="title">
                                        {{ ucwords(str_replace('_', ' ', str_replace('social_', '', str_replace('site_', '', $setting->option_key)))) }}
                                    </x-slot>
                                    <x-slot name="prev">{{ $setting->option_value }}</x-slot>
                                </x-form-image>
                            @elseif($setting->option_key === 'site_currency')
                                <select class="choices form-select form-select-lg" name="option_value"
                                    id="option_value">
                                    <option @if ($setting->option_value === 'AED') selected @endif value="AED">AED</option>
                                    <option @if ($setting->option_value === 'AFN') selected @endif value="AFN">AFN</option>
                                    <option @if ($setting->option_value === 'ALL') selected @endif value="ALL">ALL</option>
                                    <option @if ($setting->option_value === 'AMD') selected @endif value="AMD">AMD</option>
                                    <option @if ($setting->option_value === 'ANG') selected @endif value="ANG">ANG</option>
                                    <option @if ($setting->option_value === 'AOA') selected @endif value="AOA">AOA</option>
                                    <option @if ($setting->option_value === 'ARS') selected @endif value="ARS">ARS</option>
                                    <option @if ($setting->option_value === 'AUD') selected @endif value="AUD">AUD</option>
                                    <option @if ($setting->option_value === 'AWG') selected @endif value="AWG">AWG</option>
                                    <option @if ($setting->option_value === 'AZN') selected @endif value="AZN">AZN</option>
                                    <option @if ($setting->option_value === 'BAM') selected @endif value="BAM">BAM</option>
                                    <option @if ($setting->option_value === 'BBD') selected @endif value="BBD">BBD</option>
                                    <option @if ($setting->option_value === 'BDT') selected @endif value="BDT">BDT</option>
                                    <option @if ($setting->option_value === 'BGN') selected @endif value="BGN">BGN</option>
                                    <option @if ($setting->option_value === 'BHD') selected @endif value="BHD">BHD</option>
                                    <option @if ($setting->option_value === 'BIF') selected @endif value="BIF">BIF</option>
                                    <option @if ($setting->option_value === 'BMD') selected @endif value="BMD">BMD</option>
                                    <option @if ($setting->option_value === 'BND') selected @endif value="BND">BND</option>
                                    <option @if ($setting->option_value === 'BOB') selected @endif value="BOB">BOB</option>
                                    <option @if ($setting->option_value === 'BRL') selected @endif value="BRL">BRL</option>
                                    <option @if ($setting->option_value === 'BSD') selected @endif value="BSD">BSD</option>
                                    <option @if ($setting->option_value === 'BTN') selected @endif value="BTN">BTN</option>
                                    <option @if ($setting->option_value === 'BWP') selected @endif value="BWP">BWP</option>
                                    <option @if ($setting->option_value === 'BYR') selected @endif value="BYR">BYR</option>
                                    <option @if ($setting->option_value === 'BZD') selected @endif value="BZD">BZD</option>
                                    <option @if ($setting->option_value === 'CAD') selected @endif value="CAD">CAD</option>
                                    <option @if ($setting->option_value === 'CDF') selected @endif value="CDF">CDF</option>
                                    <option @if ($setting->option_value === 'CHF') selected @endif value="CHF">CHF</option>
                                    <option @if ($setting->option_value === 'CLP') selected @endif value="CLP">CLP</option>
                                    <option @if ($setting->option_value === 'CNY') selected @endif value="CNY">CNY</option>
                                    <option @if ($setting->option_value === 'COP') selected @endif value="COP">COP</option>
                                    <option @if ($setting->option_value === 'CRC') selected @endif value="CRC">CRC</option>
                                    <option @if ($setting->option_value === 'CUC') selected @endif value="CUC">CUC</option>
                                    <option @if ($setting->option_value === 'CVE') selected @endif value="CVE">CVE</option>
                                    <option @if ($setting->option_value === 'CZK') selected @endif value="CZK">CZK</option>
                                    <option @if ($setting->option_value === 'DJF') selected @endif value="DJF">DJF</option>
                                    <option @if ($setting->option_value === 'DKK') selected @endif value="DKK">DKK</option>
                                    <option @if ($setting->option_value === 'DOP') selected @endif value="DOP">DOP</option>
                                    <option @if ($setting->option_value === 'DZD') selected @endif value="DZD">DZD</option>
                                    <option @if ($setting->option_value === 'EEK') selected @endif value="EEK">EEK</option>
                                    <option @if ($setting->option_value === 'EGP') selected @endif value="EGP">EGP</option>
                                    <option @if ($setting->option_value === 'ERN') selected @endif value="ERN">ERN</option>
                                    <option @if ($setting->option_value === 'ETB') selected @endif value="ETB">ETB</option>
                                    <option @if ($setting->option_value === 'EUR') selected @endif value="EUR">EUR</option>
                                    <option @if ($setting->option_value === 'FJD') selected @endif value="FJD">FJD</option>
                                    <option @if ($setting->option_value === 'FKP') selected @endif value="FKP">FKP</option>
                                    <option @if ($setting->option_value === 'GBP') selected @endif value="GBP">GBP</option>
                                    <option @if ($setting->option_value === 'GEL') selected @endif value="GEL">GEL</option>
                                    <option @if ($setting->option_value === 'GHS') selected @endif value="GHS">GHS</option>
                                    <option @if ($setting->option_value === 'GIP') selected @endif value="GIP">GIP</option>
                                    <option @if ($setting->option_value === 'GMD') selected @endif value="GMD">GMD</option>
                                    <option @if ($setting->option_value === 'GNF') selected @endif value="GNF">GNF</option>
                                    <option @if ($setting->option_value === 'GQE') selected @endif value="GQE">GQE</option>
                                    <option @if ($setting->option_value === 'GTQ') selected @endif value="GTQ">GTQ</option>
                                    <option @if ($setting->option_value === 'GYD') selected @endif value="GYD">GYD</option>
                                    <option @if ($setting->option_value === 'HKD') selected @endif value="HKD">HKD</option>
                                    <option @if ($setting->option_value === 'HNL') selected @endif value="HNL">HNL</option>
                                    <option @if ($setting->option_value === 'HRK') selected @endif value="HRK">HRK</option>
                                    <option @if ($setting->option_value === 'HTG') selected @endif value="HTG">HTG</option>
                                    <option @if ($setting->option_value === 'HUF') selected @endif value="HUF">HUF</option>
                                    <option @if ($setting->option_value === 'IDR') selected @endif value="IDR">IDR</option>
                                    <option @if ($setting->option_value === 'ILS') selected @endif value="ILS">ILS</option>
                                    <option @if ($setting->option_value === 'INR') selected @endif value="INR">INR</option>
                                    <option @if ($setting->option_value === 'IQD') selected @endif value="IQD">IQD</option>
                                    <option @if ($setting->option_value === 'IRR') selected @endif value="IRR">IRR</option>
                                    <option @if ($setting->option_value === 'ISK') selected @endif value="ISK">ISK</option>
                                    <option @if ($setting->option_value === 'JMD') selected @endif value="JMD">JMD</option>
                                    <option @if ($setting->option_value === 'JOD') selected @endif value="JOD">JOD</option>
                                    <option @if ($setting->option_value === 'JPY') selected @endif value="JPY">JPY</option>
                                    <option @if ($setting->option_value === 'KES') selected @endif value="KES">KES</option>
                                    <option @if ($setting->option_value === 'KGS') selected @endif value="KGS">KGS</option>
                                    <option @if ($setting->option_value === 'KHR') selected @endif value="KHR">KHR</option>
                                    <option @if ($setting->option_value === 'KMF') selected @endif value="KMF">KMF</option>
                                    <option @if ($setting->option_value === 'KPW') selected @endif value="KPW">KPW</option>
                                    <option @if ($setting->option_value === 'KRW') selected @endif value="KRW">KRW</option>
                                    <option @if ($setting->option_value === 'KWD') selected @endif value="KWD">KWD</option>
                                    <option @if ($setting->option_value === 'KYD') selected @endif value="KYD">KYD</option>
                                    <option @if ($setting->option_value === 'KZT') selected @endif value="KZT">KZT</option>
                                    <option @if ($setting->option_value === 'LAK') selected @endif value="LAK">LAK</option>
                                    <option @if ($setting->option_value === 'LBP') selected @endif value="LBP">LBP</option>
                                    <option @if ($setting->option_value === 'LKR') selected @endif value="LKR">LKR</option>
                                    <option @if ($setting->option_value === 'LRD') selected @endif value="LRD">LRD</option>
                                    <option @if ($setting->option_value === 'LSL') selected @endif value="LSL">LSL</option>
                                    <option @if ($setting->option_value === 'LTL') selected @endif value="LTL">LTL</option>
                                    <option @if ($setting->option_value === 'LVL') selected @endif value="LVL">LVL</option>
                                    <option @if ($setting->option_value === 'LYD') selected @endif value="LYD">LYD</option>
                                    <option @if ($setting->option_value === 'MAD') selected @endif value="MAD">MAD</option>
                                    <option @if ($setting->option_value === 'MDL') selected @endif value="MDL">MDL</option>
                                    <option @if ($setting->option_value === 'MGA') selected @endif value="MGA">MGA</option>
                                    <option @if ($setting->option_value === 'MKD') selected @endif value="MKD">MKD</option>
                                    <option @if ($setting->option_value === 'MMK') selected @endif value="MMK">MMK</option>
                                    <option @if ($setting->option_value === 'MNT') selected @endif value="MNT">MNT</option>
                                    <option @if ($setting->option_value === 'MOP') selected @endif value="MOP">MOP</option>
                                    <option @if ($setting->option_value === 'MRO') selected @endif value="MRO">MRO</option>
                                    <option @if ($setting->option_value === 'MUR') selected @endif value="MUR">MUR</option>
                                    <option @if ($setting->option_value === 'MVR') selected @endif value="MVR">MVR</option>
                                    <option @if ($setting->option_value === 'MWK') selected @endif value="MWK">MWK</option>
                                    <option @if ($setting->option_value === 'MXN') selected @endif value="MXN">MXN</option>
                                    <option @if ($setting->option_value === 'MYR') selected @endif value="MYR">MYR</option>
                                    <option @if ($setting->option_value === 'MZM') selected @endif value="MZM">MZM</option>
                                    <option @if ($setting->option_value === 'NAD') selected @endif value="NAD">NAD</option>
                                    <option @if ($setting->option_value === 'NGN') selected @endif value="NGN">NGN</option>
                                    <option @if ($setting->option_value === 'NIO') selected @endif value="NIO">NIO</option>
                                    <option @if ($setting->option_value === 'NOK') selected @endif value="NOK">NOK</option>
                                    <option @if ($setting->option_value === 'NPR') selected @endif value="NPR">NPR</option>
                                    <option @if ($setting->option_value === 'NZD') selected @endif value="NZD">NZD</option>
                                    <option @if ($setting->option_value === 'OMR') selected @endif value="OMR">OMR</option>
                                    <option @if ($setting->option_value === 'PAB') selected @endif value="PAB">PAB</option>
                                    <option @if ($setting->option_value === 'PEN') selected @endif value="PEN">PEN</option>
                                    <option @if ($setting->option_value === 'PGK') selected @endif value="PGK">PGK</option>
                                    <option @if ($setting->option_value === 'PHP') selected @endif value="PHP">PHP</option>
                                    <option @if ($setting->option_value === 'PKR') selected @endif value="PKR">PKR</option>
                                    <option @if ($setting->option_value === 'PLN') selected @endif value="PLN">PLN</option>
                                    <option @if ($setting->option_value === 'PYG') selected @endif value="PYG">PYG</option>
                                    <option @if ($setting->option_value === 'QAR') selected @endif value="QAR">QAR</option>
                                    <option @if ($setting->option_value === 'RON') selected @endif value="RON">RON</option>
                                    <option @if ($setting->option_value === 'RSD') selected @endif value="RSD">RSD</option>
                                    <option @if ($setting->option_value === 'RUB') selected @endif value="RUB">RUB</option>
                                    <option @if ($setting->option_value === 'SAR') selected @endif value="SAR">SAR</option>
                                    <option @if ($setting->option_value === 'SBD') selected @endif value="SBD">SBD</option>
                                    <option @if ($setting->option_value === 'SCR') selected @endif value="SCR">SCR</option>
                                    <option @if ($setting->option_value === 'SDG') selected @endif value="SDG">SDG</option>
                                    <option @if ($setting->option_value === 'SEK') selected @endif value="SEK">SEK</option>
                                    <option @if ($setting->option_value === 'SGD') selected @endif value="SGD">SGD</option>
                                    <option @if ($setting->option_value === 'SHP') selected @endif value="SHP">SHP</option>
                                    <option @if ($setting->option_value === 'SLL') selected @endif value="SLL">SLL</option>
                                    <option @if ($setting->option_value === 'SOS') selected @endif value="SOS">SOS</option>
                                    <option @if ($setting->option_value === 'SRD') selected @endif value="SRD">SRD</option>
                                    <option @if ($setting->option_value === 'SYP') selected @endif value="SYP">SYP</option>
                                    <option @if ($setting->option_value === 'SZL') selected @endif value="SZL">SZL</option>
                                    <option @if ($setting->option_value === 'THB') selected @endif value="THB">THB</option>
                                    <option @if ($setting->option_value === 'TJS') selected @endif value="TJS">TJS</option>
                                    <option @if ($setting->option_value === 'TMT') selected @endif value="TMT">TMT</option>
                                    <option @if ($setting->option_value === 'TND') selected @endif value="TND">TND</option>
                                    <option @if ($setting->option_value === 'TRY') selected @endif value="TRY">TRY</option>
                                    <option @if ($setting->option_value === 'TTD') selected @endif value="TTD">TTD</option>
                                    <option @if ($setting->option_value === 'TWD') selected @endif value="TWD">TWD</option>
                                    <option @if ($setting->option_value === 'TZS') selected @endif value="TZS">TZS</option>
                                    <option @if ($setting->option_value === 'UAH') selected @endif value="UAH">UAH</option>
                                    <option @if ($setting->option_value === 'UGX') selected @endif value="UGX">UGX</option>
                                    <option @if ($setting->option_value === 'USD') selected @endif value="USD">USD</option>
                                    <option @if ($setting->option_value === 'UYU') selected @endif value="UYU">UYU</option>
                                    <option @if ($setting->option_value === 'UZS') selected @endif value="UZS">UZS</option>
                                    <option @if ($setting->option_value === 'VEB') selected @endif value="VEB">VEB</option>
                                    <option @if ($setting->option_value === 'VND') selected @endif value="VND">VND</option>
                                    <option @if ($setting->option_value === 'VUV') selected @endif value="VUV">VUV</option>
                                    <option @if ($setting->option_value === 'WST') selected @endif value="WST">WST</option>
                                    <option @if ($setting->option_value === 'XAF') selected @endif value="XAF">XAF</option>
                                    <option @if ($setting->option_value === 'XCD') selected @endif value="XCD">XCD</option>
                                    <option @if ($setting->option_value === 'XDR') selected @endif value="XDR">XDR</option>
                                    <option @if ($setting->option_value === 'XOF') selected @endif value="XOF">XOF</option>
                                    <option @if ($setting->option_value === 'XPF') selected @endif value="XPF">XPF</option>
                                    <option @if ($setting->option_value === 'YER') selected @endif value="YER">YER</option>
                                    <option @if ($setting->option_value === 'ZAR') selected @endif value="ZAR">ZAR</option>
                                    <option @if ($setting->option_value === 'ZMK') selected @endif value="ZMK">ZMK</option>
                                    <option @if ($setting->option_value === 'ZWR') selected @endif value="ZWR">ZWR</option>
                                </select>
                            @else
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="option_value"
                                        name="option_value" placeholder="Setting Value *" minlength="1"
                                        value={{ $setting->option_value }}>
                                </div>
                            @endif

                            <button type="submit" name="editSetting" value="sfddsfs" class="btn btn-primary mt-4">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
