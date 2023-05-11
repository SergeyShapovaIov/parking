@if($pageCount > 1)
    <div class="pagination-container justify-content-center d-flex">
        <div class="pagination-wrapper">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item @if($pageNumber == 1) disabled @endif"><a class="page-link"
                                                                                   href="/cart-list?page={{$pageNumber-1}}">Previous</a>
                    </li>
                    @if($pageCount < 9)
                        @for($i = 1; $i <= $pageCount; $i++)
                            <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link"
                                                                                          href="/car-list?page= {{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor
                    @else

                        @if($pageNumber <= 9 )
                            @for($i = 1; $i <=10; $i++)
                                <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link"
                                                                                              href="/car-list?page= {{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                        @endif

                        @if($pageNumber > 9 && $pageNumber <= $pageCount-9)
                            <li class="page-item @if($pageNumber == 1) active @endif"><a class="page-link"
                                                                                         href="/car-list?page= {{ 1 }}">{{ 1 }}</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#"> ... </a></li>
                            <li class="page-item"><a class="page-link"
                                                     href="/car-list?page= {{ $pageNumber - 2 }}">{{ $pageNumber - 2 }}</a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="/car-list?page= {{ $pageNumber - 1 }}">{{ $pageNumber - 1 }}</a>
                            </li>
                            <li class="page-item active"><a class="page-link"
                                                            href="/car-list?page= {{ $pageNumber }}">{{ $pageNumber }}</a>
                            </li>
                            <li class="page-item "><a class="page-link"
                                                      href="/car-list?page= {{ $pageNumber + 1 }}">{{ $pageNumber + 1 }}</a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="/car-list?page= {{ $pageNumber + 2 }}">{{ $pageNumber + 2 }}</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#"> ... </a></li>
                            <li class="page-item @if($pageNumber == $pageCount) active @endif"><a class="page-link"
                                                                                                  href="/car-list?page= {{ $pageCount }}">{{ $pageCount }}</a>
                            </li>
                        @endif

                        @if($pageNumber > 9 && $pageNumber > $pageCount -9)
                            @for($i = $pageCount-9; $i <= $pageCount; $i++)
                                <li class="page-item @if($i == $pageNumber) active @endif"><a class="page-link"
                                                                                              href="/car-list?page= {{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                        @endif
                    @endif

                    <li class="page-item @if($pageNumber == $pageCount) disabled @endif"><a class="page-link"
                                                                                            href="/car-list?page={{$pageNumber+1}}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endif
@push('styles')
    <style>
        .pagination-container {
            margin-top: 40px;
            width: 100%
        }

        .pagination-wrapper {
            width: 300px;
            margin: auto;
        }
    </style>
@endpush
