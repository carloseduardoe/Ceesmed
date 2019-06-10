@extends('layouts.level2.cred')

@section('title')
Update doctor info
@endsection

@section('details')
  <form class="" action="{{ route('doctors.update', $doctor->id) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"/>
    <input type="hidden" name="user_id" value="{{ $doctor->user_id }}"/>
    <label>User: {{ CEM\User::find($doctor->user_id)->name }}</label>
    <div class="form-group">
      <label for="specialty">Specialty</label>
      <select class="form-control" name="specialty">
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
          <option value="{{ $item }}" {!! $item == $doctor->specialty ? "selected" : "" !!}>
            {{ $item }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="position">Position</label>
      <select class="form-control" name="position">
        @foreach ([
          'Doctor', 'Certified Therapist', 'Medical Technician',
        ] as $item)
          <option value="{{ $item }}" {!! $item == $doctor->position ? "selected" : "" !!}>
            {{ $item }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-primary" href="{{ route('profile.doctor', $doctor->user_id) }}">Cancel</a>
    </div>
  </form>
@endsection
