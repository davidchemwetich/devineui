<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Reorder Team Members</h2>
        <a href="{{ route(config('app.admin_prefix') . '.team-members.team-members') }}"
            class="px-4 py-2 text-white transition bg-gray-600 rounded-md hover:bg-gray-700">
            Back to List
        </a>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-700">Select Category</label>
            <div class="flex flex-wrap gap-2">
                @foreach($categories as $category)
                <button wire:click="changeCategory({{ $category->id }})"
                    class="px-4 py-2 text-sm rounded-md {{ $selectedCategory == $category->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>

        @if(count($teamMembers) > 0)
        <div class="p-4 mb-4 text-blue-800 rounded-md bg-blue-50">
            <p>Drag and drop team members to change their display order. Changes are saved automatically.</p>
        </div>

        <div x-data="{
                    items: @entangle('teamMembers'),
                    draggingItem: null,

                    init() {
                        this.$watch('items', value => {
                            const itemsWithOrder = value.map((item, index) => ({ value: item.id, order: index + 1 }));
                            @this.updateOrder(itemsWithOrder);
                        });
                    },

                    startDrag(event, item) {
                        this.draggingItem = item;
                        event.dataTransfer.effectAllowed = 'move';
                        event.dataTransfer.setData('text/plain', '');
                    },

                    dragOver(event, targetItem) {
                        if (this.draggingItem === null) return;
                        if (targetItem === this.draggingItem) return;

                        event.preventDefault();

                        const sourceIndex = this.items.findIndex(i => i.id === this.draggingItem.id);
                        const targetIndex = this.items.findIndex(i => i.id === targetItem.id);

                        // Reorder items array
                        const removedItem = this.items.splice(sourceIndex, 1)[0];
                        this.items.splice(targetIndex, 0, removedItem);
                    },

                    endDrag() {
                        this.draggingItem = null;
                    }
                }" class="space-y-2">
            <template x-for="(item, index) in items" :key="item.id">
                <div draggable="true" @dragstart="startDrag($event, item)" @dragover="dragOver($event, item)"
                    @dragend="endDrag"
                    class="flex items-center p-3 bg-white border border-gray-200 rounded-md cursor-move hover:bg-gray-50">
                    <div class="flex-shrink-0 mr-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-shrink-0 w-10 h-10 mr-4">
                        <img :src="item.profile_image_url" :alt="item.name" class="object-cover w-10 h-10 rounded-full">
                    </div>
                    <div class="flex-grow">
                        <p class="font-medium text-gray-800" x-text="item.name"></p>
                        <p class="text-sm text-gray-500" x-text="item.role"></p>
                    </div>
                    <div class="flex-shrink-0 px-3 py-1 bg-gray-200 rounded-full">
                        <span class="text-sm font-medium text-gray-800" x-text="`Order: ${index + 1}`"></span>
                    </div>
                </div>
            </template>
        </div>
        @else
        <div class="py-8 text-center">
            <p class="text-gray-500">No team members found in this category. Add team members first to arrange their
                order.</p>
            <a href="{{ route(config('app.admin_prefix') . '.team-members.team-members.create') }}"
                class="inline-block px-4 py-2 mt-4 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                Add Team Member
            </a>
        </div>
        @endif
    </div>
</div>
