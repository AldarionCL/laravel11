@if($row->state === 3)
{{ $row->created_at->diffInDays($row->updated_at) }}
@endif
