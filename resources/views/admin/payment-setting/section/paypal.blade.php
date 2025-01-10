<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.paypal-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="clearfix">
                    <h4 class="text-blue h4">PayPal Settings</h4>
                    <p class="mb-30">Configure your PayPal settings below.</p>
                </div>

                <div class="form-group">
                    <label>PayPal Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ @$paypalSetting->status === 1 ? 'selected' : '' }}>Enable</option>
                        <option value="0" {{ @$paypalSetting->status === 0 ? 'selected' : '' }}>Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" class="form-control">
                        <option value="0" {{ @$paypalSetting->mode === 0 ? 'selected' : '' }}>Sandbox</option>
                        <option value="1" {{ @$paypalSetting->mode === 1 ? 'selected' : '' }}>Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option value="{{ $country }}" {{ $country === @$paypalSetting->country_name ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.currecy_list') as $key => $currency)
                            <option value="{{ $currency }}" {{ $currency === @$paypalSetting->currency_name ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Rate (Per {{ @$settings->currency_name }})</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{ @$paypalSetting->currency_rate }}" required>
                </div>

                <div class="form-group">
                    <label>PayPal Client ID</label>
                    <input type="text" class="form-control" name="client_id" value="{{ @$paypalSetting->client_id }}" required>
                </div>

                <div class="form-group">
                    <label>PayPal Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" value="{{ @$paypalSetting->secret_key }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
