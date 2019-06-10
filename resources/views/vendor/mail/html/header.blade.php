<div class="col-12">
  <div class="row align-items-start">
    <a class="col-2 bg-dark justify-content-center" style="min-width: 125px !important; max-width: 125px !important;" href="{{ $url or '' }}">
      <img class="py-3 w-100 mx-auto" src="{{ Storage::url('public/brand/logo.png') }}">
    </a>
    <div class="col-9 text-left">
      <h2>Centro de Especialidades Médicas<br>
        <small class="text-muted">{{ $slot or '' }}</small>
      </h2>
    </div>
  </div>
</div>
