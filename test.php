<?php

/*
$dt = new \DateTime();
$dt->setTimestamp(1584915938);
echo $dt->format('Y.m.d H:i:s');
die;
*/

/*
$client = new Google\Client();
$client->setApplicationName("Reseller");
$client->setDeveloperKey("AIzaSyAG5-c20Rocj8LnzttKAQzAlyt9exel_-g");

$service = new Google\Service\Sheets($client);

$spreadsheetId = '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms';
$range = 'Class Data!A2:E';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
print "No data found.\n";
} else {
print "Name, Major:\n";
foreach ($values as $row) {
// Print columns A and E, which correspond to indices 0 and 4.
printf("%s, %s\n", $row[0], $row[4]);
}
}
*/