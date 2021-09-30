<form action="{{route(Route::currentRouteName())}}" method="GET">
<div class="form-row">
<div class="form-group col-sm-4 col-md-2">
      <select id="inputState" class="form-control" name="search_by">
        @foreach($colunas as $key => $item)
        <option value="{{$key}}" {{isset($_GET["search_by"]) ? $key == $_GET["search_by"] ? 'selected' : '' : ''}} >{{$item}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-sm-8 col-md-4">
      <input type="text" placeholder="Pesquisar" name="search" value="{{$_GET['search'] ?? ''}}" class="form-control">
    </div>
</div>
</form>
