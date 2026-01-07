@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<div class="bg-white dark:bg-[#020202] min-h-screen py-24 transition-colors duration-700 relative overflow-hidden font-sans">
    
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
        <div class="absolute top-[-5%] left-[-5%] w-[30%] h-[30%] bg-blue-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-5%] right-[-5%] w-[30%] h-[30%] bg-emerald-500/5 rounded-full blur-[120px]"></div>
    </div>

    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        
        
        <div class="text-center mb-24 reveal-header">
            <div class="inline-flex items-center gap-3 py-2 px-6 rounded-full bg-zinc-900 dark:bg-white/5 border border-zinc-100 dark:border-white/10 backdrop-blur-xl mb-10 shadow-2xl">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-zinc-900 dark:text-zinc-300">Secure Payment Gateway</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tighter uppercase mb-6 leading-none">
                Giao dịch <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-emerald-400 to-cyan-500 opacity-90">Kỹ thuật số.</span>
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 max-w-xl mx-auto text-sm uppercase tracking-[0.2em] font-medium leading-relaxed">
                Tích hợp đa nền tảng, bảo mật tuyệt đối cho mọi hành trình Elite của quý khách.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            
            <div class="lg:col-span-7 space-y-8 reveal-left">
                <div class="p-10 rounded-[3rem] bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 backdrop-blur-md">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="w-12 h-12 rounded-2xl bg-zinc-900 dark:bg-white text-white dark:text-black flex items-center justify-center text-xl shadow-xl">
                            <i class="fa-solid fa-vault"></i>
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Chuyển khoản Priority</h3>
                    </div>

                    
                    <div class="credit-card-wrap perspective-lg">
                        <div class="credit-card relative h-64 md:h-72 w-full rounded-[2.5rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(0,0,0,0.3)] transition-transform duration-500 ease-out" id="priorityCard">
                            
                            <div class="absolute inset-0 bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#020617]"></div>
                            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-[80px] -mr-20 -mt-20"></div>
                            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
                            
                            <div class="relative p-10 h-full flex flex-col justify-between text-white">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-[9px] font-black text-emerald-500 uppercase tracking-[0.4em] mb-1">Elite Banking</p>
                                        <p class="text-xl font-black tracking-tight uppercase">Military Bank (MB)</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <i class="fa-brands fa-cc-visa text-4xl opacity-90"></i>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-2">Số tài khoản định danh</p>
                                    <div class="flex items-center gap-4">
                                        <p class="text-3xl md:text-5xl font-mono tracking-[0.2em] font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-zinc-500" id="bankNumber">0909 123 456</p>
                                        <button onclick="copyToClipboard('0909123456')" class="w-10 h-10 rounded-full bg-white/10 hover:bg-emerald-500 hover:text-black flex items-center justify-center backdrop-blur-sm transition-all group/copy">
                                            <i class="fa-regular fa-copy group-active/copy:scale-90 transition-transform"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-[9px] font-bold text-zinc-500 uppercase tracking-widest mb-1">Elite Member Name</p>
                                        <p class="text-sm font-black uppercase tracking-[0.2em]">LUONG KHANH THIEU</p>
                                    </div>
                                    <div class="w-14 h-10 bg-gradient-to-br from-zinc-400 to-zinc-600 rounded-lg opacity-80 flex items-center justify-center overflow-hidden">
                                        <div class="w-full h-px bg-black/20 my-1"></div>
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/EMV_Chip.svg/100px-EMV_Chip.svg.png" class="h-8 brightness-110">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex items-center gap-4 p-6 bg-zinc-900/5 dark:bg-white/5 rounded-2xl border border-dashed border-zinc-200 dark:border-white/10">
                        <i class="fa-solid fa-circle-info text-emerald-500 animate-pulse"></i>
                        <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">
                            Cú pháp mặc định: <span class="text-zinc-900 dark:text-white">[Số điện thoại] + [Tên xe]</span>
                        </p>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-5 space-y-8 reveal-right">
                
                
                <div class="group bg-zinc-50/50 dark:bg-white/[0.02] border border-zinc-100 dark:border-white/5 p-10 rounded-[3rem] flex flex-col gap-8 transition-all hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">Quét mã VietQR</h3>
                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-[8px] font-black uppercase tracking-widest">Auto Detect</span>
                    </div>
                    <div class="relative w-48 h-48 mx-auto p-4 bg-white rounded-3xl shadow-xl overflow-hidden group-hover:scale-105 transition-transform duration-500">
                        <img src="https://img.vietqr.io/image/MB-0909123456-compact2.png" class="w-full h-full object-contain">
                        <div class="absolute inset-0 border-2 border-emerald-500/20 rounded-3xl animate-pulse"></div>
                    </div>
                    <p class="text-zinc-500 dark:text-zinc-400 text-xs leading-relaxed text-center font-light italic">
                        "Hỗ trợ tất cả ứng dụng Ngân hàng & Ví điện tử. <br> Xác nhận giao dịch trong 30 giây."
                    </p>
                </div>

                
                <div class="p-10 rounded-[3rem] bg-zinc-900 dark:bg-white text-white dark:text-black relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-10 opacity-10 rotate-45 pointer-events-none group-hover:rotate-90 transition-transform duration-1000">
                        <i class="fa-solid fa-money-bill-transfer text-[150px]"></i>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-xl font-black uppercase tracking-tighter mb-4">Giao dịch trực tiếp</h3>
                        <p class="text-zinc-400 dark:text-zinc-500 text-xs mb-8 font-light">Thanh toán tại showroom hoặc trực tiếp cho nhân viên bàn giao xe tại địa điểm của quý khách.</p>
                        <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-widest border-b border-amber-500 pb-1 hover:text-amber-500 transition-colors">
                            Vị trí Showroom <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-2"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>

    
    <div id="copyToast" class="fixed bottom-10 left-1/2 -translate-x-1/2 bg-zinc-900 dark:bg-white text-white dark:text-black px-8 py-4 rounded-full text-[10px] font-black uppercase tracking-widest shadow-2xl transform translate-y-20 opacity-0 transition-all duration-500 pointer-events-none z-50 backdrop-blur-xl flex items-center gap-3 border border-white/10">
        <i class="fa-solid fa-shield-check text-emerald-500"></i> Đã sao chép định danh ngân hàng
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    
    const tl = anime.timeline({ easing: 'easeOutExpo' });

    tl.add({
        targets: '.reveal-header',
        opacity: [0, 1],
        translateY: [50, 0],
        duration: 1500,
        delay: 200
    })
    .add({
        targets: '.reveal-left',
        opacity: [0, 1],
        translateX: [-50, 0],
        duration: 1200,
        offset: '-=1000'
    })
    .add({
        targets: '.reveal-right',
        opacity: [0, 1],
        translateX: [50, 0],
        duration: 1200,
        offset: '-=1200'
    });

    
    const card = document.getElementById('priorityCard');
    const cardWrap = document.querySelector('.credit-card-wrap');

    cardWrap.addEventListener('mousemove', (e) => {
        const rect = cardWrap.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = (y - centerY) / 10;
        const rotateY = (centerX - x) / 10;

        card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
    });

    cardWrap.addEventListener('mouseleave', () => {
        card.style.transform = `rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
    });
});


function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copyToast');
        toast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 3000);
    });
}
</script>

<style>
    .perspective-lg { perspective: 2000px; }
    .credit-card { transform-style: preserve-3d; will-change: transform; }
    
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
</style>
@endsection