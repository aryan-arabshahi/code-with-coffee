@if (isset($breadcrumb) AND is_array($breadcrumb))
    @php
        $breadcrumb_items_count = count($breadcrumb);
        $item_index = 1;
    @endphp
    <ul class="breadcrumb-list cursor-default flex">
        <li class="breadcrumb-item">
            <a href="/">
                <i class="fa fa-home mr-1"></i>
                Home
            </a>
        </li>
        @foreach ($breadcrumb as $item => $link)
            <li class="breadcrumb-item">
                @if ($item_index == $breadcrumb_items_count)
                    <span>{{$item}}</span>
                @else
                    <a href="{{$link}}">{{$item}}</a>
                @endif
            </li>
            @php
                $item_index++;
            @endphp
        @endforeach
    </ul>
@endif