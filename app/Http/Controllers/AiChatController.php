<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array|max:10',
        ]);

        $apiKey = config('services.nvidia.api_key');
        $model  = config('services.nvidia.model', 'nvidia/nemotron-3.5-lightning-30b-a3b');

        if (empty($apiKey)) {
            return response()->json([
                'reply' => 'Konfigurasi API Key NVIDIA belum ditemukan di server.'
            ], 500);
        }

        // Pengetahuan dasar website Klinik Trias Medika
        $systemPrompt = <<<PROMPT
Anda adalah Asisten Virtual AI resmi untuk website "Klinik Trias Medika".
Tugas utama Anda membantu pengunjung website untuk:
1. Chat & tanya jawab informasi klinik.
2. Diskusi kesehatan ringan & edukasi awal (selalu ingatkan bahwa saran AI tidak menggantikan pemeriksaan langsung oleh dokter).
3. Memberikan rekomendasi layanan poli/dokter yang tepat berdasarkan keluhan pengunjung.
4. Membuat kesimpulan/ringkasan isi website Klinik Trias Medika.

Informasi Resmi Website Klinik Trias Medika:
- Layanan Medis: Poli Umum, Poli Gigi, Kesehatan Ibu & Anak (KIA), Ruang Bersalin 24 Jam, Unit Gawat Darurat (UGD) 24 Jam, Laboratorium Modern, dan Farmasi/Apotek terintegrasi.
- Penjaminan & Kemitraan: Menerima pasien BPJS Kesehatan maupun Pasien Umum, bermitra dengan GERMAS Kemenkes RI dan Ikatan Bidan Indonesia (IBI).
- Fitur & Navigasi Website:
  - Beranda: Informasi profil klinik, kemitraan, dan fasilitas medis.
  - Jadwal Dokter: Daftar lengkap nama dokter umum, dokter gigi, dan bidan beserta jam praktiknya.
  - Buat Janji Temu (Booking Online): Pendaftaran pasien secara online tanpa antre lama, dilengkapi cetak tiket antrean PDF & verifikasi QR Code.
  - Pusat Informasi & Kontak: Formulir kontak langsung ke WhatsApp Admin (0812-8899-7722) serta informasi aksesibilitas.
- Kontak Darurat: Hotline UGD 24 Jam di (021) 590-3321.

Aturan Jawaban:
- Gunakan bahasa Indonesia yang ramah, sopan, jelas, dan terstruktur (gunakan poin-poin singkat jika merangkum atau merekomendasikan).
- Jawab secara singkat, padat, dan langsung ke inti (maksimal 3-4 poin singkat atau maksimal 100 kata) tanpa bertele-tele agar respons cepat tampil di jendela chat.
- DILARANG mengarang nama dokter atau menulis placeholder seperti "<Nama Dokter>". Jika pengunjung menanyakan daftar nama atau jadwal praktik dokter, jelaskan poli yang tersedia (Poli Umum, Poli Gigi, dan KIA/Bidan) lalu arahkan pengunjung untuk melihat daftar nama & jam praktik lengkapnya pada menu "Jadwal Dokter" di website atau menghubungi WhatsApp Admin (0812-8899-7722).
- Jika kondisi terdengar gawat darurat, segera arahkan untuk menghubungi Hotline UGD (021) 590-3321 atau datang langsung ke UGD 24 Jam.
PROMPT;

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt],
        ];

        // Sertakan riwayat percakapan sebelumnya agar mendukung diskusi multi-turn
        if (!empty($validated['history'])) {
            foreach ($validated['history'] as $item) {
                if (
                    isset($item['role'], $item['content']) &&
                    in_array($item['role'], ['user', 'assistant']) &&
                    is_string($item['content'])
                ) {
                    $messages[] = [
                        'role'    => $item['role'],
                        'content' => mb_substr($item['content'], 0, 1000),
                    ];
                }
            }
        }

        $messages[] = [
            'role'    => 'user',
            'content' => $validated['message'],
        ];

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(9)
                ->post('https://integrate.api.nvidia.com/v1/chat/completions', [
                    'model'                => $model,
                    'messages'             => $messages,
                    'temperature'          => 0.4,
                    'max_tokens'           => 1024,
                    'stream'               => false,
                    'chat_template_kwargs' => [
                        'enable_thinking' => false,
                    ],
                ]);

            if ($response->failed()) {
                Log::error('NVIDIA API Error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                return response()->json([
                    'reply' => 'Maaf, asisten AI sedang sibuk memproses permintaan. Silakan coba beberapa saat lagi.'
                ], 502);
            }

            $content = $response->json('choices.0.message.content');

            if (empty($content)) {
                Log::warning('NVIDIA Empty Content Response', [
                    'model' => $model,
                    'body'  => $response->json(),
                ]);

                return response()->json([
                    'reply' => 'Maaf, saya belum dapat menghasilkan jawaban saat ini.'
                ]);
            }

            // Bersihkan tag penalaran internal jika model masih menyertakannya
            $reply = preg_replace('/<think>.*?<\/think>/s', '', $content);

            return response()->json([
                'reply' => trim($reply),
            ]);
        } catch (\Throwable $e) {
            Log::error('NVIDIA Connection Exception: ' . $e->getMessage());

            return response()->json([
                'reply' => 'Server AI sedang padat. Silakan kirim ulang pertanyaan Anda beberapa detik lagi.'
            ], 500);
        }
    }
}