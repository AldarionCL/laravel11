@if( $value === 2)
    <a href="{{ route('request-order-prices', $row->id ) }}">
        <i class="fa fa-search"></i>
    </a>
@endif
