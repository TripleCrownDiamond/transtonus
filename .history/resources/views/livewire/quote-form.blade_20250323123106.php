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
                    <option value="{{ __('messages.services.storage_title') }}">{{ __('messages.services.storage_title') }}</option>
                    <option value="{{ __('messages.services.logistics_title') }}">{{ __('messages.services.logistics_title') }}</option>
                    <option value="{{ __('messages.services.cargo_title') }}">{{ __('messages.services.cargo_title') }}</option>
                    <option value="{{ __('messages.services.trucking_title') }}">{{ __('messages.services.trucking_title') }}</option>
                    <option value="{{ __('messages.services.packaging_title') }}">{{ __('messages.services.packaging_title') }}</option>
                    <option value="{{ __('messages.services.warehousing_title') }}">{{ __('messages.services.warehousing_title') }}</option>
                </select>
                @error('service_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-12">
                <textarea wire:model="details" class="form-control" rows="6"
                    placeholder="{{ __('messages.quote.form.details_placeholder') }}" required></textarea>
                @error('details') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <input type="hidden" wire:model="locale" value="{{ App::getLocale() }}">
            <div class="col-md-12 text-start">
                <button type="submit" class="btn btn-primary">
                    {{ __('messages.quote.form.submit_button') }}
                </button>
            </div>
        </div>
    </form>
</div>