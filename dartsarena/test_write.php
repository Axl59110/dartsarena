<?php
$testFile = __DIR__ . '/bootstrap/cache/test.txt';
$result = file_put_contents($testFile, 'test');
echo $result !== false ? "✅ OK - Written to: $testFile" : "❌ FAIL - Cannot write to bootstrap/cache";
echo "\n";
if ($result !== false) {
    unlink($testFile);
}
