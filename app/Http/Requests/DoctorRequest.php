<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'user_id'   => 'required|integer|min:1',
      'specialty' => 'required|in:Anatomical pathology,Anesthesiology,Cardiology,Cardiovascular/thoracic surgery,Clinical immunology/allergy,Dermatology,Diagnostic radiology,Emergency medicine,Endocrinology/metabolism,Family medicine,Gastroenterology,General Internal Medicine,General/clinical pathology,General surgery,Geriatric medicine,Hematology,Medical biochemistry,Medical genetics,Medical oncology,Medical microbiology and infectious diseases,Nephrology,Neurology,Neurosurgery,Nuclear medicine,Obstetrics/gynecology,Occupational medicine,Ophthalmology,Orthopedic Surgery,Otolaryngology,Pediatrics,Physical medicine and rehabilitation,Plastic surgery,Psychiatry,Public health and preventive medicine,Radiation oncology,Respiratory medicine/respirology,Rheumatology,Urology',
      'position'  => 'required|in:Doctor,Certified Therapist,Medical Technician',
    ];
  }
}
