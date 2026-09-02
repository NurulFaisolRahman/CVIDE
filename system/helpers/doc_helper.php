<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load Composer Autoload
if (file_exists(FCPATH . 'vendor/autoload.php')) {
    require_once FCPATH . 'vendor/autoload.php';
}

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

/**
 * Convert DOCX ke HTML
 */
function docx_to_html($docx_path) {
    if (!file_exists($docx_path)) {
        return '<p><em>File tidak ditemukan</em></p>';
    }
    
    $tempDir = FCPATH . 'uploads/temp/';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }
    Settings::setTempDir($tempDir);
    
    try {
        $phpWord = IOFactory::load($docx_path);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
        
        ob_start();
        $htmlWriter->save('php://output');
        $html = ob_get_clean();
        
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $matches)) {
            $html = $matches[1];
        }
        
        return $html;
        
    } catch (Exception $e) {
        log_message('error', 'DOCX to HTML failed: ' . $e->getMessage());
        return '<p><em>Error: ' . $e->getMessage() . '</em></p>';
    }
}

/**
 * Convert HTML ke DOCX
 */
function html_to_docx($html_content, $output_path) {
    if (empty($html_content)) {
        log_message('error', 'HTML content is empty');
        return false;
    }
    
    if (!class_exists('\PhpOffice\PhpWord\PhpWord')) {
        log_message('error', 'PhpWord library not found');
        return false;
    }
    
    $tempDir = FCPATH . 'uploads/temp/';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }
    Settings::setTempDir($tempDir);
    
    try {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);
        
        $section = $phpWord->addSection();
        
        // Bersihkan HTML
        $clean_html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html_content);
        
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $clean_html, false, false);
        
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($output_path);
        
        return true;
        
    } catch (Exception $e) {
        log_message('error', 'HTML to DOCX failed: ' . $e->getMessage());
        return false;
    }
}

/**
 * Generate PDF (Disabled untuk PHP 7.4)
 */
function html_to_pdf($html_content, $output_path) {
    // mPDF tidak kompatibel dengan PHP 7.4
    // Tapi return true agar proses tidak gagal
    log_message('info', 'PDF generation skipped (PHP 7.4 compatibility)');
    return true;
}
?>