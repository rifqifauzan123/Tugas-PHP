<?php
$data = <<<'EOD'
	X, -9\\\10\100\-5\\\0\\\\, A
	Y, \\13\\1\, B
	Z, \\\5\\\-3\\2\\\800, C
EOD;

$rows = explode("\n", $data);
$output = [];

foreach ($rows as $row) {
  $row = trim($row);
  if (empty($row)) continue;

  list($key, $values, $label) = explode(",", $row);
  $values = explode("\\", $values);

  $index = 1;
  foreach ($values as $value) {
    if ($value === "") continue;

    $output[] = [
      "key" => trim($key),
      "value" => (int) $value,
      "label" => trim($label),
      "index" => $index
    ];

    $index++;
  }
}

usort($output, function($a, $b) {
  if ($a["key"] === $b["key"]) {
    if ($a["value"] === $b["value"]) {
      return $a["index"] - $b["index"];
    } else {
      return $a["value"] - $b["value"];
    }
  } else {
    return strcmp($a["key"], $b["key"]);
  }
});

foreach ($output as $row) {
  echo "{$row['key']}, {$row['value']}, {$row['label']}, {$row['index']}"."<br>";
}
?>