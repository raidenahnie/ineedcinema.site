@extends('layouts.app')

@section('title', 'Terms of Service - iNeedCinema')
@section('description', 'Terms of Service and legal information for iNeedCinema streaming aggregator.')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-900 to-black">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-red-600 to-orange-500 rounded-2xl mb-4">
                    <i class="fas fa-file-contract text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                    Terms of Service
                </h1>
                <p class="text-gray-400">Last Updated: {{ date('F d, Y') }}</p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-4xl mx-auto bg-gray-800/30 backdrop-blur-xl rounded-2xl border border-gray-700/50 p-8 md:p-12 space-y-8">
            
            <!-- Acceptance -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-3"></i>
                    Acceptance of Terms
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    By accessing and using iNeedCinema (the "Service"), you accept and agree to be bound by these Terms of Service. 
                    If you do not agree to these terms, please do not use the Service.
                </p>
            </section>

            <!-- Content Disclaimer -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                    Content Disclaimer
                </h2>
                <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-6 mb-4">
                    <p class="text-yellow-200 font-semibold mb-2">⚠️ IMPORTANT NOTICE</p>
                    <ul class="text-gray-300 space-y-2 list-disc list-inside">
                        <li><strong>No Content Hosting:</strong> iNeedCinema does NOT host, store, or upload any video files on its servers.</li>
                        <li><strong>Third-Party Sources:</strong> All content is provided through third-party APIs and external streaming services.</li>
                        <li><strong>Content Aggregator:</strong> We are a content discovery and aggregation platform only.</li>
                        <li><strong>No Ownership:</strong> We do not own, produce, or distribute any movies, TV shows, or anime displayed on this website.</li>
                        <li><strong>No Copyright Infringement:</strong> All trademarks, logos, and copyrighted materials belong to their respective owners.</li>
                    </ul>
                </div>
                <p class="text-gray-300 leading-relaxed">
                    The Service uses The Movie Database (TMDB) API for content metadata and third-party streaming APIs for playback links. 
                    We have no control over the content provided by these external sources.
                </p>
            </section>

            <!-- User Responsibilities -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-user-shield text-blue-500 mr-3"></i>
                    User Responsibilities
                </h2>
                <div class="text-gray-300 space-y-3">
                    <p>As a user of this Service, you agree to:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Use the Service for personal, non-commercial purposes only</li>
                        <li>Comply with all applicable local, state, national, and international laws</li>
                        <li>Respect intellectual property rights of content owners</li>
                        <li>Not attempt to circumvent any security measures or access controls</li>
                        <li>Not use automated systems (bots, scrapers) to access the Service</li>
                        <li>Verify the legality of streaming content in your jurisdiction</li>
                    </ul>
                </div>
            </section>

            <!-- DMCA & Copyright -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-copyright text-purple-500 mr-3"></i>
                    Copyright & DMCA
                </h2>
                <div class="text-gray-300 space-y-3">
                    <p class="leading-relaxed">
                        We respect intellectual property rights. Since we do not host any content, copyright concerns should be directed to:
                    </p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>The original content owners</li>
                        <li>The third-party streaming services providing the content</li>
                        <li>TMDB (The Movie Database) for metadata concerns</li>
                    </ul>
                    <p class="leading-relaxed mt-4">
                        If you believe any content linked from our Service infringes your copyright, please contact the appropriate 
                        third-party service provider directly. We will cooperate with legitimate DMCA takedown requests by removing 
                        links to allegedly infringing content.
                    </p>
                </div>
            </section>

            <!-- Limitation of Liability -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-red-500 mr-3"></i>
                    Limitation of Liability
                </h2>
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6">
                    <p class="text-gray-300 leading-relaxed">
                        <strong>THE SERVICE IS PROVIDED "AS IS" WITHOUT WARRANTIES OF ANY KIND.</strong> We are not liable for:
                    </p>
                    <ul class="text-gray-300 space-y-2 list-disc list-inside mt-3">
                        <li>Content availability, accuracy, or quality from third-party sources</li>
                        <li>Any damages arising from use or inability to use the Service</li>
                        <li>Actions taken by third-party content providers</li>
                        <li>Legal consequences of content streaming in your jurisdiction</li>
                        <li>Data loss, service interruptions, or technical issues</li>
                    </ul>
                </div>
            </section>

            <!-- Third-Party Services -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-link text-green-500 mr-3"></i>
                    Third-Party Services
                </h2>
                <div class="text-gray-300 space-y-3">
                    <p class="leading-relaxed">Our Service integrates with:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li><strong>TMDB API:</strong> For movie, TV show, and anime metadata</li>
                        <li><strong>VidLink API:</strong> For streaming links</li>
                        <li><strong>Other streaming providers:</strong> As available</li>
                    </ul>
                    <p class="leading-relaxed mt-4">
                        These services have their own Terms of Service and Privacy Policies. We are not responsible for their practices, 
                        content, or availability.
                    </p>
                </div>
            </section>

            <!-- Changes to Terms -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-sync-alt text-cyan-500 mr-3"></i>
                    Changes to Terms
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    We reserve the right to modify these Terms of Service at any time. Changes will be effective immediately upon posting. 
                    Your continued use of the Service after changes constitutes acceptance of the modified terms.
                </p>
            </section>

            <!-- Donations & Support -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-heart text-pink-500 mr-3"></i>
                    Voluntary Donations
                </h2>
                <div class="bg-pink-500/10 border border-pink-500/30 rounded-xl p-6">
                    <p class="text-gray-300 leading-relaxed mb-3">
                        Users may voluntarily support the developer through donation platforms like Ko-fi. Please note:
                    </p>
                    <ul class="text-gray-300 space-y-2 list-disc list-inside">
                        <li><strong>Completely Optional:</strong> All donations are 100% voluntary with no obligation</li>
                        <li><strong>No Content Access:</strong> Donations do NOT unlock content, features, or special access</li>
                        <li><strong>Supporting Development:</strong> Donations support the developer and cover server costs, NOT content acquisition</li>
                        <li><strong>Non-Refundable:</strong> Donations are final and support ongoing development</li>
                        <li><strong>Third-Party Processing:</strong> Payments are processed by Ko-fi/PayPal, not by iNeedCinema</li>
                        <li><strong>No Guarantees:</strong> Donations do not guarantee specific features, updates, or service levels</li>
                    </ul>
                    <p class="text-gray-400 text-sm mt-4 italic">
                        All content remains free and accessible regardless of donation status. This is a passion project supported by the community.
                    </p>
                </div>
            </section>

            <!-- Contact -->
            <section class="border-t border-gray-700/50 pt-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-envelope text-red-500 mr-3"></i>
                    Contact & Questions
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    For questions about these Terms of Service, please review our disclaimer in the footer or check the FAQ section.
                </p>
            </section>

        </div>

        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-xl hover:shadow-lg hover:shadow-red-500/50 transition-all duration-300">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</div>
@endsection
