<div>
    <form wire:submit.prevent="quoteSubmit">
        <div class="row gy-4">
            <div class="col-md-6">
                <input type="text" wire:model="name" class="form-control"
                    placeholder="{{ __('messages.quote.form.name_placeholder') }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <input type="email" wire:model="email" class="form-control"
                    placeholder="{{ __('messages.quote.form.email_placeholder') }}" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <input type="tel" wire:model="phone" class="form-control"
                    placeholder="{{ __('messages.quote.form.phone_placeholder') }}" required>
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <input type="text" wire:model="company" class="form-control"
                    placeholder="{{ __('messages.quote.form.company_placeholder') }}">
                @error('company') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <input type="text" wire:model="origin" class="form-control"
                    placeholder="{{ __('messages.quote.form.origin_placeholder') }}">
                @error('origin') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <input type="text" wire:model="destination" class="form-control"
                    placeholder="{{ __('messages.quote.form.destination_placeholder') }}">
                @error('destination') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12">
                <select wire:model="service_type" class="form-select" required>
                    <option value="">{{ __('messages.quote.form.service_select') }}</option>
                    <option value="maritime">{{ __('messages.quote.form.service_maritime') }}</option>
                    <option value="cargo">{{ __('messages.quote.form.service_cargo') }}</option>
                    <option value="logistics">{{ __('messages.quote.form.service_logistics') }}</option>
                    <option value="trucking">{{ __('messages.quote.form.service_trucking') }}</option>
                    <option value="packaging">{{ __('messages.quote.form.service_packaging') }}</option>
                    <option value="warehousing">{{ __('messages.quote.form.service_warehousing') }}</option>
                </select>
                @error('service_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12">
                <textarea wire:model="details" class="form-control" rows="6"
                    placeholder="{{ __('messages.quote.form.details_placeholder') }}" required></textarea>
                @error('details') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12 text-start">
                <button type="submit" class="btn btn-primary">
                    {{ __('messages.quote.form.submit_button') }}
                </button>
            </div>
        </div>
    </form>
</div>