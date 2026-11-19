<!-- Floating AI Assistant Widget (NVIDIA NIM - Gemma 4 31B) -->
<style>
    #trias-ai-widget {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }
    #trias-ai-window {
        width: 375px;
        max-width: calc(100vw - 32px);
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.18);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 14px;
        display: flex;
        flex-direction: column;
    }
    #trias-ai-window.ai-hidden {
        display: none !important;
    }
    .trias-ai-header {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        color: #ffffff;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .trias-ai-header-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .trias-ai-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .trias-ai-title {
        margin: 0;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.25;
        color: #ffffff;
    }
    .trias-ai-status {
        margin: 2px 0 0;
        font-size: 11px;
        color: #d1fae5;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .trias-ai-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #6ee7b7;
        display: inline-block;
    }
    .trias-ai-close {
        background: transparent;
        border: none;
        color: #ffffff;
        padding: 6px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .trias-ai-close:hover {
        background: rgba(255, 255, 255, 0.15);
    }
    #trias-ai-messages {
        height: 310px;
        overflow-y: auto;
        padding: 16px;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-size: 13.5px;
        line-height: 1.55;
    }
    .trias-msg-row-ai {
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }
    .trias-msg-badge {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: #d1fae5;
        color: #047857;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .trias-bubble-ai {
        background: #ffffff;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        border-radius: 16px 16px 16px 4px;
        padding: 10px 14px;
        max-width: 84%;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    .trias-msg-row-user {
        display: flex;
        justify-content: flex-end;
    }
    .trias-bubble-user {
        background: #047857;
        color: #ffffff;
        border-radius: 16px 16px 4px 16px;
        padding: 10px 14px;
        max-width: 82%;
        box-shadow: 0 2px 6px rgba(4, 120, 87, 0.22);
    }
    .trias-quick-bar {
        padding: 8px 12px;
        background: #ffffff;
        border-top: 1px solid #f1f5f9;
        display: flex;
        gap: 6px;
        overflow-x: auto;
    }
    .trias-quick-btn {
        flex-shrink: 0;
        font-size: 11.5px;
        font-weight: 600;
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        border-radius: 9999px;
        padding: 5px 11px;
        cursor: pointer;
        transition: background 0.15s ease;
    }
    .trias-quick-btn:hover {
        background: #d1fae5;
    }
    #trias-ai-form {
        padding: 10px 12px;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    #trias-ai-input {
        flex: 1;
        font-size: 13.5px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 10px 13px;
        color: #0f172a;
        outline: none;
    }
    #trias-ai-input:focus {
        border-color: #047857;
        background: #ffffff;
    }
    #trias-ai-submit {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #047857;
        color: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.15s ease;
    }
    #trias-ai-submit:hover {
        background: #065f46;
    }
    #trias-ai-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    #trias-ai-launcher {
        margin-left: auto;
        height: 52px;
        padding: 0 20px;
        border-radius: 9999px;
        background: #047857;
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.25);
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 10px 25px rgba(4, 120, 87, 0.38);
        display: flex;
        align-items: center;
        gap: 9px;
        cursor: pointer;
        transition: transform 0.15s ease, background 0.15s ease;
    }
    #trias-ai-launcher:hover {
        background: #065f46;
        transform: translateY(-2px);
    }
    .trias-ai-typing {
        font-size: 12px;
        color: #64748b;
        padding-left: 36px;
        font-style: italic;
    }
</style>

<div id="trias-ai-widget">
    <!-- Jendela Chat -->
    <div id="trias-ai-window" class="ai-hidden">
        <!-- Header -->
        <div class="trias-ai-header">
            <div class="trias-ai-header-info">
                <div class="trias-ai-avatar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>
                    </svg>
                </div>
                <div>
                    <h4 class="trias-ai-title">Asisten AI Trias Medika</h4>
                    <p class="trias-ai-status">
                        <span class="trias-ai-dot"></span>
                        Powered by NVIDIA NIM
                    </p>
                </div>
            </div>
            <button type="button" onclick="toggleTriasAi()" class="trias-ai-close" aria-label="Tutup Chat AI">
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                </svg>
            </button>
        </div>

        <!-- Area Pesan -->
        <div id="trias-ai-messages">
            <div class="trias-msg-row-ai">
                <div class="trias-msg-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
                    </svg>
                </div>
                <div class="trias-bubble-ai">
                    Halo! Saya <strong>Asisten AI Klinik Trias Medika</strong>. Saya siap membantu merangkum isi website, merekomendasikan layanan poli, atau berdiskusi seputar keluhan kesehatan Anda. Ada yang bisa dibantu?
                </div>
            </div>
        </div>

        <!-- Tombol Pertanyaan Cepat (Quick Prompts) -->
        <div class="trias-quick-bar">
            <button type="button" onclick="sendQuickPrompt('Buatkan kesimpulan isi website Klinik Trias Medika secara singkat.')" class="trias-quick-btn">
                Ringkas Isi Web
            </button>
            <button type="button" onclick="sendQuickPrompt('Rekomendasikan layanan poli jika saya mengalami sakit gigi dan gusi bengkak.')" class="trias-quick-btn">
                Rekomendasi Poli
            </button>
            <button type="button" onclick="sendQuickPrompt('Bagaimana cara membuat janji temu online dan apakah menerima BPJS?')" class="trias-quick-btn">
                Cara Janji Temu
            </button>
        </div>

        <!-- Form Input -->
        <form id="trias-ai-form" onsubmit="submitTriasAi(event)">
            <input
                type="text"
                id="trias-ai-input"
                placeholder="Tulis pertanyaan atau keluhan Anda..."
                autocomplete="off"
                required
            >
            <button type="submit" id="trias-ai-submit" aria-label="Kirim Pesan">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Tombol Bulat Floating -->
    <button type="button" id="trias-ai-launcher" onclick="toggleTriasAi()">
        <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>
        </svg>
        <span>Tanya AI Klinik</span>
    </button>
</div>

<script>
    const triasAiHistory = [];

    function toggleTriasAi() {
        const win = document.getElementById('trias-ai-window');
        win.classList.toggle('ai-hidden');
        if (!win.classList.contains('ai-hidden')) {
            document.getElementById('trias-ai-input').focus();
        }
    }

    function sendQuickPrompt(text) {
        const input = document.getElementById('trias-ai-input');
        input.value = text;
        document.getElementById('trias-ai-form').dispatchEvent(new Event('submit'));
    }

    function formatAiText(text) {
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
            wrapper.className = 'trias-msg-row-user';
            wrapper.innerHTML = `<div class="trias-bubble-user">${formatAiText(text)}</div>`;
        } else {
            wrapper.className = 'trias-msg-row-ai';
            wrapper.innerHTML = `
                <div class="trias-msg-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
                    </svg>
                </div>
                <div class="trias-bubble-ai">${formatAiText(text)}</div>
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

        const loadingId = 'ai-loading-' + Date.now();
        const loadingEl = document.createElement('div');
        loadingEl.id = loadingId;
        loadingEl.className = 'trias-ai-typing';
        loadingEl.textContent = 'Asisten AI sedang menyusun jawaban...';
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