<?php

use App\Models\AdminBoardOfDirector;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    #[Validate('required|string|max:255|min:3')]
    public string $name = '';

    #[Validate('required|string|max:255|min:3')]
    public string $designation = '';

    #[Validate('required|string')]
    public string $profile = '';

    #[Validate('required|image|max:1024')]
    public $photo;

    protected function messages(): array
    {
        return [
            'name.required'        => 'Please enter the board member\'s name.',
            'name.string'          => 'The name must be valid text.',
            'name.max'             => 'The name may not be longer than 255 characters.',

            'designation.required' => 'Please enter the designation.',
            'designation.string'   => 'The designation must be valid text.',
            'designation.max'      => 'The designation may not be longer than 255 characters.',

            'profile.required'     => 'Please enter the profile details.',
            'profile.string'       => 'The profile must be valid text.',

            'photo.required'       => 'Please upload a profile picture.',
            'photo.image'          => 'The file must be an image (JPG, PNG, GIF, WEBP).',
            'photo.max'            => 'The picture must be smaller than 1 MB.',
            'photo.uploaded'       => 'The picture failed to upload. Please try a smaller file.',
        ];
    }

    public function updated(string $property): void
    {
        $this->validateOnly($property);
    }

    public function save(): void
    {
        $this->validate();

        $member = AdminBoardOfDirector::create([
            'name'      => $this->name,
            'type'      => $this->designation,
            'profile'   => $this->profile,
            'picture'   => $this->photo,
            'user_id'   => 1,
        ]);

        $member->addMedia($this->photo->getRealPath())
            ->usingFileName($this->photo->hashName())
            ->toMediaCollection('photo');

        $this->reset(['name', 'designation', 'profile', 'photo']);
        $this->dispatch('profile-reset');
        $this->dispatch('form-saved');
    }
};
?>

<div>
    <form wire:submit="save" novalidate>
        <div class="mb-5">
            <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
            <input type="text" id="name" wire:model.blur="name"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" />
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="designation" class="block mb-2.5 text-sm font-medium text-heading">Designation</label>
            <input type="text" id="designation" wire:model.blur="designation"
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" />
            @error('designation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="profile" class="block mb-2.5 text-sm font-medium text-heading">Profile</label>

            <div wire:ignore x-data="{
            async init() {
                if (!window.ClassicEditor) {
                    await new Promise(r => window.addEventListener('rte-loaded', r, { once: true }));
                }

                const el = this.$refs.editor;
                const editor = await ClassicEditor.create(el, window.rteConfig);

                el._editor = editor;               // plain DOM property, not reactive
                editor.setData(@js($profile));

                editor.model.document.on('change:data', () => {
                    $wire.$set('profile', editor.getData(), false);
                });
            }
         }" x-on:profile-reset.window="$refs.editor._editor?.setData('')">
                <textarea x-ref="editor" id="profile" class="rte-livewire"></textarea>
            </div>

            @error('profile') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="mb-5" x-data="{ preview: null }" x-on:form-saved.window="
            if (preview) URL.revokeObjectURL(preview);
            preview = null;
        ">
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
            "
                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" />
            @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="photo,save"
            class="text-white cursor-pointer bg-black box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none disabled:opacity-50">
            Submit
        </button>
    </form>
</div>
