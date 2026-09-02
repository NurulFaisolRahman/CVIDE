<?php
// test_composer.php
echo "<h2>Testing Composer Installation</h2>";

// Load autoload
require_once 'vendor/autoload.php';

// Test PHPWord
if (class_exists('PhpOffice\PhpWord\PhpWord')) {
    echo "✅ PHPWord loaded successfully<br>";
    
    // Test create simple document
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
    $section->addText('Test document');
    
    echo "✅ PHPWord can create documents<br>";
} else {
    echo "❌ PHPWord failed to load<br>";
}

// Test mPDF
if (class_exists('Mpdf\Mpdf')) {
    echo "✅ mPDF loaded successfully<br>";
} else {
    echo "⚠️ mPDF not loaded (not critical for DOCX editing)<br>";
}

echo "<br><strong>PHP Version:</strong> " . phpversion();
echo "<br><strong>Memory Limit:</strong> " . ini_get('memory_limit');
echo "<br><strong>Max Execution Time:</strong> " . ini_get('max_execution_time');
?>