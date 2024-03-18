<div>
    <a wire:click.prevent="plus({{ $id }})" class="text-green-600">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <a wire:click.prevent="minus({{ $id  }})" class="text-red-600">
        <i class="fa fa-minus" aria-hidden="true"></i>
    </a>

    <a wire:click.prevent="trash({{ $id }})" class="text-black">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>
