<!-- Floating AI Assistant Widget (NVIDIA NIM - Gemma 4 31B) -->
<div id="trias-ai-widget" class="fixed bottom-6 right-6 z-50 font-sans">
    <!-- Jendela Chat -->
    <div id="trias-ai-window" class="hidden mb-4 w-[350px] sm:w-[390px] bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col transition-all">
        <!-- Header -->
        <div class="bg-teal-700 text-white px-4 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">smart_toy</span>
                </div>
                <div>
                    <h4 class="font-bold text-sm leading-tight">Asisten AI Trias Medika</h4>
                    <p class="text-[11px] text-teal-100 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 inline-block"></span>
                        Powered by NVIDIA NIM
                    </p>
                </div>
            </div>
            <button type="button" onclick="toggleTriasAi()" class="p-1.5 rounded-lg hover:bg-white/15 transition-colors" aria-label="Tutup Chat AI">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <!-- Area Pesan -->
        <div id="trias-ai-messages" class="p-4 h-80 overflow-y-auto space-y-3 bg-slate-50 text-sm">
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center shrink-0 mt-0.5">
                    <span class="material-symbols-outlined text-base">auto_awesome</span>
                </div>
                <div class="bg-white border border-slate-200 text-slate-700 rounded-2xl rounded-tl-none px-3.5 py-2.5 shadow-sm leading-relaxed">
                    Halo! Saya <strong>Asisten AI Klinik Trias Medika</strong>. Saya bisa membantu merangkum isi website, merekomendasikan layanan poli, atau berdiskusi seputar keluhan kesehatan Anda. Ada yang bisa dibantu?
                </div>
            </div>
        </div>

        <!-- Tombol Pertanyaan Cepat (Quick Prompts) -->
        <div class="px-3 py-2 bg-white border-t border-slate-100 flex gap-1.5 overflow-x-auto">
            <button type="button" onclick="sendQuickPrompt('Buatkan kesimpulan isi website Klinik Trias Medika secara singkat.')" class="shrink-0 text-xs bg-teal-50 hover:bg-teal-100 text-teal-800 font-medium px-2.5 py-1 rounded-full border border-teal-200 transition">
                Ringkas Isi Web
            </button>
            <button type="button" onclick="sendQuickPrompt('Rekomendasikan layanan poli jika saya mengalami sakit gigi dan gusi bengkak.')" class="shrink-0 text-xs bg-teal-50 hover:bg-teal-100 text-teal-800 font-medium px-2.5 py-1 rounded-full border border-teal-200 transition">
                Rekomendasi Poli
            </button>
            <button type="button" onclick="sendQuickPrompt('Bagaimana cara membuat janji temu online dan apakah menerima BPJS?')" class="shrink-0 text-xs bg-teal-50 hover:bg-teal-100 text-teal-800 font-medium px-2.5 py-1 rounded-full border border-teal-200 transition">
                Cara Janji Temu
            </button>
        </div>

        <!-- Form Input -->
        <form id="trias-ai-form" onsubmit="submitTriasAi(event)" class="p-3 bg-white border-t border-slate-200 flex items-center gap-2">
            <input
                type="text"
                id="trias-ai-input"
                placeholder="Tulis pertanyaan atau keluhan Anda..."
                autocomplete="off"
                required
                class="flex-1 text-sm bg-slate-100 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-teal-600 focus:bg-white"
            >
            <button type="submit" id="trias-ai-submit" class="h-10 w-10 rounded-xl bg-teal-700 hover:bg-teal-800 text-white flex items-center justify-center shrink-0 transition shadow-sm" aria-label="Kirim Pesan">
                <span class="material-symbols-outlined text-lg">send</span>
            </button>
        </form>
    </div>

    <!-- Tombol Bulat Floating -->
    <button type="button" onclick="toggleTriasAi()" class="ml-auto h-14 px-5 rounded-full bg-teal-700 hover:bg-teal-800 text-white font-bold text-sm shadow-lg hover:shadow-xl flex items-center gap-2.5 transition-all">
        <span class="material-symbols-outlined text-2xl">smart_toy</span>
        <span>Tanya AI Klinik</span>
    </button>
</div>

<script>
    const triasAiHistory = [];

    function toggleTriasAi() {
        const win = document.getElementById('trias-ai-window');
        win.classList.toggle('hidden');
        if (!win.classList.contains('hidden')) {
            document.getElementById('trias-ai-input').focus();
        }
    }

    function sendQuickPrompt(text) {
        const input = document.getElementById('trias-ai-input');
        input.value = text;
        document.getElementById('trias-ai-form').dispatchEvent(new Event('submit'));
    }

    function formatAiText(text) {
        // Escape HTML dasar untuk mencegah XSS, lalu ubah **bold** dan baris baru
        const escaped = text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
        return escaped
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\n/g, '<br>');
    }

    function appendMessage(role, text) {
        const container = document.getElementById('trias-ai-messages');
        const wrapper = document.createElement('div');

        if (role === 'user') {
            wrapper.className = 'flex justify-end';
            wrapper.innerHTML = `
                <div class="bg-teal-700 text-white rounded-2xl rounded-tr-none px-3.5 py-2.5 max-w-[82%] shadow-sm leading-relaxed">
                    ${formatAiText(text)}
                </div>
            `;
        } else {
            wrapper.className = 'flex items-start gap-2.5';
            wrapper.innerHTML = `
                <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center shrink-0 mt-0.5">
                    <span class="material-symbols-outlined text-base">auto_awesome</span>
                </div>
                <div class="bg-white border border-slate-200 text-slate-700 rounded-2xl rounded-tl-none px-3.5 py-2.5 max-w-[85%] shadow-sm leading-relaxed">
                    ${formatAiText(text)}
                </div>
            `;
        }

        container.appendChild(wrapper);
        container.scrollTop = container.scrollHeight;
    }

    async function submitTriasAi(e) {
        e.preventDefault();
        const input = document.getElementById('trias-ai-input');
        const submitBtn = document.getElementById('trias-ai-submit');
        const container = document.getElementById('trias-ai-messages');
        const message = input.value.trim();

        if (!message) return;

        appendMessage('user', message);
        input.value = '';
        input.disabled = true;
        submitBtn.disabled = true;

        // Indikator mengetik
        const loadingId = 'ai-loading-' + Date.now();
        const loadingEl = document.createElement('div');
        loadingEl.id = loadingId;
        loadingEl.className = 'flex items-center gap-2 text-xs text-slate-500 pl-9';
        loadingEl.innerHTML = `<span class="animate-pulse">Asisten AI sedang menyusun jawaban...</span>`;
        container.appendChild(loadingEl);
        container.scrollTop = container.scrollHeight;

        try {
            const response = await fetch("{{ route('ai.chat') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    message: message,
                    history: triasAiHistory.slice(-6)
                })
            });

            const data = await response.json();
            document.getElementById(loadingId)?.remove();

            const replyText = data.reply || 'Maaf, tidak ada respons dari server.';
            appendMessage('assistant', replyText);

            triasAiHistory.push({ role: 'user', content: message });
            triasAiHistory.push({ role: 'assistant', content: replyText });
        } catch (err) {
            document.getElementById(loadingId)?.remove();
            appendMessage('assistant', 'Gagal terhubung ke server. Silakan periksa koneksi Anda.');
        } finally {
            input.disabled = false;
            submitBtn.disabled = false;
            input.focus();
        }
    }
</script>