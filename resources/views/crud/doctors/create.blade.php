@extends('layouts.level2.cred')

@section('title')
Create doctor
@endsection

@section('details')
  <form class="" action="{{ route('doctors.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="user_id">User</label>
      <select class="form-control" name="user_id">
        <option class="d-none"></option>
        @foreach ($users as $item)
          <option value="{{ $item->id }}">
            {{ $item->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="specialty">Specialty</label>
      <select class="form-control" name="specialty">
        <option class="d-none"></option>
        @foreach ([
          'Anatomical pathology', 'Anesthesiology', 'Cardiology', 'Cardiovascular/thoracic surgery',
          'Clinical immunology/allergy', 'Dermatology', 'Diagnostic radiology', 'Emergency medicine',
          'Endocrinology/metabolism', 'Family medicine', 'Gastroenterology', 'General Internal Medicine',
          'General/clinical pathology', 'General surgery', 'Geriatric medicine', 'Hematology',
          'Medical biochemistry', 'Medical genetics', 'Medical oncology', 'Medical microbiology and infectious diseases',
          'Nephrology', 'Neurology', 'Neurosurgery', 'Nuclear medicine', 'Obstetrics/gynecology',
          'Occupational medicine', 'Ophthalmology', 'Orthopedic Surgery', 'Otolaryngology', 'Pediatrics',
          'Physical medicine and rehabilitation', 'Plastic surgery', 'Psychiatry', 'Public health and preventive medicine',
          'Radiation oncology', 'Respiratory medicine/respirology', 'Rheumatology', 'Urology',
        ] as $item)
          <option value="{{ $item }}">{{ $item }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="position">Position</label>
      <select class="form-control" name="position">
        <option class="d-none"></option>
        @foreach ([
          'Doctor', 'Certified Therapist', 'Medical Technician',
        ] as $item)
          <option value="{{ $item }}">{{ $item }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('doctors.index') }}">Cancel</a>
    </div>
  </form>
@endsection
