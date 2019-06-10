@if(Session::has('info'))
  <div class="row">
    <div class="col alert alert-info">
      <button type="button" class="close" data-dismiss="alert"><i class="material-icons">clear</i></button>
      {!! Session::get('info') !!}
    </div>
  </div>
@endif
