@extends('layouts.app')

@section('title', 'Privacy Policy - iNeedCinema')
@section('description', 'Privacy Policy for iNeedCinema. Learn how we handle your data.')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-900 to-black">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl mb-4">
                    <i class="fas fa-user-lock text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                    Privacy Policy
                </h1>
                <p class="text-gray-400">Last Updated: {{ date('F d, Y') }}</p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-4xl mx-auto bg-gray-800/30 backdrop-blur-xl rounded-2xl border border-gray-700/50 p-8 md:p-12 space-y-8">
            
            <!-- Introduction -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                    Introduction
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    iNeedCinema ("we", "our", or "us") respects your privacy. This Privacy Policy explains what information 
                    we collect, how we use it, and your rights regarding your data.
                </p>
            </section>

            <!-- No Account System -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-user-slash text-green-500 mr-3"></i>
                    No User Accounts
                </h2>
                <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-6">
                    <p class="text-green-200 font-semibold mb-2">✓ Privacy-Focused</p>
                    <p class="text-gray-300 leading-relaxed">
                        iNeedCinema does NOT require user registration or accounts. You can browse and use our Service 
                        anonymously without providing any personal information.
                    </p>
                </div>
            </section>

            <!-- Information We Collect -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-database text-purple-500 mr-3"></i>
                    Information We Collect
                </h2>
                <div class="text-gray-300 space-y-4">
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">1. Minimal Data Collection</h3>
                        <p class="mb-2">Our website collects <strong>very minimal data</strong>. We automatically collect:</p>
                        <ul class="list-disc list-inside space-y-1 ml-4">
                            <li><strong>Laravel Session Cookies:</strong> Essential for CSRF protection and basic functionality</li>
                            <li><strong>Search Cache:</strong> Stored <em>locally in your browser</em> for faster results (not sent to server)</li>
                            <li><strong>Standard Web Logs:</strong> IP address, browser type, timestamps (standard server logs for security)</li>
                        </ul>
                        <p class="mt-3 text-sm text-green-400">
                            ✓ We do NOT track you with analytics, pixels, or third-party cookies<br>
                            ✓ We do NOT collect personal information, emails, or user profiles<br>
                            ✓ We do NOT store your viewing history on our servers
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">2. Search Data</h3>
                        <p>
                            Your search queries are temporarily cached <strong>in your browser's local storage</strong> for faster results. 
                            This data never leaves your device and is NOT sent to our servers or third parties.
                        </p>
                    </div>
                </div>
            </section>

            <!-- How We Use Information -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-cogs text-yellow-500 mr-3"></i>
                    How We Use Your Information
                </h2>
                <div class="text-gray-300">
                    <p class="mb-3">We use collected information to:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Provide and maintain the Service</li>
                        <li>Improve user experience and functionality</li>
                        <li>Analyze usage patterns and trends</li>
                        <li>Prevent fraud and abuse</li>
                        <li>Ensure security and troubleshoot technical issues</li>
                    </ul>
                </div>
            </section>

            <!-- Third-Party Services -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-share-alt text-red-500 mr-3"></i>
                    Third-Party Services
                </h2>
                <div class="text-gray-300 space-y-4">
                    <p class="leading-relaxed">
                        Our Service integrates with third-party APIs that may collect their own data:
                    </p>
                    <div class="bg-gray-900/50 border border-gray-700 rounded-xl p-4 space-y-2">
                        <div>
                            <strong class="text-white">TMDB (The Movie Database):</strong>
                            <p class="text-sm">Provides movie, TV show, and anime metadata. See their 
                                <a href="https://www.themoviedb.org/privacy-policy" target="_blank" class="text-blue-400 hover:text-blue-300">Privacy Policy</a>.
                            </p>
                        </div>
                        <div>
                            <strong class="text-white">VidLink API:</strong>
                            <p class="text-sm">Provides streaming links. We do not control their data practices.</p>
                        </div>
                        <div>
                            <strong class="text-white">Ko-fi (Optional Donations):</strong>
                            <p class="text-sm">If you choose to donate, your payment is processed by Ko-fi. See their 
                                <a href="https://ko-fi.com/home/privacy" target="_blank" class="text-blue-400 hover:text-blue-300">Privacy Policy</a>.
                            </p>
                        </div>
                    </div>
                    <p class="text-sm italic">
                        When you click on streaming links or donation buttons, you leave our Service and are subject to the 
                        privacy policies of those external sites.
                    </p>
                </div>
            </section>

            <!-- Cookies -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-cookie-bite text-orange-500 mr-3"></i>
                    Cookies & Local Storage
                </h2>
                <div class="text-gray-300 space-y-3">
                    <p class="leading-relaxed">
                        We use cookies and browser local storage for:
                    </p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li><strong>Essential functionality:</strong> CSRF protection, session management</li>
                        <li><strong>Search cache:</strong> Storing recent searches locally for faster results</li>
                        <li><strong>User preferences:</strong> Remembering your settings (if implemented)</li>
                    </ul>
                    <p class="leading-relaxed mt-4">
                        You can disable cookies in your browser settings, but this may affect Service functionality.
                    </p>
                </div>
            </section>

            <!-- Data Security -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-lock text-cyan-500 mr-3"></i>
                    Data Security
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    We implement reasonable security measures to protect your data. However, no internet transmission is 
                    100% secure. Since we don't collect personal information or require accounts, your risk is minimal.
                </p>
            </section>

            <!-- Your Rights -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-balance-scale text-blue-500 mr-3"></i>
                    Your Rights
                </h2>
                <div class="text-gray-300 space-y-2">
                    <p>You have the right to:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Clear your browser cookies and local storage at any time</li>
                        <li>Use browser privacy/incognito mode for anonymous browsing</li>
                        <li>Request information about data we collect (minimal anonymous usage data)</li>
                        <li>Stop using the Service at any time</li>
                    </ul>
                </div>
            </section>

            <!-- Children's Privacy -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-child text-pink-500 mr-3"></i>
                    Children's Privacy
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    Our Service is not intended for children under 13. We do not knowingly collect information from children. 
                    If you believe a child has provided us with personal information, please contact us.
                </p>
            </section>

            <!-- Changes to Policy -->
            <section>
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-edit text-green-500 mr-3"></i>
                    Changes to This Policy
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    We may update this Privacy Policy periodically. Changes will be posted on this page with an updated "Last Updated" date. 
                    Continued use of the Service constitutes acceptance of the updated policy.
                </p>
            </section>

            <!-- Contact -->
            <section class="border-t border-gray-700/50 pt-8">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-envelope text-red-500 mr-3"></i>
                    Contact Us
                </h2>
                <p class="text-gray-300 leading-relaxed">
                    For questions about this Privacy Policy, please review the information provided on our website.
                </p>
            </section>

        </div>

        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</div>
@endsection
