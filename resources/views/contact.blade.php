@extends('layouts.app')

@section('title', 'Contact Us - iNeedCinema')
@section('description', 'Get in touch with iNeedCinema. Send us your questions, feedback, or report issues.')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-900 to-black py-12 px-4">
    <div class="container mx-auto max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-block p-4 bg-gradient-to-br from-red-600 to-red-500 rounded-2xl shadow-lg shadow-red-500/30 mb-6">
                <i class="fas fa-envelope text-white text-4xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="bg-gradient-to-r from-white via-gray-200 to-gray-400 bg-clip-text text-transparent">
                    Get In Touch
                </span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Have questions, feedback, or need help? We'd love to hear from you!
                Fill out the form below and we'll get back to you as soon as possible.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <!-- Contact Form (2/3 width on desktop) -->
            <div class="md:col-span-2">
                <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700/50 rounded-2xl p-6 md:p-8 shadow-2xl">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <i class="fas fa-paper-plane text-red-500"></i>
                        Send Us a Message
                    </h2>

                    <form id="contactForm" action="https://api.web3forms.com/submit" method="POST" class="space-y-6">
                        <!-- Web3Forms Access Key -->
                        <input type="hidden" name="access_key" value="YOUR_ACCESS_KEY_HERE">
                        <input type="hidden" name="subject" value="New Contact from iNeedCinema">
                        <input type="hidden" name="from_name" value="iNeedCinema Contact Form">
                        <input type="hidden" name="redirect" value="{{ url('/contact?success=true') }}">
                        
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-user text-red-500 mr-2"></i>Your Name *
                            </label>
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   placeholder="John Doe" 
                                   required
                                   class="w-full bg-gray-900/50 text-white placeholder-gray-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500/50 border border-gray-700/50 hover:border-gray-600 transition-all">
                        </div>
                        
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-envelope text-red-500 mr-2"></i>Your Email *
                            </label>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   placeholder="john@example.com" 
                                   required
                                   class="w-full bg-gray-900/50 text-white placeholder-gray-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500/50 border border-gray-700/50 hover:border-gray-600 transition-all">
                        </div>
                        
                        <!-- Subject Field -->
                        <div>
                            <label for="contact_subject" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-tag text-red-500 mr-2"></i>Subject
                            </label>
                            <select id="contact_subject" 
                                    name="contact_subject"
                                    class="w-full bg-gray-900/50 text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500/50 border border-gray-700/50 hover:border-gray-600 transition-all">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Bug Report">Bug Report</option>
                                <option value="Feature Request">Feature Request</option>
                                <option value="Content Issue">Content Issue (DMCA)</option>
                                <option value="Support">Support</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <!-- Message Field -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-comment text-red-500 mr-2"></i>Your Message *
                            </label>
                            <textarea id="message"
                                      name="message" 
                                      placeholder="Tell us what's on your mind..." 
                                      rows="6" 
                                      required
                                      class="w-full bg-gray-900/50 text-white placeholder-gray-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500/50 border border-gray-700/50 hover:border-gray-600 transition-all resize-none"></textarea>
                        </div>
                        
                        <!-- Honeypot Spam Protection -->
                        <input type="checkbox" name="botcheck" class="hidden" style="display: none;">
                        
                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3 shadow-lg shadow-red-500/30 hover:shadow-red-500/50">
                            <i class="fas fa-paper-plane"></i>
                            <span>Send Message</span>
                        </button>
                        
                        <!-- Success/Error Messages -->
                        <div id="formMessage" class="hidden"></div>
                    </form>
                </div>
            </div>

            <!-- Contact Info Sidebar (1/3 width on desktop) -->
            <div class="space-y-6">
                <!-- Quick Links -->
                <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700/50 rounded-2xl p-6 shadow-xl">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-link text-red-500"></i>
                        Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('support') }}" class="flex items-center gap-3 text-gray-400 hover:text-red-500 transition-colors group">
                                <i class="fas fa-heart text-red-500 group-hover:scale-110 transition-transform"></i>
                                <span>Support Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="flex items-center gap-3 text-gray-400 hover:text-red-500 transition-colors group">
                                <i class="fas fa-file-contract text-blue-500 group-hover:scale-110 transition-transform"></i>
                                <span>Terms of Service</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('privacy') }}" class="flex items-center gap-3 text-gray-400 hover:text-red-500 transition-colors group">
                                <i class="fas fa-shield-alt text-green-500 group-hover:scale-110 transition-transform"></i>
                                <span>Privacy Policy</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Response Time -->
                <div class="bg-gradient-to-br from-blue-500/10 to-purple-500/10 border border-blue-500/30 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-start gap-3 mb-3">
                        <i class="fas fa-clock text-blue-400 text-2xl"></i>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Response Time</h3>
                            <p class="text-gray-400 text-sm">
                                We typically respond within <strong class="text-blue-400">24-48 hours</strong> during business days.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="bg-gray-800/50 backdrop-blur-xl border border-gray-700/50 rounded-2xl p-6 shadow-xl">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-share-alt text-red-500"></i>
                        Connect With Us
                    </h3>
                    <div class="flex gap-3">
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-700/50 hover:bg-blue-600 rounded-xl text-gray-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-700/50 hover:bg-sky-500 rounded-xl text-gray-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-700/50 hover:bg-pink-600 rounded-xl text-gray-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-700/50 hover:bg-red-600 rounded-xl text-gray-400 hover:text-white transition-all duration-300 hover:scale-110">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message (shown when redirected with success=true) -->
        @if(request()->get('success'))
        <div class="bg-green-500/20 border-2 border-green-500/50 rounded-2xl p-6 mb-8 animate-pulse">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-green-400 mb-2">Message Sent Successfully!</h3>
                    <p class="text-gray-300">
                        Thank you for reaching out! We've received your message and will get back to you as soon as possible.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- FAQ Section -->
        <div class="bg-gray-800/30 backdrop-blur-xl border border-gray-700/50 rounded-2xl p-6 md:p-8">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                <i class="fas fa-question-circle text-yellow-500"></i>
                Frequently Asked Questions
            </h2>
            <div class="space-y-4">
                <details class="bg-gray-800/50 rounded-xl p-4 group">
                    <summary class="cursor-pointer font-semibold text-white flex items-center justify-between group-hover:text-red-500 transition-colors">
                        <span><i class="fas fa-server text-red-500 mr-2"></i>Do you host the content?</span>
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-3 text-gray-400 text-sm pl-6">
                        No, iNeedCinema does not host any files. All content is provided by third-party services. We aggregate links from various sources.
                    </p>
                </details>

                <details class="bg-gray-800/50 rounded-xl p-4 group">
                    <summary class="cursor-pointer font-semibold text-white flex items-center justify-between group-hover:text-red-500 transition-colors">
                        <span><i class="fas fa-copyright text-blue-500 mr-2"></i>How do I report copyright issues?</span>
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-3 text-gray-400 text-sm pl-6">
                        Please use this contact form and select "Content Issue (DMCA)" as the subject. Include the specific URL and proof of ownership.
                    </p>
                </details>

                <details class="bg-gray-800/50 rounded-xl p-4 group">
                    <summary class="cursor-pointer font-semibold text-white flex items-center justify-between group-hover:text-red-500 transition-colors">
                        <span><i class="fas fa-bug text-purple-500 mr-2"></i>Found a bug?</span>
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-3 text-gray-400 text-sm pl-6">
                        We appreciate bug reports! Use the form above and select "Bug Report". Please include details like browser, device, and steps to reproduce.
                    </p>
                </details>

                <details class="bg-gray-800/50 rounded-xl p-4 group">
                    <summary class="cursor-pointer font-semibold text-white flex items-center justify-between group-hover:text-red-500 transition-colors">
                        <span><i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Have a feature request?</span>
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-3 text-gray-400 text-sm pl-6">
                        We love hearing your ideas! Select "Feature Request" and tell us what would make iNeedCinema better for you.
                    </p>
                </details>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Contact Form Handler with AJAX
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');
    
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('span');
            const btnIcon = submitBtn.querySelector('i');
            const originalText = btnText.textContent;
            
            // Show loading state
            btnText.textContent = 'Sending...';
            btnIcon.className = 'fas fa-spinner fa-spin';
            submitBtn.disabled = true;
            formMessage.classList.add('hidden');
            
            try {
                const formData = new FormData(contactForm);
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (response.ok && result.success) {
                    // Success - page will redirect via Web3Forms redirect
                    formMessage.className = 'text-sm p-4 rounded-xl bg-green-500/20 border border-green-500/50 text-green-400 animate-pulse';
                    formMessage.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Message sent successfully! Redirecting...';
                    formMessage.classList.remove('hidden');
                    
                    // Fallback redirect if Web3Forms redirect doesn't work
                    setTimeout(() => {
                        window.location.href = '{{ url("/contact?success=true") }}';
                    }, 2000);
                } else {
                    throw new Error(result.message || 'Failed to send message');
                }
            } catch (error) {
                console.error('Form submission error:', error);
                formMessage.className = 'text-sm p-4 rounded-xl bg-red-500/20 border border-red-500/50 text-red-400';
                formMessage.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i>Failed to send message. Please try again.';
                formMessage.classList.remove('hidden');
                
                btnText.textContent = originalText;
                btnIcon.className = 'fas fa-paper-plane';
                submitBtn.disabled = false;
            }
        });
    }
</script>
@endpush
@endsection
