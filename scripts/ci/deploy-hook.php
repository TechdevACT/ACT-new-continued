<?php
/**
 * ============================================================
 *  ACT DISAIN — Post-Deploy Hook
 * ============================================================
 *  Dipanggil manual dari browser setelah GitHub Actions selesai.
 *
 *  ENDPOINT:
 *  https://actdisain.com/deploy-hook.php?token=TOKEN
 *  https://actdisain.com/deploy-hook.php?token=TOKEN&migrate=true
 * ============================================================
 */

// ── Konfigurasi ─────────────────────────────────────────────────────────────
define('DEPLOY_TOKEN', getenv('DEPLOY_TOKEN') ?: 'ACT-Deploy-2024-kJ9x');
define('LARAVEL_ROOT', dirname(__DIR__));

// ── Deteksi PHP binary yang benar ────────────────────────────────────────────
// Shared hosting cPanel mempunyai PHP CLI di path yang berbeda-beda.
// Script ini mencoba satu per satu sampai ketemu yang bekerja.
function findPhpBin(): string
{
    $candidates = [
        '/opt/cpanel/ea-php82/root/usr/bin/php',  // cPanel EasyApache PHP 8.2
        '/opt/cpanel/ea-php81/root/usr/bin/php',  // cPanel EasyApache PHP 8.1
        '/opt/cpanel/ea-php80/root/usr/bin/php',  // cPanel EasyApache PHP 8.0
        '/usr/local/bin/php82',
        '/usr/local/bin/php81',
        '/usr/local/bin/php80',
        '/usr/local/bin/php',
        '/usr/bin/php82',
        '/usr/bin/php81',
        '/usr/bin/php',
        'php82',
        'php81',
        'php',
    ];

    foreach ($candidates as $bin) {
        // Coba jalankan php -r "echo 'ok';" untuk tes
        $test = shell_exec("$bin -r \"echo 'cli_ok';\" 2>&1");
        if ($test !== null && str_contains($test, 'cli_ok')) {
            return $bin;
        }
    }

    return 'php'; // fallback
}

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
function artisan(string $command, string $phpBin): array
{
    $artisan = LARAVEL_ROOT . '/artisan';
    // display_errors=1 agar error PHP terlihat di output
    $cmd     = "TERM=dumb $phpBin -d display_errors=1 -d error_reporting=32767 $artisan $command 2>&1";
    $start   = microtime(true);
    $output  = shell_exec($cmd);
    $elapsed = round((microtime(true) - $start) * 1000) . 'ms';
    return [
        'cmd'     => "artisan $command",
        'output'  => trim($output ?? '(no output — shell_exec returned null)'),
        'elapsed' => $elapsed,
    ];
}

// ── Validasi request ─────────────────────────────────────────────────────────
if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'POST'])) {
    respond(405, 'Method not allowed');
}

$token = $_GET['token'] ?? $_POST['token'] ?? '';
if (!hash_equals(DEPLOY_TOKEN, $token)) {
    sleep(2);
    respond(403, 'Forbidden: token tidak valid');
}

if (!function_exists('shell_exec')) {
    respond(500, 'shell_exec tidak tersedia. Hubungi hosting support.');
}

// ── Temukan PHP binary yang benar ────────────────────────────────────────────
$phpBin = findPhpBin();
$log    = [];
$log[]  = ['info' => "PHP binary ditemukan: $phpBin"];

// ── Baca parameter opsional ──────────────────────────────────────────────────
$runMigration = ($_GET['migrate'] ?? 'false') === 'true';

// ── Fix permissions vendor jika perlu ───────────────────────────────────────
$vendorPath = LARAVEL_ROOT . '/vendor';
$log[]      = ['info' => 'Memperbaiki permission vendor...'];
shell_exec("find $vendorPath -type f -exec chmod 644 {} \; 2>&1");
shell_exec("find $vendorPath -type d -exec chmod 755 {} \; 2>&1");
$log[]      = ['info' => 'Permission vendor selesai diperbaiki'];

// ── Jalankan post-deploy tasks ───────────────────────────────────────────────

// 1. Bersihkan semua cache lama
$log[] = artisan('cache:clear', $phpBin);

// 2. Cache konfigurasi
$log[] = artisan('config:cache', $phpBin);

// 3. Cache route
$log[] = artisan('route:cache', $phpBin);

// 4. Cache view/blade
$log[] = artisan('view:cache', $phpBin);

// 5. Storage link
$log[] = artisan('storage:link', $phpBin);

// 6. [OPSIONAL] Migration
if ($runMigration) {
    $log[] = ['info' => '⚠️ Menjalankan migration karena parameter migrate=true'];
    $log[] = artisan('migrate --force', $phpBin);
} else {
    $log[] = ['info' => '⏭️ Migration dilewati (gunakan ?migrate=true untuk menjalankan)'];
}

// 7. Optimasi
$log[] = artisan('optimize', $phpBin);

// ── Response ─────────────────────────────────────────────────────────────────
respond(200, 'Post-deploy selesai! 🎉', $log);
