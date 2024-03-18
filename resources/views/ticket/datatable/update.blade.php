@if($row->comments->isNotEmpty())
    {{ $row->comments->last()->created_at->format('d-m-Y') }}
@endif

