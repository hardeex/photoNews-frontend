@extends('base.base')
@section('title', ucwords(strtolower($post['title'])))

@section('content')
    <meta name="api-base-url" content="{{ config('api.base_url') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>        
        body {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }
        
        .official-seal {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: 3px solid #1e40af;
            width: 100px;
            height: 100px;
        }
        
        .notice-header {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-left: 8px solid #2563eb;
            padding: 2rem;
        }
        
        .priority-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            animation: pulse 2s infinite;
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .notice-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        
        .notice-content p {
            margin-bottom: 1.5rem;
        }
        
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 10rem;
            color: rgba(37, 99, 235, 0.05);
            font-weight: bold;
            z-index: 1;
            pointer-events: none;
            opacity: 0.3;
        }
        
        .content-wrapper {
            position: relative;
            z-index: 2;
        }
        
        .signature-section {
            border-top: 3px solid #2563eb;
            background: #f8fafc;
            padding: 2rem;
        }
        
        .print-only {
            display: none;
        }
        
        /* Improved button styling for better visibility */
        .action-button {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 8px;
            min-width: 220px;
            margin: 0.5rem;
        }
        
        /* Larger text for important elements */
        .notice-title {
            font-size: 2rem;
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }
        
        /* Enhanced contrast for better readability */
        .text-high-contrast {
            color: #111;
        }
        
        /* Increased spacing between sections */
        .section-spacing {
            margin-bottom: 3rem;
        }
        
        /* Larger click targets for interactive elements */
        .click-target {
            padding: 1rem;
        }
        
        /* Simplified layout for smaller screens */
        @media (max-width: 768px) {
            body {
                font-size: 16px;
            }
            
            .notice-title {
                font-size: 1.5rem;
            }
            
            .official-seal {
                width: 80px;
                height: 80px;
            }
            
            .watermark {
                font-size: 6rem;
            }
        }
        
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            .watermark { display: none; }
            body { 
                background: white !important; 
                font-size: 16pt;
            }
            .notice-content {
                font-size: 16pt;
            }
        }
    </style>

    @if ($post)
        <!-- Watermark -->
        <div class="watermark">OFFICIAL</div>
        
        <div class="content-wrapper bg-gray-50 min-h-screen pb-12">
            <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Official Header -->
                <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-10 section-spacing">
                    <!-- Government Seal and Title -->
                    <div class="bg-blue-600 text-white py-8">
                        <div class="max-w-4xl mx-auto px-6 flex items-center justify-center">
                            <div class="text-center">
                                <!-- Official Seal -->
                                <div class="official-seal rounded-full mx-auto mb-6 flex items-center justify-center">
                                    <i class="fas fa-university text-white text-3xl"></i>
                                </div>
                                <h1 class="text-3xl font-bold mb-4">OFFICIAL PUBLIC NOTICE</h1>
                                <p class="text-blue-100 text-xl">{{ config('app.name', 'Government Authority') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notice Header Information -->
                    <div class="notice-header">
                        <div class="max-w-4xl mx-auto">
                            <div class="flex flex-wrap items-center justify-between gap-6 mb-6">
                                <!-- Notice Number -->
                                <div class="flex items-center">
                                    <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-base font-semibold">
                                        Notice #{{ $post['id'] ?? 'N/A' }}
                                    </span>
                                </div>
                                
                                <!-- Priority Badge -->
                                @if(isset($post['priority']) && $post['priority'] === 'high')
                                    <div class="priority-badge text-white rounded-full text-base font-bold">
                                        <i class="fas fa-exclamation-triangle mr-2"></i> URGENT NOTICE
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Title -->
                            <h2 class="notice-title font-bold text-high-contrast">
                                {{ ucwords(strtolower($post['title'])) }}
                            </h2>
                            
                            <!-- Meta Information -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-base text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-600 mr-3 text-xl"></i>
                                    <span><strong>Published:</strong> {{ \Carbon\Carbon::parse($post['created_at'])->format('F d, Y') }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-blue-600 mr-3 text-xl"></i>
                                    <span><strong>Time:</strong> {{ \Carbon\Carbon::parse($post['created_at'])->format('g:i A') }}</span>
                                </div>
                                
                                @if(isset($post['effective_date']))
                                <div class="flex items-center">
                                    <i class="fas fa-play-circle text-blue-600 mr-3 text-xl"></i>
                                    <span><strong>Effective:</strong> {{ \Carbon\Carbon::parse($post['effective_date'])->format('F d, Y') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Notice Content -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden section-spacing">
                    <div class="max-w-4xl mx-auto p-8">
                        
                        <!-- Category Badge -->
                        @if (isset($post['category_names']) || (isset($post['category']) && isset($post['category']['name'])))
                            <div class="mb-8">
                                <span class="inline-flex items-center px-5 py-3 rounded-full text-base font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                    <i class="fas fa-tag mr-3"></i>
                                    {{ isset($post['category_names'])
                                        ? ucwords(strtolower($post['category_names']))
                                        : ucwords(strtolower($post['category']['name'])) }}
                                </span>
                            </div>
                        @endif

                        <!-- Notice Content -->
                        <div class="notice-content text-high-contrast">
                            <div class="leading-relaxed space-y-6">
                                {!! $post['content'] !!}
                            </div>
                        </div>

                        <!-- Important Information Box -->
                        <div class="mt-10 bg-blue-50 border-l-6 border-blue-500 p-8 rounded-r-lg">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 text-2xl mt-1 mr-4"></i>
                                <div>
                                    <h4 class="text-blue-800 font-semibold mb-4 text-xl">Important Information</h4>
                                    <p class="text-blue-700 text-lg">
                                        This is an official public notice. Please read carefully and take note of any deadlines or requirements mentioned above.
                                        For questions or clarifications, contact the issuing authority using the information provided below.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mt-10 bg-gray-50 rounded-xl p-8">
                            <h4 class="text-gray-900 font-semibold mb-6 text-xl flex items-center">
                                <i class="fas fa-address-book text-blue-600 mr-3 text-2xl"></i>
                                Contact Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg text-gray-700">
                                <div class="space-y-3">
                                    <p><strong>Department:</strong> Public Affairs Office</p>
                                    <p><strong>Phone:</strong> +1 (234) 814841 3982</p>
                                </div>
                                <div class="space-y-3">
                                    <p><strong>Email:</strong> support@essentialnews.ng</p>
                                    <p><strong>Office Hours:</strong> Mon-Fri, 9:00 AM - 5:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="signature-section bg-white rounded-xl shadow-lg mt-10">
                    <div class="max-w-4xl mx-auto">
                        <div class="flex flex-col md:flex-row justify-between items-end space-y-8 md:space-y-0">
                            <div class="text-center md:text-left">
                                <div class="border-t-3 border-gray-400 pt-4 mb-4" style="width: 250px;">
                                    <p class="text-lg text-gray-600">Authorized Signature</p>
                                </div>
                                <p class="font-semibold text-gray-800 text-xl">Director of Public Affairs</p>
                                <p class="text-lg text-gray-600">{{ \Carbon\Carbon::parse($post['created_at'])->format('F d, Y') }}</p>
                            </div>
                            
                            <div class="official-seal rounded-full flex items-center justify-center">
                                <i class="fas fa-stamp text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="no-print mt-12 flex flex-wrap gap-4 justify-center">
                    <button onclick="window.print()" 
                            class="action-button bg-blue-600 hover:bg-blue-700 text-white font-semibold flex items-center justify-center transition-colors click-target">
                        <i class="fas fa-print mr-3 text-xl"></i> Print Notice
                    </button>
                    
                    <button onclick="downloadPDF()" 
                            class="action-button bg-white hover:bg-gray-50 text-blue-600 border-3 border-blue-600 font-semibold flex items-center justify-center transition-colors click-target">
                        <i class="fas fa-download mr-3 text-xl"></i> Download PDF
                    </button>
                    
                    <button onclick="shareNotice()" 
                            class="action-button bg-gray-600 hover:bg-gray-700 text-white font-semibold flex items-center justify-center transition-colors click-target">
                        <i class="fas fa-share-alt mr-3 text-xl"></i> Share Notice
                    </button>
                </div>

                <!-- Share Modal (Hidden by default) -->
                <div id="shareModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
                    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-900">Share This Notice</h3>
                            <button onclick="closeShareModal()" class="text-gray-500 hover:text-gray-700 text-2xl click-target">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <a href="{{ 'https://twitter.com/intent/tweet?url=' . urlencode(request()->url()) . '&text=' . urlencode('Public Notice: ' . $post['title']) }}"
                               target="_blank" 
                               class="flex items-center gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors click-target text-lg">
                                <i class="fab fa-twitter text-blue-400 text-2xl"></i>
                                <span>Share on Twitter</span>
                            </a>
                            
                            <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(request()->url()) }}"
                               target="_blank"
                               class="flex items-center gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors click-target text-lg">
                                <i class="fab fa-facebook text-blue-600 text-2xl"></i>
                                <span>Share on Facebook</span>
                            </a>
                            
                            <a href="{{ 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(request()->url()) . '&title=' . urlencode('Public Notice: ' . $post['title']) }}"
                               target="_blank"
                               class="flex items-center gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors click-target text-lg">
                                <i class="fab fa-linkedin text-blue-700 text-2xl"></i>
                                <span>Share on LinkedIn</span>
                            </a>
                            
                            <button onclick="copyNoticeUrl()" 
                                    class="w-full flex items-center gap-4 p-4 rounded-lg hover:bg-gray-50 transition-colors click-target text-lg">
                                <i class="fas fa-link text-gray-600 text-2xl"></i>
                                <span>Copy Link</span>
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>

        <script>
            function shareNotice() {
                document.getElementById('shareModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
            }
            
            function closeShareModal() {
                document.getElementById('shareModal').classList.add('hidden');
                document.body.style.overflow = ''; // Re-enable scrolling
            }
            
            function copyNoticeUrl() {
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(function() {
                    alert('Notice URL has been copied to your clipboard!');
                    closeShareModal();
                }, function(err) {
                    console.error('Could not copy text: ', err);
                    alert('Failed to copy URL. Please try again or copy manually.');
                });
            }
            
            function downloadPDF() {
                // In a real implementation, this would generate or fetch a PDF
                alert('For your convenience, we recommend using the Print button and selecting "Save as PDF" from your printer options.');
            }
            
            // Close modal when clicking outside
            document.getElementById('shareModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeShareModal();
                }
            });
            
            // Larger font size toggle for accessibility
            function increaseFontSize() {
                const body = document.body;
                const currentSize = parseFloat(window.getComputedStyle(body, null).getPropertyValue('font-size'));
                body.style.fontSize = (currentSize + 2) + 'px';
            }
            
            function decreaseFontSize() {
                const body = document.body;
                const currentSize = parseFloat(window.getComputedStyle(body, null).getPropertyValue('font-size'));
                body.style.fontSize = (currentSize - 2) + 'px';
            }
            
            // Add these functions to buttons if you want font size controls
        </script>

    @else
        <div class="max-w-4xl mx-auto px-4 py-20 text-center">
            <div class="bg-white rounded-xl shadow-lg p-10">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-8xl mb-6"></i>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Notice Not Found</h2>
                <p class="text-gray-600 text-xl mb-8">The requested public notice could not be found or may have been removed.</p>
                <a href="{{ url()->previous() }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold inline-flex items-center text-xl click-target">
                    <i class="fas fa-arrow-left mr-3"></i> Go Back
                </a>
            </div>
        </div>
    @endif
@endsection