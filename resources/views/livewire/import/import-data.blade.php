<div>
    <form wire:submit.prevent="submit">
        <input wire:model="file" type="file">
        <button class="h-8 mt-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-blue-500 rounded-lg focus:shadow-outline hover:bg-indigo-800" type="submit">
            Enviar
        </button>
    </form>
</div>
