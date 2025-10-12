@extends('layouts.app')

@section('title', 'Support the Developer - iNeedCinema')
@section('description', 'Support iNeedCinema development and help cover server costs through Ko-fi.')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-900 to-black">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-yellow-500 via-orange-500 to-red-500 rounded-2xl mb-6 animate-pulse">
                    <i class="fas fa-heart text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                    Support the Developer
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                    Help keep iNeedCinema running and support continued development
                </p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto space-y-8">
            
            <!-- Ko-fi Widget Card -->
            <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-700/50 p-8 md:p-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-4">Support the Project 💖</h2>
                    <p class="text-gray-300 leading-relaxed max-w-2xl mx-auto">
                        This is a passion project built and maintained by one developer. Your support helps cover server costs, 
                        API fees, and motivates me to keep improving the platform!
                    </p>
                </div>

                <!-- Dual Payment Options -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <!-- Ko-fi (International) -->
                    <div class="bg-gray-900/50 border border-blue-500/30 rounded-xl p-6 hover:border-blue-500/60 transition-all">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-globe text-blue-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">International (USD)</h3>
                                <p class="text-xs text-gray-400">PayPal, Cards via Ko-fi</p>
                            </div>
                        </div>
                        <a href="https://ko-fi.com/raidenahnie" target="_blank" 
                           class="block w-full text-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                            <i class="fas fa-coffee mr-2"></i>
                            Ko-fi Donation
                        </a>
                    </div>

                    <!-- GCash (Philippines) -->
                    <div class="bg-gray-900/50 border border-green-500/30 rounded-xl p-6 hover:border-green-500/60 transition-all">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-green-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Philippines (PHP)</h3>
                                <p class="text-xs text-gray-400">GCash</p>
                            </div>
                        </div>
                        <button onclick="showGCashModal()" 
                                class="block w-full text-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-green-500/50 transition-all duration-300">
                            <i class="fas fa-qrcode mr-2"></i>
                            GCash Donation
                        </button>
                    </div>
                </div>

                <p class="text-center text-gray-400 text-sm">
                    <i class="fas fa-heart text-red-500 mr-1"></i>
                    Choose your preferred payment method • All support is appreciated!
                </p>
            </div>

            <!-- Why Support Section -->
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-800/30 backdrop-blur-xl rounded-xl border border-gray-700/50 p-6 hover:border-red-500/50 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-server text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Server Costs</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Hosting, domain, SSL certificates, and API usage fees add up. Your support keeps the site online!
                    </p>
                </div>

                <div class="bg-gray-800/30 backdrop-blur-xl rounded-xl border border-gray-700/50 p-6 hover:border-red-500/50 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-code text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Development Time</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Hundreds of hours go into building features, fixing bugs, and improving the user experience.
                    </p>
                </div>

                <div class="bg-gray-800/30 backdrop-blur-xl rounded-xl border border-gray-700/50 p-6 hover:border-red-500/50 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-rocket text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Future Features</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Better search, more content, faster loading, and new features are always in development!
                    </p>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-yellow-500 text-2xl"></i>
                    </div>
                    <div class="text-gray-300">
                        <h3 class="text-lg font-semibold text-yellow-400 mb-2">Important Disclaimer</h3>
                        <ul class="space-y-2 text-sm">
                            <li>✓ <strong>100% Voluntary:</strong> All donations are completely optional</li>
                            <li>✓ <strong>No Unlocked Content:</strong> All content remains free for everyone</li>
                            <li>✓ <strong>No Refunds:</strong> Donations are non-refundable as they support ongoing development</li>
                            <li>✓ <strong>Not for Content:</strong> Donations support the developer and platform, not copyrighted content</li>
                            <li>✓ <strong>Independent Project:</strong> This is a personal passion project, not a company</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="bg-gray-800/30 backdrop-blur-xl rounded-2xl border border-gray-700/50 p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-question-circle text-blue-500 mr-3"></i>
                    Frequently Asked Questions
                </h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Is this a subscription?</h3>
                        <p class="text-gray-400">
                            No! Ko-fi allows one-time donations. You can support once or set up monthly support if you choose, 
                            but there's no obligation or subscription required.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Will I get special features?</h3>
                        <p class="text-gray-400">
                            No. All content and features remain 100% free for everyone. Donations simply help keep the site running 
                            and support development time.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Where does the money go?</h3>
                        <p class="text-gray-400">
                            Your support covers: server hosting (~$15-30/month), domain renewal (~$12/year), SSL certificates, 
                            development tools, and my time maintaining and improving the site.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Can I donate anonymously?</h3>
                        <p class="text-gray-400">
                            Yes! Ko-fi allows anonymous donations. Your financial information is handled by Ko-fi/PayPal, 
                            not by this website.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Are you monetizing copyrighted content?</h3>
                        <p class="text-gray-400">
                            <strong>No.</strong> We do not host, own, or distribute any content. Donations support the developer 
                            and platform infrastructure, not content acquisition or distribution.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Alternative Support Methods -->
            <div class="bg-gray-800/30 backdrop-blur-xl rounded-2xl border border-gray-700/50 p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-hands-helping text-green-500 mr-3"></i>
                    Other Ways to Support
                </h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-share-alt text-blue-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Share with Friends</h3>
                            <p class="text-gray-400 text-sm">Tell others about iNeedCinema if you find it useful!</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-star text-purple-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Provide Feedback</h3>
                            <p class="text-gray-400 text-sm">Report bugs and suggest features to help improve the site</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <i class="fab fa-github text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Contribute Code</h3>
                            <p class="text-gray-400 text-sm">If you're a developer, contributions are always welcome!</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-heart text-red-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Just Say Thanks</h3>
                            <p class="text-gray-400 text-sm">Kind words and appreciation mean a lot too! 💙</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thank You Message -->
            <div class="text-center bg-gradient-to-r from-red-500/10 via-pink-500/10 to-purple-500/10 border border-red-500/30 rounded-2xl p-8">
                <i class="fas fa-heart text-red-500 text-4xl mb-4 inline-block animate-pulse"></i>
                <h2 class="text-3xl font-bold text-white mb-4">Thank You! 🙏</h2>
                <p class="text-gray-300 text-lg leading-relaxed max-w-2xl mx-auto">
                    Whether you donate or not, thank you for using iNeedCinema! Your support—in any form—makes 
                    this project possible and motivates me to keep improving it.
                </p>
                <p class="text-gray-400 mt-4 text-sm">
                    - The Developer
                </p>
            </div>

        </div>

        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mt-12 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-all duration-300">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>

    <!-- GCash Modal - Mobile Optimized -->
    <div id="gcashModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-gray-900 border border-gray-700 rounded-2xl w-full max-w-[calc(100vw-1.5rem)] sm:max-w-md p-4 sm:p-8 relative animate-fadeIn">
            <!-- Close Button - Mobile Optimized -->
            <button 
                onclick="closeGCashModal()" 
                class="absolute top-2 right-2 sm:top-4 sm:right-4 text-gray-400 hover:text-white transition-colors p-2 touch-manipulation"
                style="min-width: 44px; min-height: 44px;"
            >
                <i class="fas fa-times text-lg sm:text-2xl"></i>
            </button>

            <!-- Header - Mobile Optimized -->
            <div class="text-center mb-4 sm:mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-green-500/20 rounded-2xl mb-3 sm:mb-4">
                    <i class="fas fa-mobile-alt text-green-400 text-2xl sm:text-3xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-white mb-2">GCash Donation</h3>
                <p class="text-gray-400 text-xs sm:text-sm">Support from the Philippines 🇵🇭</p>
            </div>

            <!-- GCash QR Code - Mobile Optimized -->
            <div class="bg-white rounded-xl p-3 sm:p-4 mb-4 sm:mb-6">
                <div class="text-center">
                    <img src="{{ asset('images/gcash-qr.jpg') }}" alt="GCash QR Code" class="w-36 sm:w-48 mx-auto rounded-lg shadow-lg">
                </div>
            </div>

            <!-- Privacy Notice - Mobile Optimized -->
            <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-3 sm:p-4 mb-4 sm:mb-6">
                <div class="flex items-start gap-2 sm:gap-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-green-400 text-base sm:text-xl"></i>
                    </div>
                    <div class="text-gray-300 text-xs sm:text-sm">
                        <p class="font-semibold text-green-400 mb-1">Privacy Protected</p>
                        <p class="text-xs leading-relaxed">
                            For your security, only the QR code is provided. Simply scan with your GCash app to donate. 
                            No personal details are displayed publicly.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Instructions - Mobile Optimized -->
            <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-3 sm:p-4 mb-4 sm:mb-6">
                <h4 class="text-blue-400 font-semibold mb-2 text-xs sm:text-sm flex items-center gap-2">
                    <i class="fas fa-info-circle"></i>
                    How to donate via GCash:
                </h4>
                <ol class="text-gray-300 text-xs space-y-1.5 list-decimal list-inside">
                    <li>Open your <strong>GCash app</strong></li>
                    <li>Tap the <strong>QR icon</strong> (Scan QR)</li>
                    <li><strong>Scan the QR code</strong> above</li>
                    <li>Enter amount (₱20, ₱50, ₱100, or any amount)</li>
                    <li>Optional: Add "<strong>iNeedCinema</strong>" in message</li>
                    <li>Confirm and send! 🎉</li>
                </ol>
            </div>

            <!-- Thank You -->
            <div class="text-center">
                <p class="text-gray-400 text-sm">
                    <i class="fas fa-heart text-red-500 mr-1"></i>
                    Thank you for supporting this project!
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // GCash Modal Functions
    function showGCashModal() {
        document.getElementById('gcashModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        // Reset to hidden state when opening modal
        hideGCashDetails();
    }

    function closeGCashModal() {
        document.getElementById('gcashModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        // Reset to hidden state when closing
        hideGCashDetails();
    }

    // Privacy Protection: Reveal GCash details
    function revealGCashDetails() {
        document.getElementById('gcashDetailsHidden').classList.add('hidden');
        document.getElementById('gcashDetailsRevealed').classList.remove('hidden');
    }

    // Privacy Protection: Hide GCash details
    function hideGCashDetails() {
        document.getElementById('gcashDetailsHidden').classList.remove('hidden');
        document.getElementById('gcashDetailsRevealed').classList.add('hidden');
    }

    function copyGCashNumber() {
        const number = '09913753717'; // Your actual GCash number
        navigator.clipboard.writeText(number).then(() => {
            // Show copied feedback
            const icon = event.target.closest('button').querySelector('i');
            const originalClass = icon.className;
            icon.className = 'fas fa-check';
            
            // Show success message
            const button = event.target.closest('button');
            const originalTitle = button.title;
            button.title = 'Copied!';
            
            setTimeout(() => {
                icon.className = originalClass;
                button.title = originalTitle;
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy:', err);
            alert('Failed to copy. Please copy manually: 09913753717');
        });
    }

    // Close modal when clicking outside
    document.getElementById('gcashModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeGCashModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeGCashModal();
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>

@endsection
