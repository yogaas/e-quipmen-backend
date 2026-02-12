<?php

$namaFile = "index.php";
$isiFile = "<?php\n";
$isiFile .= 'echo "hello";';
$isiFile .= "\n?>";

// buat file
file_put_contents($namaFile, $isiFile);

echo "File $namaFile berhasil dibuat";