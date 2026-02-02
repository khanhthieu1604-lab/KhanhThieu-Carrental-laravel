{{-- AI-Powered Chat Widget --}}
<div x-data="aiChatWidget()" x-cloak class="fixed bottom-8 right-8 z-50">
    {{-- Chat Window --}}
    <div x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="absolute bottom-20 right-0 w-96 max-w-[calc(100vw-2rem)] bg-white dark:bg-gray-900 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-800 overflow-hidden flex flex-col" style="height: 600px;">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 relative overflow-hidden flex-shrink-0">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-lg flex items-center justify-center relative">
                        <i class="fa-solid fa-robot text-white text-xl"></i>
                        <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white animate-pulse"></span>
                    </div>
                    <div>
                        <h3 class="text-white font-black text-lg">Thiuu AI Assistant</h3>
                        <p class="text-white/80 text-xs font-bold">Trợ lý thông minh</p>
                    </div>
                </div>
                <button @click="isOpen = false" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-white"></i>
                </button>
            </div>
        </div>

        {{-- Messages Container --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50 dark:bg-gray-950" x-ref="messagesContainer">
            {{-- Welcome Message --}}
            <template x-if="messages.length === 0">
                <div class="text-center py-8">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-sparkles text-white text-2xl"></i>
                    </div>
                    <h4 class="font-black text-gray-900 dark:text-white mb-2">Xin chào! 👋</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tôi là Thiuu AI, trợ lý ảo của bạn.<br>Tôi có thể giúp gì cho bạn?</p>
                </div>
            </template>

            {{-- Chat Messages --}}
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.type === 'user' ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white'"
                        class="max-w-[80%] rounded-2xl p-4 shadow-sm">
                        <p class="text-sm whitespace-pre-wrap" x-html="msg.text"></p>
                        <p class="text-[10px] mt-2 opacity-60" x-text="msg.time"></p>
                    </div>
                </div>
            </template>

            {{-- Typing Indicator --}}
            <template x-if="isTyping">
                <div class="flex justify-start">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm">
                        <div class="flex gap-1">
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Quick Actions --}}
        <div x-show="messages.length === 0" class="px-6 py-4 border-t border-gray-200 dark:border-gray-800 flex-shrink-0">
            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-3">Câu hỏi gợi ý:</p>
            <div class="flex flex-wrap gap-2">
                <button @click="sendMessage('Thuê xe cưới giá bao nhiêu?')" class="px-3 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl text-xs font-bold text-gray-700 dark:text-gray-300 transition-colors">
                    💍 Xe cưới
                </button>
                <button @click="sendMessage('Tư vấn chọn xe trong ngân sách 3 triệu')" class="px-3 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl text-xs font-bold text-gray-700 dark:text-gray-300 transition-colors">
                    💰 Tư vấn xe
                </button>
                <button @click="sendMessage('Thủ tục thuê xe như thế nào?')" class="px-3 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl text-xs font-bold text-gray-700 dark:text-gray-300 transition-colors">
                    📄 Thủ tục
                </button>
            </div>
        </div>

        {{-- Input Area --}}
        <div class="p-4 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 flex-shrink-0">
            <form @submit.prevent="sendMessage()" class="flex gap-2">
                <input x-model="inputMessage"
                    type="text"
                    placeholder="Nhập câu hỏi..."
                    class="flex-1 px-4 py-3 rounded-full bg-gray-100 dark:bg-gray-800 border-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-900 dark:text-white"
                    :disabled="isTyping">
                <button type="submit"
                    :disabled="!inputMessage.trim() || isTyping"
                    class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 text-white flex items-center justify-center hover:scale-105 transition-transform disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Floating Button --}}
    <button @click="toggleChat()"
        class="relative w-16 h-16 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 shadow-2xl hover:scale-110 transition-all duration-300 flex items-center justify-center group overflow-hidden">
        {{-- Ripple Effect --}}
        <div class="absolute inset-0 rounded-full bg-white/30 animate-ping"></div>

        {{-- Icon --}}
        <div class="relative z-10">
            <i x-show="!isOpen" class="fa-solid fa-robot text-white text-2xl"></i>
            <i x-show="isOpen" class="fa-solid fa-xmark text-white text-2xl"></i>
        </div>

        {{-- AI Badge --}}
        <span x-show="!isOpen" class="absolute -top-1 -right-1 px-2 py-1 bg-gradient-to-r from-yellow-400 to-yellow-500 text-black text-[8px] font-black rounded-full border-2 border-white dark:border-gray-900 uppercase tracking-wider">
            AI
        </span>
    </button>
</div>

<script>
    function aiChatWidget() {
        return {
            isOpen: false,
            isTyping: false,
            inputMessage: '',
            messages: [],

            init() {
                // Auto open after 5 seconds (optional)
                // setTimeout(() => { this.isOpen = true }, 5000);
            },

            toggleChat() {
                this.isOpen = !this.isOpen;
                if (this.isOpen && this.messages.length === 0) {
                    // Show welcome message
                    setTimeout(() => this.scrollToBottom(), 100);
                }
            },

            async sendMessage(message = null) {
                const text = message || this.inputMessage?.trim();
                if (!text) return;

                // Add user message
                this.messages.push({
                    type: 'user',
                    text: text,
                    time: new Date().toLocaleTimeString('vi-VN', {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                });

                this.inputMessage = '';
                this.isTyping = true;
                this.scrollToBottom();

                try {
                    const response = await fetch('/api/ai/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            message: text
                        })
                    });

                    const data = await response.json();

                    this.isTyping = false;

                    if (data.success) {
                        this.messages.push({
                            type: 'ai',
                            text: this.formatMarkdown(data.message),
                            time: new Date().toLocaleTimeString('vi-VN', {
                                hour: '2-digit',
                                minute: '2-digit'
                            })
                        });
                    } else {
                        this.messages.push({
                            type: 'ai',
                            text: '❌ Xin lỗi, đã có lỗi xảy ra. Vui lòng thử lại hoặc liên hệ hotline: <strong>0909.123.456</strong>',
                            time: new Date().toLocaleTimeString('vi-VN', {
                                hour: '2-digit',
                                minute: '2-digit'
                            })
                        });
                    }
                } catch (error) {
                    this.isTyping = false;
                    this.messages.push({
                        type: 'ai',
                        text: '❌ Không thể kết nối. Vui lòng kiểm tra internet hoặc gọi: <strong>0909.123.456</strong>',
                        time: new Date().toLocaleTimeString('vi-VN', {
                            hour: '2-digit',
                            minute: '2-digit'
                        })
                    });
                }

                this.scrollToBottom();
            },

            formatMarkdown(text) {
                // Simple markdown formatting
                return text
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.*?)\*/g, '<em>$1</em>')
                    .replace(/\n/g, '<br>');
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    const container = this.$refs.messagesContainer;
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                });
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }

    @keyframes ping {

        75%,
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .animate-ping {
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-4px);
        }
    }

    .animate-bounce {
        animation: bounce 1s infinite;
    }
</style>