<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\About;

class SiteTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Homepage Settings
        $homepage = \App\Models\HomepageSetting::first();
        if (!$homepage) {
            $homepage = new \App\Models\HomepageSetting();
        }
        
        if (empty($homepage->about_description)) {
            $homepage->about_description = "KOMUNITAS MASYARAKAT DESA-SULAWESI TENGGARA (Komdes Sultra) adalah organisasi masyarakat sipil yang berfokus pada isu-isu pedesaan, lingkungan, dan ruang hidup masyarakat.\n\nMelalui edukasi, riset, dan advokasi kebijakan, Komdes Sultra berupaya mendorong pengelolaan sumber daya alam yang adil dan berkelanjutan untuk kesejahteraan masyarakat.";
        }
        if (empty($homepage->network_subtitle)) $homepage->network_subtitle = 'Jejaring komunitas dan organisasi yang berkolaborasi bersama Komdes Sultra.';
        if (empty($homepage->issue_subtitle)) $homepage->issue_subtitle = 'Isu-isu strategis yang menjadi fokus utama kegiatan Komdes Sultra.';
        if (empty($homepage->agenda_subtitle)) $homepage->agenda_subtitle = 'Ikuti berbagai kegiatan edukasi, diskusi, dan pelatihan bersama Komdes Sultra.';
        if (empty($homepage->publication_subtitle)) $homepage->publication_subtitle = 'Kumpulan berita, artikel, dan laporan riset terbaru dari Komdes Sultra.';
        if (empty($homepage->gallery_subtitle)) $homepage->gallery_subtitle = 'Kumpulan foto dokumentasi aksi lapangan dan kegiatan Komdes Sultra.';
        
        $homepage->save();

        // 2. Seed Hero & Footer Texts
        $heroKeys = [
            'hero_about_text' => 'Mengenal lebih dekat visi dan arah pergerakan Komdes Sultra.',
            'hero_event_text' => 'Informasi detail terkait agenda kegiatan Komdes Sultra.',
            'hero_issue_text' => 'Berbagai isu strategis yang menjadi fokus utama gerakan Komdes Sultra.',
            'hero_news_text' => 'Kabar terkini seputar pelaksanaan kegiatan Komdes Sultra.',
            'hero_article_text' => 'Kumpulan tulisan, gagasan, dan cerita menarik dari perjalanan Komdes Sultra.',
            'hero_research_text' => 'Laporan dan dokumentasi hasil riset Komdes Sultra.',
            'hero_press_text' => 'Pernyataan resmi dan sikap kelembagaan Komdes Sultra menyikapi isu publik.',
            'hero_gallery_text' => 'Kumpulan foto dokumentasi berbagai kegiatan Komdes Sultra.',
            'footer_description' => 'Komunitas Masyarakat Desa-Sulawesi Tenggara (Komdes Sultra) hadir untuk memberdayakan masyarakat dan menjaga kelestarian lingkungan.',
        ];

        foreach ($heroKeys as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Seed About Page Texts if empty
        $about = About::first();
        if (!$about) {
            $about = new About();
            $about->id = 1;
        }

        // Only update if they are currently null or empty
        if (empty($about->hero_description)) {
            $about->hero_description = 'Mengenal lebih dekat KOMUNITAS MASYARAKAT DESA-SULAWESI TENGGARA (Komdes Sultra) sebagai wadah kolaborasi untuk kelestarian alam dan kesejahteraan masyarakat.';
        }
        if (empty($about->profil_singkat)) {
            $about->profil_singkat = 'Komdes Sultra didirikan atas dasar kepedulian terhadap kelestarian ekosistem dan kesejahteraan masyarakat. Organisasi ini percaya bahwa kolaborasi dan edukasi adalah kunci utama untuk menjaga keseimbangan alam sekaligus memajukan kemandirian ekonomi.';
        }
        if (empty($about->mengapa_komdes)) {
            $about->mengapa_komdes = 'Komdes Sultra hadir sebagai jembatan penghubung antara masyarakat akar rumput, pemerintah, dan pemangku kepentingan lainnya. Dengan komitmen pada pembangunan yang inklusif, Komdes Sultra berupaya menginisiasi program-program berkelanjutan yang memberikan dampak positif secara langsung bagi lingkungan dan masyarakat luas.';
        }
        if (empty($about->tujuan_quote)) {
            $about->tujuan_quote = '"Melangkah bersama masyarakat, menjaga kelestarian alam, dan mewujudkan kesejahteraan yang berkelanjutan dan berkeadilan."';
        }

        $about->save();
    }
}
