<?php
/**
 * ============================================================
 *  ACT DISAIN — Post-Deploy Hook
 * ============================================================
 *  Dipanggil oleh GitHub Actions setelah FTP upload selesai.
 *
 *  ENDPOINT:
 *  https://actdisain.com/deploy-hook.php?token=TOKEN
 *  https://actdisain.com/deploy-hook.php?token=TOKEN&migrate=true
 *
 *  KEAMANAN:
 *  Token wajib cocok dengan DEPLOY_TOKEN di GitHub Secrets
 * ============================================================
 */

// ── Konfigurasi ─────────────────────────────────────────────────────────────
define('DEPLOY_TOKEN', getenv('DEPLOY_TOKEN') ?: 'ACT-Deploy-2024-kJ9x');
define('LARAVEL_ROOT', dirname(__DIR__));
define('PHP_BIN',      '/usr/bin/php');

// ── Helper: Kirim JSON response ─────────────────────────────────────────────
function respond(int $code, string $message, array $log = []): void
{
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode([
        'status'    => $code === 200 ? 'ok' : 'error',
        'message'   => $message,
        'log'       => $log,
        'timestamp' => date('Y-m-d H:i:s T'),
    ], JSON_PRETTY_PRINT);
    exit;
}

// ── Helper: Jalankan artisan command ────────────────────────────────────────
function artisan(string $command): array
{
    $artisan = LARAVEL_ROOT . '/artisan';
    $php     = PHP_BIN;
    $cmd     = "$php $artisan $command 2>&1";
    $start   = microtime(true);
    $output  = shell_exec($cmd);
    $elapsed = round((microtime(true) - $start) * 1000) . 'ms';
    return [
        'cmd'     => "artisan $command",
        'output'  => trim($output ?? '(no output)'),
        'elapsed' => $elapsed,
    ];
}

// ── Validasi request ─────────────────────────────────────────────────────────
if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'POST'])) {
    respond(405, 'Method not allowed');
}

$token = $_GET['token'] ?? $_POST['token'] ?? '';
if (!hash_equals(DEPLOY_TOKEN, $token)) {
    // Delay untuk mencegah brute force
    sleep(2);
    respond(403, 'Forbidden: token tidak valid');
}

if (!function_exists('shell_exec')) {
    respond(500, 'shell_exec tidak tersedia. Hubungi hosting support untuk mengaktifkannya.');
}

// ── Baca parameter opsional ──────────────────────────────────────────────────
$runMigration = ($_GET['migrate'] ?? 'false') === 'true';

// ── Jalankan post-deploy tasks ───────────────────────────────────────────────
$log = [];

// 1. Bersihkan semua cache lama
$log[] = artisan('cache:clear');

// 2. Cache konfigurasi (wajib setelah deploy)
$log[] = artisan('config:cache');

// 3. Cache route
$log[] = artisan('route:cache');

// 4. Cache view/blade
$log[] = artisan('view:cache');

// 5. Storage link — buat symlink public/storage → storage/app/public
//    Aman dijalankan berulang, tidak akan error jika sudah ada
$log[] = artisan('storage:link');

// 6. [OPSIONAL] Migration — hanya jika diminta secara eksplisit
if ($runMigration) {
    $log[] = ['info' => '⚠️ Menjalankan migration karena parameter migrate=true'];
    $log[] = artisan('migrate --force');
} else {
    $log[] = ['info' => '⏭️ Migration dilewati (gunakan ?migrate=true untuk menjalankan)'];
}

// 7. Optimasi aplikasi
$log[] = artisan('optimize');

// ── Response ─────────────────────────────────────────────────────────────────
respond(200, 'Post-deploy selesai! 🎉', $log);
