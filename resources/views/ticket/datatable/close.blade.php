@if($row->state === 3)
    {{ $row->created_at->diffInMonths($row->updated_at) }}
@endif
