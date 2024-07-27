<?php

require_once('../common.php');

$contactUsDb = new dbcontactus();

// Define an array of mock data
$mockData = [
  ['from_email' => 'example1@example.com', 'email_body' => 'Hello, this is a test message 1.'],
  ['from_email' => 'example2@example.com', 'email_body' => 'Hello, this is a test message 2.'],
  ['from_email' => 'example3@example.com', 'email_body' => 'Hello, this is a test message 3.'],
  ['from_email' => 'example4@example.com', 'email_body' => 'Hello, this is a test message 4.'],
  ['from_email' => 'example5@example.com', 'email_body' => 'Hello, this is a test message 5.']
];

// Loop through each mock data entry and insert into the database
foreach ($mockData as $data) {
  $result = $contactUsDb->insert($data['from_email'], $data['email_body']);
  if ($result) {
    echo "Data inserted successfully: " . $data['from_email'] . "\n";
  } else {
    echo "Failed to insert data for: " . $data['from_email'] . "\n";
  }
}
