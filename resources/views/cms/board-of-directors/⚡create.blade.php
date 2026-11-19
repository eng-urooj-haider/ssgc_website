<?php

use App\Models\BoardMember;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|max:255')]
    public string $designation = '';

    #[Validate('required|string')]
    public string $profile = '';

    #[Validate('required|image|max:1024')]
    public $photo;

    public function save(): void
    {
        $this->validate();

        $member = BoardMember::create([
            'name' => $this->name,
            'designation' => $this->designation,
            'profile' => $this->profile,
        ]);

        $member->addMedia($this->photo->getRealPath())
            ->usingFileName($this->photo->hashName())
            ->toMediaCollection('photo');

        $this->reset(['name', 'designation', 'profile', 'photo']);
    }
};
?>
<div>
    <form wire:submit="save">
        <div class="mb-5">
            <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
            <input type="text" id="name" wire:model="name"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                required />
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="type" class="block mb-2.5 text-sm font-medium text-heading">Designation</label>
            <input type="text" id="type" wire:model="designation"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                required />
            @error('designation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="profile" class="block mb-2.5 text-sm font-medium text-heading">Profile</label>
            <input type="text" id="profile" wire:model="profile"
                class="rte1 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                required />
            @error('profile') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5" x-data="{ preview: null }">
            <label for="picture" class="block mb-2.5 text-sm font-medium text-heading">Profile Picture</label>

            <div class="mb-3 flex items-center gap-4">
                <template x-if="preview">
                    <img :src="preview" alt="Avatar preview"
                        class="w-20 h-20 rounded-full object-cover border border-default-medium shadow-xs" />
                </template>

                <template x-if="!preview">
                    <div
                        class="w-20 h-20 rounded-full bg-neutral-secondary-medium border border-default-medium flex items-center justify-center text-xs text-body">
                        No avatar
                    </div>
                </template>

                <div wire:loading wire:target="photo" class="text-xs text-body">
                    Uploading...
                </div>
            </div>

            <input type="file" id="picture" wire:model="photo" accept="image/*" x-on:change="
            const file = $event.target.files[0];
            if (preview) URL.revokeObjectURL(preview);
            preview = file ? URL.createObjectURL(file) : null;
        " class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                required />
            @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="photo,save"
            class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none disabled:opacity-50">
            Submit
        </button>
    </form>
</div>
