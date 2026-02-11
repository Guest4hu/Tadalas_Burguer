<?php
$dados = [
    ['foto_produto' => 'img-1.avif']
];

echo "Current Dir: " . __DIR__ . "\n";
$uploadDir = __DIR__ . '/../../../upload/';
echo "Upload Dir: " . realpath($uploadDir) . "\n";

foreach ($dados as &$produto) {
    if (!empty($produto['foto_produto'])) {
        $imagePath = __DIR__ . '/../../../upload/' . $produto['foto_produto'];
        
        if (file_exists($imagePath)) {
            echo "File found: $imagePath\n";
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);
            echo "Type: $type\n";
            $data = file_get_contents($imagePath);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $produto['foto_produto'] = $base64;
            echo "Base64 start: " . substr($base64, 0, 50) . "...\n";
            echo "SUCCESS\n";
        } else {
            echo "File NOT found: $imagePath\n";
            echo "FAILURE\n";
        }
    }
}
