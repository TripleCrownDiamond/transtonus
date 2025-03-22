<div>
    <form wire:submit.prevent="submit">
        <div class="row gy-4">
            <div class="col-md-6">
                <input type="text" wire:model="name" class="form-control"
                    placeholder="{{ __('messages.contact.form.name_placeholder') }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="email" wire:model="email" class="form-control"
                    placeholder="{{ __('messages.contact.form.email_placeholder') }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <input type="text" wire:model="subject" class="form-control"
                    placeholder="{{ __('messages.contact.form.subject_placeholder') }}" required>
                @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <textarea wire:model="message" class="form-control" rows="6"
                    placeholder="{{ __('messages.contact.form.message_placeholder') }}" required></textarea>
                @error('message')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 text-start">
                <button type="submit" class="btn btn-primary">
                    {{ __('messages.contact.form.submit_button') }}
                </button>
            </div>
        </div>
    </form>
</div>
