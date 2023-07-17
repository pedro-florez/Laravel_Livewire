@if ( $sortField == $campoActual )    

    <i 
    class="fas fa-sort-amount-down{{ $sortDirection === 'asc' ? '-alt' : '' }}"
    ></i>

@else

    <i class="fas fa-exchange-alt fa-rotate-90 iconOpacity"></i>

@endif