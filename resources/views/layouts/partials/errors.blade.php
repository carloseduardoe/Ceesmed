@if (count($errors))
  <div class="row">
      <div class="col alert alert-danger">
        <button type="button" class="close" data-dismiss="alert"><i class="material-icons">clear</i></button>
        <ul class="mb-0">
          @foreach ($errors->all() as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
  </div>
@endif
