<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$settings = [
    'hero_news_text' => 'Liputan peristiwa terkini, informasi aktual, dan laporan faktual seputar kegiatan serta advokasi Komdes Sultra.',
    'hero_article_text' => 'Kumpulan opini, kajian mendalam, dan tulisan inspiratif yang menggali lebih jauh tentang program dan isu-isu masyarakat desa.',
];

foreach ($settings as $key => $value) {
    \App\Models\SiteSetting::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
    );
}

echo "DB Updated successfully!";
