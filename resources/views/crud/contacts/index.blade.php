@extends('layouts.level2.index')

@section('title')
Contact Index
@endsection

@section('action')
  @if (!Auth::user()->isJustPatient())
    <a class="btn btn-primary float-right" role="button" href="{{ route('home') }}">Home</a>
  @endif
@endsection

@section('table')
    <tr>
      <th scope="col">User</th>
      <th scope="col">Phone</th>
      <th scope="col">Mobile</th>
      <th scope="col">Address</th>
      <th scope="col" colspan="2">City</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($contacts as $item)
      <tr>
        <td><strong>{{ CEM\User::find($item->user_id)->name }}</strong></td>
        <td>{{ $item->phone }}</td>
        <td>{{ $item->mobile }}</td>
        <td>{{ $item->address }}</td>
        <td>{{ $item->city }}</td>
        <td class="p-0 align-middle text-right d-print-none">
          <a class="btn btn-sm" href="{{ route('contacts.edit', $item->user_id) }}">Update</a>
        </td>
      </tr>
    @endforeach
@endsection

@section('pagination')
  {!! $contacts->render() !!}
@endsection
