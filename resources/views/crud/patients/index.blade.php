@extends('layouts.level2.index')

@section('title')
Patient Index
@endsection

@section('action')
  <form class="form-inline float-right dropdown" action="{{ route('patients.search') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group pr-2 mb-0">
      <input type="text" class="form-control dropdown-toggle" id="searchTerm" name="searchTerm" placeholder="Name or Email" data-toggle="dropdown" autocomplete="off">
      <div class="dropdown-menu" id="searchResults"></div>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
    <script type="text/javascript">
      var searchTerm = document.getElementById('searchTerm');
      searchTerm.onkeyup = function() {
        if (searchTerm.value.length >= 4) {
          $.ajax({
            url: "{{ url('/patients/search/') }}/"+searchTerm.value,
            dataType: 'json',
            success: function(data) {
              var list = document.getElementById('searchResults');
              if (data.length > 0) {
                list.className = "dropdown-menu";
                while (list.childNodes[0]) {
                  list.removeChild(list.childNodes[0]);
                }
                data.map((item, i) => {
                  var link = document.createElement('a');
                  link.href = "{{ url('/patient') }}/" + item.id;
                  link.className = "dropdown-item";
                  link.appendChild(document.createTextNode(item.name));
                  list.appendChild(link);
                });
                $('.dropdown-toggle').dropdown('toggle');
                $('.dropdown-toggle').dropdown('toggle');
              } else {
                list.className = "d-none";
                list.innerHTML = "";
              }
            }
          });
        } else {
          document.getElementById('searchResults').innerHTML = "";
        }
      }
    </script>
  </form>
@endsection

@section('table')
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Date of birth</th>
      <th scope="col">Gender</th>
      <th scope="col">History Enabled</th>
      <th scope="col" colspan="2">Bloodtype</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($patients as $item)
      <tr>
        <td><strong>{{ $item->user->name }}</strong></td>
        <td>{{ Carbon\Carbon::parse($item->birthdate)->format('F j\\, Y') }}</td>
        <td>{{ $item->gender == 'm' ? "male" : ($item->gender == 'f' ? "female" : "undisclosed") }}</td>
        <td>
          @if($item->viewhistory)
            <a href="{{ route('records.index', $item->user->id) }}">yes</a>
          @else
            no
          @endif
        </td>
        <td>{{ $item->bloodtype }}</td>
        <td class="p-0 align-middle text-right d-print-none">
          <a class="btn btn-sm" href="{{ route('profile.patient', $item->user->id) }}">Profile</a>
          <a class="btn btn-sm" href="{{ route('patients.edit', $item->user->id) }}">Update</a>
        </td>
      </tr>
    @endforeach
@endsection

@section('pagination')
  {!! $patients->render() !!}
@endsection
