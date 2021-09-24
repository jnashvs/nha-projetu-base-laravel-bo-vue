@foreach(backoffice_menus() as $key => $menu)
<li class="nav-item">
    <a href="{{$menu['route']}}" class="nav-link">
        <i class="{{$menu['icon']}}"></i>
        <p>
            {{$menu['title']}}
        </p>
    </a>
</li>
@endforeach
