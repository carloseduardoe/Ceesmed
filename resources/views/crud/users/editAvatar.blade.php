@extends('layouts.level2.cred')

@section('title')
Update Avatar
@endsection

@section('details')
  <form action="{{ route('avatar.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <fieldset id="media">
      <legend class="">{{ $user->name }}</legend>
      <div class="row justify-content-around py-5">
        <div class="col-10 text-center">
          <img class="w-100" style="max-width: 250px;" src="{{ Storage::url($user->avatar) }}" alt="Image Error"/>
        </div>
      </div>
      <div class="form-group">
        <div class="custom-file w-100">
          <input class="custom-file-input" name="avatar" id="avatar" type="file">
          <label class="custom-file-label" for="avatar" id="avatarLabel">Upload Image...</label>
        </div>
      </div>
      <script type="text/javascript">
        document.getElementById('avatar').addEventListener('change', function(event){
          var label = document.getElementById('avatarLabel');
          label.textContent = this.files[0].name;
        });
      </script>
    </fieldset>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('profile.patient', $user->id) }}">Cancel</a>
    </div>
  </form>
@endsection
