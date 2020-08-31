@if ($paginator->lastPage() > 1)
	<ul class="pagination fright">
	    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
	    	@if( abs($paginator->currentPage() - $i) <= 2 )
		        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
		            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
		        </li>
	        @endif
	    @endfor
		<li class="last"><a href="{{ $paginator->url($paginator->lastPage()) }}"></a>
	</ul>
@endif