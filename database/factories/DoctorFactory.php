<?php

use Faker\Generator as Faker;

$factory->define(CEM\Doctor::class, function (Faker $faker) {
  return [
    'user_id' => CEM\User::pluck('id')->random(),
    'specialty' => $faker->randomElement([
      'Anatomical pathology', 'Anesthesiology',
      'Cardiology', 'Cardiovascular/thoracic surgery',
      'Clinical immunology/allergy', 'Dermatology',
      'Diagnostic radiology', 'Emergency medicine',
      'Endocrinology/metabolism', 'Family medicine',
      'Gastroenterology', 'General Internal Medicine',
      'General/clinical pathology', 'General surgery',
      'Geriatric medicine', 'Hematology', 'Medical biochemistry',
      'Medical genetics', 'Medical oncology',
      'Medical microbiology and infectious diseases',
      'Nephrology', 'Neurology', 'Neurosurgery',
      'Nuclear medicine', 'Obstetrics/gynecology',
      'Occupational medicine', 'Ophthalmology',
      'Orthopedic Surgery', 'Otolaryngology', 'Pediatrics',
      'Physical medicine and rehabilitation', 'Plastic surgery',
      'Psychiatry', 'Public health and preventive medicine',
      'Radiation oncology', 'Respiratory medicine/respirology',
      'Rheumatology', 'Urology',
    ]),
    'position' => $faker->randomElement([
      'Doctor', 'Certified Therapist', 'Medical Technician',
    ]),
  ];
});
